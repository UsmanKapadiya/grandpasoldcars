<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Album;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function getForm($id)
    {
        $album = Album::find($id);
        return view('albums.addimage',compact('album'));

//        return View::make('addimage')
//            ->with('album',$album);
    }

    public function postAdd(Request $request)
    {
        $request->validate([
            'album_id' => 'required|numeric|exists:albums,id',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'description'=>'nullable|string|max:1000'
        ]);



//        $rules = array(
//
//            'album_id' => 'required|numeric|exists:albums,id',
//            'image'=>'required|image'
//
//        );
//
//        $validator = Validator::make(Input::all(), $rules);
//        if($validator->fails()){
//
//            return Redirect::route('add_image',array('id' =>Input::get('album_id')))
//                ->withErrors($validator)
//                ->withInput();
//        }

        $file = $request->file('image');
        $random_name = date('YmdHis') . bin2hex(random_bytes(4));
        $destinationPath = public_path('uploads').'/albums/';
        $extension = $file->extension();
        $filename=$random_name.'_album_image.'.$extension;
        $file->move($destinationPath, $filename);

        $image = new Image();
        $image->description = $request->description;
        $image->image = $filename;
        $image->album_id = $request->album_id;
        $image->save();

//        $uploadSuccess = Input::file('image')->move($destinationPath, $filename);
//        Image::create(array(
//            'description' => Input::get('description'),
//            'image' => $filename,
//            'album_id'=> Input::get('album_id')
//        ));
//        return redirect('/albums/view-album/{id}')->with('success','News created successfully!');

//        return view('albums.album',compact());
//        $album = Album::find($request->album_id);
//        return view('albums.album',compact('album'));


        return redirect()->route('show_album', ['id' => $request->album_id]);

//        return Redirect::route('show_album',array('id'=>$request->album_id));
//        return redirect('/albums')->with('success','News created successfully!');

    }
    public function getDelete($id)
    {
        $image = Image::findOrFail($id);
        $image->delete();
        return redirect()->route('show_album', ['id' => $image->album_id]);

//        return Redirect::route('show_album',array('id'=>$image->album_id));
    }

    public function postMove(Request $request){

        $request->validate([
            'new_album' => 'required|numeric|exists:albums,id',
            'photo'=>'required|numeric|exists:images,id'
        ]);

//        $rules = array(
//
//            'new_album' => 'required|numeric|exists:albums,id',
//            'photo'=>'required|numeric|exists:images,id'
//
//        );
//
//        $validator = Validator::make(Input::all(), $rules);
//        if($validator->fails()){
//
//            return Redirect::route('index');
//        }

        $image = Image::find($request->photo);
        $image->album_id = $request->new_album;
        $image->save();
//        $image = Image::find(Input::get('photo'));
//        $image->album_id = Input::get('new_album');
//        $image->save();
//        return Redirect::route('show_album',array('id'=>Input::get('new_album')));
//        return Redirect::route('show_album',array('id'=>$request->new_album));
        return redirect()->route('show_album', ['id' => $request->new_album]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
}
