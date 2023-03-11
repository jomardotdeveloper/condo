@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Finance', 'url' => 'javascript:void(0);'),
        array('name' => 'Invoices', 'url' => route('invoices.index')),
        array('name' => 'Create', 'url' => route('invoices.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="New Invoice" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('invoices.store') }}" class="row" method="POST">
                @csrf
                <div class="col-6">
                    <x-input name="due_date" label="Due Date" type="date" :is-required="true"/>
                </div>

                @if (isset($units))
                    <div class="col-6">
                        <x-select name="unit_id" label="Unit" :options="$units" :is-required="true"/>
                    </div>
                @endif

                @if (isset($applications))
                    <div class="col-6">
                        <x-select name="application_id" label="Application" :options="$applications" :is-required="true"/>
                    </div>
                @endif

                @if (isset($move_outs))
                    <div class="col-6">
                        <x-select name="move_out_id" label="Move Out" :options="$move_outs" :is-required="true"/>
                    </div>
                @endif

                @if(isset($remarks))
                    <div class="col-6">
                        <x-input name="remarks" label="Remarks" type="text" />
                    </div>
                @endif


                <div class="col-12 mt-3">
                    <button type="button" class="btn btn-sm btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#invoice-line-modal">
                        Add Line
                    </button>
                    {{-- INVOICE LINE --}}
                    <x-table-line :columns="['Label', 'Amount']" :initial-data="[['asd', 'asd'], ['asd', 'asd']]"  /> 
                </div>

                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

{{-- INVOICE LINE MODAL --}}
<x-modal id="invoice-line-modal" title="Invoice Line" footer="footer">
    <form action="#" class="row" method="POST">
        @csrf
        <div class="col-12">
            <x-input name="label" label="Label" type="text" />
        </div>

        <div class="col-12">
            <x-input name="amount" label="Amount" type="number" />
        </div>

        <div class="col-12 mt-2">
            <button type="button" class="btn btn-primary" onclick="addLine()">Add</button>
        </div>
    </form>
</x-modal>

@endsection

@push('scripts')
    <script>
        var lines = [];
        var id = 1;

        function addLine() {
            var label = $('#invoice-line-modal input[name="label"]').val();
            var amount = $('#invoice-line-modal input[name="amount"]').val();

            if (label == '' || amount == '') {
                return;
            }

            lines.push({
                id : id,
                label: label,
                amount: amount
            });

            $("#table_body").append(`
                <tr id="${id}">
                    <td class="tb-col-ip"><span class="sub-text">${label}</span></td>
                    <td class="tb-col-ip"><span class="sub-text">${amount}</span></td>
                    <td class="tb-col-action"><a href="javascript:void(0);" onclick="removeLine(${id})" class="link-cross me-sm-n1"><em class="icon ni ni-cross"></em></a></td>
                </tr>
            `);

            $('#lines').val(JSON.stringify(lines));
            $('#invoice-line-modal').modal('hide');
            $('#invoice-line-modal input[name="label"]').val("");
            $('#invoice-line-modal input[name="amount"]').val("");
            id++;
        }

        function removeLine(id) {
            lines = lines.filter(function (line) {
                return line.id != id;
            });

            $('#lines').val(JSON.stringify(lines));
            $(`#${id}`).remove();
        }
    </script>
@endpush
