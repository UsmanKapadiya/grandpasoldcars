@extends('frontend.layout')

@section('content')
    <section class="news-banner section-border">
        <div class="container-fluid">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="banner-container">
                            <h1>
                                News
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-pad section-border">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 ">
                        @forelse($news as $n)
                            <div class="row mb-5">
                                <div class="col-sm-12">
                                    <div class="">
                                        @if($n->banner)
                                            <div class="news-image">
                                                <img src="{{ asset('uploads/'.$n->banner) }}" width="100%"
                                                     alt="{{$n->title}}">
                                            </div>
                                        @endif
                                        <div class="news-heading">
                                            <div class="news-title">
                                                <h3><a href="{!! url('news-detail').'/'.$n->id !!}">{{ $n->title }}</a></h3>
                                            </div>
                                            <div class="news-date">
                                                {{ date('F d, Y', strtotime($n->news_date)) }}
                                            </div>
                                        </div>
                                        <div class="news-body">
                                            {!! \Stevebauman\Purify\Facades\Purify::clean($n->description) !!}
                                        </div>
                                        <a class="read_more" href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="text-center">No new(s) found</div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 ">
                        @include('frontend.sidebar_news')
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <div class="float-right mt-3">
                            {!! $news->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
