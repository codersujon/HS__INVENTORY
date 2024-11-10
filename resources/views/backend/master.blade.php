    @include('backend.layouts.styles')

    <!--sidebar wrapper -->
    @include('backend.layouts.sidebar')
    <!--end sidebar wrapper -->

    @include('backend.layouts.top-bar')

    <!--start page wrapper -->

    <div class="page-wrapper">
        @yield('main-content')
    </div>

    <!--end page wrapper -->


    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i
            class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->
    @include('backend.layouts.footer')

    @include('backend.layouts.scripts')

