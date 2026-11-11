@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit News') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{URL('/news/'.$news->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">News Title</label>
                                <input type="text" name="title" class="form-control" value="{{$news->title}}">
                            </div>

                            <div class="form-group">
                                <label for="">News Description</label>
                                <textarea name="description" id="news_description" cols="30" rows="10" class="form-control">{{$news->description}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="">Publish At</label>
                                <input type="date" name="news_date" class="form-control" value="{{ date('Y-m-d', strtotime($news->news_date)) }}">
                            </div>

                            <label for="">Select News Category</label>
                            <?php
                                $category = explode(",","$news->category");
                            ?>
                            <div class="form-group form-inline">
                                @foreach($categories as $cat)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="category[]" value="{{ $cat->id }}" <?=(in_array($cat->id,$category))?"checked":" ";?>>
                                        <label class="form-check-label" for="Checkbox">{{ $cat->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="banner"> News Banner</label>
                                <input class="form-control" type="file" name="image">
                                @if($news->banner)
                                <img src="{{ asset('uploads/'.$news->banner) }}" width="300"/>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/summernote/summernote-lite.js') }}"></script>
    <link href="{{ asset('js/summernote/summernote-lite.css') }}" rel="stylesheet">
@endsection
