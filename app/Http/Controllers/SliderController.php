<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\SyncEvent;
use App\Models\Slider;
use ImageResize;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function createSlider(Request $request) {
        if ($request->method() == 'GET') {
            return view('create-slider');
        }
        if ($request->method() == 'POST') {
            $validator = $request->validate([
                // 'image' => 'required',
                'title' => 'required',
            ]);
            $name = "";
            if($request->hasfile('image_before'))
            {
                //  crop image start
                $file=$request->file('image_before');
                $name = time().'_product_'.uniqid().$file->getClientOriginalName();
                $image_parts = explode(";base64,", $request->image);
                if(isset($image_parts[0]) && $image_parts[0] != "")
                {
                    $image_type_aux = explode("image/", $image_parts[0]);
                    $image_type = $image_type_aux[1];
                    $image_base64 = base64_decode($image_parts[1]);
                    $imageName = $name;
                    $imageFullPath = public_path().'/uploads/slider/'.$imageName;
                    file_put_contents($imageFullPath, $image_base64);
                }
                else
                {
                    $img = ImageResize::make($file->path());
                    $img->resize(626, 367, function ($constraint) {
                    //   $constraint->aspectRatio();
                    })->resizeCanvas(626, 367)->save(public_path().'/uploads/slider/'.$name);
                }
            }
             $slider = Slider::create([
                'title' => $request->title,
                'image' => $name,
                'description' => $request->description
            ]);
            if($request->hasfile('web_image')){
                $web_image = $request->file('web_image');
                $web_image_name = time().'_'.$web_image->getClientOriginalName();
                $web_image_path = $web_image->storeAs('uploads/slider', $web_image_name, 'public');
                $slider->web_image = $web_image_name;
            }
            $slider->translationId = $slider->id;
            $slider->save();
            event(new SyncEvent($slider->id, 'add', 'slider'));

            return redirect()->route('allSliders')->with('success', 'slider has been created successfully.');
        }
    }

    public function allSliders() {
        $sliders = Slider::orderby('updated_at', 'desc')->get();
        foreach($sliders as $slider){
            $slider['duplicate'] = $this->has_arabic_translation($slider->id);
        }
        return view('all-slider', compact('sliders'));
    }

    public function has_arabic_translation($slider_id){
        $has_slider = Slider::where('translationId', $slider_id)->get();
        $count = $has_slider->count();
        if($count == 1){
            return false;
        }else{
            return true;
        }
    }

    public function addTranslatedSlider($id, Request $request) {
        $slider = Slider::findOrFail($id);
        if ($request->method() == 'GET') {
            return view('create-translated-slider', compact('slider'));
        }
        if ($request->method() == 'POST') {
            $validator = $request->validate([
                'title' => 'required',
            ]);
            $saved_slider = Slider::create([
                        'title' => $request->title,
                        'description' => $request->description,
                        'image' => $slider->image,
                        'web_image' => $slider->web_image,
            ]);
            $saved_slider->translationId = $slider->id;
            $saved_slider->language = 'AR';
            $saved_slider->save();
            return redirect()->route('allSliders')->with('success', 'Translation has been created successfully.');
        }
    }

    public function editSlider($id, Request $request) {
        $slider = Slider::findOrFail($id);
        $oldImage = $slider->image;
        $oldWebImage = $slider->web_image;
        if ($request->method() == 'GET') {
            return view('edit-slider', compact('slider'));
        }

        if ($request->method() == 'POST') {
            $validator = $request->validate([
                'title' => 'required',
            ]);
            if($request->hasfile('image_before'))
            {
                Storage::delete("public/uploads/slider/$oldImage");
                //  crop image start
                $file=$request->file('image_before');
                $name = time().'_product_'.uniqid().$file->getClientOriginalName();
                $image_parts = explode(";base64,", $request->image);
                if(isset($image_parts[0]) && $image_parts[0] != "")
                {
                    $image_type_aux = explode("image/", $image_parts[0]);
                    $image_type = $image_type_aux[1];
                    $image_base64 = base64_decode($image_parts[1]);
                    $imageName = $name;
                    $imageFullPath = public_path().'/uploads/slider/'.$imageName;
                    file_put_contents($imageFullPath, $image_base64);
                }
                else
                {
                    $img = ImageResize::make($file->path());
                    $img->resize(626, 367, function ($constraint) {
                    //   $constraint->aspectRatio();
                    })->resizeCanvas(626, 367)->save(public_path().'/uploads/slider/'.$name);
                }
                $slider->image = $name;
            }
            if($request->hasfile('web_image')){
                $web_image = $request->file('web_image');
                $web_image_name = time().'_'.$web_image->getClientOriginalName();
                $path = $web_image->storeAs('uploads/slider', $web_image_name, 'public');
                $slider->web_image = $web_image_name;
            }
            $slider->title = $request->title;
            $slider->description = $request->description;
            $slider->save();
            event(new SyncEvent($slider->id, 'update', 'slider'));
            // $tr_slider = Slider::where(['translationId' => $slider->id])->get()->except([$slider->id]);
            // if ($tr_slider) {
            //     foreach($tr_slider as $tr)
            //     {
            //         $tr->image = $slider->image;
            //         $tr->web_image = $slider->web_image;
            //         $tr->save();
            //     }
            // }
            return redirect()->route('allSliders')->with('success', 'Slider has been updated successfully.');
        }
    }

    public function editTranslatedSlider($id, Request $request) {
        $slider = Slider::findOrFail($id);
        $slider_eng = Slider::where('translationId', $slider->translationId)->where('language', 'EN')->first();
        if ($request->method() == 'GET') {
            return view('edit-translated-slider', compact('slider', 'slider_eng'));
        }

        if ($request->method() == 'POST') {
            $validator = $request->validate([
                'title' => 'required',
            ]);
            $slider->title = $request->title;
            $slider->description = $request->description;
            $slider->save();
            return redirect()->route('allSliders')->with('success', 'Slider has been updated successfully.');
        }
    }

    public function deleteSlider($id) {
        $slider = Slider::findOrFail($id);
        $tr_slider = Slider::where(['translationId' => $slider->id])->get()->except([$slider->id]);
        if ($tr_slider) {
            foreach($tr_slider as $tr)
            {
                $tr->delete();
            }
        }
        Storage::delete("public/uploads/slider/$slider->image");
        $slider->delete();
        event(new SyncEvent($slider->id, 'delete', 'slider'));
        return redirect()->back()->with('delete', 'Slider has been deleted successfully.');
    }
}
