@include('layouts.parts.header')

<div class="app layout-fixed-header">

    @include('layouts.parts.sidebar')

    <!-- content panel -->
    <div class="main-panel">
        @include('layouts.parts.top_header')

        <!-- main area -->
        <div class="main-content">

            <div class="page-title">
                <div class="title">@yield('page-title')</div>
                <div class="sub-title">@yield('page-subtitle')</div>
            </div>

            @yield('main_content')

        </div>
        <!-- /main area -->
    </div>
    <!-- /content panel -->

    @include('layouts.parts.bottom_footer')
</div>

@include('layouts.parts.footer')
