<table class="table table-ulogs">
    <thead class="table-light">
        <tr>
            @foreach ($columns as $column)
            <th class="tb-col-ip"><span class="overline-title">{{ $column }}</span></th>
            @endforeach
            <th class="tb-col-action"><span class="overline-title">&nbsp;</span></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($initialData as $data)
            <tr>
                @foreach ($data as $key => $value)
                    <td class="tb-col-ip"><span class="sub-text">{{ $value }}</span></td>
                @endforeach
                <td class="tb-col-action"></td>
            </tr>
        @endforeach
        <tr>
            <td class="tb-col-os">Chrome on Window</td>
            <td class="tb-col-ip"><span class="sub-text">192.149.122.128</span></td>
            <td class="tb-col-time"><span class="sub-text">11:34 PM</span></td>
            <td class="tb-col-action"><a href="#" class="link-cross me-sm-n1"><em class="icon ni ni-cross"></em></a></td>
        </tr>
    </tbody>
</table>