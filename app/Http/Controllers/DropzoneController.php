<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DropzoneController extends Controller
{
    function index()
    {
        return view('dropzone');
    }

    function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        $image = $request->file('file');

        // Extension comes from the file's real content, never from the client-supplied name.
        $imageName = bin2hex(random_bytes(8)) . '.' . $image->extension();

        $image->move(public_path('uploads/albums'), $imageName);

        return response()->json(['success' => $imageName]);
    }

    function fetch()
    {
        $images = File::files(public_path('uploads/albums'));
        $output = '<ul id ="image-list">';
        foreach($images as $image)
        {
            $name = e($image->getFilename());
            $output .= '
            <li style="margin-bottom:16px;" align="center" class="ui-state-default">
                <img src="'.e(asset('uploads/albums/' . $image->getFilename())).'" class="img-thumbnail" width="175" height="175" style="height:175px;" />
                <button type="button" class="btn btn-link remove_image" id="'.$name.'">Remove</button>
            </li>
      ';
        }
        $output .= '</ul>';

        return response($output)->header('Content-Type', 'text/html; charset=UTF-8');
    }

    function delete(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'regex:/^[A-Za-z0-9_\-]+\.(jpe?g|png|gif|webp)$/i'],
        ]);

        // The regex above forbids slashes and "..", so the path cannot leave the uploads directory.
        $path = public_path('uploads/albums/' . $request->input('name'));
        if (is_file($path)) {
            File::delete($path);
        }

        return response()->json(['success' => true]);
    }
}
