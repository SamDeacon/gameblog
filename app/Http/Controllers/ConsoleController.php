<?php

namespace App\Http\Controllers;

use App\Console;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConsoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Console::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
          'name' => 'required|string|max:191|unique:consoles',
          'manufacturer' => 'required',
        ]);

        if ($request['thumbnail'] == NULL) {
            $set_photo = 'console-thumbnail-missing.jpg';
          } else {
            $set_photo = $request['thumbnail'];
          }

        $name = $request['name'];
        $slug = str_slug($name);

        return Console::create([
          'name' => $request['name'],
          'slug' => $slug,
          'description' => $request['description'],
          'manufacturer' => $request['manufacturer'],
          'thumbnail' => $set_photo,
          'pal_release_date' => $request['pal_release_date'],
          'na_release_date' => $request['na_release_date'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Console  $console
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Console  $console
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $console = Console::findOrFail($id);
        $this->validate($request,[
            'name' => 'required|string|max:191|unique:consoles',
            'manufacturer' => 'required',
        ]);
        $console->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Console  $console
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      $console = Console::findOrFail($id);

      $console->delete();

      return['message' => 'Console '.$id.' Deleted'];
    }
}
