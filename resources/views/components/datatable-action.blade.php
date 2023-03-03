<td class="nk-tb-col nk-tb-col-tools">
    <ul class="nk-tb-actions gx-1">
        <li>
            <div class="drodown">
                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                <div class="dropdown-menu dropdown-menu-end">
                    <ul class="link-list-opt no-bdr">
                        @foreach ($items as $item)
                        @if(array_key_exists('url', $item))
                        <li><a href="{{ $item['url'] }}"><em class="{{ $item['icon'] }}"></em><span> {{ $item['name'] }} </span></a></li>
                        @else
                        <li><a href="javascript:void(0);" onclick="{{ $item['onclick'] }}"><em class="{{ $item['icon'] }}"></em><span>{{ $item['name'] }}</span></a></li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </li>
    </ul>
</td>