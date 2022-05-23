<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Modules\Ads\Entities\AdLocation;
use Modules\Appearance\Entities\ThemeSection;
use Modules\Post\Entities\Post;
use Modules\Post\Entities\Section;
use LaravelLocalization;
use App\VisitorTracker;
use Illuminate\Support\Facades\Input;
use Sentinel;
use DB;
use Modules\Post\Entities\Category;
use File;
use Modules\Ads\Entities\AdSide;
use Modules\Ads\Entities\AdCenter;

class HomeController extends Controller
{
    public function home()
    {
        $primarySection             = Cache::rememberForever('primarySection', function () {
            return ThemeSection::where('is_primary', 1)->first();
        });

        $language = LaravelLocalization::setLocale() ?? settingHelper('default_language');

        if (Sentinel::check()) :

            if (!View::exists('site.website.' . $language . '.logged.widgets')) :
                $this->widgetsSection($language);
            endif;


            $categorySections       = Cache::remember('categorySectionsAuth', $seconds = 1200, function () {
                return ThemeSection::with('ad')
                    ->with(['category'])
                    ->where('is_primary', '<>', 1)->orderBy('order', 'ASC')
                    ->where(function ($query) {
                        $query->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->orWhere('language', null);
                    })
                    ->get();
            });

            $categorySections->each(function ($section) {
                $section->load('post');
            });

            $video_posts     = Cache::remember('video_postsAuth', $seconds = 1200, function () {
                return Post::with('category', 'image', 'user')
                    ->where('post_type', 'video')
                    ->where('visibility', 1)
                    ->where('status', 1)
                    ->orderBy('id', 'desc')
                    ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                    ->limit(8)
                    ->get();
            });

            $totalPostCount     = Cache::remember('totalPostCountAuth', $seconds = 1200, function () {
                return Post::where('visibility', 1)
                    ->where('status', 1)
                    ->orderBy('id', 'desc')
                    ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                    ->count();
            });

        else :


            $categorySections       = Cache::remember('categorySections', $seconds = 1200, function () {
                return ThemeSection::with('ad')
                    ->with(['category'])
                    ->where('is_primary', '<>', 1)->orderBy('order', 'ASC')
                    ->where(function ($query) {
                        $query->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->orWhere('language', null);
                    })
                    ->get();
            });

            $categorySections->each(function ($section) {
                $section->load('post');
            });


            $latest_posts       = Cache::remember('latest_posts', $seconds = 1200, function () {
                return Post::with('category', 'image', 'user')
                    ->where('visibility', 1)
                    ->where('status', 1)
                    ->when(Sentinel::check() == false, function ($query) {
                        $query->where('auth_required', 0);
                    })
                    ->orderBy('id', 'desc')
                    ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                    ->limit(6)
                    ->get();
            });

            $totalPostCount     = Cache::remember('totalPostCount', $seconds = 1200, function () {
                return Post::where('visibility', 1)
                    ->where('status', 1)
                    ->when(Sentinel::check() == false, function ($query) {
                        $query->where('auth_required', 0);
                    })
                    ->orderBy('id', 'desc')
                    ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                    ->count();
            });

        endif;

        $categories = Category::all();


        $category_sections = Category::orderBy('order', 'asc')->get();
        $sections = Section::where('id', '!=', 1)->orderBy('rank', 'asc')->get();
        // dd($sections[0]->posts);


        $tracker                 = new VisitorTracker();
        $tracker->page_type      = \App\Enums\VisitorPageType::HomePage;
        $tracker->url            = \Request::url();
        $tracker->source_url     = \url()->previous();
        $tracker->ip             = \Request()->ip();
        $tracker->agent_browser  = UserAgentBrowser(\Request()->header('User-Agent'));

        $tracker->save();


        //        if (!View::exists('site.website.'.$language.'.widgets')):
        //            $this->widgetsSection($language);
        //        endif;
        //        if (!View::exists('site.website.category_sections')):
        //            $this->categorySections($language);
        //        endif;

        return view('site.pages.home', compact('primarySection', 'categorySections', 'totalPostCount', 'categories', 'category_sections', 'sections'));
    }

    public function categorySections($language)
    {
        if (Sentinel::check()) :
            $categorySections       = Cache::remember('categorySectionsAuth', $seconds = 1200, function () {
                return ThemeSection::with('ad')
                    ->with(['category'])
                    ->where('is_primary', '<>', 1)->orderBy('order', 'ASC')
                    ->where(function ($query) {
                        $query->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->orWhere('language', null);
                    })
                    ->get();
            });

            $categorySections->each(function ($section) {
                $section->load('post');
            });

            $video_posts     = Cache::remember('video_postsAuth', $seconds = 1200, function () {
                return Post::with('category', 'image', 'user')
                    ->where('post_type', 'video')
                    ->where('visibility', 1)
                    ->where('status', 1)
                    ->orderBy('id', 'desc')
                    ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                    ->limit(8)
                    ->get();
            });

            $latest_posts       = Cache::remember('latest_postsAuth', $seconds = 1200, function () {
                return Post::with('category', 'image', 'user')
                    ->where('visibility', 1)
                    ->where('status', 1)
                    ->orderBy('id', 'desc')
                    ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                    ->limit(6)
                    ->get();
            });

            $totalPostCount     = Cache::remember('totalPostCountAuth', $seconds = 1200, function () {
                return Post::where('visibility', 1)
                    ->where('status', 1)
                    ->orderBy('id', 'desc')
                    ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                    ->count();
            });

        else :
            $categorySections       = Cache::remember('categorySections', $seconds = 1200, function () {
                return ThemeSection::with('ad')
                    ->with(['category'])
                    ->where('is_primary', '<>', 1)->orderBy('order', 'ASC')
                    ->where(function ($query) {
                        $query->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))->orWhere('language', null);
                    })
                    ->get();
            });

            $categorySections->each(function ($section) {
                $section->load('post');
            });

            $video_posts     = Cache::remember('video_posts', $seconds = 1200, function () {
                return Post::with('category', 'image', 'user')
                    ->where('post_type', 'video')
                    ->where('visibility', 1)
                    ->where('status', 1)
                    ->when(Sentinel::check() == false, function ($query) {
                        $query->where('auth_required', 0);
                    })
                    ->orderBy('id', 'desc')
                    ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                    ->limit(8)
                    ->get();
            });

            $latest_posts       = Cache::remember('latest_posts', $seconds = 1200, function () {
                return Post::with('category', 'image', 'user')
                    ->where('visibility', 1)
                    ->where('status', 1)
                    ->when(Sentinel::check() == false, function ($query) {
                        $query->where('auth_required', 0);
                    })
                    ->orderBy('id', 'desc')
                    ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                    ->limit(6)
                    ->get();
            });

            $totalPostCount     = Cache::remember('totalPostCount', $seconds = 1200, function () {
                return Post::where('visibility', 1)
                    ->where('status', 1)
                    ->when(Sentinel::check() == false, function ($query) {
                        $query->where('auth_required', 0);
                    })
                    ->orderBy('id', 'desc')
                    ->where('language', LaravelLocalization::setLocale() ?? settingHelper('default_language'))
                    ->count();
            });

        endif;

        if (fopen(resource_path() . "/views/site/website/category_sections.blade.php", 'w')) :
            $file = resource_path() . "/views/site/website/category_sections.blade.php";
            $view = view('site.partials.home.category_section', compact('categorySections', 'video_posts', 'totalPostCount', 'latest_posts'))->render();
            File::put($file, $view);
        endif;


        //        return view('site.partials.home.category_section',compact('categorySections','video_posts','totalPostCount','latest_posts'))->render();
    }

    public function widgetsSection($language)
    {

        if (Sentinel::Check()) :
            $path = resource_path() . "/views/site/website/" . $language . '/logged';
        else :
            $path = resource_path() . "/views/site/website/" . $language;
        endif;

        File::makeDirectory($path, 0777, true, true);

        $file = $path . '/widgets.blade.php';

        if (fopen($file, 'w')) :

            $view = view('site.partials.right_sidebar_widgets');

            File::put($file, $view);
        endif;
    }

    public function feed_detail_page($id)
    {
        $post = Post::find($id);
        return view('site.pages.feed_detail_page', compact('post'));
    }

    public function load_img_album($album_id)
    {
        $album = \Modules\Gallery\Entities\Album::find($album_id);
        $images = $album->galleryImages;
        $response = "";
        foreach ($images as $image) {
            $response .= '<img src="' . static_asset($image->original_image) . '" class="lightboxed" rel="img-' . $album->id . ' ">';
        }
        // dd($response);
        echo $response;
    }
}
