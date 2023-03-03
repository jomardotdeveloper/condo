<nav>
    <ul class="breadcrumb breadcrumb-arrow" >
        @foreach ($items as $item)
            @if($items[count($items) - 1] == $item)
                <li class="breadcrumb-item active" style="font-size:13px !important;">{{ $item['name'] }}</li>
            @else
                <li class="breadcrumb-item" style="font-size:13px !important;"><a href="{{ $item['url'] }}">{{ $item['name'] }}</a></li>
            @endif
        @endforeach
        
    </ul>
</nav>