@extends('layouts.app')

@section('title')
    {{ __('messages.leave_policies') }}
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
   
</style>
@endsection
@section('content')
<section class="section">
    <div class="section-header leave-header-section">
        <h1 class="page__heading">Storola Leave Policy</h1>
    </div>

    <div class="section-body">
        <div class="leave-policy-wrapper">
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
                    <strong>Unpaid Leave Policy</strong>
                    <p>
                        এক মাসে <strong>২ দিনের বেশি ছুটি</strong> গ্রহণ করলে অতিরিক্ত দিনসমূহ
                        <strong>Unpaid Leave</strong> হিসেবে গণ্য হবে।
                    </p>
                </li>

                <li>
                    <strong>Late Attendance Policy</strong>
                    <p>
                        অফিসে না জানিয়ে <strong>২ (দুই) ঘণ্টার বেশি দেরিতে উপস্থিত হলে</strong>,
                        সেটি সেদিনের <strong> Full Day Absence (অনুপস্থিত) </strong> হিসেবে গণ্য হবে।
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
                    <strong>Leave Application Timeline</strong>
                    <p>
                        সাধারণ ছুটির জন্য কর্মীকে সর্বনিম্ন
                        <strong>৩ (তিন) কার্যদিবস পূর্বে</strong> লিখিত আবেদন জমা দিতে হবে।
                    </p>
                </li>

                <li>
                    <strong>Approval Notification</strong>
                    <p>
                        ছুটি অনুমোদিত হলে সংশ্লিষ্ট কর্মীকে অবশ্যই
                        <strong>অফিস লবিতে আনুষ্ঠানিকভাবে জানাতে হবে।</strong>
                    </p>
                </li>

                <li>
                    <strong>Emergency Leave</strong>
                    <p>
                        জরুরি পরিস্থিতিতে ছুটি গ্রহণের জন্য
                        কর্মীকে অবশ্যই <strong>কর্তৃপক্ষের পূর্বানুমতি</strong> গ্রহণ করতে হবে।
                    </p>
                </li>
            </ol>
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