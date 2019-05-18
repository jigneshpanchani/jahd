<!doctype html>
<!--[if lte IE 9]>
<html class="lte-ie9" lang="en">
<![endif]-->

<!--[if gt IE 9]><!-->
<html lang="en">
<!--<![endif]-->

    @include('layouts.template.header')

    <body class="disable_transitions sidebar_main_open sidebar_main_swipe">
        <!-- main header -->
        @include('layouts.template.body-header')
        <!-- main header end -->

        <!-- main sidebar -->
        @include('layouts.template.left-sidebar')
        <!-- main sidebar end -->

        <div id="page_content">
            <div id="page_content_inner">

                <!-- notifications -->
                @include('layouts.template.notifications')
                <!-- notifications end -->

                <!-- main content -->
                @yield('content')
                <!-- main content end -->

            </div>
        </div>

        @include('layouts.template.footer')

        @stack('scripts')

    </body>

</html>