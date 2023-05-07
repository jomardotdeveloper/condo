@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Purchasing', 'url' => 'javascript:void(0);'),
        array('name' => 'Projects', 'url' => route('projects.index')),
        array('name' => 'Edit', 'url' => route('projects.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="Edit Project" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('projects.update', ['project' => $project]) }}" class="row" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="col-6 mt-2">
                    <x-input name="name" label="Name" type="text" :is-required="true" :default-value="$project->name"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="budget" label="Budget" type="number" :is-required="true" :default-value="$project->budget"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="is_approved" label="Approved" :options="[['id' => 1, 'name' => 'YES'], ['id' => 2, 'name' => 'NO']]"  :is-required="true"  :default-value="$project->is_approved ? 1 : 2"/>
                </div>
                
                <div class="col-6 mt-2">
                    <div class="form-group">
                        <label class="form-label">Participants</label>
                        <div class="form-control-wrap">
                            <select class="form-select js-select2" name="participants[]" multiple="multiple" data-placeholder="Select Participants" required>
                                @foreach ($participants as $participant)
                                    @if (in_array($participant->id, $project->biddings()->pluck('dealer_id')->toArray()))
                                    <option value="{{ $participant->id }}" selected>{{ $participant->organization_name }}</option>
                                    @else
                                    <option value="{{ $participant->id }}">{{ $participant->organization_name }}</option>
                                    @endif
                                    
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-2">
                    <textarea name="description" placeholder="Description" class="form-control" id="" cols="30" rows="10">{{ $project->description }}</textarea>
                </div>
                
                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection