<?php

namespace App\Http\Controllers;

use ImageResize;
use App\Events\SyncEvent;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller {

    public function createCategory(Request $request) {
        $max = Category::max('order');
        $categories = Category::where('parentId', null)->where('language', 'EN')
        ->with('subcategory', function($query){
            $query->where('language', 'EN');
        })
        ->orderby('updated_at', 'desc')->get();
        if ($request->method() == 'GET') {
            return view('create-category', compact('categories'));
        }
        if ($request->method() == 'POST') {
            $validator = $request->validate([
                'title' => 'required',
                'title_ar' => 'required',
                'parentId' => 'nullable|numeric',
                // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
$name = "";
$thumb_name = "";
$tab_thumb = "";
            if($request->hasfile('image'))
            {
                //  crop image start
                $file=$request->file('image');
                $name = time().'_product_'.uniqid().$file->getClientOriginalName();
                $thumb_name = 'thumbnail_'.$name;
                $img = ImageResize::make($file->path());
                    $img->resize(214, 125, function ($constraint) {
                    //   $constraint->aspectRatio();
                    })->resizeCanvas(214, 125)->save(public_path().'/uploads/category/'.$name);
                    $img->resize(214, 125, function ($constraint) {
                        //   $constraint->aspectRatio();
                    })->resizeCanvas(214, 125)->save(public_path().'/uploads/category/'.$thumb_name);
            }
            if($request->hasfile('tab_image'))
            {
                //  crop image start
                $file=$request->file('tab_image');
                $tab_thumb = 'tab_thumb_'.time().'_product_'.uniqid().$file->getClientOriginalName();
                $img = ImageResize::make($file->path());
                    $img->resize(90, 90, function ($constraint) {
                    //   $constraint->aspectRatio();
                    })->resizeCanvas(90, 90)->save(public_path().'/uploads/category/'.$tab_thumb);
            }
            $category = Category::create([
                'title' => $request->title,
                'title_ar' => $request->title_ar,
                'parentId' => $request->parentId,
                'image' => $name,
                'thumbnail' => $thumb_name,
                'tab_image' => $tab_thumb
            ]);
            $category->order = $max+1;
            $category->translationId = $category->id;
            $category->save();
            event(new SyncEvent($category->id, 'add', 'category'));
            return redirect()->route('allCategories')->with('success', 'Category has been created successfully.');
        }
    }

    public function getSubcategories($id)
    {
        $response = '';
        // $response = '<option value="">---Select one---</option>';
        $categories = Category::where('parentId', $id)->where('language', 'EN')->orderby('order', 'asc')->get();
        if(count($categories))
        {
        foreach($categories as $category)
        {
            $response .= "<option value='".$category->id."'>".$category->title."</option>";
        }
    }
    else
    $response = '';
        return response()->json(['success', true, 'data' => $response]);
    }

    public function addTranslatedCategory($id, Request $request) {
        $category = Category::findOrFail($id);
        if ($request->method() == 'GET') {
            return view('create-translated-category', compact('category'));
        }
        if ($request->method() == 'POST') {
            $validator = $request->validate([
                'title' => 'required',
            ]);
            $saved_category = Category::create([
                        'title' => $request->title,
                        'image' => $category->image,
                        'order' => $category->order
            ]);
            $saved_category->parentId = $category->parentId;
            $saved_category->translationId = $category->id;
            $saved_category->thumbnail = $category->thumbnail;
            $saved_category->language = 'AR';
            $saved_category->save();
            return redirect()->route('allCategories')->with('success', 'Translation has been created successfully.');
        }
    }

    public function allCategories() {
        $max = Category::max('order');
        $categories = Category::where('parentId', null)->where('language', 'EN')->orderby('order', 'asc')->with('subcategory', function($query){
            $query->where('language', 'EN');
        })->get();
        return view('all-category', compact('categories', 'max'));
    }

    public function has_arabic_translation($category_id){
        $has_category = Category::where('translationId', $category_id)->get();
        $count = $has_category->count();
        if($count == 1){
            return false;
        }else{
            return true;
        }
    }

    public function editCategory($id, Request $request) {
        $category = Category::findOrFail($id);
        $oldImage = $category->image;
        if ($request->method() == 'GET') {
            $categories = Category::where('parentId', null)->where('language', 'EN')->where('id', '!=', $category->id)
            ->with('subcategory', function($query){
                $query->where('language', 'EN');
            })
            ->orderby('updated_at', 'desc')->get();
            return view('edit-category', compact('category', 'categories'));
        }

        if ($request->method() == 'POST') {
            $validator = $request->validate([
                'title' => 'required',
                'title_ar' => 'required',
                'parentId' => 'nullable|numeric'
            ]);
            if ($request->title != $category->title || $request->parentId != $category->parentId) {
                if (isset($request->parentId)) {
                    $checkDuplicate = Category::where('title', $request->title)->where('parentId', $request->parentId)->first();
                    if ($checkDuplicate) {
                        return redirect()->back()->with('error', 'Category already exist in this parent.');
                    }
                } else {
                    $checkDuplicate = Category::where('title', $request->title)->where('parentId', null)->first();
                    if ($checkDuplicate) {
                        return redirect()->back()->with('error', 'Category already exist with this name.');
                    }
                }
            }

                        if($request->hasfile('image'))
                        {
                            //  crop image start
                            $file=$request->file('image');
                            $name = time().'_product_'.uniqid().$file->getClientOriginalName();
                            $thumb_name = 'thumbnail_'.$name;
                            $img = ImageResize::make($file->path());
                                $img->resize(214, 125, function ($constraint) {
                                //   $constraint->aspectRatio();
                                })->resizeCanvas(214, 125)->save(public_path().'/uploads/category/'.$name);
                                $img->resize(214, 125, function ($constraint) {
                                    //   $constraint->aspectRatio();
                                })->resizeCanvas(214, 125)->save(public_path().'/uploads/category/'.$thumb_name);
                                $category->thumbnail = $thumb_name;
                $category->image = $name;
                        }
                        if($request->hasfile('tab_image'))
                        {
                            //  crop image start
                            $file=$request->file('tab_image');
                            $tab_thumb = 'tab_thumb_'.time().'_product_'.uniqid().$file->getClientOriginalName();
                            $img = ImageResize::make($file->path());
                                $img->resize(90, 90, function ($constraint) {
                                //   $constraint->aspectRatio();
                                })->resizeCanvas(90, 90)->save(public_path().'/uploads/category/'.$tab_thumb);
                $category->tab_image = $tab_thumb;
                                
                        }

            
                
            $category->title = $request->title;
            $category->title_ar = $request->title_ar;
            $category->parentId = $request->parentId;
            $category->save();
            event(new SyncEvent($category->id, 'update', 'category'));
            return redirect()->route('allCategories')->with('success', 'Category has been updated successfully.');
        }
    }

    public function editTranslatedCategory($id, Request $request) {
        $category = Category::findOrFail($id);
        $category_eng = Category::where('translationId', $category->translationId)->where('language', 'EN')->first();
        if ($request->method() == 'GET') {
            return view('edit-translated-category', compact('category', 'category_eng'));
        }

        if ($request->method() == 'POST') {
            $validator = $request->validate([
                'title' => 'required',
            ]);
            $category->title = $request->title;
            $category->save();
            return redirect()->route('allCategories')->with('success', 'Category has been updated successfully.');
        }
    }

    public function deleteCategory($id) {
        $category = Category::where('id', $id)->first();
        Category::where('id',$id)->delete();
        Product::where('categoryId', $id)->where('language', 'EN')->delete();
        $subcategories = Category::where('parentId', $id)->get();
        if(count($subcategories))
        {
            foreach($subcategories as $subcat)
            {
                Product::where('categoryId', $subcat->translationId)->delete();
                $subcat->delete();
            }
        }
        event(new SyncEvent($category->id, 'delete', 'category'));
        return redirect()->back()->with('delete', 'Category has been deleted successfully.');
    }

    public function updateCatOrder(Request $request)
    {
        $cats = Category::where('language', 'EN')->get();
        foreach ($cats as $cat) {
            foreach ($request->order as $order) {
                if ($order['id'] == $cat->translationId) {
                    $cat->update(['order' => $order['position']]);
                }
            }
        }
        
        return response()->json(['success' => true, 'code' => 200, 'message' => 'Ordering updated successfully']);
    }

    public function updateOrder(Request $request)
    {
        $order = $request->order;
        $category = Category::where('id', $request->id)->first();
        if($category->order != $order)
        {
            if($category->order > $order)
            {
                //bottom to top
                $categories = Category::where('order', '<', $category->order)->where('order', '>=', $order)->get();
                foreach($categories as $cat)
                {
                    $cat->order = $cat->order + 1;
                    $cat->save();
                }
                Category::where('id', $category->id)->update(['order' => $order]);
                return redirect()->back()->with('success', 'Categories reordered successfully.');
            }
            else{
                //top to bottom
                $categories = Category::where('order', '>', $category->order)->where('order', '<=', $order)->get();
                foreach($categories as $cat)
                {
                    $cat->order = $cat->order - 1;
                    $cat->save();
                }
                Category::where('id', $category->id)->update(['order' => $order]);
                return redirect()->back()->with('success', 'Categories reordered successfully.');
            }
        }
        else{
            return redirect()->back()->with('error', 'Already with same order');
        }
        
    }

    public function addCategoriesDefaultOrdering()
    {
        $categories = Category::where('language', 'EN')->orderby('id', 'desc')->get();
        $i = 1;
        foreach($categories as $category)
        {
            Category::where('id', $category->id)->update(['order' => $i]);
            $i++;
        }
        return response()->json(['success' => true]);
    }

}
