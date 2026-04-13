<style>
#attendanceSection, #signInBtn, #signOutBtn, #breakBtn, #backBtn {
    transition: all 0.3s ease;
}
/* Hidden state */
.attendance-hidden {
    opacity: 0;
    visibility: hidden;
    transform: translateY(-5px);
    transition: all 0.3s ease;
}

/* Show state */
.attendance-visible {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
    border: 1px solid white;
    padding: 10px;
    box-shadow: 1px 1px 12px 4px #fff1f1;
    transition: all 0.3s ease;
}


.separator {
    margin: 0 8px;
    margin-right: -2px;
    color: #ccc;
    display: inline-block;
    width: 3px;
    background: #ccc;
    height: 29px;
    transition: all 0.3s ease;
}
</style>

@php
    $currentLang = \App\Models\User::whereId($loggedInUserId)->first()->language;
    $currentUser = \App\Models\User::find($loggedInUserId);
    $canShowAttendanceButtons = $currentUser && is_null($currentUser->deleted_at) && $currentUser->is_active == 1;
@endphp
<form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
</form>
<ul class="navbar-nav navbar-right">
     @if($canShowAttendanceButtons)
        <li class="mt-2 mr-4" id="attendanceSection">
            <button id="signInBtn" class="btn btn-sm btn-success d-none" title="Check In">
                <i class="fas fa-sign-in-alt"></i> Check In
            </button>
             <button id="breakBtn" class="btn btn-sm btn-info d-none" title="Break">
                <i class="fas fa-coffee"></i> Break
            </button>
            <button id="backBtn" class="btn btn-md  btn-danger d-none" title="Back">
                <i class="fas fa-undo"></i> Back
            </button>
             <!-- Separator before Sign Out -->
            <span id="signOutSeparator" class="separator d-none">|</span>
            <button id="signOutBtn" class="btn btn-sm btn-warning ml-2 d-none" title="Check Out">
                <i class="fas fa-sign-out-alt"></i> Check Out
            </button>
           
        </li>
    @endif
    @can('manage_settings')
        <li class="mt-2"><a href="{{route('settings.edit')}}" title="{{ __('messages.setting') }}">
                <i class="fa fa-cog text-white font-size-20px"></i></a>
        </li>
    @endcan
    
   
    <li class="dropdown dropdown-list-toggle mt-1 ml-2 nt"><a href="#" data-toggle="dropdown"
                                                              class="nav-link notification-toggle nav-link-lg"
                                                              title="{{__('messages.notification.notifications')}}" style="position: relative;">
            <i class="far fa-bell"></i>
            <span id="notificationCount" class="badge badge-danger badge-pill d-none" style="position:absolute; top:-4px; right:-4px; font-size:10px;">0</span>
        </a>
        <div class="dropdown-menu dropdown-list dropdown-menu-right" id="notification">
            <div class="dropdown-header">
                <div class="row justify-content-between">
                    <div class="px-3">{{__('messages.notification.notifications')}}</div>
                    <div class="px-3" id="allRead">
                        <a href="#" class="text-decoration-none">{{__('messages.notification.mark_all_as_read')}}</a>
                    </div>
                </div>
            </div>
            <div class="dropdown-list-content dropdown-list-icons notification-content"
                 style="overflow-y:auto !important; ">
                <div class="empty-state empty-notification d-none" data-height="300" style="padding: 0px 40px;">
                    <div class="empty-state-icon">
                        <i class="fas fa-question mt-4"></i>
                    </div>
                    <h2>{{__('messages.notification.empty_notifications')}}</h2>
                </div>
            </div>
        </div>
    </li>
        <li class="dropdown language-menu no-hover ml-2">
            <a href="#" class="dropdown-toggle text-white text-decoration-none"
               data-toggle="dropdown" role="button" title="{{ __('messages.user.change_language') }}">
                {{ strtoupper($currentLang) }}&nbsp;
                <span class="caret"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right w-100" role="menu">
                @foreach(getUserLanguages() as $key => $value)
                    <span class="language-item"><a href="javascript:void(0)"
                                                   class="changeLanguage mb-1 dropdown-item {{$currentLang == $key   ? 'active' : ''}}"
                                                   data-prefix-value="{{ $key }}">{{ $value }}</a></span>
                @endforeach
            </div>
        </li>
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ Auth::user()->img_avatar }}"
                     class="rounded-circle mr-1 thumbnail-rounded user-thumbnail">
                <div class="d-sm-none d-lg-inline-block">{{ html_entity_decode(Auth::user()->name) }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right overflow-hidden text-break">
            <a href="#" class="dropdown-item has-icon btn-flat edit-profile" data-id="{{ $loggedInUserId }}">
                <i class="fa fa-user mr-2"></i> {{ __('messages.user.profile') }}</a>
            <a href="#" class="dropdown-item has-icon btn-flat changePasswordModal drop-down-links"
               data-id="{{ $loggedInUserId }}">
                <i class="fa fa-key mr-1"></i> {{ __('messages.user.change_password') }}</a>
            <a href="#" class="dropdown-item has-icon btn-flat notificationModal drop-down-links"
               data-id="{{ $loggedInUserId }}">
                <i class="fa fa-cog mr-2"></i>{{ __('messages.notification.notification_setting') }}</a>
            <a href="{{ url('/logout') }}" class="dropdown-item text-danger has-icon"
               onclick="event.preventDefault(); localStorage.clear(); document.getElementById('logout-form').submit();">
                <i class="fa fa-lock mr-2"></i>{{ __('messages.user.logout') }}
            </a>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="display-none">
                {{ csrf_field() }}
            </form>
        </div>
    </li>
</ul>