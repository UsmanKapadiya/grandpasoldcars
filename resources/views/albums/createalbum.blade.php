@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Gallery') }}</div>


                    <div class="card-body">
                        @if($errors->count())
                            <div class="alert alert-success" role="alert">
                                <?php
                                $messages = $errors->all('<li>:message</li>');
                                ?>
                                <button type="button" class="close" data-dismiss="alert">×</button>

                                <h4>Warning!</h4>
                                <ul>
                                    @foreach($messages as $message)
                                        {{$message}}
                                    @endforeach

                                </ul>
                            </div>
                        @endif


                        <form id="createnewalbum" name="createnewalbum" method="POST"
                              action="{{URL::route('create_album')}}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Album Name</label>
                                <input name="name" type="text" class="form-control" placeholder="Album Name" value="">
                                <label class="text-danger" for="name"></label>
                            </div>
                            <div class="form-group">
                                <label for="description">Album Description</label>
                                <textarea name="description" type="text" class="form-control"
                                          placeholder="Album description" cols="30" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Publish At</label>
                                <input type="date" name="publishDate" class="form-control">
                            </div>
                            <label for="">Select Gallery Category</label>

                            <div class="form-group form-inline">
                                @foreach($categories as $cat)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="category[]"
                                               value="{{ $cat->id }}">
                                        <label class="form-check-label" for="Checkbox">{{ $cat->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <label class="text-danger" for="category"></label>
                            <div class="form-group">
                                <label for="cover_image">Select a Cover Image</label>
                                <input type="file" name="cover_image" id="cover_image" class="form-control">
                                <label class="text-danger" for="cover_image"></label>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-secondary" data-toggle="modal"
                                        data-target="#imageUploadModal">
                                    Upload image(s)
                                </button>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="javascript:submitGallery()">Create
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /container -->

    <!-- Modal -->
    @include("albums/imageModal")
@endsection
{{--</body>--}}
{{--</html>--}}
