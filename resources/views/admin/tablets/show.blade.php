<!DOCTYPE html>
<html lang="zxx" class="js">

@include('layouts.admin.head')

<style>
    .block {
        display: block;
        width: 100%;
        border: none;
        padding: 14px 28px;
        font-size: 16px;
        cursor: pointer;
        text-align: center;
    }
</style>

<body class="nk-body bg-white npc-default pg-error p-5">
    @if ($_GET['type'] == 'visitor')
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('guests.store') }} " class="row" method="POST">
                @csrf

                @if (!isset($_GET['is_returnee']))

                <div class="col-6">
                    <x-input name="first_name" label="First Name" type="text" />
                </div>

                <div class="col-6">
                    <x-input name="last_name" label="Last Name" type="text" />
                </div>

                <div class="col-6">
                    <x-input name="middle_name" label="Middle Name" type="text" />
                </div>

                <div class="col-6">
                    <x-input name="contact_number" label="Contact #" type="text" />
                </div>

                <div class="col-6">
                    <x-input name="email" label="Email" type="text" />
                </div>

                <div class="col-6">
                    <x-input name="address" label="Address" type="text" />
                </div>
                
                @else
                <input type="hidden" name="is_returnee" value="1">
                <div class="col-6 mt-2">
                    <x-select name="visitor_id" label="Visitor" :options="$visitors" :is-required="true"/>
                </div>
                @endif



                <div class="col-6 mt-2">
                    <x-select name="unit_id" label="Unit" :options="$units" :is-required="true"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="valid_id" label="Valid ID" :options="$valid_ids" :is-required="true"/>
                </div>

                <div class="col-6">
                    <x-input name="valid_id_number" label="Valid ID Number" type="text" />
                </div>

                <div class="col-6">
                    <x-input name="reason" label="Reason of visitation" type="text" />
                </div>

                <div class="col-6">
                    <x-input name="number_of_guests" label="Number of Guests" type="text" />
                </div>

                <div class="col-6">
                    <x-input name="expected_arrival_date" label="Expected Arrival Date" type="datetime-local" />
                </div>

                <div class="col-6">
                    <x-input name="plate_number" label="Plate Number" type="text" />
                </div>
                
                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>

    @endif
</body>
</html>