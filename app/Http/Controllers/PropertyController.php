<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use App\Models\UserNotification;
use App\Models\PropertyDocument;
use App\Queries\PropertyDatatable;
use App\Repositories\PropertyRepository;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use DataTables;
use Laracasts\Flash\Flash;
use Exception;

class PropertyController extends AppBaseController
{
    private $propertyRepository;

    public function __construct(PropertyRepository $repo)
    {
        $this->propertyRepository = $repo;
    }

    /**
     * INDEX (LIKE LEAVE)
     */
    public function index(Request $request)
    {
        $isAdmin = auth()->user()->hasRole('Admin');

        if ($request->ajax()) {

            $query = (new PropertyDatatable())->get($request->only([
                'filter_user',
                'filter_status',
                'search',
            ]));

            if (!$isAdmin) {
                $query->where('owner_id', auth()->id());
            }

            return DataTables::of($query)

                ->editColumn('owner.name', fn($p) => $p->owner->name ?? 'N/A')

                ->editColumn('status', function ($p) {
                    $badge = $p->status == 'active' ? 'success'
                        : ($p->status == 'inactive' ? 'warning' : 'danger');

                    return '<span class="badge badge-'.$badge.'">'.ucfirst($p->status).'</span>';
                })

                ->editColumn('address', function ($p) {
                    $text = $p->address ?? '';
                    return mb_strlen($text) > 80
                        ? mb_substr($text, 0, 80).'...'
                        : $text;
                })

                ->addColumn('action', function ($p) use ($isAdmin) {

                    $view = '<a href="'.route('properties.show', $p->id).'" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>';
                    $edit = '<a href="'.route('properties.edit', $p->id).'" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>';
                    $delete = '<a href="#" data-id="'.$p->id.'" class="btn btn-sm btn-danger delete-btn"><i class="fas fa-trash"></i></a>';

                    return $isAdmin ? "$view $edit $delete" : "$view $edit";
                })

                ->filterColumn('owner.name', function (Builder $q, $search) {
                    $q->whereHas('owner', fn($sub) => $sub->where('name', 'like', "%$search%"));
                })

                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        $users = $isAdmin
            ? User::pluck('name', 'id')
            : User::where('id', auth()->id())->pluck('name', 'id');

        $statuses = Property::STATUSES;

        return view('properties.index', compact('users', 'statuses'));
    }

    /**
     * CREATE
     */
    public function create()
    {
        $users = auth()->user()->hasRole('Admin')
            ? User::pluck('name', 'id')
            : User::where('id', auth()->id())->pluck('name', 'id');

        $statuses = Property::STATUSES;

        return view('properties.create', compact('users', 'statuses'));
    }

    /**
     * STORE (LIKE LEAVE)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'owner_id' => 'required',
            'address' => 'required',
            'total_floors' => 'required|integer',
            'total_units' => 'required|integer',
        ]);

        $input = $request->all();
        $input['owner_id'] = $input['owner_id'] ?? auth()->id();
        $input['created_by'] = getLoggedInUserId();

        $property = $this->propertyRepository->create($input);

        // ✅ MULTIPLE DOCUMENT UPLOAD
        if ($request->hasFile('files')) {

            foreach ($request->file('files') as $file) {

                if ($file->isValid()) {

                    $fileName = $file->getClientOriginalName();
                    $filePath = PropertyDocument::PATH.'/'.$property->id;

                    $file->storeAs($filePath, $fileName, 'public');

                    PropertyDocument::create([
                        'property_id' => $property->id,
                        'file' => $fileName,
                        'document_type' => 'General',
                    ]);
                }
            }
        }

        // NOTIFICATION
        UserNotification::create([
            'title' => 'Property Created',
            'description' => 'A property has been created',
            'link' => url('/properties/'.$property->id),
            'type' => Property::class,
            'user_id' => $property->owner_id,
        ]);

        Flash::success('Property created successfully.');

        return redirect(route('properties.index'));
    }

    /**
     * SHOW
     */
    public function show($id)
    {
        $property = Property::findOrFail($id);

        // return $property;

        if (!auth()->user()->hasRole('Admin') && $property->owner_id !== auth()->id()) {
            Flash::error('Unauthorized');
            return redirect()->route('properties.index');
        }

        return view('properties.show', compact('property'));
    }

    /**
     * EDIT
     */
    public function edit(Property $property)
    {
        if (!auth()->user()->hasRole('Admin') && $property->owner_id !== auth()->id()) {
            Flash::error('Unauthorized');
            return redirect()->route('properties.index');
        }

        $users = auth()->user()->hasRole('Admin')
            ? User::pluck('name', 'id')
            : User::where('id', auth()->id())->pluck('name', 'id');

        $statuses = Property::STATUSES;

        return view('properties.edit', compact('property', 'users', 'statuses'));
    }

    /**
     * UPDATE (LIKE LEAVE)
     */
    public function update(Request $request, Property $property)
    {
        $this->propertyRepository->update($request->all(), $property->id);

        // ADD NEW DOCUMENTS
        if ($request->hasFile('files')) {

            foreach ($request->file('files') as $file) {

                if ($file->isValid()) {

                    $fileName = $file->getClientOriginalName();
                    $filePath = PropertyDocument::PATH.'/'.$property->id;

                    $file->storeAs($filePath, $fileName, 'public');

                    PropertyDocument::create([
                        'property_id' => $property->id,
                        'file' => $fileName,
                        'document_type' => 'General',
                    ]);
                }
            }
        }

        UserNotification::create([
            'title' => 'Property Updated',
            'description' => 'Property updated successfully',
            'link' => url('/properties/'.$property->id),
            'type' => Property::class,
            'user_id' => $property->owner_id,
        ]);

        Flash::success('Property updated successfully.');

        return redirect(route('properties.index'));
    }

    /**
     * DELETE
     */
    public function destroy(Property $property)
    {
        if (!auth()->user()->hasRole('Admin') && $property->owner_id !== auth()->id()) {
            return $this->sendError('Unauthorized');
        }

        $property->update(['deleted_by' => getLoggedInUserId()]);
        $property->delete();

        UserNotification::create([
            'title' => 'Property Deleted',
            'description' => 'Property deleted',
            'link' => url('/properties'),
            'type' => Property::class,
            'user_id' => $property->owner_id,
        ]);

        return $this->sendSuccess('Property Deleted Successfully.');
    }

    /**
 * Delete Property Attachment
 */

     public function deleteAttachment(PropertyDocument $attachment)
    {
        $property = $attachment->property;
    
        // DEBUG (optional)
        // dd($attachment->file_path);
    
        // Permission check (FIXED)
        if (
            !auth()->user()->hasRole('Admin') &&
            auth()->id() != $property->owner_id
        ) {
            return $this->sendError('You are not authorized to delete this attachment.');
        }
    
        // Delete file safely
        Storage::disk('public')->delete($attachment->file_path);
    
        // Delete DB record
        $attachment->delete();
    
        return $this->sendSuccess('Attachment deleted successfully.');
    }

    /**
 * Download Property Attachment
 */
    public function downloadAttachment($id)
    {
        try {
            $document = PropertyDocument::find($id);
            
    
            if (!$document) {
                return response()->json(['error' => 'Attachment not found'], 404);
            }
    
            // Multiple path support (IMPORTANT)
           $possiblePaths = [
    
               // Laravel default storage (RECOMMENDED)
               storage_path('app/public/' . $document->file_path),
           
               // public storage symlink path
               public_path('storage/' . $document->file_path),
           
               // direct uploads fallback (if you ever used move())
               public_path('uploads/' . $document->file_path),
           
               // fallback: property specific folder (your structure case)
               public_path('uploads/property_documents/' . $document->file),
           
               // storage fallback (old structure support)
               storage_path('app/public/uploads/property_documents/' . $document->file),
            ];
    
            $filePath = null;
    
            foreach ($possiblePaths as $path) {
                if (file_exists($path)) {
                    $filePath = $path;
                    break;
                }
            }
    
            // If file not found
            if (!$filePath) {
    
                // fallback URL
                if (filter_var($document->file_url, FILTER_VALIDATE_URL)) {
                    return redirect()->away($document->file_url);
                }
    
                abort(404, 'File not found.');
            }
    
            return response()->download($filePath, $document->file);
    
        } catch (\Exception $e) {
            \Log::error('Property download error: ' . $e->getMessage());
            abort(500, 'Download failed.');
        }
    }
}