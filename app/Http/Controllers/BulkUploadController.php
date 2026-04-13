<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use App\Exports\LeadsTemplateExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\HeadingRowImport;
use App\Http\Requests\CreateLeadRequest;
use App\Http\Requests\BulkUploadLeadsRequest;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Validators\ValidationException;



class BulkUploadController extends Controller
{
    /**
     * Display the bulk upload page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('leads.bulk_upload');
    }

    /**
     * Download sample template.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadTemplate()
    {
        return Excel::download(new LeadsTemplateExport(), 'leads_template.xlsx');
    }

    /**
     * Import leads from uploaded Excel file.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        // Validate only the file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240',
        ]);

        $file = $request->file('file');

        // Validate headings
        HeadingRowFormatter::default('none');
        $headings = (new HeadingRowImport())->toArray($file);
        $expectedHeadings = (new LeadsTemplateExport())->headings();

        // if (empty($headings) || empty($headings[0]) || array_map('strtolower', $headings[0][0]) !== array_map('strtolower', $expectedHeadings)) {
        //     return redirect()->back()->withErrors([
        //         'file' => 'The uploaded file does not match the expected template. Please download the template and try again.'
        //     ]);
        // }

        try {
            Excel::import(new class implements ToModel, WithHeadingRow {
                public function model(array $row)
                {
                    // Skip if both name and email missing
                    if (empty($row['first_name']) && empty($row['email'])) {
                        return null;
                    }

                    return new Lead([
                        'first_name'  => $row['first_name'] ?? '',
                        'last_name'   => $row['last_name'] ?? '',
                        'email'       => $row['email'] ?? '',
                        'phone'       => $row['phone'] ?? '',
                        'source_id'   => $row['source'] ?? null,   // must map to ID
                        'stage_id'    => $row['stage'] ?? null,    // must map to ID
                        'assigned_to' => $row['assigned_to'] ?? null,
                        'job_title'   => $row['job_title'] ?? '',
                        'industry'    => $row['industry'] ?? '',
                        'company'     => $row['company'] ?? '',
                        'website'     => $row['website'] ?? '',
                        'linkedin'    => $row['linkedin'] ?? '',
                        'instagram'   => $row['instagram'] ?? '',
                        'facebook'    => $row['facebook'] ?? '',
                        'pinterest'   => $row['pinterest'] ?? '',
                        'city'        => $row['city'] ?? '',
                        'state'       => $row['state'] ?? '',
                        'zip'         => $row['zip'] ?? '',
                        'country'     => $row['country'] ?? '',
                        'description' => $row['description'] ?? '',
                        'created_by'  => auth()->id(),
                    ]);
                }
            }, $file);
        } catch (ValidationException $e) {
            $failures = $e->failures();
            $errorMessages = [];
            foreach ($failures as $failure) {
                $errorMessages[] = 'Row ' . $failure->row() . ': ' . implode(', ', $failure->errors());
            }
            return redirect()->back()->withErrors(['file' => 'Validation errors: ' . implode(' | ', $errorMessages)]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['file' => 'An error occurred: ' . $e->getMessage()]);
        }
         Flash::success('Leads imported successfully.');
        return redirect()->route('leads.index')->with('success', 'Leads imported successfully.');
    }
}
