@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Purchasing', 'url' => 'javascript:void(0);'),
        array('name' => 'Projects', 'url' => route('projects.index')),
        array('name' => 'View', 'url' => route('projects.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="View Project" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- BUTTONS --}}
    @if ($project->is_approved && !$project->dealer_id)
    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#choose-winner-modal">
        Choose Winner
    </button>
    @endif

    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#view-participants-modal">
        View Participant
    </button>
    


    <div class="card card-bordered card-preview mt-2">
        <div class="card-inner">
            <div class="tab-content">
                <h6 class="title overline-title text-base">Project Details</h6>
                <div class="tab-pane active" id="personal-info">
                    <div class="nk-block">
                        <div class="profile-ud-list">
                            <x-show-item label="Name" value="{{ $project->name }}"/>
                            <x-show-item label="Approved" value="{{ $project->is_approved ? 'YES' : 'NO' }}"/>
                            <x-show-item label="Budget" value="{{ $project->budget }}"/>
                            <x-show-item label="Winner" value="{{ $project->dealer_id ? $project->dealer->organization_name : 'N/A' }}"/>
                            <x-show-item label="Description" value="{{ $project->description }}"/>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- MODAL --}}
<x-modal id="choose-winner-modal" title="Choose Winner" footer="Choose Winner">
    <form action="{{ route('projects.update', ['project' => $project]) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="choose_winner" value="1" />
        <div class="col-12 mt-2">
            <x-select name="bidding_id" label="Participant" :options="$participants" />
        </div>
        <div class="col-12 mt-2">
            <input type="submit" value="Submit" class="btn btn-primary" />
        </div>
    </form>
</x-modal>

<x-modal id="view-participants-modal" title="Participants" footer="Participants">
    <table class="table table-responsive">
        <thead>
            <tr>
                <th>Company Name</th>
                <th>File</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($project->biddings as $bidding)
                <tr>
                    <td>{{ $bidding->dealer->organization_name }}</td>
                    <td>
                        @if ($bidding->offer_src)
                            <a href="{{ asset($bidding->offer_src) }}" target="_blank">View</a>
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-modal>
{{-- 
<x-modal id="attachment-create-modal" title="Add Attachment" footer="Attachment">
    <form action="{{ route('applications.store-attachment') }}" class="row" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="application_id" value="{{ $application->id }}"/>
        <input type="hidden" name="status" value="{{ $application->status }}"/>
        <div class="col-12">
            <x-input name="name" label="Name" type="text"  :is-required="true"/>
        </div>

        <div class="col-12">
            <x-input name="path" label="File" type="file" :is-required="true"/>
        </div>

        <div class="col-12 mt-2">
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
    </form>
</x-modal> --}}



@endsection
