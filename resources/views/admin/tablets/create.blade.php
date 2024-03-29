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
    @if ($_GET['type'] == 'visitation')
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            @include('admin.includes.alerts')
            <form action="{{ route('tablets.store') }} " class="row" method="POST">
                @csrf
                <input type="hidden" name="type" value="visitation"/>
                @if (!isset($_GET['is_returnee']))
                <input type="hidden" id='is_hidden_default' value="0" />
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
                <input type="hidden" id='is_hidden_default' value="1" />
                <input type="hidden" id='visitor_id' name="visitor_id" value="0" />
                <div class="col-6">
                    <x-input name="email" label="Email" type="text" />
                </div>

                    <div class="col-12 mt-2">
                        <button type="button" class="btn btn-primary" onclick="find()">
                            Find
                        </button>
                    </div>


                {{-- <div class="col-6 mt-2">
                    <x-select name="visitor_id" label="Visitor" :options="$visitors" :is-required="true"/>
                </div> --}}
                @endif


                <div class="row" id="to_be_hide">
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
    
                    {{-- <div class="col-6">
                        <x-input name="number_of_guests" label="Number of Guests" type="text" />
                    </div>
    
                    <div class="col-6">
                        <x-input name="expected_arrival_date" label="Expected Arrival Date" type="datetime-local" />
                    </div> --}}
    
                    <div class="col-6">
                        <x-input name="plate_number" label="Plate Number" type="text" />
                    </div>
                    <div class="col-12 mt-2">
                        <input type="submit" value="Submit" class="btn btn-primary" />
                    </div>
                </div>
                
                
              
            </form>
        </div>
    </div>
    @else
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('tablets.store') }}" class="row" method="POST">
                @csrf
                <input type="hidden" name="type" value="delivery"/>
                <div class="col-6 mt-2">
                    <x-select name="unit_id" label="Unit" :options="$units" :is-required="true"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="type" label="Type" :options="$types" :is-required="true"/>
                </div>

                <div class="col-6">
                    <x-input name="receiver_name" label="Receiver Name" type="text" />
                </div>

                <div class="col-6">
                    <x-input name="from" label="From" type="text" />
                </div>

                <div class="col-6">
                    <x-input name="number_of_items" label="Number of items" type="text" />
                </div>

                <div class="col-6">
                    <x-input name="reference_number" label="Reference Number" type="text" />
                </div>

                <div class="col-6">
                    <x-input name="notes" label="Notes" type="text" />
                </div>

                {{-- <div class="col-6">
                    <x-input name="expected_arrival_date" label="Expected Arrival Date" type="datetime-local" />
                </div> --}}

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
<script>
    var emails = @json($emails);
    var is_hidden_default = document.getElementById('is_hidden_default').value  == "1" ? true : false;

    if(is_hidden_default) {
        document.getElementById('to_be_hide').style.display = 'none';
    } else {
        document.getElementById('to_be_hide').style.display = null;
    }

    function find() {
        var email = document.getElementsByName('email')[0].value;
        var visitor_id = document.getElementById('visitor_id').value;

        if(Object.values(emails).includes(email)) {
            document.getElementById('to_be_hide').style.display = null;
            document.getElementById('visitor_id').value = getKeyByValue(emails, email);
        }else {
            alert('Email not found');
        }
    }
    function getKeyByValue(object, value) {
        return Object.keys(object).find(key => object[key] === value);
    }

    // console.log(getKeyByValue(emails, 'demo@demo.com'));
    // console.log(emails);

   
</script>
</html>

