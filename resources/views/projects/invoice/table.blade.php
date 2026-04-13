@php
    $user = Auth::user();
    $canCreateInvoice = $user && ($user->role === 'Admin' || $user->id === $project->created_by);
@endphp

{{-- Table 1: Pending & Rejected --}}
<div class="d-flex justify-content-between align-items-center mb-2">
    <h6 class="mb-0">Pending & Rejected</h6>
    @if($canCreateInvoice)
        <button type="button" class="btn btn-light btn-sm print-invoices-btn" data-scope="pending_rejected" data-project-id="{{ $project->id }}" title="Print Pending & Rejected">
            <i class="fas fa-print"></i>
        </button>
    @endif
</div>

<div class="table-responsive" id="invoiceTablePendingRejected">
    <table class="table table-striped mb-4">
        <thead>
        <tr>
            <th>Invoice</th>
            <th>Status</th>
            <th>Price</th>
            <th>Paid</th>
            <th>Due</th>
            <th>Created At</th>
            @php /* $canCreateInvoice computed above */ @endphp
            @if($canCreateInvoice)
                <th class="no-print d-print-none">Action</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @php
            $pendingRejected = $project->invoices->filter(function($inv){
                return in_array($inv->status, [\App\Models\ProjectsInvoice::STATUS_PENDING, \App\Models\ProjectsInvoice::STATUS_REJECTED]);
            });
        @endphp
        @forelse($pendingRejected as $inv)
            @php
                $user = Auth::user();
                $isAdmin = $user && ($user->role === 'Admin');
                $isCreator = $user && ($user->id === $inv->created_by);
                $isPending = $inv->status === \App\Models\ProjectsInvoice::STATUS_PENDING;
                $isApprovedOrRejected = in_array($inv->status, [\App\Models\ProjectsInvoice::STATUS_APPROVED, \App\Models\ProjectsInvoice::STATUS_REJECTED]);
            @endphp
            <tr>
                <td>{{ $inv->invoice }}</td>
                <td class="text-capitalize">{{ $inv->status }}</td>
                <td><i class="{{ \App\Models\Project::getCurrencyClass($project->currency) }}"></i> {{ number_format($project->price) }}</td>
                <td><i class="{{ \App\Models\Project::getCurrencyClass($project->currency) }}"></i> {{ number_format($inv->paid) }}</td>
                <td><i class="{{ \App\Models\Project::getCurrencyClass($project->currency) }}"></i> {{ number_format(max(($project->price ?? 0) - ($inv->paid ?? 0), 0)) }}</td>
                <td>{{ $inv->created_at ? $inv->created_at->diffForHumans() : '' }}</td>
                @if($isAdmin || $isCreator )
                    <td class="no-print d-print-none">
                        @if($isAdmin)
                            <button type="button" class="btn btn-sm btn-success approve-invoice" data-id="{{ $inv->id }}" data-status="approved" title="Approve"><i class="fas fa-check" style="font-size:15px;"></i></button>
                            <button type="button" class="btn btn-sm btn-danger reject-invoice" data-id="{{ $inv->id }}" data-status="rejected" title="Reject"><i class="fas fa-times" style="font-size:15px;"></i></button>
                            <button type="button" class="btn btn-sm btn-primary edit-invoice" data-id="{{ $inv->id }}" title="Edit"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-sm btn-danger delete-invoice" data-id="{{ $inv->id }}" title="Delete"><i class="fas fa-trash"></i></button>
                        @else
                            @if($isCreator)
                                @if($isPending)
                                    <button type="button" class="btn btn-sm btn-primary edit-invoice" data-id="{{ $inv->id }}" title="Edit"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger delete-invoice" data-id="{{ $inv->id }}" title="Delete"><i class="fas fa-trash"></i></button>
                                @endif
                            @endif
                        @endif
                        @if($isAdmin || $isCreator)
                            <button type="button" class="btn btn-sm btn-info view-invoice" data-id="{{ $inv->id }}" title="View"><i class="fas fa-eye"></i></button>
                        @endif
                    </td>
                @endif
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">No invoices yet.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

{{-- Table 2: Approved --}}
<div class="d-flex justify-content-between align-items-center mb-2 mt-3">
    <h6 class="mb-0">Approved</h6>
    @if($canCreateInvoice)
        <button type="button" class="btn btn-light btn-sm print-invoices-btn" data-scope="approved" data-project-id="{{ $project->id }}" title="Print Approved">
            <i class="fas fa-print"></i>
        </button>
    @endif
</div>

<div class="table-responsive" id="invoiceTableApproved">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Invoice</th>
            <th>Status</th>
            <th>Price</th>
            <th>Paid</th>
            <th>Due</th>
            <th>Created At</th>
            @if($canCreateInvoice)
                <th class="no-print d-print-none">Action</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @php
            $approved = $project->invoices->filter(function($inv){
                return $inv->status === \App\Models\ProjectsInvoice::STATUS_APPROVED;
            });
        @endphp
        @forelse($approved as $inv)
            @php
                $user = Auth::user();
                $isAdmin = $user && ($user->role === 'Admin');
                $isCreator = $user && ($user->id === $inv->created_by);
                $isPending = $inv->status === \App\Models\ProjectsInvoice::STATUS_PENDING;
            @endphp
            <tr>
                <td>{{ $inv->invoice }}</td>
                <td class="text-capitalize">{{ $inv->status }}</td>
                <td><i class="{{ \App\Models\Project::getCurrencyClass($project->currency) }}"></i> {{ number_format($project->price) }}</td>
                <td><i class="{{ \App\Models\Project::getCurrencyClass($project->currency) }}"></i> {{ number_format($inv->paid) }}</td>
                <td><i class="{{ \App\Models\Project::getCurrencyClass($project->currency) }}"></i> {{ number_format(max(($project->price ?? 0) - ($inv->paid ?? 0), 0)) }}</td>
                <td>{{ $inv->created_at ? $inv->created_at->diffForHumans() : '' }}</td>
                @if($isAdmin || $isCreator )
                    <td class="no-print d-print-none">
                        @if($isAdmin)
                           <button type="button" class="btn btn-sm btn-danger reject-invoice" data-id="{{ $inv->id }}" data-status="rejected" title="Reject"><i class="fas fa-times" style="font-size:15px;"></i></button>
                            <button type="button" class="btn btn-sm btn-primary edit-invoice" data-id="{{ $inv->id }}" title="Edit"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-sm btn-danger delete-invoice" data-id="{{ $inv->id }}" title="Delete"><i class="fas fa-trash"></i></button>
                        @else
                            @if($isCreator)
                                <!-- @if($isPending)
                                    <button type="button" class="btn btn-sm btn-primary edit-invoice" data-id="{{ $inv->id }}" title="Edit"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger delete-invoice" data-id="{{ $inv->id }}" title="Delete"><i class="fas fa-trash"></i></button>
                                @endif -->
                            @endif
                        @endif
                        @if($isAdmin || $isCreator)
                            <button type="button" class="btn btn-sm btn-info view-invoice" data-id="{{ $inv->id }}" title="View"><i class="fas fa-eye"></i></button>
                        @endif
                    </td>
                @endif
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">No invoices yet.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
