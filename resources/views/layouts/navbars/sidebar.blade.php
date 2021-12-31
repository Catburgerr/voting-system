<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ __('ICT') }}</a>
            <a href="#" class="simple-text logo-normal">{{ __('Employee Voting') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug ?? '' == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>  
            @if (auth()->check())
                @if (auth()->user()->is_admin)         
                <li @if ($pageSlug ?? '' == 'vote') class="active " @endif>
                    <a href="{{ route('votes.create') }}">
                        <i class="tim-icons icon-paper"></i>
                        <p>{{ __('Create Vote') }}</p>
                    </a>
                </li>
                @else
                <li @if ($pageSlug ?? '' == 'votes') class="active " @endif>
                    <a href="{{ route('pages.vote') }}">
                        <i class="tim-icons icon-paper"></i>
                        <p>{{ __('Vote') }}</p>
                    </a>
                </li>
                @endif
            @endif
            <li @if ($pageSlug ?? '' == 'results') class="active " @endif>
                <a href="{{ route('votes.list') }}">
                    <i class="tim-icons icon-chart-bar-32"></i>
                    <p>{{ __('Vote List') }}</p>
                </a>
            </li>
            <li hidden @if ($pageSlug ?? '' == 'typography') class="active " @endif>
                <a href="{{ route('pages.typography') }}">
                    <i class="tim-icons icon-align-center"></i>
                    <p>{{ __('Typography') }}</p>
                </a>
            </li>
            <li hidden @if ($pageSlug ?? '' == 'rtl') class="active " @endif>
                <a href="{{ route('pages.rtl') }}">
                    <i class="tim-icons icon-world"></i>
                    <p>{{ __('RTL Support') }}</p>
                </a>
            </li>
            <li hidden class=" {{ $pageSlug ?? '' == 'upgrade' ? 'active' : '' }} bg-info">
                <a href="{{ route('pages.upgrade') }}">
                    <i class="tim-icons icon-spaceship"></i>
                    <p>{{ __('Upgrade to PRO') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
