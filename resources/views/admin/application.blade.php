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
                <form action="{{ route('applications.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="from_frontend" value="1"/>
                    <ul class="nav nav-tabs mt-n4">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1">Move In Clearance Form</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tabItem2">Resident's Information Sheet</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabItem1">
                            <div class="row">
                                @include('admin.applications.move-in-clearance')
                            </div>
                        </div>
                        <div class="tab-pane" id="tabItem2">
                            <div class="row">
                                @include('admin.applications.resident-information')
                                <div class="col-12 mt-2">
                                    <input type="submit" value="Submit" class="btn btn-primary" />
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </form>
            </div>
        </div>
        <!-- form -->
        @endif
    </div><!-- .nk-block -->
    @include('layouts.admin.scripts')
    <script>
        $(document).ready(function(){
            $('#tenant_checklist').hide();
            $('#unit_owner_checklist').hide();
            $('#tenand_bond_ar_container').hide();
            $('#utility_bond_ar_container').hide();

            $('#resident_type').on('change', function(){
                if(this.value == 2){
                    $('#tenant_checklist').show();
                    $('#unit_owner_checklist').hide();
                    $('#tenand_bond_ar_container').show();
                    $('#utility_bond_ar_container').hide();
                }else if(this.value == 1){
                    $('#tenant_checklist').hide();
                    $('#unit_owner_checklist').show();
                    $('#tenand_bond_ar_container').hide();
                    $('#utility_bond_ar_container').show();
                }else{
                    $('#tenant_checklist').hide();
                    $('#unit_owner_checklist').hide();
                    $('#tenand_bond_ar_container').hide();
                    $('#utility_bond_ar_container').hide();

                }
            });
        });
    </script>
</html>