@extends('common::layouts.master')
@section('post-aria-expanded')
    aria-expanded="true"
@endsection
@section('post-show')
    show
@endsection
@section('post')
    active
@endsection
@section('create_audio')
    active
@endsection
@section('modal')
    @include('gallery::image-gallery')
    @include('gallery::audio-gallery')
    @include('gallery::video-gallery')
@endsection

@section('style')
    <link rel="stylesheet" href="{{url('public/vendor/persian-datepicker/persian-datepicker.css') }}">
@endsection

@section('content')
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            {!! Form::open(['route' => ['update-post', 'audio', $post->id], 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
            <input type="hidden" id="images" value="{{ $countImage }}">
            <input type="hidden" id="videos" value="{{ $countVideo }}">
            <input type="hidden" id="audios" value="{{ $countAudio }}">
            <input type="hidden" id="imageCount" value="1">
            <input type="hidden" id="audioCount" value="1">
            <div class="row clearfix">
                <div class="col-12">
                    <div class="add-new-header clearfix m-b-20">
                        <div class="row">
                            <div class="col-6">
                                <div class="block-header">
                                    <h2>{{ __('update_post') }}</h2>
                                </div>
                            </div>
                            <div class="col-6 text-left">
                                <a href="{{ route('post') }}" class="btn btn-primary btn-add-new"><i class="fas fa-list"></i> {{ __('posts') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            @if (session('error'))
                                <div id="error_m" class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if (session('success'))
                                <div id="success_m" class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <!-- Main Content section start -->
                        <div class="col-12 col-lg-9">
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header">
                                    <h2>{{ __('posts_details') }}</h2>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="post_on_title" class="col-form-label">???? ????????</label>
                                        <input id="post_on_title" onkeyup="metaTitleSet()" name="on_title" value="{{ $post->on_title }}" value="{{ old('on_title') }}" type="text" class="form-control" placeholder="???? ???????? ???? ???????? ????????????">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="post_title" class="col-form-label">{{ __('title') }}*</label>
                                        <input id="post_title" name="title" value="{{ $post->title }}" value="{{ old('title') }}" type="text" class="form-control" required placeholder="???????? ???? ???????? ????????????">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="post_sub_title" class="col-form-label">?????? ??????</label>
                                        <textarea name="sub_title" id="post_sub_title" cols="30" class="form-control" rows="4" placeholder="?????? ?????? ???? ???????? ????????????">{{ $post->sub_title }}{{ old('sub_title') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="post-slug" class="col-form-label"><b>{{ __('slug') }}</b></label>
                                        <input id="post-slug" value="{{ $post->slug }}" name="slug" type="text" class="form-control" placeholder="???????? ???? ???????? ????????????">
                                    </div>
                                </div>
                                <!-- tinemcey start -->
                                <div class="row p-l-15">
                                    <div class="col-12">
                                        <label for="post_content" class="col-form-label">{{ __('content') }}*</label>
                                        <textarea name="content" value="{{ $post->content }}" id="post_content" cols="30" rows="5">
                                                        {!! $post->content !!}
                                                    </textarea>
                                    </div>
                                </div>
                                <!-- tinemcey end -->
                            </div>

                            {{-- ???????? ?????? ?????? ?????????? --}}
                            {{-- <div class="add-new-page  bg-white p-20 m-b-20 add-new-content">
                                <div class="block-header">
                                    <h2>{{ __('add_content') }}</h2>
                                </div>
                                <div class="row pb-3">
                                    <div class="col-md-2 text-center area">
                                        <div class="item" onclick="addContent('text')">
                                            <img class="pb-3" src="{{static_asset('default-image/content-icon/text.png') }}"><br>
                                            <label>{{ __('text') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center area">
                                        <div class="item" onclick="addContent('image')">
                                            <img class="pb-3" src="{{static_asset('default-image/content-icon/image.png') }}"><br>
                                            <label>{{ __('image') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center area">
                                        <div class="item" onclick="addContent('image-text')">
                                            <img class="pb-3" src="{{static_asset('default-image/content-icon/image-text.png') }}"><br>
                                            <label>{{ __('image_left') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center area">
                                        <div class="item" onclick="addContent('text-image')">
                                            <img class="pb-3" src="{{static_asset('default-image/content-icon/text-image.png') }}"><br>
                                            <label>{{ __('image_right') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center area">
                                        <div class="item" onclick="addContent('text-image-text')">
                                            <img class="pb-3" src="{{static_asset('default-image/content-icon/text-image-text.png') }}"><br>
                                            <label>{{ __('image_center') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center area">
                                        <div class="item" onclick="addContent('video')">
                                            <img class="pb-3" src="{{static_asset('default-image/content-icon/video.png') }}"><br>
                                            <label>{{ __('video') }}</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="row pb-3">
                                    <div class="col-md-2 text-center area">
                                        <div class="item" onclick="addContent('ads')">
                                            <img class="pb-3" src="{{static_asset('default-image/content-icon/ads.png') }}"><br>
                                            <label>{{ __('ads') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="block-header">
                                    <h2>{{ __('embadded') }}</h2>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 text-center area">
                                        <div class="item" onclick="addContent('code')">
                                            <img class="pb-3" src="{{static_asset('default-image/content-icon/code.png') }}"><br>
                                            <label>{{ __('code') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center area">
                                        <div class="item" onclick="addContent('twitter-embed')">
                                            <img class="pb-3" src="{{static_asset('default-image/content-icon/twitter.png') }}"><br>
                                            <label>{{ __('twitter') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center area">
                                        <div class="item" onclick="addContent('vimeo-embed')">
                                            <img class="pb-3" src="{{static_asset('default-image/content-icon/vimeo.png') }}"><br>
                                            <label>{{ __('vimeo') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center area">
                                        <div class="item" onclick="addContent('youtube-embed')">
                                            <img class="pb-3" src="{{static_asset('default-image/content-icon/youtube.png') }}"><br>
                                            <label>{{ __('youtube') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="content-area">
                                {{-- all content --}}
                                @php
                                    $content_count = 0;
                                @endphp
                                @foreach ($post_contents as $page => $content)
                                    @php
                                        $page = array_keys($content);
                                        $content_count++;
                                        
                                    @endphp
                                    @include('post::contents/' . $page[0], compact('content_count', 'content'))
                                @endforeach
                                {{-- all content --}}
                            </div>
                            <!-- visibility section start -->
                            <div class="row add-new-page  bg-white p-20 m-b-20">
                                <div class="col-sm-6 p-l-15">
                                    <label class="custom-control custom-checkbox pt-1">
                                        <input type="checkbox" id="featured_post" name="featured" class="custom-control-input" @if ($post->featured == 1) checked @endif>
                                        <span class="custom-control-label"></span>
                                        <label for="featured_post">{{ __('add_to_featured') }}</label>
                                    </label>
                                </div>
                                <div class="col-sm-6 p-l-15">
                                    <label class="custom-control custom-checkbox pt-1">
                                        <input type="checkbox" id="add_to_breaking" @if ($post->breaking == 1) checked @endif name="breaking" class="custom-control-input">
                                        <span class="custom-control-label"></span>
                                        <label for="add_to_breaking">{{ __('add_to_breaking') }}</label>
                                    </label>
                                </div>
                                <div class="col-sm-6 p-l-15">
                                    <label class="custom-control custom-checkbox pt-1">
                                        <input type="checkbox" id="add_to_slide" @if ($post->slider == 1) checked @endif name="slider" class="custom-control-input">
                                        <span class="custom-control-label"></span>
                                        <label for="add_to_slide">{{ __('add_to_slider') }}</label>
                                    </label>
                                </div>
                                <div class="col-sm-6 p-l-15">
                                    <label class="custom-control custom-checkbox pt-1">
                                        <input type="checkbox" id="recommended" @if ($post->recommended == 1) checked @endif name="recommended" class="custom-control-input">
                                        <span class="custom-control-label"></span>
                                        <label for="recommended">{{ __('add_to_recommended') }}</label>
                                    </label>
                                </div>
                                <div class="col-sm-6 p-l-15">
                                    <label class="custom-control custom-checkbox pt-1">
                                        <input type="checkbox" id="editor_picks" name="editor_picks" class="custom-control-input" @if ($post->editor_picks == 1) checked @endif>
                                        <span class="custom-control-label"></span>
                                        <label for="editor_picks">{{ __('add_to_editor_picks') }}</label>
                                    </label>
                                </div>
                                <div class="col-sm-6 p-l-15 pt-1">
                                    <label class="custom-control custom-checkbox pt-1">
                                        <input type="checkbox" id="auth_required" @if ($post->auth_required == 1) checked @endif name="auth_required" class="custom-control-input">
                                        <span class="custom-control-label"></span>
                                        <label for="auth_required">{{ __('show_only_to_authenticate_users') }}</label>
                                    </label>
                                </div>
                                <div class="col-sm-6 p-l-15 pt-1">
                                    <label class="custom-control custom-checkbox pt-1">
                                        <input type="checkbox" id="iran" name="iran" class="custom-control-input" @if ($post->iran == 1) checked @endif>
                                        <span class="custom-control-label"></span>
                                        <label for="iran">??????????</label>
                                    </label>
                                </div>
                                <div class="col-sm-6 p-l-15 pt-1">
                                    <label class="custom-control custom-checkbox pt-1">
                                        <input type="checkbox" id="world" name="world" class="custom-control-input" @if ($post->world == 1) checked @endif>
                                        <span class="custom-control-label"></span>
                                        <label for="world">????????</label>
                                    </label>
                                </div>
                                <div class="col-sm-6 p-l-15 pt-1">
                                    <label class="custom-control custom-checkbox pt-1">
                                        <input type="checkbox" id="populare" name="populare" class="custom-control-input" @if ($post->populare == 1) checked @endif>
                                        <span class="custom-control-label"></span>
                                        <label for="populare">????????????????</label>
                                    </label>
                                </div>
                                <div class="col-sm-6 p-l-15 pt-1">
                                    <label class="custom-control custom-checkbox pt-1">
                                        <input type="checkbox" id="report" name="report" class="custom-control-input" @if ($post->report == 1) checked @endif>
                                        <span class="custom-control-label"></span>
                                        <label for="report">??????????</label>
                                    </label>
                                </div>
                                <div class="col-sm-6 p-l-15 pt-1">
                                    <label class="custom-control custom-checkbox pt-1">
                                        <input type="checkbox" id="conversation" name="conversation" class="custom-control-input" @if ($post->conversation == 1) checked @endif>
                                        <span class="custom-control-label"></span>
                                        <label for="conversation">??????????</label>
                                    </label>
                                </div>
                                <div class="col-sm-6 p-l-15">
                                    <label class="custom-control custom-checkbox pt-1">
                                        <input type="checkbox" id="visibility" name="visibility" class="custom-control-input" @if ($post->visibility == 0) checked @endif>
                                        <span class="custom-control-label"></span>
                                        <label for="visibility">?????? ??????????</label>
                                    </label>
                                </div>
                                <div class="col-sm-6 offset-6 p-l-15">
                                    <label class="custom-control custom-checkbox pt-1">
                                        <input type="checkbox" id="is_state_post" name="is_state_post" class="custom-control-input" @if ($post->is_state_post == 1) checked @endif>
                                        <span class="custom-control-label"></span>
                                        <label for="is_state_post">???????????? ???? ?????????? ?????????? ????</label>
                                    </label>
                                </div>
                                <div class="col-sm-6 p-l-15">
                                    @php
                                        $states = DB::table('states')->get();
                                    @endphp
                                    <label><b>??????????</b></label>
                                    <select name="state_id" class="form-control">
                                        @foreach ($states as $state)
                                            <option @if ($post->state_id == $state->id) selected @endif value="{{ $state->id }}">{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 p-l-15">
                                    @php
                                        $sections = DB::table('sections')->get();
                                    @endphp
                                    <label><b>?????? ???? ????????</b></label>
                                    <select name="section_id" class="form-control">
                                        @foreach ($sections as $section)
                                            <option @if ($post->section_id == $section->id) selected @endif value="{{ $section->id }}">{{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- visibility section end -->
                            <!-- SEO section start -->
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header">
                                    <h2>{{ __('seo_details') }}</h2>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="meta_title"><b>?????????? ??????????</b></label>
                                        <input class="form-control meta" value="{{ $post->meta_title ?? $post->title }}" id="meta_title" name="meta_title" data-type="title" placeholder="?????????? ?????????? ???? ???????? ????????????">
                                        {{-- <p class="display-nothing alert alert-danger mt-2" role="alert">
                                            {{ __('current_characters') }}: <span class="characters"></span>, {{ __('meta_title') . ' ' . __('should_bd') . ' ' . __('in_between') . ' ' . '30-60 ' . __('characters') }}
                                        </p>
                                        <p class="display-nothing alert alert-success mt-2" role="alert">
                                            {{ __('current_characters') }}: <span class="characters"></span>
                                        </p> --}}
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="post_desc"><b>?????????? ??????????????</b></label>
                                        <textarea class="form-control meta" id="meta_description" name="meta_description" data-type="description" rows="3" placeholder="?????????? ?????????????? ???? ???????? ????????????">{{ $post->meta_description }}</textarea>
                                        {{-- <p class="display-nothing alert alert-danger mt-2" role="alert">
                                            {{ __('current_characters') }}: <span class="characters"></span>, {{ __('meta_title') . ' ' . __('should_bd') . ' ' . __('in_between') . ' ' . '30-60 ' . __('characters') }}
                                        </p>
                                        <p class="display-nothing alert alert-success mt-2" role="alert">
                                            {{ __('current_characters') }}: <span class="characters"></span>
                                        </p> --}}
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="post-keywords" class="col-form-label"><b>{{ __('keywords') }}</b>
                                        </label>
                                        <input id="post-keywords" name="meta_keywords" value="{{ $post->meta_keywords }}" type="text" class="form-control" placeholder="?????????? ?????????? ???? ???????? ????????????">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="post_tags" class="col-form-label"><b>{{ __('tags') }}</b></label>
                                        <input id="post_tags" name="tags" type="text" value="{{ $post->tags }}" data-role="tagsinput" class="form-control"  placeholder="?????????? ???? ???? ???????? ????????????">
                                    </div>
                                </div>
                            </div>
                            <!-- SEO section end -->
                        </div>
                        <!-- Main Content section end -->

                        <!-- right sidebar start -->
                        <div class="col-12 col-lg-3">
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header">
                                    <h2>{{ __('upload_audio') }}*</h2>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <!-- Large modal -->
                                        <div id="image_library_selection">
                                            <button type="button" id="btnAudioModal" class="btn btn-primary" data-toggle="modal" data-target=".audio-modal-lg">{{ __('add_audio') }}</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="selected-audios">
                                            <span id="audio_thumb">
                                                @foreach (@$post->audio as $item)
                                                    @if (isFileExist($item, @$item->original))
                                                        <div class="audio-item audio_{{ $item->id }} mb-1" id="{{ $item->id }}">
                                                            <input id="{{ $item->id }}" name="audio[]" type="hidden" value="{{ $item->id }}">
                                                            <div class="left"><i class="fa fa-music"></i></div>
                                                            <div class="center">{{ $item->audio_name }}</div>
                                                            <div class="right"><button type='button' class='btn btn-danger px-1 py-0 float-right row_remove'><i class='m-r-0 mdi mdi-delete'></i></button></div>

                                                        </div>
                                                    @endif
                                                @endforeach
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="col-sm-12">
                                    <div class="form-group text-center">
                                        <!-- Large modal -->
                                        <button type="button" id="btn_image_modal" class="btn btn-primary btn-image-modal" data-id="1" data-toggle="modal" data-target=".image-modal-lg">{{ __('add_image') }}</button>
                                        <input id="image_id" value="{{ $post->image_id }}" name="image_id" type="hidden" class="form-control image_id">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-group text-center">
                                            @if (isFileExist($post->image, $result = @$post->image->thumbnail))
                                                <img src=" {{ basePath($post->image) }}/{{ $result }} " id="image_preview" width="200" height="200" alt="image" class="img-responsive img-thumbnail image_preview" alt="{!! $post->title !!}">
                                            @else
                                                <img src="{{ static_asset('default-image/default-100x100.png') }} " id="image_preview" width="200" height="200" alt="image" class="img-responsive img-thumbnail image_preview" alt="{!! $post->title !!}">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="post_language">{{ __('select_language') }}*</label>
                                        <select class="form-control dynamic-category" id="post_language" name="language" data-dependent="category_id">
                                            @foreach ($activeLang as $lang)
                                                <option @if ($post->language == $lang->code) Selected @endif value="{{ $lang->code }}">{{ $lang->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="category_id">{{ __('category') }}*</label>
                                        <select class="form-control dynamic" id="category_id" name="category_id" data-dependent="sub_category_id" required>
                                            <option value="">{{ __('select_category') }}</option>
                                            @foreach ($categories as $category)
                                                <option @if ($post->category_id == $category->id) Selected @endif value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="sub_category_id">{{ __('sub_category') }}</label>
                                        <select class="form-control dynamic" id="sub_category_id" name="sub_category_id">
                                            <option value="">{{ __('select_sub_category') }}</option>
                                            @foreach ($subCategories as $subCategory)
                                                <option @if ($post->sub_category_id == $subCategory->id) Selected @endif value="{{ $subCategory->id }}">{{ $subCategory->sub_category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="add-new-page  bg-white p-20 pb-1">
                                <div class="col-md-12">
                                    <div class="block-header">
                                        <h2>{{ __('article_detail') }}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header col-sm-12">
                                    <h2>{{ __('publish') }}*</h2>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <select class="form-control" id="post_status" name="status" required>
                                            <option @if ($post->status == 1 && $post->scheduled == 0) selected @endif value="1">{{ __('published') }}</option>
                                            <option @if ($post->status == 0 && $post->scheduled == 0) selected @endif value="0">{{ __('draft') }}</option>
                                            <option @if ($post->status == 0 && $post->scheduled == 1) selected @endif value="2">{{ __('scheduled') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 divScheduleDate" @if ($post->post_status == 0 && $post->scheduled == 1) @else id="display-nothing" @endif>
                                    <label for="scheduled_date">{{ __('schedule_date') }}</label>
                                    <div class="input-group">
                                        <label class="input-group-text" for="scheduled_date"><i class="fa fa-calendar-alt"></i></label>
                                        <input type="text" class="form-control example1" name="scheduled_date" style="direction: rtl" />
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="custom-control" for="btnSubmit"></label>
                                        <button type="submit" name="btnSubmit" class="btn btn-primary pull-right"><i class="m-l-10 mdi mdi-content-save-all"></i>{{ __('save') }}
                                        </button>
                                        <label class="" for="btnSubmit"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- right sidebar end -->
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
            <!-- page info end-->
        </div>
    </div>

    <input type="hidden" value="{{ $content_count }}" id="content_number">





@endsection
@section('script')
    <script>
        $(document).ready(function() {

            $('.dynamic-category').change(function() {
                if ($(this).val() != '') {
                    var select = $(this).attr("id");
                    var value = $(this).val();
                    var dependent = $(this).data('dependent');
                    var _token = "{{ csrf_token() }}";
                    $.ajax({
                        url: "{{ route('category-fetch') }}",
                        method: "POST",
                        data: {
                            select: select,
                            value: value,
                            _token: _token
                        },
                        success: function(result) {
                            $('#' + dependent).html(result);
                        }

                    })
                }
            });


            $('#post_language').change(function() {
                $('#category_id').val('');
                $('#sub_category_id').val('');
            });

            $('.dynamic').change(function() {
                if ($(this).val() != '') {
                    var select = $(this).attr("id");
                    var value = $(this).val();
                    var dependent = $(this).data('dependent');
                    var _token = "{{ csrf_token() }}";
                    $.ajax({
                        url: "{{ route('subcategory-fetch') }}",
                        method: "POST",
                        data: {
                            select: select,
                            value: value,
                            _token: _token
                        },
                        success: function(result) {
                            $('#' + dependent).html(result);
                        }

                    })
                }
            });

            $('#category').change(function() {
                $('#sub_category_id').val('');
            });

            $(document).on("click", ".row_remove", function() {
                let element = $(this).parents('.audio-item');
                let id = element.attr("id");
                $('#' + id).remove();
            });
        });
    </script>
    <script>
        addContent = function(value) {

            var content_number = $("#content_number").val();
            content_number++;

            $.ajax({
                url: "{{ route('add-content') }}",
                method: "GET",
                data: {
                    value: value,
                    content_count: content_number
                },
                success: function(result) {
                    $('.content-area').append(result);
                    $("#content_number").val(content_number);

                    // auto scrolling to newly added element
                    var newlyAdded = 'content_' + content_number;
                    $('body, html').animate({
                        scrollTop: $('.' + newlyAdded).offset().top
                    }, 1000);
                }

            });
        }


        $(document).on("click", ".add-new-page .row_remove", function() {
            let element = $(this).parents('.add-new-page');
            //element.remove(1000);
            element.hide("slow", function() {
                $(this).remove();
            })
        });
    </script>

    <script type="text/javascript" src="{{ static_asset('js/post.js') }}"></script>
    <script src="{{ static_asset('js/tagsinput.js') }}"></script>

    
    <script type="text/javascript" src="{{ url('public/vendor/persian-datepicker/persian-date.js') }}"></script>
    <script type="text/javascript" src="{{ url('public/vendor/persian-datepicker/persian-datepicker.js') }}"></script>


    <script>
        $(document).ready(function() {
            $(".example1").pDatepicker({
                'timePicker': {
                    'enabled': false,
                },
                format: ' H:m:s YYYY/MM/DD ',

            });
        });

        $("input[name='title']").blur(function() {
            $("input[name='meta_title']").val($(this).val());
            var text = $(this).val();
            text = text.replace(/\ /g, "-");
            $("input[name='slug']").val(text);
        });

        $("textarea[name='sub_title']").blur(function() {
            $("textarea[name='meta_description']").val($(this).val());
        });
    </script>
@endsection
