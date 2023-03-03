
@if($isParent)
    <li class="nk-menu-item has-sub">
        <a href="#" class="nk-menu-link nk-menu-toggle">
            <span class="nk-menu-icon"><em class="{{ $logo }}"></em></span>
            <span class="nk-menu-text">{{ $name }}</span>
        </a>
        <ul class="nk-menu-sub">
            @foreach ($children as $child)
                <li class="nk-menu-item">
                    <a href="{{ $child['url'] }}" class="nk-menu-link"><span class="nk-menu-text">{{ $child['name'] }}</span></a>
                </li>
            @endforeach
        </ul>
    </li>
@else
    <li class="nk-menu-item">
        <a href="{{ $url }}" class="nk-menu-link">
            <span class="nk-menu-icon"><em class="{{ $logo }}"></em></span>
            <span class="nk-menu-text">{{ $name }}</span>
        </a>
    </li>
@endif