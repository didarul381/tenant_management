<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectsInvoice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProjectsInvoiceController extends AppBaseController
{
    public function store(Project $project, Request $request): JsonResponse
    {
        $rules = [
            'paid' => 'required|integer|min:0',
            'in_word' => 'nullable|string',
            'for' => 'nullable|string',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        $price = (int) $project->price;
        $paid = (int) $request->input('paid', 0);
        if ($paid > $price) {
            return $this->sendError('Paid amount cannot exceed total amount.');
        }

        $invoiceCode = ProjectsInvoice::generateUniqueInvoice();

        $invoice = ProjectsInvoice::create([
            'client_id' => $project->client_id,
            'project_id' => $project->id,
            'status' => ProjectsInvoice::STATUS_PENDING,
            'created_by' => Auth::id(),
            'deleted_by' => null,
            'price' => $price,
            'paid' => $paid,
            'due' => $price - $paid,
            'invoice' => $invoiceCode,
            'in_word' => $request->input('in_word'),
            'for' => $request->input('for'),
        ]);

        // log activity for invoice creation
        activity()
            ->causedBy(getLoggedInUser())
            ->withProperties(['modal' => ProjectsInvoice::class, 'data' => 'of '.$project->name])
            ->performedOn($project)
            ->useLog('Invoice Created')
            ->log('Created invoice '.$invoice->invoice);

        return $this->sendResponse($invoice, 'Project invoice created successfully.');
    }

    public function show(ProjectsInvoice $invoice): JsonResponse
    {
        $user = Auth::user();
        if (! $user) {
            return $this->sendError('Unauthorized.', 403);
        }
        if (!($user->role === 'Admin' || $invoice->created_by === $user->id)) {
            return $this->sendError('Forbidden.', 403);
        }
        // log activity for invoice view
        $project = $invoice->project;
        if ($project) {
            activity()
                ->causedBy(getLoggedInUser())
                ->withProperties(['modal' => ProjectsInvoice::class, 'data' => 'of '.$project->name])
                ->performedOn($project)
                ->useLog('Invoice Viewed')
                ->log('Viewed invoice '.$invoice->invoice);
        }
        
        return $this->sendResponse($invoice->load(['project','client','createdUser']), 'Invoice retrieved successfully.');
    }

    public function update(ProjectsInvoice $invoice, Request $request): JsonResponse
    {
        $user = Auth::user();
        if (! $user) {
            return $this->sendError('Unauthorized.', 403);
        }

        $isAdmin = $user->role === 'Admin';
        $isCreatorAndPending = ($invoice->created_by === $user->id) && ($invoice->status === ProjectsInvoice::STATUS_PENDING);
        if (!($isAdmin || $isCreatorAndPending)) {
            return $this->sendError('Forbidden.', 403);
        }

        $rules = [
            'paid' => 'required|integer|min:0',
            'in_word' => 'nullable|string',
            'for' => 'nullable|string',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        $price = (int) $invoice->price;
        $paid = (int) $request->input('paid', 0);
        if ($paid > $price) {
            return $this->sendError('Paid amount cannot exceed total amount.');
        }

        $invoice->update([
            'paid' => $paid,
            'due' => $price - $paid,
            'in_word' => $request->input('in_word'),
            'for' => $request->input('for'),
        ]);

        // log activity for invoice update
        $project = $invoice->project;
        if ($project) {
            activity()
                ->causedBy(getLoggedInUser())
                ->withProperties(['modal' => ProjectsInvoice::class, 'data' => 'of '.$project->name])
                ->performedOn($project)
                ->useLog('Invoice Updated')
                ->log('Updated invoice '.$invoice->invoice);
        }

        return $this->sendResponse($invoice, 'Invoice updated successfully.');
    }

    public function destroy(ProjectsInvoice $invoice): JsonResponse
    {
         $user = Auth::user();
        if (! $user) {
            return $this->sendError('Unauthorized.', 403);
        }

        $isAdmin = $user->role === 'Admin';
        $isCreatorAndPending = ($invoice->created_by === $user->id) && ($invoice->status === ProjectsInvoice::STATUS_PENDING);
        if (!($isAdmin || $isCreatorAndPending)) {
            return $this->sendError('Forbidden.', 403);
        }

        $invoice->delete();
        // log activity for invoice delete
        $project = $invoice->project;
        if ($project) {
            activity()
                ->causedBy(getLoggedInUser())
                ->withProperties(['modal' => ProjectsInvoice::class, 'data' => 'of '.$project->name])
                ->performedOn($project)
                ->useLog('Invoice Deleted')
                ->log('Deleted invoice '.$invoice->invoice);
        }
        return $this->sendSuccess('Invoice deleted successfully.');
    }

    public function updateStatus(ProjectsInvoice $invoice, Request $request): JsonResponse
    {
        $user = Auth::user();
        if (! $user || $user->role !== 'Admin') {
            return $this->sendError('Forbidden.', 403);
        }
        $status = $request->input('status');
        if (!in_array($status, [ProjectsInvoice::STATUS_APPROVED, ProjectsInvoice::STATUS_REJECTED], true)) {
            return $this->sendError('Invalid status.');
        }

          // Only check for approval, rejection doesn't need payment validation
            if ($status === ProjectsInvoice::STATUS_APPROVED) {
                // Get the project
                $project = $invoice->project;
               
                if (!$project) {
                    return $this->sendError('Project not found.', 404);
                }
                
                // Get project price
                $projectPrice = $project->price ?? 0;
               
                if ($projectPrice <= 0) {
                    return $this->sendError('Cannot approve invoice for project with no price set.');
                }
                
                // Get total already approved paid amount for this project (excluding current invoice)
                $totalApprovedPaid = ProjectsInvoice::where('project_id', $project->id)
                    ->where('status', ProjectsInvoice::STATUS_APPROVED)
                    ->where('id', '!=', $invoice->id) // Exclude current invoice
                    ->sum('paid');
                
                // Current invoice amount
                $currentInvoiceAmount = $invoice->paid ?? 0;
                
                // Calculate new total if this invoice is approved
                $newTotal = $totalApprovedPaid + $currentInvoiceAmount;
                
                // Check if new total would exceed project price
                if ($newTotal > $projectPrice) {
                    $remaining = $projectPrice - $totalApprovedPaid;
                    return $this->sendError(
                        "Cannot Approving this invoice would exceed the project price. " .
                        "Project price: {$projectPrice} TK. Already approved: {$totalApprovedPaid} TK. " .
                        "This invoice amount: {$currentInvoiceAmount} TK. "
                    );
                }
                
                // Optional: Check if the invoice amount is 0 or negative
                if ($currentInvoiceAmount <= 0) {
                    return $this->sendError('Cannot approve invoice with zero or negative amount.');
                }
            }

        $invoice->update(['status' => $status]);

        // log activity for invoice status change
        $project = $invoice->project;
        if ($project) {
            $logName = $status === ProjectsInvoice::STATUS_APPROVED ? 'Invoice Approved' : 'Invoice Rejected';
            activity()
                ->causedBy(getLoggedInUser())
                ->withProperties(['modal' => ProjectsInvoice::class, 'data' => 'of '.$project->name])
                ->performedOn($project)
                ->useLog($logName)
                ->log(ucfirst($status).' invoice '.$invoice->invoice);
        }
        return $this->sendResponse($invoice, 'Invoice status updated.');
    }

    /**
     * Log printing a single invoice.
     */
    public function printedSingle(ProjectsInvoice $invoice): JsonResponse
    {
        $user = Auth::user();
        if (! $user) {
            return $this->sendError('Unauthorized.', 403);
        }
        if (!($user->role === 'Admin' || $invoice->created_by === $user->id)) {
            return $this->sendError('Forbidden.', 403);
        }
        $project = $invoice->project;
        if ($project) {
            activity()
                ->causedBy(getLoggedInUser())
                ->withProperties(['modal' => ProjectsInvoice::class, 'data' => 'of '.$project->name])
                ->performedOn($project)
                ->useLog('Invoice Printed')
                ->log('Printed invoice '.$invoice->invoice);
        }
        return $this->sendSuccess('Print logged.');
    }

    /**
     * Log printing all invoices in a project listing.
     */
    public function printedAll(Project $project): JsonResponse
    {
        $user = Auth::user();
        if (! $user) {
            return $this->sendError('Unauthorized.', 403);
        }
        // Allow Admin or project creator to log bulk print
        if (!($user->role === 'Admin' || $project->created_by === $user->id)) {
            return $this->sendError('Forbidden.', 403);
        }
        $count = $project->invoices()->count();
        activity()
            ->causedBy(getLoggedInUser())
            ->withProperties(['modal' => ProjectsInvoice::class, 'data' => 'of '.$project->name, 'count' => $count])
            ->performedOn($project)
            ->useLog('Invoices Printed')
            ->log('Printed '.$count.' invoices');

        return $this->sendSuccess('Bulk print logged.');
    }

    // single print view
    public function printView(ProjectsInvoice $invoice)
    {
        $user = Auth::user();
        if (! $user) abort(403);

        if (!($user->role === 'Admin' || $invoice->created_by === $user->id)) {
            abort(403);
        }

        $invoice->load(['project.client', 'createdUser']);

        return view('projects.invoice.print', compact('invoice'));

        }
}
