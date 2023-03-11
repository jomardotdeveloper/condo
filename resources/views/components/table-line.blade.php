<input type="hidden" name="lines" id="lines">
<table class="table table-ulogs">
    <thead class="table-light text-center">
        <tr>
            @foreach ($columns as $column)
            <th class="tb-col-ip"><span class="overline-title">{{ $column }}</span></th>
            @endforeach
            <th class="tb-col-action"><span class="overline-title">&nbsp;</span></th>
        </tr>
    </thead>
    <tbody class="text-center" id="table_body">
        @foreach ($initialData as $data)
            <tr id="tr">
                @foreach ($data as $value)
                    <td class="tb-col-ip"><span class="sub-text">{{ $value }}</span></td>
                @endforeach
                <td class="tb-col-action"></td>
                {{-- <td class="tb-col-action"><a href="javascript:void(0);" onclick="removeLine()" class="link-cross me-sm-n1"><em class="icon ni ni-cross"></em></a></td> --}}
            </tr>
        @endforeach

    </tbody>
</table>