<?php

namespace App\Http\Controllers;



use App\Models\Album;
use App\Models\AlbumCategory;
use App\Models\AlbumImagesDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class AlbumController extends Controller
{
    private function deleteFileIfExists(string $path): void
    {
        if (is_file($path)) {
            unlink($path);
        }
    }

    public function getList()
    {
        $albums = Album::with('Photos')->get();
        return view('albums.index', compact('albums'));
    }

    public function getAlbum($id)
    {
        $album = Album::with('Photos')->find($id);

        $albums = Album::all();
//        return View::make('album')
//            ->with('album',$album);
        return view('albums.album', compact('album', 'albums'));

    }


    public function editAlbum($id)
    {
        $album = Album::find($id);
        if ($album) {
            $images = $album->Photos;
            $categories = AlbumCategory::all();
            return view('albums.editalbum', compact('album', 'images', 'categories'));
        }
    }

    public function getForm()
    {
        $categories = AlbumCategory::all();
        return view('albums.createalbum', compact('categories'));
    }


    public function updateAlbum(Request $request)
    {
        $element_array = array(
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
            'category' => 'required|array',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'allImageFiles.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        );
        $validator = Validator::make($request->all(), $element_array);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        $album = Album::find($request->id);
        if ($album) {
            $file = $request->file('cover_image');
            if ($file) {
                $this->deleteFileIfExists(public_path('uploads/albums/' . basename((string) $album->cover_image)));
                $random_name = date('YmdHis') . bin2hex(random_bytes(4));
                $destinationPath = public_path('uploads') . '/albums/';
                $extension = $file->extension();
                $filename = $random_name . '_cover.' . $extension;
                $file->move($destinationPath, $filename);
                $album->cover_image = $filename;
            }
            $album->name = $request->name;
            $album->description = $request->description;
            $album->category = implode(',', $request->category);
            if($request->input("publishDate")) {
                $album->publishDate = Carbon::parse($request->input("publishDate"))->format("Y-m-d");
            }
            $album->save();

            $deleted_ids = $request->input("deleted_id");
            if ($deleted_ids != null) {
                $deleted_ids_array = explode(",", $deleted_ids);
                foreach (count($deleted_ids_array) > 0 ? $deleted_ids_array : array() as $d) {
                    $image_file = AlbumImagesDetail::where("id", $d)->where("albumId", $album->id)->first();
                    if ($image_file) {
                        if ($image_file->fileName != null && file_exists(public_path("uploads/albums/" . $album->id . "/" . $image_file->fileName))) {
                            unlink(public_path("uploads/albums/" . $album->id . "/" . $image_file->fileName));
                        }
                        $image_file->delete();
                    }
                }
            }
            $sort_ids = json_decode($request->input("sort_ids"), true);
            foreach (count((array)$sort_ids) > 0 ? $sort_ids : array() as $s => $value) {
                $al_file = AlbumImagesDetail::where("id", $s)->where("albumId", $album->id)->first();
                if ($al_file) {
                    $al_file->sortIndex = $value;
                    $al_file->save();
                }
            }

            $album_images = $request->file("allImageFiles");
            $image_data = $request->input("allImageData");

            if (count((array)$album_images) > 0) {
                $imgPath = public_path('uploads') . '/albums/' . $album->id . "/";
                if (!File::exists($imgPath)) {
                    File::makeDirectory($imgPath);
                }
                foreach ($album_images as $key => $value) {
                    $album_image = new AlbumImagesDetail();
                    $album_image->albumId = $album->id;
                    $image_data_array = json_decode($image_data[$key], true);
                    $album_image->sortIndex = intval($image_data_array["sortIndex"]);
                    $album_image->caption = $image_data_array["caption"];
                    $album_image->credit = $image_data_array["credit"];
                    $album_image->save();

                    $album_image->fileName = date('YmdHis') . "_" . $album->id . "_" . $album_image->id . "." . $value->extension();
                    $album_image->save();
                    $value->move($imgPath, $album_image->fileName);
                }
            }
            \Request::session()->flash('success', "Album updated successfully!");
            return response()->json(array("list" => url("albums")));
        }
    }


    public function postCreate(Request $request)
    {
        $element_array = array(
            'name' => 'required|string|max:255',
            'category' => 'required|array',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'allImageFiles.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096'
        );
        $validator = Validator::make($request->all(), $element_array);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        $file = $request->file('cover_image');
        $random_name = date('YmdHis') . bin2hex(random_bytes(4));
        $destinationPath = public_path('uploads') . '/albums/';
        $extension = $file->extension();
        $filename = $random_name . '_cover.' . $extension;
        $file->move($destinationPath, $filename);

        $album = new Album();
        $album->name = $request->name;
        $album->description = $request->description;
        $album->category = implode(',', $request->category);
        $album->cover_image = $filename;
        if($request->input("publishDate")) {
            $album->publishDate = Carbon::parse($request->input("publishDate"))->format("Y-m-d");
        }
        $album->save();

        $album_images = $request->file("allImageFiles");
        $image_data = $request->input("allImageData");

        if (count((array)$album_images) > 0) {
            $imgPath = public_path('uploads') . '/albums/' . $album->id . "/";
            if (!File::exists($imgPath)) {
                File::makeDirectory($imgPath);
            }
            foreach ($album_images as $key => $value) {
                $album_image = new AlbumImagesDetail();
                $album_image->albumId = $album->id;
                $image_data_array = json_decode($image_data[$key], true);
                $album_image->sortIndex = intval($image_data_array["sortIndex"]);
                $album_image->caption = $image_data_array["caption"];
                $album_image->credit = $image_data_array["credit"];
                $album_image->save();

                $album_image->fileName = date('YmdHis') . "_" . $album->id . "_" . $album_image->id . "." . $value->extension();
                $album_image->save();
                $value->move($imgPath, $album_image->fileName);
            }
        }
        \Request::session()->flash('success', "Album created successfully!");
        return response()->json(array("list" => url("albums")));
    }

    public function getDelete($id)
    {
        $album = Album::find($id);
        if ($album) {
            $albumImages = AlbumImagesDetail::where("albumId", $id)->get();
            foreach (!$albumImages->isEmpty() ? $albumImages : array() as $ai) {
                if ($ai->fileName != null && file_exists(public_path("uploads/albums/" . $album->id . "/" . $ai->fileName))) {
                    unlink(public_path("uploads/albums/" . $album->id . "/" . $ai->fileName));
                }
                $ai->delete();
            }
            $this->deleteFileIfExists(public_path('uploads/albums/' . basename((string) $album->cover_image)));
            File::deleteDirectory(public_path("uploads/albums/" . $id));
            $album->delete();
            return redirect('/albums')->with('success', 'Album Deleted!');
        }
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Album $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Album $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Album $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Album $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        //
    }
}
