@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Settings', 'url' => 'javascript:void(0);'),
        array('name' => 'Setting', 'url' => route('settings.index')),
        array('name' => 'Create', 'url' => route('settings.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="New Setting" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('settings.update', ['setting' => $setting]) }}" class="row" method="POST">
                @csrf
                @method('PUT')
                <div class="col-6">
                    <x-input name="key" label="Key" type="text" :is-required="true" :default-value="$setting->key"/>
                </div>

                <div class="col-6">
                    <x-input name="value" label="Value" type="text" :is-required="true" :default-value="$setting->value"/>
                </div>

                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection