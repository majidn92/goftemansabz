@php
$side_ads = $section->side_ads->sortBy('rank');
@endphp
<style>
    img {
        height: unset;
    }
</style>
@foreach ($side_ads as $item)
<div class="mb-1">
    <a href="{{ $item->url }}">
        <img src="{{ url($item->path) }}" style="height: 100px;width:100%">
    </a>
</div>
@endforeach