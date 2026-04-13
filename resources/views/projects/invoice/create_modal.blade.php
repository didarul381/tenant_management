<div id="addProjectInvoiceModal" class="modal fade" role="dialog" data-onboard-amount="{{ (int) ($project->price ?? 0) }}" data-approved-paid="{{ (int) $project->invoices()->where('status', \App\Models\ProjectsInvoice::STATUS_APPROVED)->sum('paid') }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Invoice</h5>
                <button type="button" class="btn btn-light btn-sm mr-2 no-print d-print-none" id="btnPrintInvoice" title="Print Invoice">
                    <i class="fas fa-print"></i>
                </button>
                <button type="button" aria-label="Close" class="close outline-none" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'addProjectInvoiceForm']) }}
            <div class="modal-body">
                @php
                    $piOnBoardAmount = (int) ($project->price ?? 0);
                    $piApprovedPaid = (int) $project->invoices()->where('status', \App\Models\ProjectsInvoice::STATUS_APPROVED)->sum('paid');
                    $piInitialDue = max($piOnBoardAmount - $piApprovedPaid, 0);
                @endphp
                <div class="alert alert-danger display-none" id="projectInvoiceValidationErrorsBox"></div>
                <input type="hidden" id="pi_project_id" name="project_id" value="{{ $project->id }}">
                <input type="hidden" id="pi_invoice_id" value="">
                <input type="hidden" id="pi_onboard_amount" value="{{ $piOnBoardAmount }}">
                <input type="hidden" id="pi_approved_paid" value="{{ $piApprovedPaid }}">
                <div class="form-group d-flex align-items-center">
                    {{ Form::label('received_from', 'Received From: ', ['class' => 'mb-0 me-3']) }}
                    <div id="pi_received_from" class="mb-0">
                        {{ $project->name }} ({{ $project->client->name }})
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('amount', 'Onboard Amount:') }}
                    <div class="input-group">
                        <div class="input-group-prepend"><div class="input-group-text">@if($project->currency != 7)
                                    <i class="{{ \App\Models\Project::getCurrencyClass($project->currency) }}"></i>
                                @else
                                    <img src="{{ asset('assets/img/bangladeshi-taka-sign-solid.svg') }}"
                                         alt="৳" width="16" height="16" style="display:block">
                                @endif
</div></div>
                        <input type="text"
                               class="form-control"
                               id="pi_amount_display"
                               value="{{ number_format($project->price) }}"
                               readonly
                               style="background-color:#fff !important; opacity:1 !important; color:#495057 !important;">
                    </div>
                </div>
                 <div class="form-group">
                    {{ Form::label('paid', 'Paid Amount:') }}
                    <div class="input-group">
                        <div class="input-group-prepend"><div class="input-group-text">@if($project->currency != 7)
                                    <i class="{{ \App\Models\Project::getCurrencyClass($project->currency) }}"></i>
                                @else
                                    <img src="{{ asset('assets/img/bangladeshi-taka-sign-solid.svg') }}"
                                         alt="৳" width="16" height="16" style="display:block">
                                @endif
</div></div>
                        <input type="number" min="0" step="1" class="form-control" id="pi_paid" name="paid" value="0" max="{{ $piInitialDue }}">
                    </div>
                    <small class="text-muted">Min 0, Max equals Amount.</small>
                </div>
                <div class="form-group">
                    {{ Form::label('in_word', 'In Word:') }}
                    {{ Form::textarea('in_word', null, ['class' => 'form-control', 'id' => 'pi_in_word', 'rows'=>2]) }}
                </div>
                <div class="form-group">
                    {{ Form::label('for', 'For (Description):') }}
                    {{ Form::textarea('for', null, ['class' => 'form-control', 'id' => 'pi_for', 'rows'=>2]) }}
                </div>
               
                <div class="form-group">
                    {{ Form::label('due', 'Remaining (Due):') }}
                    <div class="input-group">
                        <div class="input-group-prepend"><div class="input-group-text">@if($project->currency != 7)
                                    <i class="{{ \App\Models\Project::getCurrencyClass($project->currency) }}"></i>
                                @else
                                    <img src="{{ asset('assets/img/bangladeshi-taka-sign-solid.svg') }}"
                                         alt="৳" width="16" height="16" style="display:block">
                                @endif
</div></div>
                        <input type="text" class="form-control" id="pi_due" value="{{ number_format($piInitialDue) }}" readonly>



                        
                    </div>
                </div>
                <!-- <div class="form-group">
                    {{ Form::label('invoice_preview', 'Invoice No:') }}
                    <input type="text" class="form-control" id="pi_invoice_preview" value="Will be auto-generated" readonly>
                </div> -->
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnProjectInvoiceSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-light ml-1" data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<script>
    (function () {
        var piApprovedPaid = {{ $piApprovedPaid }};
        var piOnBoardAmount = {{ $piOnBoardAmount }};
        var paidInput = document.getElementById('pi_paid');
        var dueInput = document.getElementById('pi_due');

        function formatNumber(n) {
            var val = Number(n || 0);
            try { return val.toLocaleString(undefined, { maximumFractionDigits: 0 }); }
            catch (e) { return String(val); }
        }

        function recalcDue() {
            if (!paidInput || !dueInput) return;
            var paidVal = parseInt(paidInput.value || '0', 10);
            if (isNaN(paidVal) || paidVal < 0) paidVal = 0;
            var remaining = piOnBoardAmount - (piApprovedPaid + paidVal);
            if (remaining < 0) remaining = 0;
            dueInput.value = formatNumber(remaining);
        }

        if (paidInput) {
            paidInput.addEventListener('input', recalcDue);
            paidInput.addEventListener('change', recalcDue);
            // Trigger once in case edit mode pre-fills paid
            recalcDue();
        }
    })();
    </script>
