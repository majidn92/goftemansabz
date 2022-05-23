<style>
    .nav li a i {
        transition: .4s;
    }

    .nav li a i:hover {
        color: var(--primary-color);
        transform: translateY(-5px);
    }

    .footer-bottom ul li:last-child {
        margin-right: 25px
    }

    .footer-top{
        background-color: var(--primary-color);
    }
</style>

<div class="footer footer-style-1" style="margin-top: 10px">
    <div class="footer-top">
        <div class="container" style="max-width: 100%">
            <div class="footer-content">
                <div class="row">
                    @foreach ($footerWidgets as $widget)
                    @if ($widget['view'] == 'popular_post')
                    @include('site.widgets.footer.popular_post', $widget)
                    @elseif($widget['view'] == 'editor_picks')
                    @include('site.widgets.footer.editor_picks', $widget)
                    @elseif($widget['view'] == 'categories')
                    @include('site.widgets.footer.categories', $widget)
                    @elseif($widget['view'] == 'newsletter')
                    @include('site.widgets.footer.newsletter', $widget)
                    @endif
                    @endforeach
                </div><!-- /.row -->
            </div>
        </div><!-- /.container -->
    </div>
    <div class="footer-bottom">
        <div class="container text-center">
            <span>{{ settingHelper('copyright_text') }}</span>
        </div><!-- /.container -->
        <div>
            <div class="col-sm-12">
                <ul class="nav text-center" style="align-items:center;justify-content:end;">
                    @foreach ($socialMedias as $socialMedia)
                    <li>
                        <a href="{{ $socialMedia->url }}" target="_blank" name="{{ $socialMedia->name }}">
                            <i class="{{ $socialMedia->icon }}" aria-hidden="true" style="font-size: 25px"></i>
                        </a>
                    </li>
                    @endforeach
                    <li>
                        <a href="{{ url('feed') }}" name="{{ __('feed') }}">
                            <i class="fa fa-rss" aria-hidden="true" style="font-size: 25px"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div><!-- /.footer -->