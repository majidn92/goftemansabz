<style>
    #section-{{$section->id}} a:hover {
        color: {{$section->color}};
    }

    #section-{{$section->id}} li.nav-item a.active {
        background-color: {{$section->color }} !important;
    }

    #section-{{$section->id}} .nav-tabs {
        border-bottom: 1px solid {{$section->color}};
    }

    #section-{{$section->id}} .nav-link.active {
        border-color: {{$section->color}}  !important;
    }

    #section-{{$section->id}} .mb-4 li:before {
        background-color: {{$section->color}};
    }

    #section-{{$section->id}} .tab-pane li:before {
        background-color: {{$section->color}};
    }
</style>

@php
$posts = $section->posts->where('status',1)->where('visibility',1);
@endphp

<div id="section-{{ $section->id }}" class="section-box" style="border-color: {{ $section->color }}">

    <div class="section-seprator" style="border-bottom: solid 3px {{ $section->color }}">
        <a href="{{ $section->url }}" target="_blank">
            <span style="background-color: {{ $section->color }}">{{ $section->name }}</span>
        </a>
        @php
        $breaking_news = Modules\Post\Entities\Post::where('visibility',1)->where('status',1)->where('section_id',$section->id)->where('breaking',1)->orderBy('breaking','asc')->orderBy('created_at','desc')->get();
        @endphp
        <div>
            @include('site.partials.breaking_news')
        </div>
        <div style="clear: both"></div>
    </div>



    @if ($section->slider)
    <div class="row m-0">
        {{-- نمایش بخش اسلایدر --}}
        <div class="col-sm-10">
            @include('site.partials.home.primary.style_1')
        </div>
        {{-- نمایش بخش تبلیغات کناری --}}
        <div class="col-sm-2 text-center p-0">
            @include('site.partials.home.side_ads')
        </div>
    </div>
    @endif



    <div class="row mb-4 mt-2">
        {{-- نمایش بخش آخرین اخبار --}}
        @if ($section->last_post)
        <div class="col-sm-6 mb-2">
            <div class="p-2" style="background-color: rgb(235, 235, 235);padding-right: 20px !important;border-radius: 4px">
                <span style="font-weight: 600;color:{{ $section->color }}">آخرین اخبار</span>
                <hr style="height: 2px;margin-top: 8px;background-color: {{ $section->color }}">
                <div>
                    <ul>
                        @php
                        $last_posts = $posts->sortByDesc('created_at')->take(10);
                        @endphp
                        {{-- بابت آخرین اخبار --}}
                        @foreach ($last_posts as $last_post)
                        <div>
                            @switch($last_post->post_type)
                            @case("video")
                            <i class="fa fa-file-video-o" style="color: {{$section->color}}"></i>
                            @break
                            @case("audio")
                            <i class="fa fa-file-audio-o" style="color: {{$section->color}}"></i>
                            @break
                            @case("article")
                            <i class="fa fa-file-text-o" style="color: {{$section->color}}"></i>
                            @break
                            @default
                            <i class="fa fa-rss" style="color: {{$section->color}}"></i>
                            @endswitch
                            <li style="font-size: 13px;list-style-type: none;padding-bottom:2px;display: inline">
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
                <span style="font-weight: 600;color: {{ $section->color }}">اخبار پربیننده</span>
                <hr style="height: 2px;margin-top: 8px;background-color: {{ $section->color }}">
                <div>
                    <ul>
                        @php
                        $popular_posts = $posts->where('populare', 1)->take(10);
                        // dd($popular_posts);
                        @endphp
                        {{-- اخبار پربیننده --}}
                        @foreach ($popular_posts as $popular_post)
                        <li style="font-size: 13px;list-style-type: none;padding-bottom:2px">
                            <a href="{{ route('article.detail', ['id' => $popular_post->slug]) }}" target="_blank">
                                {{ Str::limit($popular_post->title, 50) }} |
                            </a>
                            {{ $popular_post->feed }} --
                            <span style="color: #a99f9f">{{ ago_time($popular_post->created_at) }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        {{-- نمایش بخش مدیا --}}
        @if ($section->video)
        @php
        $media_posts = Modules\Post\Entities\Post::where('status',1)->where('visibility',1)->where('section_id',$section->id)->where(function ($query) {
        $query->where('post_type', 'audio')
        ->orwhere('post_type', 'video');
        })->get();
        @endphp
        <div class="col-sm-4 mb-2 media">
            @foreach ($media_posts as $media_post)
            <div class="entry-header">
                <a href="{{ route('article.detail', ['id' => $last_post->slug]) }}">
                    <img src="{{ static_asset($media_post->image->big_image) }}" width="426" height="240" style="height: 240px !important">
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

        <div class="col-sm-4 mb-2">
            <a href="{{ url('/') }}">
                <img src="{{ url('/') }}" width="426" height="240">
            </a>
        </div>
        <div class="col-sm-4 mb-2">
            <a href="{{ url('/') }}">
                <img src="{{ url('/') }}" width="426" height="240">
            </a>
        </div>
        @endif

        {{-- نمایش بخش تبلیغات --}}
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