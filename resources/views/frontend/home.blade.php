@extends('frontend.layout')

@section('content')
<section class="section-border home-banner">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset('images/banner/ccca_banner_cultural_bridges.jpg') }}" alt="ccca banner cultural bridges">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="banner-title">Creating an Environment that Bridges between Cultures</h1>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('images/banner/ccca_banner_uniting_community.jpg') }}" alt="ccca banner uniting community">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="banner-title">Building Community Through Communication</h1>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('images/banner/ccca_banner_community_concept.jpg') }}" alt="ccca banner community concepts">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="banner-title">Join Us and Be Part of Our Diverse Community</h1>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>



{{--    <section class="home-banner section-border">--}}
{{--        <div class="container-fluid">--}}
{{--            <div class="container">--}}
{{--                <div class="row justify-content-center">--}}
{{--                    <div class="col-md-12">--}}
{{--                        <div class="home-banner-container">--}}
{{--                            <h1 class="text-center">--}}
{{--                                Creating An Environment That Bridges Between Cultures--}}
{{--                            </h1>--}}
{{--                            <div class="d-inline-block text-center w-100">--}}
{{--                                <button class="btn btn-success">Get Involved</button>--}}
{{--                                <button class="btn btn-primary">Learn More</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <section class="intro-section section-pad section-border">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="intro-container">
                            <h2 class="text-blue">A <span class="text-success">Community</span> where all <span class="text-success">Diverse Experiences </span>are valued</h2>
                            <p class="intro-head">
                                Welcome to the CLF Cultural Canada Association, where inclusivity thrives and diversity is celebrated! Our mission is to create a vibrant community where everyone feels valued and welcomed, regardless of background. Through targeted programs and events designed for all ages and cultural backgrounds, we foster meaningful connections and relationships. At CCCA, every voice matters. We believe in advocating for a harmonious and inclusive Canadian society by valuing the input of all our members. Join us in building a community where diversity is embraced and every individual's unique perspective contributes to our shared vision of unity and understanding.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
{{--    <section class="home-latest-news section-border">--}}
{{--        <div class="container-fluid">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-sm-12">--}}
{{--                        <h3 class="news-head">Latest News</h3>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    @foreach($news as $n)--}}
{{--                        <div class="col-sm-6">--}}
{{--                            <div class="homenews-container">--}}
{{--                                <div class="homenews-heading">--}}
{{--                                    <div class="homenews-title">--}}
{{--                                        <a href="/news-detail/{{$n->id}}">{{ $n->title }}</a>--}}
{{--                                    </div>--}}
{{--                                    <div class="homenews-date">--}}
{{--                                        {{ date('F d, Y', strtotime($n->news_date)) }}--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="homenews-body">--}}
{{--                                    {!! $n->description !!}--}}
{{--                                </div>--}}

{{--                            </div>--}}

{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-sm-12">--}}
{{--                        <div class="d-inline-block text-center w-100 my-5">--}}
{{--                            <a class="btn btn-success" href="{{ url('news-list') }}">View More</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </section>--}}
@endsection