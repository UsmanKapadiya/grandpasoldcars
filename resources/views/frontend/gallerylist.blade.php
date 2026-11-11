@extends('frontend.layout')

@section('content')
{{--    <section class="gallery-banner section-border">--}}
{{--        <div class="container-fluid">--}}
{{--            <div class="container">--}}
{{--                <div class="row justify-content-center">--}}
{{--                    <div class="col-md-12">--}}
{{--                        <div class="banner-container">--}}
{{--                            <h1>--}}
{{--                                Gallery--}}
{{--                            </h1>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <section class="section-pad section-border gallery-section">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <div class="row">
                            @foreach($gallery as $g)
                                <div class="col-sm-3" style="padding: 0 1.5rem">
                                    <div class="content mb-5">
                                        <a href="{!! url('/gallery-detail') !!}/{{$g->id}}">
                                            <div class="content-overlay"></div>
                                            <img class="content-image" src="{{ asset('uploads/albums/'.$g->cover_image) }}" alt="{{$g->name}}">
                                            <div class="content-details fadeIn-bottom">
                                                <h5 class="content-title">{{ $g->name }}</h5>
                                                <p class="content-text"><i class="fas fa-image"></i> {!! isset($g->Photos) ? count($g->Photos) : 0 !!} Images</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                <div class="d-flex justify-content-center mt-3">
                    {!! $gallery->links() !!}
                </div>
            </div>
        </div>

    </section>

@endsection
