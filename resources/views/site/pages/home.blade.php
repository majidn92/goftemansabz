@extends('site.layouts.app')



@section('content')
<div style="width: 90%;margin: auto">
    <h1>ahmad</h1>
    @include('site.partials.home.main_section')
    @foreach ($sections as $section)
    @php
        $posts = $section->posts->where('visibility',1)->where('status', 1)->where('section_id',$section->id);
    @endphp
    @include('site.partials.home.sections')
    @endforeach
</div>
@endsection