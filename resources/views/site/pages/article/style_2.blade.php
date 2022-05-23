<div class="px-4 on-title" style="background-color: var(--primary-color);color: white;padding: 5px;margin-bottom: 10px;min-height: 34px">{{ $post->on_title }}</div>
<div class="entry-header">
    <div class="header-top px-4" style="padding-bottom: 5px;padding-top: 0px">

        <h3 class="entry-title title" style="font-size: 18px;font-weight: 600">{!! $post->title ?? '' !!}</h3>
        <div class="entry-meta mb-2" style="color: #706f6f;display: flex;font-size: 13px">
            <span>
                <img src="{{ url('public/' . $post->user->profile_image) }}" style="border-radius: 50%;width: 35px;height:35px">
                {{ $post->user->first_name }}
                {{ $post->user->last_name }}
            </span>
            <span style="margin-right: auto;margin-left: 5px;padding-top: 16px">کد خبر : {{ $post->id }}</span>
            <span style="padding-top: 16px"><i class="fa fa-calendar-minus-o" aria-hidden="true"></i>
                <a style="color: #706f6f" href="{{ route('article.date', date('Y-m-d', strtotime($post->updated_at))) }}">{{ miladi_to_jalali($post->updated_at) }}</a>
            </span>
        </div><!-- /.entry-meta -->
        <div class="sub-title" style="background-color: #dddddd;padding: 5px">
            {{ $post->sub_title }}
        </div>
    </div>
    @include('site.partials.social_media_links', ['post' => $post])

    <div class="entry-thumbnail" height="100%" style="margin: 1.5rem;margin-top: 0;margin-bottom: 0">
        @include('site.pages.article.partials.detail_image')
    </div>
</div>

<div class="entry-content p-4" style="padding-top: 0px!important;padding-bottom: 0px!important">
    @if (@$post->post_type == 'audio')
        @include('site.pages.article.partials.audio')
    @endif
    <div class="paragraph">
        {!! $post->content !!}
    </div>
    @if (isset($post->read_more_link))
        <div class="rss-content-actual-link">
            <a href="{{ url("rss/$post->id") }}" class="btn btn-primary" target="_blank">
                {{ __('read_actual_content') }}
                <i class="fa fa-long-arrow-right"></i>
            </a>
        </div>
    @endif
    @include('site.pages.article.partials.content')
    @if (settingHelper('adthis_option') == 1 and settingHelper('addthis_public_id') != null and settingHelper('addthis_toolbox') != null)
        {!! base64_decode(settingHelper('addthis_toolbox')) !!}
    @endif
    @if (@$post->post_type == 'trivia-quiz')
        @include('site.pages.article.partials.trivia-quiz')
    @endif
    @if (@$post->post_type == 'personality-quiz')
        @include('site.pages.article.partials.personality-quiz')
    @endif

    @if (@$post->user->permissions['author_show'] == 1)
        @include('site.pages.article.partials.author')
    @endif
</div>
