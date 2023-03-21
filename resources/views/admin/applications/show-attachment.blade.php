<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
    {{-- HEAD --}}
    <thead>
        <tr class="nk-tb-item nk-tb-head">
            <th class="nk-tb-col"><span class="sub-text">Name</span></th>
            <th class="nk-tb-col"><span class="sub-text">Download</span></th>
        </tr>
    </thead>
    {{-- BODY --}}
    <tbody>
        @foreach ($application->inAttachments as $attachment)
        <tr class="nk-tb-item">
            <td class="nk-tb-col">
                {{ $attachment->name }}
            </td>
            <td class="nk-tb-col">
                <a href="{{ $attachment->path }}" class="btn btn-primary" download>Download</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>