<?php

namespace App\Http\Controllers;

use App\Models\album;
use App\Http\Requests\StorealbumRequest;
use App\Http\Requests\UpdatealbumRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id, $tipo)
    {
        return view('album.create', compact('id', 'tipo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorealbumRequest $request, $id, $tipo)
    {
        $request->validate([
            'file' => 'required|image'
        ]);

        $nombre = Str::random(10) . $request->file('file')->getClientOriginalName();
        $ruta = storage_path() . '\app\public\album/' . $nombre;

        Image::make($request->file('file'))
            ->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($ruta);

        $album = new Album();
        $album->albumable_id = $id;
        $album->albumable_type = $tipo;
        $album->album = '/storage/album/' . $nombre;
        $album->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatealbumRequest $request, album $album)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($img)
    {
        $imagen = Album::find($img);

        $url = str_replace('storage', 'public', $imagen->album);
        Storage::delete($url);

        $imagen->delete();
        return  redirect()->back()->with('eliminado', 'si');
    }
}
