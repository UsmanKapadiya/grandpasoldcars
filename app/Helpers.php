<?php

use App\Models\Album;
use App\Models\Category;
use App\Models\News;

function recentNews()
{
    $recent = News::orderBy('news_date', 'desc')->take(5)->get();
    return $recent;
}

function newsCategory()
{
    $news_cat = Category::get();
    return $news_cat;
}

function recentGallery()
{
    return Album::orderBy('id', 'desc')->take(4)->get();
}

function getArchiveYear()
{
    $years = News::selectRaw("YEAR(news_date) as year")->groupByRaw("YEAR(news_date)")->orderByRaw("YEAR(news_date) DESC")->get();
    $year_array = array();
    if ($years) {
        foreach ($years as $y) {
            array_push($year_array, $y->year);
        }
    }
    return $year_array;
}

?>
