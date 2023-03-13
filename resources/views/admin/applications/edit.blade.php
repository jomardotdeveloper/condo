@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Move In', 'url' => 'javascript:void(0);'),
        array('name' => 'Applications', 'url' => route('applications.index')),
        array('name' => 'Edit', 'url' => route('applications.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="Edit Application" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('applications.update', ['application' => $application]) }}" method="POST">
                @csrf
                @method('PUT')
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
                            @include('admin.applications.edit-move-in-clearance')
                        </div>
                    </div>
                    <div class="tab-pane" id="tabItem2">
                        <div class="row">
                            @include('admin.applications.edit-resident-information')
                            <div class="col-12 mt-2">
                                <input type="submit" value="Submit" class="btn btn-primary" />
                            </div>
                        </div>
                    </div>
                </div>
            
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
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
    
@endpush