@php
$rightWidgets = data_get($widgets, \Modules\Widget\Enums\WidgetLocation::RIGHT_SIDEBAR, []);
$lates_posts = \Modules\Post\Entities\Post::where('status', 1)
    ->orderBy('created_at', 'desc')
    ->take(10)
    ->get();
$populare_posts = \Modules\Post\Entities\Post::where('status', 1)
    ->where('populare', 1)
    ->orderBy('created_at', 'desc')
    ->take(10)
    ->get();
$report_posts = \Modules\Post\Entities\Post::where('status', 1)
    ->where('report', 1)
    ->orderBy('created_at', 'desc')
    ->take(10)
    ->get();
$conversation_posts = \Modules\Post\Entities\Post::where('status', 1)
    ->where('conversation', 1)
    ->orderBy('created_at', 'desc')
    ->take(10)
    ->get();
@endphp

@foreach ($rightWidgets as $widget)
    @php
        //dd($widget['view']);
        // $viewFile = 'site.widgets.'.$widget['view'];
        //بابت حذف محتوای ستون کناری
        $viewFile = null;
    @endphp
    @if (view()->exists($viewFile))
        @include($viewFile, $widget)
    @endif
@endforeach


<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div class="mb-2" style="background-color: rgb(235, 235, 235); !important;border-radius: 4px">
                <div style="background-color: var(--primary-color);color:white;padding: 5px;margin-bottom: 10px">آخرین اخبار</div>
                <ul class="pr-2">
                    @foreach ($lates_posts as $post)
                        <li style="font-size: 13px;list-style-type: none;padding-bottom:2px">
                            <a href="{{ url("rss/$post->id") }}" target="_blank">
                                {{ Str::limit($post->title, 50) }} |
                            </a>
                            {{ $post->feed }} --
                            <span style="color: #a99f9f">{{ ago_time($post->created_at) }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="mb-2" style="background-color: rgb(235, 235, 235); !important;border-radius: 4px">
                <div style="background-color: var(--primary-color);color:white;padding: 5px;margin-bottom: 10px">اخبار پربیننده</div>
                <ul class="pr-2">
                    @foreach ($populare_posts as $post)
                        <li style="font-size: 13px;list-style-type: none;padding-bottom:2px">
                            <a href="{{ url("rss/$post->id") }}" target="_blank">
                                {{ Str::limit($post->title, 50) }} |
                            </a>
                            {{ $post->feed }} --
                            <span style="color: #a99f9f">{{ ago_time($post->created_at) }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="mb-2" style="background-color: rgb(235, 235, 235); !important;border-radius: 4px">
                <div style="background-color: var(--primary-color);color:white;padding: 5px;margin-bottom: 10px">گزارش</div>
                <ul class="pr-2">
                    @foreach ($report_posts as $post)
                        <li style="font-size: 13px;list-style-type: none;padding-bottom:2px">
                            <a href="{{ url("rss/$post->id") }}" target="_blank">
                                {{ Str::limit($post->title, 50) }} |
                            </a>
                            {{ $post->feed }} --
                            <span style="color: #a99f9f">{{ ago_time($post->created_at) }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="mb-2" style="background-color: rgb(235, 235, 235); !important;border-radius: 4px">
                <div style="background-color: var(--primary-color);color:white;padding: 5px;margin-bottom: 10px">گفتگو</div>
                <ul class="pr-2">
                    @foreach ($conversation_posts as $post)
                        <li style="font-size: 13px;list-style-type: none;padding-bottom:2px">
                            <a href="{{ url("rss/$post->id") }}" target="_blank">
                                {{ Str::limit($post->title, 50) }} |
                            </a>
                            {{ $post->feed }} --
                            <span style="color: #a99f9f">{{ ago_time($post->created_at) }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-sm-4 pl-0">
            @php
                $section = Modules\Post\Entities\Section::find(1);
            @endphp
            @include('site.partials.home.side_ads', ['side_ads' => $side_ads])
        </div>
    </div>
</div>
