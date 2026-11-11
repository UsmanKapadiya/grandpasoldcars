@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <a href="{{ url('news/create') }}" class="btn btn-primary mb-2">Create Post</a>
                <br>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Published At</th>
                        <th>Created at</th>
                        <th colspan="2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($news as $n)
                        <tr>
                            <td>{{ $n->id }}</td>
                            <td>{{ $n->title }}</td>
                            <td>{{ date('Y-m-d', strtotime($n->news_date)) }}</td>
                            <td>{{ date('Y-m-d', strtotime($n->created_at)) }}</td>
                            <td>
                                <a href="{!! url('news').'/'.$n->id !!}" class="btn btn-primary">Show</a>
                                <a href="{!! url('news').'/'.$n->id.'/edit' !!}" class="btn btn-primary">Edit</a>
                                <form action="{!! url('news').'/'.$n->id !!}" method="post" class="d-inline">
                                    {{ csrf_field() }}
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
