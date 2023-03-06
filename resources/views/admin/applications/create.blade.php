@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Move In', 'url' => 'javascript:void(0);'),
        array('name' => 'Applications', 'url' => route('applications.index')),
        array('name' => 'Create', 'url' => route('applications.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="New Application" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('applications.store') }}" class="row" method="POST">
                @csrf
                @include('admin.applications.move-in-clearance')
                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
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