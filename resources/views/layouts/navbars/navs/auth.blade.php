<nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-toggle d-inline">
                <button type="button" class="navbar-toggler">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <a class="navbar-brand" href="#">{{ $page ?? __('Dashboard') }}</a>
        </div>
        @php
            $user_id = Session::get('user_id');
            $profile_id = Session::get('profile_id');
        @endphp
        <div class="navbar-collapse collapse show" id="navigation" style="">
            <ul class="navbar-nav ml-auto">


                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false">
                        <div class="photo">
                            <img src="http://catburger.online/black/img/anime3.png" alt="Profile Photo">
                        </div>
                        <b class="caret d-none d-lg-block d-xl-block"></b>
                        <p class="d-lg-none">Log out</p>
                    </a>
                    <ul class="dropdown-menu dropdown-navbar">
                        <li class="nav-link">
                            @if (!empty($user->profile->id))
                            <a href="{{ route('profile.edit',$user->profile->id) }}"
                                class="nav-item dropdown-item">{{ __('Profile') }}</a>
                            @elseif (!empty($profile))
                            <a href="{{ route('profile.edit',$profile->id) }}"
                                class="nav-item dropdown-item">{{ __('Profile') }}</a>
                            @elseif (!empty($profile_id))
                            <a href="{{ route('profile.edit',$profile_id) }}"
                                class="nav-item dropdown-item">{{ __('Profile') }}</a>
                            @else
                            <a href="{{ route('profile.create') }}"
                                class="nav-item dropdown-item">{{ __('Create Profile') }}</a>
                            @endif
                        </li>
                        <li hidden class="nav-link">
                            <a href="#" class="nav-item dropdown-item">{{ __('Settings') }}</a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li class="nav-link">
                            <a href="{{ route('logout') }}" class="nav-item dropdown-item"
                                onclick="event.preventDefault();  document.getElementById('logout-form').submit();">{{ __('Log out') }}</a>

                        </li>
                    </ul>
                </li>
                <li class="separator d-lg-none"></li>
            </ul>
        </div>
    </div>
</nav>
<div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="{{ __('SEARCH') }}">
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Close') }}">
                    <i class="tim-icons icon-simple-remove"></i>
                </button>
            </div>
        </div>
    </div>
</div>
