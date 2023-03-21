<!DOCTYPE html>
<html lang="zxx" class="js">

@include('layouts.admin.head')

<body class="nk-body bg-lighter npc-default has-sidebar ">
    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-sidebar-brand">
                        <a href="html/index.html" class="logo-link nk-sidebar-logo">
                            <img class="logo-light logo-img" src="{{ asset('admin/images/cgs.png') }}" srcset="{{ asset('admin/images/cgs.png') }} 4x" alt="logo">
                            <img class="logo-dark logo-img" src="{{ asset('admin/images/cgs.png') }}" srcset="{{ asset('admin/images/cgs.png') }} 4x" alt="logo-dark">
                            <img class="logo-small logo-img logo-img-small" src="{{ asset('admin/images/cgs.png') }}" srcset="{{ asset('admin/images/cgs.png') }} 4x" alt="logo-small">
                        </a>
                    </div>
                    <div class="nk-menu-trigger me-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                        <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                    </div>
                </div>
                <div class="nk-sidebar-element">
                    <div class="nk-sidebar-content">
                        @include('layouts.admin.menu')
                    </div>
                </div>
            </div>
            <div class="nk-wrap ">
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ms-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand d-xl-none">
                                {{-- LOGO --}}
                                <a href="html/index.html" class="logo-link">
                                    <img class="logo-light logo-img" src="./images/logo.png" srcset="./images/logo2x.png 2x" alt="logo">
                                    <img class="logo-dark logo-img" src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                                </a>
                            </div>
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    @if(auth()->user()->user_type == App\Models\User::ADMIN)
                                        @include('layouts.admin.admin-dropdown')
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                @yield("content")
                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts.admin.footer')
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.logout') }}" id="logoutForm">
        @csrf
        {{-- <input type="hidden" name="logout" value="1"> --}}
    </form>
    
    @include('layouts.admin.scripts')
    <script>
        function logout() {
            document.getElementById('logoutForm').submit();
        }
    </script>
    @stack('scripts')
</body>

</html>