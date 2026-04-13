@extends('layouts.app')

@section('title')
    {{ __('Policy') }}
@endsection

@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/style/css/tasks.css') }}">
@endsection
@section('css')
<style>
     .leave-policy-wrapper {
    background: #ffffff;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
}

.policy-header {
    margin-bottom: 25px;
    border-bottom: 1px solid #eee;
    padding-bottom: 15px;
}

.policy-header h3 {
    font-size: 20px;
    font-weight: 600;
    color: #2c3e50;
}

.policy-header p {
    margin-top: 8px;
    font-size: 17px;
    color: #000;
}

.policy-list {
    counter-reset: policy-counter;
    list-style: none;
    padding-left: 0;
}

.policy-list li {
    counter-increment: policy-counter;
    margin-bottom: 20px;
    padding-left: 45px;
    position: relative;
}

.policy-list li::before {
    content: counter(policy-counter);
    position: absolute;
    left: 0;
    top: 0;
    width: 32px;
    height: 32px;
    background: #3498db;
    color: #fff;
    border-radius: 50%;
    text-align: center;
    line-height: 32px;
    font-weight: 600;
}

.policy-list strong {
    display: inline;
    font-size: 18px;
    color: #2c3e50;
    margin-bottom: 4px;
}

.policy-list p {
    font-size: 17px;
    color: #000000;
    margin-bottom: 0;
}

/* Tab Styles */
.policy-tabs {
    margin-bottom: 30px;
    border-bottom: 2px solid #e9ecef;
}

.policy-tabs .nav-tabs {
    border-bottom: none;
    display: flex;
    gap: 10px;
}

.policy-tabs .nav-tabs .nav-link {
    border: 2px solid #e9ecef;
    border-radius: 8px 8px 0 0;
    background: #f8f9fa;
    color: #6c757d;
    font-weight: 500;
    padding: 12px 24px;
    transition: all 0.3s ease;
    border-bottom: none;
}

.policy-tabs .nav-tabs .nav-link:hover {
    background: #e9ecef;
    color: #495057;
}

.policy-tabs .nav-tabs .nav-link.active {
    background: #3498db;
    color: white;
    border-color: #3498db;
}

.policy-tabs .nav-tabs .nav-link.active i {
    color: white !important;
}

.policy-tabs .tab-content {
    padding-top: 20px;
}

.tab-pane {
    display: none;
}

.tab-pane.active {
    display: block;
}
</style>
@endsection
@section('content')
<section class="section">
    <div class="section-header leave-header-section">
        <h1 class="page__heading">Storola Policy</h1>
    </div>

    <div class="section-body">
        <div class="leave-policy-wrapper">
            <!-- Policy Tabs -->
            <div class="policy-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#leave-policy">
                            <i class="fas fa-calendar-alt me-2"></i>Leave Policy
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#absent-policy">
                            <i class="fas fa-user-times me-2"></i>Absent Policy
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#attendance-policy">
                            <i class="fas fa-clock me-2"></i>Attendance Policy
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Tab Content -->
            <div class="tab-content">
                <!-- Leave Policy Tab -->
                <div id="leave-policy" class="tab-pane active">
                    <div class="policy-header">
                        <h3>বার্ষিক মোট ছুটি</h3>
                        <p>
                    স্টোরোলা’র কর্মীরা প্রতি ক্যালেন্ডার বছরে সর্বমোট
                            <strong>১২ (বারো) দিন</strong> কেজুয়াল এবং অসুস্থতা-জনিত ছুটি গ্রহণ করতে পারবেন।
                        </p>
                    </div>
                    

                    <ol class="policy-list">
                        <li>
                            <strong>Leave Limitations</strong>
                            <p>
                                কোনো কর্মী টানা <strong>৩ (তিন) দিন ছুটি নিতে পারবেন না।</strong>
                                প্রতি মাসে সর্বোচ্চ <strong>২ (দুই) দিন</strong> বৈধ ছুটি গ্রহণযোগ্য।
                            </p>
                        </li>

                        <li>
                            <strong>Medical Leave Consideration</strong>
                            <p>
                                কোনো কর্মী হাসপাতাল-ভিত্তিক চিকিৎসাধীন থাকলে তার ক্ষেত্রে বিশেষ বিবেচনা করা হবে।
                                এই অবস্থায় সর্বোচ্চ <strong>১৫ (পনেরো) দিন পর্যন্ত</strong> বেতন কর্তন করা হবে না।
                                ১৫ দিনের বেশি হলে বিষয়টি পুনরায় পর্যালোচনা করে সিদ্ধান্ত প্রদান করা হবে।
                            </p>
                        </li>

                        <li>
                            <strong>Extended Leave Requirement</strong>
                            <p>
                                এক মাসে <strong>একটানা ২ (দুই) দিনের বেশি</strong> ছুটি নিতে চাইলে
                                কর্মীকে অবশ্যই <strong>উইকেন্ডে অফিসে উপস্থিত থেকে কাজ সম্পন্ন করতে হবে।</strong>
                                <strong class="text-danger">Work From Home গ্রহণযোগ্য নয়।</strong>
                            </p>
                        </li>

                        
                         <li>
                            <strong>Leave Application Timeline</strong>
                            <p>
                                সাধারণ ছুটির জন্য কর্মীকে সর্বনিম্ন
                                <strong>৩ (তিন) কার্যদিবস পূর্বে</strong> লিখিত আবেদন জমা দিতে হবে।
                            </p>
                        </li>
                         <li>
                            <strong>Leave Notification</strong>
                            <p>
                                ছুটি অনুমোদিত/বাতিল/অদলবদল/মুছে ফেলা হলে সংশ্লিষ্ট কর্মী অবশ্যই
                                <strong>স্টোরোলা ট্র্যাকারে নোটিফিকেশন পাবেন।</strong>
                            </p>
                        </li>
                         <li>
                            <strong>Emergency Leave</strong>
                            <p>
                                জরুরি পরিস্থিতিতে ছুটি গ্রহণের জন্য
                                কর্মীকে অবশ্যই <strong>কর্তৃপক্ষের অনুমতি</strong> গ্রহণ করতে হবে।
                            </p>
                        </li>
                        <li>
                            <strong>Leave Penalty</strong>
                            <p>
                                এক মাসে <strong>১ দিনের বেশি ছুটি</strong> গ্রহণ করলে অতিরিক্ত দিনসমূহ
                                <strong>Unpaid Leave</strong> হিসেবে গণ্য হবে।
                                 ফলে অতিরিক্ত দিন প্রতি ১ কর্মদিবসের সমান বেতন কেটে নেওয়া হবে।
                            </p>
                        </li>
                    </ol>
                </div>

                <!-- Absent Policy Tab -->
                <div id="absent-policy" class="tab-pane">
                    <div class="policy-header">
                        <h3>অনুপস্থিতি নীতি</h3>
                        <p>
                            অনুপস্থিতির ক্ষেত্রে কর্মীদের নিম্নলিখিত নীতিমালা অনুসরণ করতে হবে।
                        </p>
                    </div>

                    <ol class="policy-list">
                         <li>
                            <strong>Office Day</strong>
                            <p>
                                অফিস দিন : <strong> স্টোরোলা ট্র্যাকার-এ অন্তর্ভুক্ত সাপ্তাহিক ছুটি, স্টোরোলা ইভেন্টের ছুটি এবং সাধারণ ছুটি ব্যতীত</strong>
                                অবশিষ্ট সকল দিনে সকল কর্মীর জন্য অফিসে উপস্থিত থাকা বাধ্যতামূলক।
                            </p>
                        </li>

                        <li>
                            <strong>Absent Policy For Late Present</strong>
                            <p>
                                অফিসে না জানিয়ে <strong>২ (দুই) ঘণ্টার বেশি দেরিতে উপস্থিত হলে</strong>,
                                সেটি সেদিনের <strong> Full Day Absence (অনুপস্থিত) </strong> হিসেবে গণ্য হবে এবং বেতন কর্তন করা হবে।
                            </p>
                        </li>

                        <li>
                            <strong>Leave Office Without Notice</strong>
                            <p>
                                
                                অফিসে না জানিয়ে <strong> চলে গেলে(অফিস ফাঁকি দিলে)</strong>,
                                সেটি সেদিনের <strong> Full Day Absence (অনুপস্থিত) </strong> হিসেবে গণ্য হবে এবং বেতন কর্তন করা হবে।
                            </p>
                        </li>

                        <li>
                            <strong>Uninformed Absence</strong>
                            <p>
                                পূর্বে না জানিয়ে <strong>ইচ্ছাকৃতভাবে অনুপস্থিত</strong> থাকলে
                                তা সরাসরি <strong>২ (দুই) দিনের Absence</strong> হিসেবে গণ্য হবে।
                            </p>
                        </li>

                        <li>
                            <strong>Consecutive Absence</strong>
                            <p>
                                টানা <strong>৩ (তিন) দিন বা তার বেশি</strong> অনুপস্থিত থাকলে
                                বিষয়টি ঊর্ধ্বতন কর্তৃপক্ষের নিকট প্রতিবেদন করা হবে এবং যথাযথ ব্যবস্থা গ্রহণ করা হবে।
                            </p>
                        </li>

                        <li>
                            <strong>Monthly Absence Limit</strong>
                            <p>
                                প্রতি মাসে <strong>৫ (পাঁচ) দিনের বেশি</strong> অনুপস্থিতি গ্রহণযোগ্য নয়।
                                ইচ্ছাকৃত ভাবে এই সীমা অতিক্রম করলে কর্মীর বিরুদ্ধে শাস্তিমূলক ব্যবস্থা গ্রহণ করা হবে।
                            </p>
                        </li>
                         <li>
                            <strong>Absent Notification</strong>
                            <p>
                                অনুপস্থিতি অনুমোদিত/বাতিল হলে সংশ্লিষ্ট কর্মী অবশ্যই
                                <strong>স্টোরোলা ট্র্যাকারে নোটিফিকেশন পাবেন।</strong>
                            </p>
                        </li>

                        <li>
                            <strong>Absent Penalty</strong>
                            <p>
                                <strong>প্রতি ১ দিনের অনুপস্থিতির জন্য</strong>
                                 2 কর্মদিবসের সমান বেতন কর্তন করা হবে।
                            </p>
                        </li>
                    </ol>
                </div>

                <!-- Attendance Policy Tab -->
                <div id="attendance-policy" class="tab-pane">
                    <div class="policy-header">
                        <h3>উপস্থিতি নীতি</h3>
                        <p>
                            সমস্ত কর্মীদের অবশ্যই সময়মতো অফিসে উপস্থিত থাকতে হবে এবং নিম্নলিখিত নীতিমালা মেনে চলতে হবে।
                        </p>
                    </div>

                    <ol class="policy-list">
                        <li>
                            <strong>Office Hours</strong>
                            <p>
                                অফিস সময়: <strong> স্টোরোলা ট্র্যাকার-এ অন্তর্ভুক্ত অফিস টাইম অনুযায়ী</strong>
                                সব কর্মীকে অবশ্যই অফিস সময়ের মধ্যে উপস্থিত হতে হবে।
                            </p>
                        </li>

                       

                        <li>
                            <strong>Grace Period</strong>
                            <p>
                                অফিস শুরুর সময়ের <strong>৫ মিনিট পর্যন্ত</strong> গ্রেস পিরিয়ড হিসেবে গণ্য হবে।
                                ই সময়ের মধ্যে চেক-ইন করলে তা সময়মতো উপস্থিতি হিসেবে বিবেচিত হবে।
                            </p>
                        </li>

                         <li>
                            <strong>Check-in/Check-out</strong>
                            <p>
                               অফিসে প্রবেশ ও বাহির হওয়ার সময় অবশ্যই <strong>স্টোরোলা ট্র্যাকারে</strong>
                                যথাযথ সময়ে চেক-ইন/চেক-আউট সম্পন্ন করতে হবে। অন্যথায়, সেটি পূর্ণ দিবসের অনুপস্থিতি হিসেবে গণ্য হবে।
                            </p>
                        </li>
                         <li>
                            <strong>Office Duration</strong>
                            <p>
                                স্টোরোলা ট্র্যাকার-এ অন্তর্ভুক্ত কর্মচারীর অফিস সময়ের সাথে<strong> চেক-ইন/চেক-আউটের সময়কাল</strong>
                               যাচাই করা হবে। নির্ধারিত সময়ের চেয়ে কম সময় অফিসে উপস্থিত থাকলে, সেটি সেদিনের জন্য বিলম্ব (Late) হিসেবে গণ্য হবে।
                            </p>
                        </li>

                        <li>
                             
                         <strong>Auto Absent Notification</strong>
                            <p>
                                চেক-ইন/চেক-আউট জনিত কারণে স্বয়ংক্রিয়ভাবে অনুপস্থিত(Auto Absent) হলে সংশ্লিষ্ট কর্মী অবশ্যই
                                <strong>স্টোরোলা ট্র্যাকারে নোটিফিকেশন পাবেন।</strong>
                            </p>
                        </li>

                        <li>
                            <strong>Late Penalty</strong>
                            <p>
                                এক মাসে <strong>২ দিনের বেশি বিলম্বে(Late + Unknown) উপস্থিত হলে</strong> পরবর্তী প্রতিটি বিলম্বের(Late + Unknown) দিন
                                <strong>বৈতনিক কর্তন প্রযোজ্য হবে</strong> এই ক্ষেত্রে, প্রতি ৩ দিন বিলম্বে(Late + Unknown) উপস্থিতির জন্য ১ কর্মদিবসের সমান বেতন কর্তন করা হবে।
                            </p>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

<!-- @section('page_js')
    <script src="{{ asset('assets/js/daterangepicker.js') }}"></script>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    const tabLinks = document.querySelectorAll('.policy-tabs .nav-link');
    const tabPanes = document.querySelectorAll('.tab-pane');
    
    tabLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all tabs and panes
            tabLinks.forEach(tab => tab.classList.remove('active'));
            tabPanes.forEach(pane => pane.classList.remove('active'));
            
            // Add active class to clicked tab and corresponding pane
            this.classList.add('active');
            
            const targetId = this.getAttribute('href').substring(1);
            const targetPane = document.getElementById(targetId);
            
            if (targetPane) {
                targetPane.classList.add('active');
            }
        });
    });
});
</script>
@endsection -->
