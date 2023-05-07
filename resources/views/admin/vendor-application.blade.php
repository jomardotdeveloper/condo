<!DOCTYPE html>
<html lang="zxx" class="js">

@include('layouts.admin.head')
<body class="nk-body bg-white npc-default pg-error">
    <div class="nk-block nk-block-middle container p-5">
        @if(isset($_GET['success']))
        <div class="nk-block nk-block-middle nk-auth-body">
            <div class="brand-logo pb-5">
                <a href="html/index.html" class="logo-link">
                    <img class="" src="{{ asset('admin/images/cgs.png') }}" srcset="{{ asset('admin/images/cgs.png') }} 2x" alt="logo-dark">
                </a>
            </div>
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title">Thank you for submitting form</h4>
                    <div class="nk-block-des text-success">
                        <p>We'll get back to you via email.</p>
                        <a href="{{ route('login') }}" class="btn btn-lg btn-primary btn-block mt-2">Login</a>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="brand-logo pb-5">
            <a href="html/index.html" class="logo-link">
                <img class="" src="{{ asset('admin/images/cgs.png') }}" srcset="{{ asset('admin/images/cgs.png') }} 2x" alt="logo-dark">
            </a>
        </div>
        @include('admin.includes.alerts')
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 class="nk-block-title">Application</h5>
                <div class="nk-block-des">
                    <p>Fill out the application</p>
                </div>
            </div>
        </div><!-- .nk-block-head -->
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <form action="{{ route('dealers.store') }}" class="row" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="from_frontend" value="1"/>
                    @include('admin.dealers.form')
                    <div class="col-12 mt-2">
                        <input type="submit" value="Submit" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>
        <!-- form -->
        @endif
    </div><!-- .nk-block -->
    @include('layouts.admin.scripts')
</html>