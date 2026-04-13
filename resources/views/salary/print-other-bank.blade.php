@extends('layouts.app')

@section('title')
    Other Bank - {{ $monthName }} {{ $year }}
@endsection

@section('css')
    <style>
        .print-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 30px;
            background: white;
            font-family: 'Arial', sans-serif;
        }

        /* Letter Header */
        .letter-date {
            text-align: right;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .to-address {
            margin-bottom: 20px;
            line-height: 1.5;
            font-size: 14px;
        }
        .to-address p {
            margin: 2px 0;
        }

        .letter-subject {
            font-weight: bold;
            text-decoration: underline;
            margin: 25px 0 15px 0;
            font-size: 15px;
        }

        .salutation {
            margin: 15px 0;
            font-size: 14px;
        }

        .request-text {
            margin: 15px 0;
            font-size: 14px;
            line-height: 1.5;
            text-align: justify;
        }

        .debit-details {
            margin: 20px 0;
            font-size: 14px;
            line-height: 1.6;
        }
        .debit-details p {
            margin: 3px 0;
        }
        .debit-details ul {
            list-style: none;
            padding-left: 20px;
            margin: 10px 0;
        }
        .debit-details li {
            margin: 5px 0;
        }

        /* Table Styles */
        .salary-table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 12px;
        }
        .salary-table th {
            border: 1px solid #000;
            padding: 8px 5px;
            text-align: center;
            font-weight: bold;
            background-color: #f2f2f2;
            font-size: 11px;
        }
        .salary-table td {
            border: 1px solid #000;
            padding: 6px 5px;
        }
        .salary-table td:first-child {
            text-align: center;
            width: 4%;
        }
        .salary-table td:nth-child(2) {
            text-align: left;
        }
        .salary-table td:nth-child(3) {
            text-align: center;
        }
        .salary-table td:nth-child(7) {
            text-align: right;
            padding-right: 10px;
        }

        /* Footer Styles */
        .footer-text {
            margin-top: 30px;
            font-size: 14px;
            line-height: 1.5;
        }

        .signature-section {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }
        .signature-box {
            width: 30%;
        }
        .signature-box p {
            margin: 2px 0;
            font-size: 13px;
        }
        .signature-line {
            border-bottom: 1px solid #000;
            width: 80%;
            margin: 15px 0 10px 0;
        }
        .signature-name {
            font-weight: bold;
            margin-top: 10px;
        }
        .designation {
            font-size: 12px;
        }

        /* Print Styles */
       @media print {
        /* Hide navbar, sidebar, footer */
        nav.navbar,
        aside.sidebar,
        footer.main-footer,
        .breadcrumb,
        .section-header,
        .no-print,
        .main-sidebar,
        .sidebar,
        .content-wrapper,
        .wrapper,
        .main-header,
        .main-footer,
        .left-side,
        .right-side {
            display: none !important;
            visibility: hidden !important;
            position: absolute !important;
            left: -9999px !important;
            top: -9999px !important;
        }

    /* Show only main content */
    .main-content,
    .content-wrapper,
    .wrapper {
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        display: block !important;
        visibility: visible !important;
        position: static !important;
        left: auto !important;
        top: auto !important;
    }

    .print-container {
        position: relative;
        z-index: 9999;
        display: block !important;
        visibility: visible !important;
    }

    /* extra css start */
     .letter-header {
            margin-top: 50px !important;
        }
         .letter-header p {

            font-size: 16px !important;
        }
        .letter-subject {

                    font-size: 17px !important;
                }
      .bank-details {

                    font-size: 16px !important;
                }
         .account-details {

                    font-size: 16px !important;
                }
        .salary-table {

                    font-size: 15px !important;
                }
        .footer-text {

                    font-size: 16px !important;
                }
                .footer-text {

                    padding-top: 100px !important;
                }
                 .signature-line {

            margin-top: 125px !important;
        }

       /* extra css end */

    /* Ensure print container is visible */
    body {
        background: white !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    /* Hide any other unwanted elements */
    .content-header,
    .content-header *,
    .navbar,
    .navbar *,
    .sidebar,
    .sidebar *,
    .main-sidebar,
    .main-sidebar * {
        display: none !important;
        visibility: hidden !important;
        position: absolute !important;
        left: -9999px !important;
        top: -9999px !important;
    }

    /* Force print container to be full width */
    .print-container {
        width: 100% !important;
        max-width: none !important;
        margin: 0 auto !important;
        display: block !important;
        visibility: visible !important;
        position: relative !important;
        left: auto !important;
        top: auto !important;
    }

    /* Remove browser header and footer */
    @page {
        margin: 0.5in;
        size: auto;

        /* Remove headers and footers */
        @top-center {
            content: "";
        }
        @bottom-center {
            content: "";
        }
        @top-left {
            content: "";
        }
        @top-right {
            content: "";
        }
        @bottom-left {
            content: "";
        }
        @bottom-right {
            content: "";
        }
    }

    /* Hide page title */
    head, title, meta, link {
        display: none;
    }

    /* Force content to be visible on all pages */
    * {
        -webkit-print-color-adjust: exact !important;
        color-adjust: exact !important;
    }

    /* Ensure table rows don't break across pages */
    table {
        page-break-inside: auto;
    }
    tr {
        page-break-inside: avoid;
        page-break-after: auto;
    }
    td {
        page-break-inside: avoid;
        page-break-after: auto;
    }

    /* Keep footer and signature together on same page */
    .footer-text {
        page-break-inside: avoid;
        page-break-after: avoid;
    }

    .signature-section {

        page-break-inside: avoid;
        page-break-before: avoid;
    }

    .signature-box {
        page-break-inside: avoid;
    }
}
    </style>
@endsection

@section('content')
<div class="print-container">
    <!-- Date -->

    <!-- To Address -->
    <div class="to-address">
        <p>{{ \Carbon\Carbon::now()->format('j F Y') }}</p>
        <p>To</p>
        <p>The EVP & Manager</p>
        <p>The Premier Bank Ltd.</p>
        <p>Panthapath Branch,</p>
        <p>Dhaka</p>
    </div>

    <!-- Subject -->
    <div class="text-bold">
        <p><strong>Subject: Transfer of Staff Salary for {{ $monthName }} {{ $year }} via BEFTN System</strong></p>
    </div>

    <!-- Salutation -->
    <div class="salutation">
        <p>Dear Sir,</p>
    </div>

    <!-- Request Text -->
    <div class="request-text">
        <p>With reference to the above subject, we kindly request you to arrange a <strong>one-time / monthly transfer of funds</strong> through the
        <strong>Bangladesh Electronic Funds Transfer Network (BEFTN)</strong> by debiting our account maintained with your bank.</p>
    </div>

    <!-- Debit Account Details -->
    <div class="debit-details">
        <p><strong>Debit Account Details:</strong></p>
        <ul>
            <li><strong>Account Name:</strong> INNOLYTIC IT LTD</li>
            <li><strong>Account Number:</strong> 0144 11100000829</li>
            <li><strong>Bank:</strong> Premier Bank PLCThe credit account details are given below</li>
        </ul>

    </div>

    @if($salaries->count() > 0)
        <!-- Salary Table -->
        <table class="salary-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>A/C Name</th>
                    <th>A/C No</th>
                    <th>Bank Name</th>
                    <th>Branch Name</th>
                    <th>Routing No</th>
                    <th>Amount</th>
                     <th>Mobile No</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalAmount = 0;
                @endphp
                @foreach($salaries as $key => $salary)
                    @php
                        $totalAmount += $salary->payable;
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $salary->user->account_name ?? $salary->user->name ?? 'N/A' }}</td>
                        <td>{{ $salary->user->account_number ?? 'N/A' }}</td>
                        <td>{{ $salary->user->bank_name ?? 'N/A' }}</td>
                        <td>{{ $salary->user->branch_name ?? 'N/A' }}</td>
                        <td>{{ $salary->user->branch_routing_number ?? 'N/A' }}</td>
                        <td>{{ round($salary->payable) }}/-</td>
                        <td>{{ $salary->user->phone ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Footer Text -->
        <div class="footer-text">
            <p>Please take necessary action in this regard.</p>
            <p>Thanks for your cooperation.</p>
        </div>

        <!-- Signature Section -->
        <div class="signature-section">
            <div class="signature-box">
                <p>Sincerely,</p>
                <div class="signature-line"></div>
                 <p style="margin-top: 15px;"><strong>Md Firoz</strong><br>
                Managing Director<br>
                Innolytic IT Ltd</p>
            </div>
        </div>
    @else
        <div class="alert alert-info" style="margin-top: 30px;">
            <i class="fas fa-info-circle"></i> No other bank employees found for {{ $monthName }} {{ $year }}.
        </div>
    @endif
</div>

<!-- Print Buttons -->
<div style="text-align: center; margin: 30px;" class="no-print">
    <button class="btn btn-primary" onclick="window.print()">
        <i class="fas fa-print"></i> Print
    </button>

</div>

@push('scripts')

@endpush
@endsection
