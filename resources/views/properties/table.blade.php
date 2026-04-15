<style>
    #properties_table {
        font-size: 13px;
    }
    #properties_table thead th {
        font-size: 13px;
        white-space: nowrap;
    }
    #properties_table tbody td {
        font-size: 13px;
    }
    /* Specific styling for the address or description toggle buttons if used */
    .details-btn-bold.btn-link {
        font-size: 10px !important;
        padding: 0 4px;
    }
</style>

<table class="table table-responsive-sm table-striped table-bordered" id="properties_table">
    <thead>
        <tr>
            <th>{{ __('properties.owner') }}</th>
            <th>{{ __('properties.property_name') }}</th>
            <th style="width:100px;">{{ __('properties.rent_amount') }}</th>
            <th>{{ __('properties.address') }}</th>
            <th>{{ __('properties.status') }}</th>
            <th style="width:85px;">{{ __('messages.common.created_on') }}</th>
            <th style="width:100px;">{{ __('messages.common.action') }}</th>
        </tr>
    </thead>
    <tbody>
       
    </tbody>
</table>