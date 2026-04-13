<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CallRecord;
use App\Queries\CallRecordDatatable;
use App\Models\Extension;
use DataTables;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class CallRecordController extends Controller
{
    public function index(Request $request)
    {
        // Get employees for filter dropdown
        $employees = Extension::with('user')
            ->whereHas('user')
            ->get()
            ->pluck('user.name', 'id');
    
        // Default date range: last 1 month
        $endDate = Carbon::now();
        $startDate = Carbon::now()->subMonth();
    
        // Summary counts for cards
        $summary = CallRecord::whereBetween('call_date', [$startDate, $endDate])
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status'); // ['ANSWERED' => 10, 'BUSY' => 5 ...]
    
        // Unique numbers count
        $uniqueNumbers = CallRecord::whereBetween('call_date', [$startDate, $endDate])
            ->distinct('source')
            ->count('source');
    
        return view('callrecords.index', compact('employees', 'summary', 'uniqueNumbers', 'startDate', 'endDate'));
    }


    public function list(Request $request)
    {
        $query = (new CallRecordDatatable())->get($request->only([
            'filter_employee_name',
            'filter_status',
            'filter_call_date',
            'filter_created_at',
        ]));
    
        return DataTables::of($query)
            ->editColumn('call_date', function ($row) {
                return $row->call_date ? $row->call_date->format('Y-m-d H:i:s') : '';
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at ? $row->created_at->format('Y-m-d H:i:s') : '';
            })
            ->addColumn('recordings', function ($row) {
               if ($row->recordings) {
                   // Normal audio player
                   return '<audio controls>
                               <source src="' . $row->recordings . '" type="audio/wav">
                               Your browser does not support audio.
                           </audio>';
                } else {
                    // Disabled audio player with 0:00
                    return '<audio controls disabled>
                                <source src="" type="audio/wav">
                                00
                            </audio>';
                }
            })
            ->rawColumns(['recordings'])
            ->make(true);
    }

    /**
     * Import remains unchanged (kept for context).
     */
    public function import(Request $request)
    {
        $request->validate(['records' => 'required|array']);
        $imported = 0;

        foreach ($request->records as $record) {
            $exists = CallRecord::where('source', $record['source'] ?? null)
                ->where('call_date', $record['call_date'] ?? null)
                ->where('destination', $record['destination'] ?? null)
                ->exists();

            if (!$exists) {
                $employeeName = null;
                if (!empty($record['source'])) {
                    $extension = Extension::where('source', $record['source'])->first();
                    if ($extension && $extension->user) {
                        $employeeName = $extension->user->name;
                    }
                }

                CallRecord::create([
                    'company_name'  => $record['company_name'] ?? null,
                    'display_name'  => $record['display_name'] ?? null,
                    'call_date'     => $record['call_date'] ?? null,
                    'source'        => $record['source'] ?? null,
                    'destination'   => $record['destination'] ?? null,
                    'duration'      => $record['duration'] ?? 0,
                    'type'          => $record['type'] ?? null,
                    'status'        => $record['status'] ?? null,
                    'recordings'    => $record['recordings'] ?? null,
                    'employee_name' => $employeeName ?? 'Unknown',
                ]);
                $imported++;
            }
        }

        return response()->json(['message' => "Imported {$imported} records successfully."]);
    }

    public function summary(Request $request)
    {
        $data = (new CallRecordDatatable())->summary($request->only([
            'filter_employee_name',
            'filter_status',
            'filter_call_date',
            'filter_created_at',
        ]));
    
        return response()->json($data);
    }


}
