@php
    //$posts = data_get($categorySection, 'category.post', collect([]));
    $blockPosts = $posts->skip(1)->take(4);
    $firstPost = $posts->first();
@endphp

<div class="sg-section">
    <div class="section-content">
        <div class="section-title">
            <h1>
            @if(data_get($categorySection, 'label') == 'videos')
                    {{__('videos')}}
                @else
                    {{ \Illuminate\Support\Str::upper(data_get($categorySection, 'label')) }}
                @endif
            </h1>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="sg-post">
                    @include('site.partials.home.category.first_post')
                    <div class="entry-content">
                        <h3 class="entry-title"><a href="{{ route('article.detail', ['id' => $firstPost->slug]) }}">{!! \Illuminate\Support\Str::limit($firstPost->title, 50) !!}</a></h3>
                        <div class="entry-meta mb-2">
                            <ul class="global-list">
                                <li>{{ __('post_by') }} <a href="{{ route('site.author',['id' => $firstPost->user->id]) }}">{{ data_get($firstPost, 'user.first_name') }}</a></li>
                                <li><a href="{{route('article.date', date('Y-m-d', strtotime($firstPost->updated_at)))}}">{{ miladi_to_jalali($firstPost->updated_at) }}</a></li>
                            </ul>
                        </div>
                        <p> {!! strip_tags(\Illuminate\Support\Str::limit($firstPost->content, 130)) !!}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                @foreach($blockPosts as $post)
                    <div class="sg-post small-post post-style-1">
                        @include('site.partials.home.category.post_block')
                        <div class="entry-content">
                           <a href="{{ route('article.detail', ['id' => $post->slug]) }}"><p>{!! \Illuminate\Support\Str::limit($post->title, 25) !!}</p></a>
                            <div class="entry-meta">
                                <ul class="global-list">
                                    <li>{{ __('post_by') }} <a href="{{ route('site.author',['id' => $firstPost->user->id]) }}"> {{ data_get($post, 'user.first_name') }}</a></li>
                                    <li><a href="{{route('article.date', date('Y-m-d', strtotime($post->updated_at)))}}"> {{ miladi_to_jalali($post->updated_at) }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>