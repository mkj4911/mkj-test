@php
    if($type === 'shops'){
        $path = 'storage/shops/';
    }
    if($type === 'products'){
        $path = 'storage/products/';
    }
    if($type === 'members'){
        $path = 'storage/members/';
    }
@endphp

<div>
    @if (empty($filename))
        <img src="{{ asset('images/no_image.jpg') }}">
    @else
        <img src="{{ asset($path . $filename) }}">
    @endif
</div>