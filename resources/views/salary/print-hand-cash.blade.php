@extends('layouts.app')

@section('title')
    Hand Cash - {{ $monthName }} {{ $year }}
@endsection

@section('css')
    <style>
        .print-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 30px 40px;
            background: white;
            font-family: 'Arial', sans-serif;
        }

        /* Company Header */
        .company-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }
        .company-name {
            font-size: 24px;
            font-weight: bold;
            margin: 0 0 5px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .company-address {
            font-size: 12px;
            color: #666;
            margin: 0;
        }
        .document-title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
            color: #2c3e50;
        }

        /* Document Info */
        .document-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
            padding: 0 10px;
        }
        .info-box {
            background: #f8f9fa;
            padding: 10px 15px;
            border-radius: 4px;
            border-left: 4px solid #2c3e50;
        }
        .info-label {
            font-size: 12px;
            color: #666;
            margin: 0 0 3px 0;
        }
        .info-value {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
            color: #2c3e50;
        }

        /* Summary Cards */
        .summary-cards {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }
        .summary-card {
            flex: 1;
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .summary-title {
            font-size: 12px;
            color: #666;
            margin: 0 0 5px 0;
            text-transform: uppercase;
        }
        .summary-amount {
            font-size: 20px;
            font-weight: bold;
            margin: 0;
        }
        .summary-amount.total {
            color: #2c3e50;
        }

        /* Table Styles */
        .salary-table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 13px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .salary-table thead tr {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .salary-table th {
            padding: 12px 10px;
            text-align: left;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .salary-table td {
            padding: 10px;
            border-bottom: 1px solid #e9ecef;
        }
        .salary-table tbody tr:hover {
            background-color: #f8f9fa;
        }
        .salary-table tbody tr:last-child td {
            border-bottom: none;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-paid {
            background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
            color: #155724;
        }
        .status-due {
            background: linear-gradient(135deg, #fbc2eb 0%, #a6c1ee 100%);
            color: #856404;
        }

        /* Total Row */
        .total-row {
            background: #e3f2fd;
            font-weight: 600;
        }
        .total-row td {
            padding: 12px 10px;
            border-top: 2px solid #2c3e50;
            font-size: 14px;
        }

        /* Signature Section */
        .signature-section {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
        }
        .signature-box {
            text-align: center;
            width: 22%;
        }
        .signature-label {
            font-size: 11px;
            color: #666;
            margin: 0 0 5px 0;
            text-transform: uppercase;
        }
        .signature-line {
            border-bottom: 2px solid #333;
            width: 100%;
            margin: 10px 0;
        }
        .signature-name {
            font-weight: bold;
            margin: 5px 0 0 0;
            font-size: 12px;
        }
        .signature-designation {
            font-size: 10px;
            color: #666;
            margin: 2px 0 0 0;
        }

        /* Footer Note */
        .footer-note {
            margin-top: 40px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 4px;
            font-size: 11px;
            color: #666;
            text-align: center;
            border: 1px dashed #dee2e6;
        }

        /* Print Styles */
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
    <!-- Company Header -->
    <div class="company-header">
        <h1 class="company-name">Innolytic IT Ltd</h1>
        <p class="company-address">House# 69/3, Road# 7/A, 6th Floor, Dhanmondi, Dhaka, 1209</p>
        <p class="document-title">HAND CASH SALARY DISBURSEMENT SHEET</p>
    </div>

    <!-- Document Info -->
    <div class="document-info">
        <div class="info-box">
            <p class="info-label">Month & Year</p>
            <p class="info-value">{{ $monthName }} {{ $year }}</p>
        </div>
        <div class="info-box">
            <p class="info-label">Print Date</p>
            <p class="info-value">{{ \Carbon\Carbon::now()->format('d M, Y') }}</p>
        </div>
        <div class="info-box">
            <p class="info-label">Payment Type</p>
            <p class="info-value">Hand Cash</p>
        </div>
    </div>

    <!-- Summary Cards -->
    @if($salaries->count() > 0)
        @php
            $totalAmount = $salaries->sum('payable');
            $employeeCount = $salaries->count();
            $paidCount = $salaries->where('status', 'paid')->count();
            $dueCount = $salaries->where('status', 'due')->count();
        @endphp

        <div class="summary-cards">
            <div class="summary-card">
                <p class="summary-title">Total Employees</p>
                <p class="summary-amount total">{{ $employeeCount }}</p>
            </div>
            <div class="summary-card">
                <p class="summary-title">Paid</p>
                <p class="summary-amount" style="color: #28a745;">{{ $paidCount }}</p>
            </div>
            <div class="summary-card">
                <p class="summary-title">Due</p>
                <p class="summary-amount" style="color: #dc3545;">{{ $dueCount }}</p>
            </div>
            <div class="summary-card">
                <p class="summary-title">Total Amount</p>
                <p class="summary-amount total">৳ {{ round($totalAmount) }}</p>
            </div>
        </div>

        <!-- Salary Table -->
        <table class="salary-table">
            <thead>
                <tr>
                    <th style="width: 5%; text-align: center;">SL</th>
                    <th style="width: 25%;">Employee Name</th>
                    <th style="width: 20%;">Phone Number</th>
                    <th style="width: 20%; text-align: right;">Amount (৳)</th>
                    <th style="width: 15%; text-align: center;">Status</th>
                    <th style="width: 15%; text-align: center;">Signature</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salaries as $key => $salary)
                    <tr>
                         <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $salary->user->name ?? 'N/A' }}</strong></td>
                        <td>{{ $salary->user->phone ?? 'N/A' }}</td>
                        <td class="text-right"><strong>৳  {{ round($salary->payable) }}/-</strong></td>
                        <td class="text-center">
                            <span class="status-badge {{ $salary->status === 'paid' ? 'status-paid' : 'status-due' }}">
                                {{ ucfirst($salary->status ?? 'Due') }}
                            </span>
                        </td>
                        <td class="text-center" style="font-family: cursive; font-size: 14px;">
                            _________________
                        </td>
                    </tr>
                @endforeach

                <!-- Total Row -->
                <!-- <tr class="total-row">
                    <td colspan="3" style="text-align: right; font-weight: 600;">GRAND TOTAL</td>
                    <td class="text-right" style="font-weight: 600;">৳ {{ round($totalAmount) }}</td>
                    <td colspan="2"></td>
                </tr> -->
            </tbody>
        </table>

        <!-- Signature Section -->
        <div class="signature-section">
            <!-- <div class="signature-box">
                <p class="signature-label">Prepared By</p>
                <div class="signature-line"></div>
                <p class="signature-name">HR Manager</p>
                <p class="signature-designation">Human Resources</p>
            </div> -->
            <div class="signature-box">
                <p>Prepared By</p>
                <div class="signature-line"></div>
                <p style="margin-top: 15px;"><strong>HR Manager</strong><br>
                Human Resources<br>
                Innolytic IT Ltd</p>
            </div>
            <div class="signature-box">
                <p>Verified By</p>
                <div class="signature-line"></div>
                <p style="margin-top: 15px;"><strong>S M MAHMUDUL HASAN</strong><br>
                Chairman<br>
                Innolytic IT Ltd</p>
            </div>
            <!-- <div class="signature-box">
                <p class="signature-label">Verified By</p>
                <div class="signature-line"></div>
                <p class="signature-name">Accounts Officer</p>
                <p class="signature-designation">Finance Department</p>
            </div> -->
            <!-- <div class="signature-box">
                <p class="signature-label">Approved By</p>
                <div class="signature-line"></div>
                <p class="signature-name">Managing Director</p>
                <p class="signature-designation">Management</p>
            </div> -->
             <div class="signature-box">
                <p>Approved By</p>
                <div class="signature-line"></div>
                <p style="margin-top: 15px;"><strong>Md Firoz</strong><br>
                Managing Director<br>
                Innolytic IT Ltd</p>
            </div>
            <!-- <div class="signature-box"> -->
                <!-- <p class="signature-label">Received By</p> -->
                <!-- <div class="signature-line"></div>
                <p class="signature-name">Employee</p>
                <p class="signature-designation">Signature</p> -->
            <!-- </div> -->
        </div>

        <!-- Footer Note -->
        <!-- <div class="footer-note">
            <i class="fas fa-info-circle"></i> This is a computer generated document. No signature is required for employees who have received payment via hand cash.
        </div> -->
    @else
        <div class="alert alert-info text-center" style="padding: 40px;">
            <i class="fas fa-info-circle fa-2x mb-3"></i>
            <h4>No Records Found</h4>
            <p>No employees without bank information found for {{ $monthName }} {{ $year }}.</p>
        </div>
    @endif
</div>

<!-- Print Buttons -->
<div style="text-align: center; margin: 30px 0;" class="no-print">
    <button class="btn btn-primary" onclick="window.print()">
        <i class="fas fa-print"></i> Print
    </button>

</div>
@endsection

@push('scripts')
<script>
    // Optional: Auto-format phone numbers
    $(document).ready(function() {
        // Add any custom JavaScript here
    });
</script>
@endpush
