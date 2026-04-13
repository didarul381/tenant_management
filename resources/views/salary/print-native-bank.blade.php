@extends('layouts.app')

@section('title')
    Native Bank - {{ $monthName }} {{ $year }}
@endsection
@php
    $totalAmount = $salaries->sum('payable');
@endphp
@section('css')
    <style>
        .print-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 20px 30px;
            background: white;
            font-family: 'Arial', sans-serif;
        }

        /* Letter Header */
        .letter-header {
            margin-bottom: 25px;
            line-height: 1.4;
        }
        .letter-header p {
            margin: 3px 0;
            font-size: 14px;
        }
        .letter-date {
            text-align: right;
            font-weight: normal;
            margin-bottom: 20px;
        }
        .letter-subject {
            font-weight: bold;
            text-decoration: underline;
            margin: 20px 0 15px 0;
            font-size: 15px;
        }
        .bank-details {
            margin: 15px 0;
            font-size: 14px;
        }
        .account-details {
            margin: 15px 0 20px 0;
            font-size: 14px;
        }

        /* Table Styles */
        .salary-table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 13px;
        }
        .salary-table th {
            border: 1px solid #000;
            padding: 10px 8px;
            text-align: center;
            font-weight: bold;
            background-color: #f2f2f2;
        }
        .salary-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .salary-table td:first-child {
            text-align: center;
            width: 8%;
        }
        .salary-table td:nth-child(3) {
            text-align: center;
        }
        .salary-table td:nth-child(4) {
            text-align: right;
            padding-right: 15px;
        }
        .salary-table td:nth-child(5) {
            text-align: center;
        }

        /* Footer Styles */
        .footer-text {
            margin-top: 30px;
            font-size: 14px;
        }
        .signature-section {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }
        .signature-box {
            width: 30%;
        }
        .signature-line {
            border-bottom: 1px solid #000;
            width: 80%;
            margin-top: 30px;
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


    <!-- Address Block -->
    <div class="letter-header">
        <!-- Date -->

       <p>{{ \Carbon\Carbon::now()->format('d F Y') }}</p>

        <p>To</p>
        <p>The EVP & Manager</p>
        <p>The Premier Bank Ltd.</p>
        <p>Panthapath Branch,</p>
        <p>Dhaka</p>
    </div>

    <!-- Subject -->
    <div class="text-bold">
        <p><strong>Subject: Regarding transfer of staff's salary for the month {{ $monthName }}-{{ $year }}</strong></p>
    </div>

    <!-- Salutation -->
    <div class="bank-details">
        <p>Dear Sir,</p>
    </div>


    <div class="account-details">
    @php
        function numberToWords($num) {
            $words = [
                0 => 'Zero', 1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four',
                5 => 'Five', 6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
                10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve', 13 => 'Thirteen',
                14 => 'Fourteen', 15 => 'Fifteen', 16 => 'Sixteen', 17 => 'Seventeen',
                18 => 'Eighteen', 19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
                40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty', 70 => 'Seventy',
                80 => 'Eighty', 90 => 'Ninety'
            ];

            if ($num < 21) {
                return $words[$num];
            } elseif ($num < 100) {
                $tens = floor($num / 10) * 10;
                $units = $num % 10;
                return $words[$tens] . ($units ? ' ' . $words[$units] : '');
            } elseif ($num < 1000) {
                $hundreds = floor($num / 100);
                $remainder = $num % 100;
                return $words[$hundreds] . ' Hundred' . ($remainder ? ' ' . numberToWords($remainder) : '');
            } elseif ($num < 100000) {
                $thousands = floor($num / 1000);
                $remainder = $num % 1000;
                return numberToWords($thousands) . ' Thousand' . ($remainder ? ' ' . numberToWords($remainder) : '');
            } elseif ($num < 10000000) {
                $lakhs = floor($num / 100000);
                $remainder = $num % 100000;
                return numberToWords($lakhs) . ' Lakh' . ($remainder ? ' ' . numberToWords($remainder) : '');
            } else {
                $crores = floor($num / 10000000);
                $remainder = $num % 10000000;
                return numberToWords($crores) . ' Crore' . ($remainder ? ' ' . numberToWords($remainder) : '');
            }
        }
    @endphp
    @php
    $finalAmount = $salaries->sum(function($salary) {
        return round($salary->payable);
    });
@endphp



    <p>With reference to the above, we request you to transfer an amount of BDT <strong>{{ round($finalAmount) }}/- (Taka {{ numberToWords($finalAmount) }} Only)</strong> from our AC:<strong> 0144 11100000829</strong> named <strong>INNOLYTIC IT LTD</strong> as monthly salary and bonus according to the list given below.</p>
    </div>

    @if($salaries->count() > 0)
        <!-- Salary Table -->
        <table class="salary-table">
            <thead>
                <tr>
                    <th>SLNo</th>
                    <th>Name</th>
                    <th>A/C No</th>
                    <th>Salary Amount</th>
                    <th>Mobile No</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salaries as $key => $salary)
                    <tr>
                         <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $salary->user->name ?? 'N/A' }}</strong></td>
                        <td>{{ $salary->user->account_number ?? 'N/A' }}</td>
                        <td>{{ round($salary->payable) }}/-</td>
                        <td><strong>{{ $salary->user->phone ?? 'N/A' }}</strong></td>
                        <td><strong>{{ $salary->user->email ?? 'N/A' }}</strong></td>
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
            <i class="fas fa-info-circle"></i> No Premier Bank employees found for {{ $monthName }} {{ $year }}.
        </div>
    @endif
</div>

<!-- Print Buttons -->
<div style="text-align: center; margin: 30px;" class="no-print">
    <button class="btn btn-primary" onclick="window.print()">
        <i class="fas fa-print"></i> Print
    </button>

</div>


@endsection
