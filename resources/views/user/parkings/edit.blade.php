@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Settings', 'url' => 'javascript:void(0);'),
        array('name' => 'Parkings', 'url' => route('user-parkings.index')),
        array('name' => 'Edit', 'url' => route('parkings.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="Edit Parking Plate Number" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('parkings.update', ['parking' => $parking]) }}" class="row" method="POST">
                @csrf
                @method('PUT')

                <div class="col-6 mt-2">
                    <x-input name="plate_number" label="Plate Number" type="text" :default-value="$parking->plate_number"/>
                </div>

                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
