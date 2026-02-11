<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GeneralAboutDetails;
use App\Models\News;
use App\Models\NewsImages;
use App\Models\PressReleases;
use App\Models\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        $home_news = News::select(
            'news.*',
            'news_images.image AS primary_image',
        )
            ->join('news_images', 'news.id', 'news_images.news_id')
            ->where('news_images.is_primary', 1)
            ->orderBy('news.id', 'DESC')
            ->groupBy('news.id')
            ->take(6)
            ->get();

        $projects = Projects::select(
            'projects.*',
            'project_images.image AS primary_image',
        )
            ->join('project_images', 'projects.id', 'project_images.project_id')
            ->where('project_images.is_primary', 1)
            ->orderBy('projects.id', 'DESC')
            ->groupBy('projects.id')
            ->take(8)
            ->get();

        return view('frontend.index', [
            'home_news' => $home_news,
            'projects' => $projects,
        ]);
    }

    public function aboutUs(Request $request)
    {
        $about = [];
        $getAbout = GeneralAboutDetails::where('id', 1)->first();

        $about['title'] = $getAbout->en_title;
        $about['content'] = $getAbout->en_content;
        $about['objective_title'] = $getAbout->en_objective_title;
        $about['objective_content'] = $getAbout->en_objective_content;
        $about['vision_title'] = $getAbout->en_vision_title;
        $about['vision_content'] = $getAbout->en_vision_content;
        $about['mission_title'] = $getAbout->en_mission_title;
        $about['mission_content'] = $getAbout->en_mission_content;

        if (!empty($this->locale && $this->locale == 'si')){
            $about['title'] = $getAbout->si_title;
            $about['content'] = $getAbout->si_content;
            $about['objective_title'] = $getAbout->si_objective_title;
            $about['objective_content'] = $getAbout->si_objective_content;
            $about['vision_title'] = $getAbout->si_vision_title;
            $about['vision_content'] = $getAbout->si_vision_content;
            $about['mission_title'] = $getAbout->si_mission_title;
            $about['mission_content'] = $getAbout->si_mission_content;
        }
        elseif (!empty($this->locale && $this->locale == 'ta')){
            $about['title'] = $getAbout->ta_title;
            $about['content'] = $getAbout->ta_content;
            $about['objective_title'] = $getAbout->ta_objective_title;
            $about['objective_content'] = $getAbout->ta_objective_content;
            $about['vision_title'] = $getAbout->ta_vision_title;
            $about['vision_content'] = $getAbout->ta_vision_content;
            $about['mission_title'] = $getAbout->ta_mission_title;
            $about['mission_content'] = $getAbout->ta_mission_content;
        }

        return view('frontend.about-us',[
            'about' => $about,
        ]);
    }

    public function newsAndEvents(Request $request)
    {
        $keyword = !empty($request->keyword) ? $request->keyword : null;

        $news = News::select(
            'news.*',
            'news_images.image AS primary_image',
        )
            ->join('news_images', 'news.id', 'news_images.news_id')
            ->when(!empty($keyword), function ($query) use ($keyword) {
                return $query->where('news.en_title', 'like', "%$keyword%")
                    ->orWhere('news.si_title', 'like', "%$keyword%")
                    ->orWhere('news.ta_title', 'like', "%$keyword%")
                    ->orWhere('news.en_content', 'like', "%$keyword%")
                    ->orWhere('news.si_content', 'like', "%$keyword%")
                    ->orWhere('news.ta_content', 'like', "%$keyword%");
            })
            ->where('news_images.is_primary', 1)
            ->orderBy('news.id', 'DESC')
            ->groupBy('news.id')
            ->paginate(6)
            ->withQueryString();

        return view('frontend.news.index',[
            'all_news' => $news,
            'keyword' => $keyword,
        ]);
    }

    public function newsAndEventsView(Request $request, $slug){

        $news = News::select(
            'news.*',
            'news_images.image AS primary_image',
        )
            ->join('news_images', 'news.id', 'news_images.news_id')
            ->where('news.slug', $slug)
            ->where('news_images.is_primary', 1)
            ->groupBy('news.id')
            ->first();

        if (empty($news)) {
            return redirect()->route('frontend.newsAndEvents.index');
        }

        return view('frontend.news.view',[
            'news' => $news,
        ]);
    }


    public function projectsAndProgrammes(Request $request)
    {
        $keyword = !empty($request->keyword) ? $request->keyword : null;

        $projects = Projects::select(
            'projects.*',
            'project_images.image AS primary_image',
        )
            ->join('project_images', 'projects.id', 'project_images.project_id')
            ->when(!empty($keyword), function ($query) use ($keyword) {
                return $query->where('projects.en_title', 'like', "%$keyword%")
                    ->orWhere('projects.si_title', 'like', "%$keyword%")
                    ->orWhere('projects.ta_title', 'like', "%$keyword%")
                    ->orWhere('projects.en_content', 'like', "%$keyword%")
                    ->orWhere('projects.si_content', 'like', "%$keyword%")
                    ->orWhere('projects.ta_content', 'like', "%$keyword%");
            })
            ->where('project_images.is_primary', 1)
            ->orderBy('projects.id', 'DESC')
            ->groupBy('projects.id')
            ->paginate(6)
            ->withQueryString();

        return view('frontend.projects.index',[
            'projects' => $projects,
            'keyword' => $keyword,
        ]);
    }

    public function projectsAndProgramView(Request $request, $slug){

        $project = Projects::select(
            'projects.*',
            'project_images.image AS primary_image',
        )
            ->join('project_images', 'projects.id', 'project_images.project_id')
            ->where('projects.slug', $slug)
            ->where('project_images.is_primary', 1)
            ->groupBy('projects.id')
            ->first();


        if (empty($project)) {
            return redirect()->route('frontend.projectsAndProgrammes.index');
        }

        return view('frontend.projects.view',[
            'project' => $project,
        ]);
    }


    public function pressReleases(Request $request)
    {
        $keyword = !empty($request->keyword) ? $request->keyword : null;

        $pressReleases = PressReleases::select(
            'press_releases.*',
            'press_release_images.image AS primary_image',
        )
            ->join('press_release_images', 'press_releases.id', 'press_release_images.press_release_id')
            ->when(!empty($keyword), function ($query) use ($keyword) {
                return $query->where('press_releases.en_title', 'like', "%$keyword%")
                    ->orWhere('press_releases.si_title', 'like', "%$keyword%")
                    ->orWhere('press_releases.ta_title', 'like', "%$keyword%")
                    ->orWhere('press_releases.en_content', 'like', "%$keyword%")
                    ->orWhere('press_releases.si_content', 'like', "%$keyword%")
                    ->orWhere('press_releases.ta_content', 'like', "%$keyword%");
            })
            ->where('press_release_images.is_primary', 1)
            ->orderBy('press_releases.id', 'DESC')
            ->groupBy('press_releases.id')
            ->paginate(6)
            ->withQueryString();

        return view('frontend.press-releases.index',[
            'press_releases' => $pressReleases,
            'keyword' => $keyword,
        ]);
    }

    public function pressReleaseView(Request $request, $slug){

        $pressRelease = PressReleases::select(
            'press_releases.*',
            'press_release_images.image AS primary_image',
        )
            ->join('press_release_images', 'press_releases.id', 'press_release_images.press_release_id')
            ->where('press_releases.slug', $slug)
            ->where('press_release_images.is_primary', 1)
            ->groupBy('press_releases.id')
            ->first();


        if (empty($pressRelease)) {
            return redirect()->route('frontend.pressReleases.index');
        }

        return view('frontend.press-releases.view',[
            'pressRelease' => $pressRelease,
        ]);
    }


    public function appLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $out = ['status' => 'success'];
        return response()->json($out);
    }

    public function localization(string $locale){
        Session::put('locale', $locale);
        return redirect()->back();
    }
}
