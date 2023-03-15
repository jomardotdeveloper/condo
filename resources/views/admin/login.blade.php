<!DOCTYPE html>
<html lang="zxx" class="js">

@include('layouts.admin.head')
<body class="nk-body bg-white npc-default pg-error">
    <div class="nk-block nk-block-middle nk-auth-body">
        <div class="brand-logo pb-2">
            <center>
                <a href="{{ route('login') }}" class="logo-link">
                    {{-- <img class="logo-light logo-img logo-img-lg" src="{{ asset('admin/images/cgs.png') }}" srcset="{{ asset('admin/images/cgs.png') }} 2x" alt="logo"> --}}
                                    <img class="" src="{{ asset('admin/images/cgs.png') }}" srcset="{{ asset('admin/images/cgs.png') }} 2x" alt="logo-dark">
             
                    
            </center>
            
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
        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <div class="form-group">
                <div class="form-label-group">
                    <label class="form-label" for="email-address">Email or Username</label>
                </div>
                <div class="form-control-wrap">
                    <input type="text" class="form-control form-control-lg" name="email" placeholder="Enter your email address"  required/>
                </div>
            </div><!-- .form-group -->
            <div class="form-group">
                <div class="form-label-group">
                    <label class="form-label" for="password">Password</label>
                </div>
                <div class="form-control-wrap">
                    <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                    </a>
                    <input  type="password" class="form-control form-control-lg" name="password" placeholder="Enter your password" required>
                </div>
            </div><!-- .form-group -->
            <div class="form-group text-center">
                <button type="submit" class="btn btn-lg btn-primary btn-block mb-2">Sign in</button>

                <a href="{{ route('application') }}"  style="font-weight:bold;">Submit Application</a>
            </div>
        </form><!-- form -->
    </div><!-- .nk-block -->
    @include('layouts.admin.scripts')
</html>