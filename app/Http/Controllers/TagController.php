<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderby('id', 'desc')->get();
        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tab_icon = 'tab_icon_placeholder.png';
        $web_icon = 'web_icon_placeholder.png';
        $request->validate([
            'title' => 'required',
            'title_ar' => 'required',
        ],[
            'title.required' => 'Title field is required',
            'title_ar.required' => 'Arabic Title field is required'
        ]);
        if($request->hasFile('tab_icon'))
        {
            $file = $request->file('tab_icon');
            $tab_icon = time() . '_tab_icon_' . uniqid() . $file->getClientOriginalName();
            $file->move(public_path('images'), $tab_icon);
        }
        if($request->hasFile('web_icon'))
        {
            $file = $request->file('web_icon');
            $web_icon = time() . '_wev_icon_' . uniqid() . $file->getClientOriginalName();
            $file->move(public_path('images'), $web_icon);
        }
        Tag::create([
            'title' => $request->title,
            'title_ar' => $request->title_ar,
            'tab_icon' => $tab_icon,
            'web_icon' => $web_icon,
            'default' => is_null($request->default) ? 0 : 1
        ]);
        return redirect()->route('tags.index')->with('success', 'Tag is added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $tab_icon = $tag->tab_icon;
        $web_icon = $tag->web_icon;
        $request->validate([
            'title' => 'required',
            'title_ar' => 'required',
        ],[
            'title.required' => 'Title field is required',
            'title_ar.required' => 'Arabic Title field is required'
        ]);
        if($request->hasFile('tab_icon'))
        {
            $file = $request->file('tab_icon');
            $tab_icon = time() . '_tab_icon_' . uniqid() . $file->getClientOriginalName();
            $file->move(public_path('images'), $tab_icon);
        }
        if($request->hasFile('web_icon'))
        {
            $file = $request->file('web_icon');
            $web_icon = time() . '_wev_icon_' . uniqid() . $file->getClientOriginalName();
            $file->move(public_path('images'), $web_icon);
        }
        $tag->update([
            'title' => $request->title,
            'title_ar' => $request->title_ar,
            'tab_icon' => $tab_icon,
            'web_icon' => $web_icon,
            'default' => is_null($request->default) ? 0 : 1
        ]);
        return redirect()->route('tags.index')->with('success', 'Tag is added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->update([
            'active' => $tag->active ? 0 : 1
        ]);
        return redirect()->back()->with('success', 'Status updated successfully');
    }
}
