@extends('layouts.app')

@section('title')
    {{ __('messages.absents') }}
@endsection

@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/style/css/tasks.css') }}">
@endsection

@section('content')
<section class="section">
    <div class="section-header leave-header-section">
        <h1 class="page__heading">{{ __('messages.absents') }}</h1>
        <div class="filter-container section-header-breadcrumb row justify-content-md-end">
        </div>
    </div>

    <div class="section-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Policy Name') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Max Days') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Annual Leave</td>
                        <td>Paid leave for vacation or personal time.</td>
                        <td>20</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Sick Leave</td>
                        <td>Leave for illness or medical appointments.</td>
                        <td>10</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Maternity Leave</td>
                        <td>Leave for childbirth and care.</td>
                        <td>90</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Paternity Leave</td>
                        <td>Leave for fathers after childbirth.</td>
                        <td>15</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Bereavement Leave</td>
                        <td>Leave for loss of a family member.</td>
                        <td>7</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Unpaid Leave</td>
                        <td>Leave without pay for personal reasons.</td>
                        <td>30</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Study Leave</td>
                        <td>Leave for educational purposes.</td>
                        <td>20</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Compensatory Leave</td>
                        <td>Leave for overtime worked.</td>
                        <td>10</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Casual Leave</td>
                        <td>Short leave for urgent matters.</td>
                        <td>8</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Marriage Leave</td>
                        <td>Leave for marriage ceremonies.</td>
                        <td>5</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection

<!-- @section('page_js')
    <script src="{{ asset('assets/js/daterangepicker.js') }}"></script>
@endsection

@section('scripts')
    <script src="{{ mix('assets/js/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/leave_requests/leave_requests.js') }}"></script>
@endsection -->
