@extends('site.layouts.app')
@php
$albums = Modules\Gallery\Entities\Album::all();
@endphp
@section('content')
<div class="sg-page-content">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('') }}">{{__('home')}}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('image.albums')}}"> {{__('albums')}}</a></li>
            </ol>
        </nav>
        <div class="row">
            @foreach ($albums as $album)
            <div class="col-sm-4 mb-2">
                <div style="position: relative">
                    <a id="img-album-cover" data-id="{{$album->id}}">
                        <img src="{{ static_asset($album->original_image) }}" data-caption="{{$album->name}}" class="lightboxed" rel="img-{{$album->id}}" style="width: 426px;height:240px !important">
                    </a>
                    @foreach ($album->galleryImages as $image)
                    <img src="{{ static_asset($image->original_image) }}" data-caption="{{$image->title}}" class="lightboxed" rel="img-{{$album->id}}" style="width: 426px;height:240px !important;display: none">
                    @endforeach
                    <div class="post-title">{{$album->name}}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ static_asset('site/js/masonry.min.js') }}"></script>
<script src="{{ static_asset('site/js/loaded.min.js') }}"></script>
<script src="{{ static_asset('site/js/initialize.js') }}"></script>
@endsection