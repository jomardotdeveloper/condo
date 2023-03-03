@if(Session::has('success'))
<x-alert color="success" :message="Session::get('success')" strong-message="Success"/>
@endif
@if($errors->any())
    @foreach($errors->all() as $error)
        <x-alert color="danger" :message="$error" strong-message="Error"/>
    @endforeach
@endif