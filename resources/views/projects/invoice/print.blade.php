{{-- resources/views/projects/invoices/print.blade.php --}}
<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>Receipt {{ $invoice->invoice }}</title>
      <!-- Bootstrap -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <!-- Poppins -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
      <style>
         :root{
         --brand-orange:#d46a2e;
         --ink:#1e1e1e;
         --paper:#f6f6f3;
         --line:#6b6b6b;
         }
         body{
         background:#e9ecef;
         color:var(--ink);
         font-family:"Poppins", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
         }
         .receipt-wrap{ max-width:980px; margin:32px auto; padding:18px; }
         .receipt-card{
         background:var(--paper);
         border:1px solid #d8d8d8;
         box-shadow:0 10px 28px rgba(0,0,0,.10);
         position:relative;
         overflow:hidden;
         }
         .strip{ height:14px; background:var(--brand-orange); }
         .inner{
         border:1px solid #cfcfcf;
         margin:10px;
         background:rgba(255,255,255,.10);
         position:relative;
         }
         /* watermark */
         .watermark{
         position:absolute;
         inset:0;
         display:flex;
         align-items:center;
         justify-content:center;
         pointer-events:none;
         opacity:.10;
         transform:translateY(10px);
         z-index:0;
         }
         .watermark-img{
         width:420px;          /* change size here */
         max-width:70%;
         height:auto;
         display:block;
         user-select:none;
         -webkit-user-drag:none;
         }
         /* header */
         .receipt-head{ padding:14px 18px 10px; position:relative; z-index:1; }
         .brand{
         display:flex;
         flex-direction:column;
         align-items:flex-start;
         }
         .brand-logo{
         width:200px;
         height:58px;
         object-fit:contain;
         display:block;
         }
         .meta{
         text-align:right;
         font-size:18px;
         font-weight:700;
         }
         .meta .rowline{
         display:flex;
         justify-content:flex-end;
         gap:10px;
         align-items:baseline;
         margin-bottom:6px;
         }
         .meta .lbl{
         font-weight:500;
         color:#2b2b2b;
         white-space:nowrap;
         }
         /* ✅ make dotted line container and allow absolute value over it */
         .meta .fill{
         min-width:260px;
         display:inline-flex;
         align-items:baseline;
         gap:2px;
         font-weight:700;
         position:relative; /* important */
         padding-bottom:2px;
         }
         .meta .fill .dots{
         flex:1;
         border-bottom:2px dotted var(--line);
         transform:translateY(-2px);
         }
         /* ✅ value sits ON the dotted line like other fields */
         .meta-value{
         position:absolute;
         right:0;
         bottom:2px;
         /* padding:0 10px;                  */
         /* background: var(--paper);   */
         line-height: 2;
         font-weight:700;
         color:#2b2b2b;
         white-space:nowrap;
         }
         .meta-value{ bottom:-4px; } 
         /* body */
         .receipt-body{ padding:12px 18px 6px; position:relative; z-index:1; }
         .line-row{
         display:grid;
         grid-template-columns:190px 1fr;
         align-items:center;
         gap:16px;
         padding:10px 0;
         }
         .line-row .label{
         font-size:20px;
         font-weight:500;
         letter-spacing:.3px;
         }
         .dotline{
         border-bottom:3px dotted var(--line);
         height:24px;
         width:100%;
         position:relative;
         }
         /* text sitting on dotted line */
         .line-value{
         position:absolute;
         left:0;
         right:0;
         bottom:2px;
         padding:0 6px;
         font-weight:500;
         color:#2b2b2b;
         white-space:nowrap;
         overflow:hidden;
         text-overflow:ellipsis;
         }
         .small-block{
         margin-top:10px;
         display:grid;
         grid-template-columns:190px 1fr;
         gap:16px;
         align-items:start;
         padding-bottom:6px;
         }
         .small-labels{
         display:flex;
         flex-direction:column;
         gap:10px;
         padding-top:4px;
         }
         .small-labels .label{
         font-size:20px;
         font-weight:500;
         line-height:1.05;
         }
         .small-lines{
         display:flex;
         flex-direction:column;
         gap:18px;
         padding-top:16px;
         max-width:260px;
         }
         .small-lines .dotline{
         border-bottom:3px dotted var(--line);
         height:20px;
         }
         /* footer */
         .receipt-foot{
         padding:12px 18px 14px;
         position:relative;
         z-index:1;
         font-size:16px;
         color:#2a2a2a;
         }
         .foot-left{
         display:flex;
         flex-direction:column;
         gap:6px;
         color:var(--brand-orange);
         font-weight:600;
         font-size:17px;
         }
         .sig{
         text-align:right;
         display:flex;
         flex-direction:column;
         align-items:flex-end;
         gap:8px;
         padding-top:4px;
         }
         .sig-line{
         width:300px;
         height:45px;
         border-bottom:3px dotted var(--line);
         position:relative;
         }
         .sig-img{
         position:absolute;
         left:50%;
         bottom:6px;
         transform:translateX(-50%);
         height:90px;        /* signature size */
         width:auto;
         object-fit:contain;
         pointer-events:none;
         user-select:none;
         }
         .sig-text{
         font-size:20px;
         font-weight:600;
         color:#2b2b2b;
         }
         
         /* print cleanup */
         @media print{
         body{ background:#fff; }
         .receipt-wrap{ margin:0; padding:0; max-width:none; }
         .receipt-card{ box-shadow:none; border:0; }
         }

         /* responsive */
         @media (max-width:768px){
         .meta .fill{ min-width:180px; }
         .line-row{ grid-template-columns:140px 1fr; }
         .small-block{ grid-template-columns:140px 1fr; }
         .watermark-img{ width:320px; }
         .sig-line{ width:220px; }
         }
      </style>
   </head>
   <body>
      @php
      $project = $invoice->project;
      $client  = $project?->client;
      // ✅ only last part after "-"
      $receiptNo = $invoice->invoice ? \Illuminate\Support\Str::afterLast($invoice->invoice, '-') : '';
      $dateStr   = $invoice->created_at ? $invoice->created_at->format('d M Y') : '';
      $receivedFrom = trim(($project?->name ?? '').' ('.($client?->name ?? '').')');
      $amount = number_format((int) $invoice->price);
      $paid   = number_format((int) $invoice->paid);
      $due    = number_format((int) $invoice->due);
      $inWord = $invoice->in_word ?? '';
      $forTxt = $invoice->for ?? '';
      // currency symbol
      $currency = ($project?->currency == 7) ? '৳' : '';
      // ✅ Put these files in: public/assets/img/
      $logoPath      = asset('assets/img/logo.png');
      $watermarkPath = asset('assets/img/icon.png');
      $signPath      = asset('assets/img/MD firoz.png');
      @endphp
      <div class="receipt-wrap">
         <div class="receipt-card">
            <div class="strip"></div>
            <div class="inner">
               <!-- watermark -->
               <div class="watermark">
                  <img class="watermark-img" src="{{ $watermarkPath }}" alt="">
               </div>
               <!-- header -->
               <div class="receipt-head">
                  <div class="row align-items-start g-3">
                     <div class="col-12 col-md-6">
                        <div class="brand">
                           <img src="{{ $logoPath }}" alt="Logo" class="brand-logo">
                        </div>
                     </div>
                     <div class="col-12 col-md-6">
                        <div class="meta">
                           <div class="rowline">
                              <span class="lbl">Receipt No:</span>
                              <span class="fill">
                              <span class="dots"></span>
                              <span class="meta-value">{{ $receiptNo }}</span>
                              </span>
                           </div>
                           <div class="rowline">
                              <span class="lbl">Date:</span>
                              <span class="fill">
                              <span class="dots"></span>
                              <span class="meta-value">{{ $dateStr }}</span>
                              </span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="strip"></div>
               <!-- body -->
               <div class="receipt-body">
                  <div class="line-row">
                     <div class="label">Received from</div>
                     <div class="dotline">
                        <div class="line-value">{{ $receivedFrom }}</div>
                     </div>
                  </div>
                  <div class="line-row">
                     <div class="label">Amount</div>
                     <div class="dotline">
                        <div class="line-value">{{ $currency }} {{ $amount }}</div>
                     </div>
                  </div>
                  <div class="line-row">
                     <div class="label">In word</div>
                     <div class="dotline">
                        <div class="line-value">{{ $inWord }}</div>
                     </div>
                  </div>
                  <div class="line-row">
                     <div class="label">For</div>
                     <div class="dotline">
                        <div class="line-value">{{ $forTxt }}</div>
                     </div>
                  </div>
                  <div class="small-block">
                     <div class="small-labels">
                        <div class="label">PAID</div>
                        <div class="label">DUE</div>
                     </div>
                     <div class="small-lines">
                        <div class="dotline">
                           <div class="line-value">{{ $currency }} {{ $paid }}</div>
                        </div>
                        <div class="dotline">
                           <div class="line-value">{{ $currency }} {{ $due }}</div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- footer -->
               <div class="receipt-foot">
                  <div class="row align-items-end g-3">
                     <div class="col-12 col-md-7">
                        <div class="foot-left">
                           <div>contact@storola.net</div>
                           <div>www.storola.net</div>
                           <div>+8801810-023549</div>
                           <div>H#69 / 3, R#7 / A, 6th Floor, Dhanmondi, Dhaka</div>
                        </div>
                     </div>
                     <div class="col-12 col-md-5">
                        <div class="sig">
                           <div class="sig-line">
                              <img src="{{ $signPath }}" class="sig-img" alt="Signature">
                           </div>
                           <div class="sig-text">Authorized Signature</div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- /inner -->
            <div class="strip"></div>
         </div>
      </div>
      <script>
         // Auto print when opened
         window.onload = function () {
             window.print();
         };
      </script>
   </body>
</html>