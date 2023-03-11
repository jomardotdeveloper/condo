<!DOCTYPE html>
<html lang="zxx" class="js">

@include('layouts.admin.head')
<body class="nk-body bg-white npc-default pg-error">
    <div class="nk-block nk-block-middle nk-auth-body">
        <div class="brand-logo pb-5">
            <a href="html/index.html" class="logo-link">
                <img class="logo-light logo-img logo-img-lg" src="{{ asset('admin/images/logo.png') }}" srcset="{{ asset('admin/images/logo2x.png') }} 2x" alt="logo">
                <img class="logo-dark logo-img logo-img-lg" src="{{ asset('admin/images/logo-dark.png') }}" srcset="{{ asset('admin/images/logo-dark2x.png') }} 2x" alt="logo-dark">
            </a>
        </div>
        @include('admin.includes.alerts')
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 class="nk-block-title">Sign-In</h5>
                <div class="nk-block-des">
                    <p>Access the Admin panel using your email and password.</p>
                </div>
            </div>
        </div><!-- .nk-block-head -->
        <form action="{{ route('admin.login') }}" class="form-validate is-alter" autocomplete="off" method="POST">
            @csrf
            <div class="form-group">
                <div class="form-label-group">
                    <label class="form-label" for="email-address">Email or Username</label>
                </div>
                <div class="form-control-wrap">
                    <input autocomplete="off" type="text" class="form-control form-control-lg" required id="email-address" placeholder="Enter your email address or username">
                </div>
            </div><!-- .form-group -->
            <div class="form-group">
                <div class="form-label-group">
                    <label class="form-label" for="password">Passcode</label>
                    <a class="link link-primary link-sm" tabindex="-1" href="html/pages/auths/auth-reset.html">Forgot Code?</a>
                </div>
                <div class="form-control-wrap">
                    <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                    </a>
                    <input autocomplete="new-password" type="password" class="form-control form-control-lg" required id="password" placeholder="Enter your passcode">
                </div>
            </div><!-- .form-group -->
            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
            </div>
        </form><!-- form -->
    </div><!-- .nk-block -->
    @include('layouts.admin.scripts')
</html>