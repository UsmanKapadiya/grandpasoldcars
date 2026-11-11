<?php

namespace App\Http\Controllers;


use App\Models\Album;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\News;
use App\Helpers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashbsoard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $news = News::orderBy('news_date', 'desc')->limit(2)->get();
        return view('frontend.home', compact('news'));
    }

    public function newsList()
    {
        $news = News::paginate(3);

        return view('frontend.newslist', compact('news'));
    }

    public function getArchiveNews($year)
    {
        abort_unless(ctype_digit((string) $year) && strlen((string) $year) === 4, 404);
        $news = News::whereYear('news_date', (int) $year)->paginate(3);
        return view('frontend.newslist', compact('news'));
    }

    public function newsDetail($id)
    {
        $news = News::find($id);
        $recent = News::orderBy('id', 'desc')->take(5)->get();
        $news_cat = Category::get();
        return view('frontend.newsdetails', compact('news', 'recent', 'news_cat'));
    }

    public function galleryList()
    {
        $gallery = Album::paginate(8);
        return view('frontend.gallerylist', compact('gallery'));
    }

    public function galleryDetail($id)
    {
        $gallery_detail = Album::find($id);
        if ($gallery_detail) {
            $gallery = Album::paginate(9);
            $images = $gallery_detail->Photos;
            $gallery_name = $gallery_detail->name;
            return view('frontend.gallerydetail', compact('gallery', 'images', 'gallery_name'));
        }
    }

}
