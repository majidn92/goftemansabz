@php
$section = Modules\Post\Entities\Section::find(1);
$posts = $section->posts->where('status',1)->where('visibility',1);
// dd($posts);
@endphp

<div class="section-box" style="border-color: var(--primary-color)">
    @if ($section->slider)
    <div class="row m-0">
        {{-- -----------------بخش اول--------------------- نمایش بخش اسلایدر ------------------------------------------------- --}}
        <div class="col-sm-10">
            @php

            $slider_posts = $posts
            ->where('slider', 1)
            ->sortByDesc('created_at')
            ->take(10);
            $block_posts = $posts
            ->where('featured', 1)
            ->sortByDesc('created_at')
            ->take(10);
            $specialty_posts = $posts
            ->where('rss', 0)
            ->sortByDesc('created_at')
            ->take(10);
            $rss_posts = $posts
            ->where('rss', 1)
            ->sortByDesc('created_at')
            ->take(10);
            @endphp

            <style>
                /* li {
        list-style-type: none;
    }

    li::before {
        content: "• ";
        color: red;
        font-size: 2em;
    } */
            </style>

            {{-- <div class="sg-breaking-news">
                <div class="container">
                    <div class="breaking-content d-flex">
                        <span>{{ __('breaking_news') }}</span>
                        <ul class="news-ticker">
                            @foreach ($breakingNewss as $post)
                            <li id="display-nothing">
                                <a href="{{ route('article.detail', ['id' => $post->slug]) }}">{!! \Illuminate\Support\Str::limit($post->title, 100) !!}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div> --}}

            <div class="sg-home-section mb-3">
                <div>
                    <div class="row">
                        <div class="col-lg-6 p-0">
                            <div class="post-slider">
                                @foreach ($slider_posts as $post)
                                <div class="sg-post featured-post">
                                    @include('site.partials.home.primary.slider')
                                    <div class="entry-content absolute">
                                        <div class="category">
                                            <ul class="global-list">
                                                @isset($post->category->category_name)
                                                <li>
                                                    <a href="{{ url('category', $post->category->slug) }}">{{ $post->category->category_name }}</a>
                                                </li>
                                                @endisset
                                            </ul>
                                        </div>
                                        <h2 class="entry-title">
                                            <a href="{{ route('article.detail', ['id' => $post->slug]) }}">{!! \Illuminate\Support\Str::limit($post->title, 50) !!}</a>
                                        </h2>
                                        <div class="entry-meta">
                                            <ul class="global-list">
                                                <li><a href="{{ route('site.author', ['id' => $post->user->id]) }}">{{ data_get($post, 'user.first_name') }} {{ data_get($post, 'user.last_name') }}</a>
                                                </li>
                                                <li><a href="{{ route('article.date', date('Y-m-d', strtotime($post->updated_at))) }}">{{ miladi_to_jalali($post->updated_at) }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            {{-- <div class="row">
                                @foreach ($blockPosts as $post)
                                <div class="col-md-6">
                                    <div class="sg-post position-relative">
                                        <div class="entry-header">
                                            <div class="entry-thumbnail">
                                                <a href="{{ route('article.detail', ['id' => $post->slug]) }}">
                                                    @if (isFileExist(@$post['image'], $result = @$post['image']->medium_image))
                                                    <img src="{{ safari_check()? basePath(@$post['image']) . '/' . $result: static_asset('default-image/default-358x215.png') }} " data-original=" {{ basePath(@$post['image']) }}/{{ $result }} " class="img-fluid lazy" alt="{!! $post->title !!}">
                                                    @else
                                                    <img src="{{ static_asset('default-image/default-358x215.png') }} " class="img-fluid" alt="{!! $post->title !!}">
                                                    @endif
                                                </a>
                                            </div>
                                            @if ($post->post_type == 'video')
                                            <div class="video-icon block">
                                                <img src="{{ static_asset('default-image/video-icon.svg') }} " alt="video-icon">
                                            </div>
                                            @elseif($post->post_type == 'audio')
                                            <div class="video-icon block">
                                                <img src="{{ static_asset('default-image/audio-icon.svg') }} " alt="audio-icon">
                                            </div>
                                            @endif
                                            <div class="category">
                                                <ul class="global-list">
                                                    @isset($post->category->category_name)
                                                    <li>
                                                        <a href="{{ url('category', $post['category']->slug) }}">{{ $post['category']->category_name }}</a>
                                                    </li>
                                                    @endisset
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="entry-content block position-absolute" style="top: 70px">
                                            <a href="{{ route('article.detail', ['id' => $post->slug]) }}">
                                                <p>{!! \Illuminate\Support\Str::limit($post->title, 70) !!}</p>
                                            </a>
                                            <div class="entry-meta">
                                                <ul class="global-list">
                                                    <li><a href="{{ route('article.date', date('Y-m-d', strtotime($post->updated_at))) }}"> {{ miladi_to_jalali($post->updated_at) }}</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                @endforeach
                            </div> --}}

                            <div class="majid">
                                @foreach ($block_posts as $post)
                                <div style="position: relative">
                                    {{-- <img src="{{ url($post) }}" width="150">
                                    <a href="{{ route('article.detail', ['id' => $post->slug]) }}">
                                        <p>{!! \Illuminate\Support\Str::limit($post->title, 70) !!}</p>
                                    </a> --}}
                                    <a href="{{ route('article.detail', ['id' => $post->slug]) }}">
                                        @if (isFileExist(@$post->image, $result = @$post->image->medium_image))
                                        <img src="{{ safari_check() ? basePath(@$post->image) . '/' . $result : static_asset('default-image/default-358x215.png') }} " data-original=" {{ basePath(@$post->image) }}/{{ $result }} " class="img-fluid lazy" alt="{!! $post->title !!}" width="100%" height="100%">
                                        @else
                                        <img src="{{ static_asset('default-image/default-358x215.png') }} " class="img-fluid" alt="{!! $post->title !!}">
                                        @endif
                                    </a>
                                    <div style="position: absolute;bottom:0;right:0;left:0;padding:3px;height:35%;background-color: black;background-color:rgba(0,0,0,0.65);color:white;display: flex; align-items: flex-end;direction: rtl;border-radius: 0px 0px 5px 5px">
                                        {!! \Illuminate\Support\Str::limit($post->title, 60) !!}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="pb-2" style="background-color: rgb(235, 235, 235);border-radius: 4px">
                                <div>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation" style="width: 50%;text-align: center">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">اخبار تخصصی</a>
                                        </li>
                                        <li class="nav-item" role="presentation" style="width: 50%;text-align: center">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">RSS</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent" style="padding-top: 15px;padding-bottom: 10px;padding-right: 5px">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            {{-- ----------------------------------------------------بابت اخبار تخصصی ---------------------------------------------------- --}}
                                            @foreach ($specialty_posts as $post)
                                            <li style="font-size: 13px;list-style-type: none;padding-bottom:2px">
                                                <a href="{{ route('article.detail', ['id' => $post->slug]) }}" target="_blank">
                                                    {{ Str::limit($post->title, 65) }} |
                                                </a>
                                                {{ $post->feed }} --
                                                <span style="color: #a99f9f">{{ ago_time($post->created_at) }}</span>
                                            </li>
                                            @endforeach
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            {{-- -------------------------------------------------- RSS بابت --------------------------------------------------------------- --}}
                                            @foreach ($rss_posts as $post)
                                            <li style="font-size: 13px;list-style-type: none;padding-bottom:2px">
                                                <a href="{{ route('article.detail', ['id' => $post->slug]) }}" target="_blank">
                                                    {{ Str::limit($post->title, 65) }} |
                                                </a>
                                                {{ $post->feed }} --
                                                <span style="color: #a99f9f">{{ ago_time($post->created_at) }}</span>
                                            </li>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- ----------------------------------------------------- نمایش بخش تبلیغات کناری --------------------------------------------- --}}
        <div class="col-sm-2 text-center p-0">
            @php
            $side_ads = $section->side_ads;
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
        </div>
    </div>
    @endif

    <div class="row mb-4 mt-2">
        {{-- -----------------------بخش دوم--------------------- نمایش بخش آخرین اخبار ----------------------------------------------------- --}}
        @if ($section->last_post)
        <div class="col-sm-6 mb-2">
            <div class="p-2" style="background-color: rgb(235, 235, 235);padding-right: 20px !important;border-radius: 4px">
                <span style="font-weight: 600;color:var(--primary-color)">آخرین اخبار</span>
                <hr style="background-color: var(--primary-color);height: 2px;margin-top: 8px">
                <div>
                    <ul>
                        @php
                        $last_posts = $posts->sortByDesc('created_at')->take(10);
                        @endphp
                        {{-- ----------------------------------------------------------- بابت آخرین اخبار --------------------------------------- --}}
                        <div>
                            @foreach ($last_posts as $last_post)
                            @switch($last_post->post_type)
                            @case("video")
                            <i class="fa fa-file-video-o" style="color: var(--primary-color)"></i>
                            @break
                            @case("audio")
                            <i class="fa fa-file-audio-o" style="color: var(--primary-color)"></i>
                            @break
                            @case("article")
                            <i class="fa fa-file-text-o" style="color: var(--primary-color)"></i>
                            @break
                            @default
                            <i class="fa fa-rss" style="color: var(--primary-color)"></i>
                            @endswitch
                            <li style="font-size: 13px;list-style-type: none;padding-bottom:2px">
                                <a href="{{ route('article.detail', ['id' => $last_post->slug]) }}" target="_blank">
                                    {{ Str::limit($last_post->title, 50) }} |
                                </a>
                                {{ $last_post->feed }} --
                                <span style="color: #a99f9f">{{ ago_time($last_post->created_at) }}</span>
                            </li>
                        </div>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mb-2">
            <div class="p-2" style="background-color: rgb(235, 235, 235);padding-right: 20px !important;border-radius: 4px">
                <span style="font-weight: 600;color:var(--primary-color)">اخبار پربیننده</span>
                <hr style="background-color:var(--primary-color);height: 2px;margin-top: 8px">
                <div>
                    <ul>
                        @php
                        $populare_posts = $posts->sortByDesc('total_hit')->take(10);
                        @endphp
                        {{-- ------------------------------------------------- اخبار پربیننده ---------------------------------------------------- --}}
                        @foreach ($populare_posts as $populare_post)
                        <div>
                            @switch($populare_post->post_type)
                            @case("video")
                            <i class="fa fa-file-video-o" style="color: var(--primary-color)"></i>
                            @break
                            @case("audio")
                            <i class="fa fa-file-audio-o" style="color: var(--primary-color)"></i>
                            @break
                            @case("article")
                            <i class="fa fa-file-text-o" style="color: var(--primary-color)"></i>
                            @break
                            @default
                            <i class="fa fa-rss" style="color: var(--primary-color)"></i>
                            @endswitch
                            <li style="font-size: 13px;list-style-type: none;padding-bottom:2px">
                                <a href="{{ route('article.detail', ['id' => $populare_post->slug]) }}" target="_blank">
                                    {{ Str::limit($populare_post->title, 50) }} |
                                </a>
                                {{ $populare_post->feed }} --
                                <span style="color: #a99f9f">{{ ago_time($populare_post->created_at) }}</span>
                            </li>
                        </div>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        {{-- ---------------------------بخش سوم----------------------------- نمایش بخش مدیا -------------------------------------- --}}
        @if ($section->video)

        @php
        $albums = Modules\Gallery\Entities\Album::all();
        $media_posts = Modules\Post\Entities\Post::where('status',1)->where('visibility',1)->where('section_id',$section->id)->where(function ($query) {
        $query->where('post_type', 'audio')
        ->orwhere('post_type', 'video');
        })->get();
        // dd($media_posts);
        @endphp

        {{-- بابت اخبار ویدئویی و صوتی --}}
        <div class="col-sm-4 mb-2 media">
            @foreach ($media_posts as $media_post)
            <div style="position: relative" class="entry-header">
                <a href="{{ route('article.detail', ['id' => $media_post->slug]) }}">
                    {{-- <video poster="{{ static_asset($media_post->image->big_image) }}" width="426" height="240" style="object-fit: cover;"></video> --}}
                    <img src="{{ static_asset($media_post->image->big_image) }}" style="width: 426px !important;height: 240px !important">
                </a>
                <a href="{{url("category/{$media_post->category->category_name}")}}">
                    <span class="post-lable">{{$media_post->category->category_name}}</span>
                </a>
                <div class="post-title">{{$media_post->title}}</div>
                @if($media_post->post_type=="video")
                <div class="video-icon">
                    <img src="{{static_asset('default-image/video-icon.svg') }} " alt="video-icon">
                </div>
                @elseif($media_post->post_type=="audio")
                <div class="video-icon">
                    <img src="{{static_asset('default-image/audio-icon.svg') }} " alt="audio-icon">
                </div>
                @endif
            </div>
            @endforeach
        </div>

        {{-- بابت آلبوم عکس --}}
        <div class="col-sm-4 mb-2 media">
            @foreach ($albums as $album)
            <div style="position: relative">
                {{-- <a type="button" data-toggle="modal" data-target="#exampleModal"> --}}
                    <a id="img-album-cover" data-id="{{$album->id}}">
                        <img src="{{ static_asset($album->original_image) }}" data-caption="{{$album->name}}" class="lightboxed" rel="img-{{$album->id}}" style="width: 426px;height:240px !important">
                    </a>
                    @foreach ($album->galleryImages as $image)
                    <img src="{{ static_asset($image->original_image) }}" data-caption="{{$image->title}}" class="lightboxed" rel="img-{{$album->id}}" style="width: 426px;height:240px !important;display: none">
                    @endforeach


                    <div id="img-box"></div>

                    <a href="{{url('albums')}}" target="_blank">
                        <span class="post-lable" style="left: 20px;right: unset;">عکس های بیشتر</span>
                    </a>
                    <div class="post-title">{{$album->name}}</div>

            </div>
            @endforeach
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        content
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Send message</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- بابت اخبار استان ها --}}
        @php
        $state_posts = $posts
        ->where('is_state_post', 1)
        ->sortByDesc('created_at')
        ->take(10);
        @endphp
        <div class="col-sm-4 mb-2 media">
            @foreach ($state_posts as $post)
            <div style="position: relative">
                <a href="{{ route('article.detail', ['id' => $post->slug]) }}">
                    <img src="{{ static_asset($post->image->original_image) }}" style="width: 426px;height:240px !important">
                    <div class="post-title">{{$post->title}}</div>
                </a>
                <a href="{{url("state/{$post->state->name}")}}">
                    <span class="post-lable">{{$post->state->name}}</span>
                </a>
            </div>
            @endforeach
        </div>
        @endif

        {{-- ------------------------------بخش چهارم-------------------- نمایش بخش تبلیغات ----------------------------------------- --}}
        @if ($section->ads)
        @php
        $center_ads = $section->center_ads;
        @endphp
        <div class="col-sm-12 mb-2">
            @foreach ($center_ads as $item)
            <div class="majid2">
                <a href="{{ url($item->url) }}">
                    <img src="{{ url($item->path) }}" width="250">
                </a>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

@section('script')
<script>
    $("#test").on('click' , function (e) { 
    e.preventDefault();
    var id = $(this).data('id');
    url = "{{url("load-img-album")}}"+ "/" + id;
    // console.log(url);
    // return false;
    $.ajax({
        type: "GET",
        url: url,
        success: function (response) {
            $("#img-box").html(response);
        }
    });
    // alert(100);
    // $('.lightboxed').lightboxed();
    // <script src="{{ static_asset('vendor/lightboxed/lightboxed.js') }}">
    });
</script>
@endsection