@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Purchasing', 'url' => 'javascript:void(0);'),
        array('name' => 'Projects', 'url' => route('projects.index')),
        array('name' => 'Create', 'url' => route('projects.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="New Project" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('projects.store') }}" class="row" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="col-6 mt-2">
                    <x-input name="name" label="Name" type="text" :is-required="true"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="budget" label="Budget" type="number" :is-required="true"/>
                </div>
                
                <div class="col-6 mt-2">
                    <div class="form-group">
                        <label class="form-label">Participants</label>
                        <div class="form-control-wrap">
                            <select class="form-select js-select2" name="participants[]" multiple="multiple" data-placeholder="Select Participants" required>
                                @foreach ($participants as $participant)
                                    <option value="{{ $participant->id }}">{{ $participant->organization_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-2">
                    <textarea name="description" placeholder="Description" class="form-control" id="" cols="30" rows="10"></textarea>
                </div>
                
                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection