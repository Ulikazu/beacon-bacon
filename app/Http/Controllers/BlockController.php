<?php

namespace App\Http\Controllers;

use Image;
use App\Block;
use App\Http\Requests;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blocks = Block::all();
        return view('blocks.index', compact('blocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blocks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'name' => 'required|max:255',
        ]);

        $block = Block::create($request->except('image'));

        $this->uploadIcon($block, $request);

        return redirect()->route('blocks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $block = Block::findOrFail($id);
        return view('blocks.show', compact('block'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $block = Block::findOrFail($id);

        return view('blocks.edit', compact('block'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
           'name' => 'required|max:255',
        ]);

        $block = Block::findOrFail($id);
        $block->update($request->except('image'));

        $this->uploadIcon($block, $request);

        return redirect()->route('blocks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $block = Block::findOrFail($id);
        $block->locations()->delete();
        $block->delete();

        return redirect()->route('blocks.index');
    }

    /**
     * Upload Image
     * @param  Block $Block
     * @param  Request  $request
     * @return void
     */
    protected function uploadIcon(Block $block, Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }

        $destinationPath = public_path('uploads/blocks/' . $block->id);
        $fileName = $request->file('image')->getClientOriginalName();

        if ($block->image && is_file($destinationPath . '/' . $block->image)) {
            unlink($destinationPath . '/' . $block->image);
        }

        $request->file('image')->move($destinationPath, $fileName);

        $image = Image::make($destinationPath . '/' . $fileName);

        $block->update([
            'image' => $fileName,
            'height' => $image->height(),
            'width' => $image->width()
        ]);
    }
}
