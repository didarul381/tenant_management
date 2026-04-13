@extends('layouts.app')

@section('title')
    {{ __('messages.absents.new_absent') }}
@endsection

@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">
@endsection

@section('content')
<section class="section">
    @include('flash::message')
    <div class="section-header">
        <h1 class="page__heading">{{ __('messages.absents.new_absent') }}</h1>
        <div class="filter-container section-header-breadcrumb justify-content-end">
            <a class="btn btn-light ml-1" href="{{ route('absents.index') }}">
                {{ __('messages.common.back') }}
            </a>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @include('layouts.errors')
                        {{ Form::open(['route' => 'absents.store', 'method' => 'post', 'class' => 'absent-form']) }}
                        
                        @include('absents.fields') {{-- create a separate fields file for Absents --}}

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('page_js')
<script src="{{ asset('assets/js/daterangepicker.js') }}"></script>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    function togglePartialFields() {
        if ($('#partial_leave').is(':checked')) {
            $('#from_time_div, #to_time_div').removeClass('d-none');
        } else {
            $('#from_time_div, #to_time_div').addClass('d-none');
            $('#from_time, #to_time').val('');
        }
        calculateTotalDays();
    }

    function calculateTotalDays() {
        let fromDate = $('#from_date').val();
        let toDate = $('#to_date').val();
        let totalDays = 0;

        if (fromDate && toDate) {
            const from = new Date(fromDate);
            const to = new Date(toDate);
            totalDays = Math.ceil((to - from) / (1000 * 60 * 60 * 24)) + 1;
        }

        $('#total_days').val(totalDays);
    }

    $('#partial_leave').change(togglePartialFields);
    $('#from_date, #to_date').change(calculateTotalDays);
});
</script>
@endsection
