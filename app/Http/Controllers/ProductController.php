<?php

namespace App\Http\Controllers;

use App\Events\SyncEvent;
use ImageResize;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class ProductController extends Controller {

    public function allProducts() {
        $max = Product::max('order');
        $products = Product::orderby('order', 'asc')->where('language', 'EN')->get();
        // $categories = Category::where('language', 'EN')->orderby('title', 'asc')->get();
        // foreach($products as $product){
        //     $category_count = Category::where('translationId', $product->categoryId)->count();
        //     if($category_count > 1)
        //     {
        //         if($product->language == 'AR')
        //         {
        //             $product->category = Category::where('translationId', $product->categoryId)->where('language', 'AR')->first();
        //         }
        //         else{
        //             $product->category = Category::where('translationId', $product->categoryId)->where('language', 'EN')->first();
        //         }
        //     }
        //     $product['duplicate'] = $this->has_arabic_translation($product->id);
        // }

        return view('all-product', compact('products', 'max'));
    }
    public function orderedProducts(Request $request)
    {
        $cat = '';
        $subcat = '';
        $products = [];
        $categories = Category::where('language', 'EN')->where('parentId', null)->orderby('order', 'asc')->get();
        if($request->method() == 'GET')
        {
            // $products = Product::where('language', 'EN')->get();
            return view('ordered-products', compact('categories', 'products', 'cat', 'subcat'));
        }
        else{
            $cat = $request->category;
            $subcat = $request->subcategory;
            if($request->subcategory && $request->subcategory != "")
            {
                $products = Product::where('categoryId', $request->subcategory)->orderby('order', 'asc')->where('language', 'EN')->get();
            }
            else{
                if($request->category && $request->category != "")
                {
                $products = Product::where('categoryId', $request->category)->orderby('order', 'asc')->where('language', 'EN')->get();
                }
            }
            return view('ordered-products', compact('categories', 'products', 'cat', 'subcat'));
        }

    }

    public function has_arabic_translation($product_id){
        $has_translation = Product::where('translationId', $product_id)->get();
        $count = $has_translation->count();
        if($count == 1){
            return false;
        }else{
            return true;
        }
    }
    public function updateProductsOrder(Request $request)
    {
        $cat_id = $request->cat_id;
        $products = Product::where('categoryId', $cat_id)->where('language', 'EN')->orderby('order', 'asc')->get();
        foreach ($products as $prod) {
            foreach ($request->order as $order) {
                if ($order['id'] == $prod->translationId) {
                    $prod->update(['order' => $order['position']]);
                }
            }
        }
        return response()->json(['success' => true, 'code' => 200, 'message' => 'Ordering updated successfully']);
    }

    public function createProduct(Request $request) {
        $max = Product::max('order');
        $categories = Category::where('parentId', null)->where('language', 'EN')->orderby('updated_at', 'desc')
        ->with('subcategory', function($query){
            $query->where('language', 'EN');
        })
        ->get();
        if ($request->method() == 'GET') {
            $tags = Tag::where('active', 1)->get();
            return view('create-product', compact('categories', 'tags'));
        }
        if ($request->method() == 'POST') {
            $validator = $request->validate([
                'title' => 'required',
                'title_ar' => 'required',
                'categoryId' => 'required',
                'price' => 'required|max:100000000|min:1',
                // 'thumbnail' => 'required||mimes:jpeg,png,jpg,gif,svg',
                // 'image' => 'required||mimes:jpeg,png,jpg,gif,svg',
            ], ['categoryId.required' => 'The category field is required.', 'price.max' => 'Price should be less than or equal to 10 Million.', 'price.min' => 'Price should be greater than 0.']);
        // ], ['categoryId.required' => 'The category field is required.', 'thumbnail.mimes' => 'Thumbnail should be an image', 'image.mimes' => 'Image should be an image', 'price.max' => 'Price should be less than or equal to 10 Million.', 'price.min' => 'Price should be greater than 0.']);
            if($request->isFeatured==1){
                $isFeatured=1;
         } 
         else{
                $isFeatured=0;
         }
         $product = Product::create([
            'title' => $request->title,
            'title_ar' => $request->title_ar,
            'categoryId' => $request->categoryId,
            'price' => $request->price,
            'chilli' => is_null($request->chilli) ? 0 : $request->chilli,
            'halal' => is_null($request->halal) ? 0 :$request->halal,
            'popular' => is_null($request->popular) ? 0 :$request->popular,
            'vageterian' => is_null($request->vageterian) ? 0 :$request->vageterian,
            'nutritionInfo' => $request->nutritionInfo,
            'nutritionInfo_ar' => $request->nutritionInfo_ar,
            'ingredients' => $request->ingredients,
            'ingredients_ar' => $request->ingredients_ar,
            'isFeatured' => $isFeatured,
            'order' => $max+1,
            'image' => 'null'
        ]);
        if(isset($request->tags) && count($request->tags))
        {
            $product->tags()->sync($request->tags);
        }
        $product->translationId = $product->id;
        $destination = public_path('uploads/product');

            if ($request->hasFile('thumbnail')) {
                $image_thumb = $request->file('thumbnail');
                $thumbfilename = pathinfo($image_thumb->getClientOriginalName(), PATHINFO_FILENAME);
            $thumb_name = 'thumbnail_'.time() . '_' . $thumbfilename.'.png';
                        
                        $img = ImageResize::make($image_thumb->path())->resize(300, 150, function ($constraint) {
                            // $constraint->aspectRatio();
                        })->save($destination . '/' . $thumb_name);
                        $product->thumbnail = $thumb_name;
            }
            if ($request->hasFile('image') && count($request->file('image'))) {
                $urls = [];
                foreach ($request->file('image') as $image) {
                    $filename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                    $name = time() . '_' . $filename.'.png';
                    $path = ImageResize::make($image->path())->resize(1908, 1101, function ($constraint) {
                        // $constraint->aspectRatio();
                    })->save($destination . '/' . $name);
                    // $path = $image->storeAs('uploads/product', $name, 'public');
                    $urls[] = $name;
                }
            }
            $product->save();
            // event(new SyncEvent($product->id, 'add', 'product'));
            if (isset($urls) && count($urls)) {
                foreach ($urls as $url) {
                    Image::create([
                        'product_id' => $product->id,
                        'url' => $url,
                        'cover' => 0
                    ]);
                }
            }
            return redirect()->route('allProducts')->with('success', 'Product has been created successfully.');
        }
    }

    public function editProduct($id)
    {
        $tags = Tag::where('active', 1)->get();
       $categories = Category::where('language', 'EN')
                    ->where('parentId', null)
                   ->with('subcategory', function($query){
                       $query->where('language', 'EN');
                   })
                   ->orderby('updated_at', 'desc')->get();

       $product = Product::findOrFail($id);
       return view('edit-product',compact('product','categories', 'tags'));
    }

    public function updateProduct(Request $request)
    {
        $validator = $request->validate([
            'title' => 'required',
            'title_ar' => 'required',
            'categoryId' => 'required',
            'price' => 'required|min:1|max:100000000',
                // 'image' => 'required||mimes:jpeg,png,jpg,gif,svg',
        ], ['categoryId.required' => 'The category field is required.', 'price.max' => 'Price should be less than or equal to 10 Million.', 'price.min' => 'Price should be greater than 0.']);
         if($request->isFeatured==1){
                $isFeatured=1;
         } 
         else{
                $isFeatured=0;
         }
         Product::where('id',$request->id)->update([
            'title' => $request->title,
            'is_active' => $request->is_active,
            'title_ar' => $request->title_ar,
            'categoryId' => $request->categoryId,
            'price' => $request->price,
            'nutritionInfo' => $request->nutritionInfo,
            'nutritionInfo_ar' => $request->nutritionInfo_ar,
            'ingredients' => $request->ingredients,
            'ingredients_ar' => $request->ingredients_ar,
            'chilli' => is_null($request->chilli) ? 0 : $request->chilli,
            'halal' => is_null($request->halal) ? 0 :$request->halal,
            'popular' => is_null($request->popular) ? 0 :$request->popular,
            'vageterian' => is_null($request->vageterian) ? 0 :$request->vageterian,
            'isFeatured' => $isFeatured,
            'image' => 'null',
        ]);
        $obj=Product::where('id', $request->id)->first();
        $obj->tags()->sync($request->tags);
        // event(new SyncEvent($obj->id, 'update', 'product'));
        $destination = public_path('uploads/product');
        if ($request->hasFile('thumbnail')) {
            $image_thumb = $request->file('thumbnail');
            $thumbfilename = pathinfo($image_thumb->getClientOriginalName(), PATHINFO_FILENAME);
            $thumb_name = 'thumbnail_'.time() . '_' . $thumbfilename.'.png';
                    
                    $img = ImageResize::make($image_thumb->path())->resize(300, 150, function ($constraint) {
                        // $constraint->aspectRatio();
                    })->save($destination . '/' . $thumb_name);
                    $obj->thumbnail = $thumb_name;
                    $obj->save();
        }
        if ($request->hasFile('image') && count($request->file('image'))) {
            $urls = [];
                foreach ($request->file('image') as $image) {
                    $filename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                    $name = time() . '_' . $filename.'.png';
                    $path = ImageResize::make($image->path())->resize(1908, 1101, function ($constraint) {
                        // $constraint->aspectRatio();
                    })->save($destination . '/' . $name);
                    $urls[] = $name;
                    $obj->save();
             }
        } 
            // Product::where('translationId',$obj->id)->update(['translationId'=>$obj->id, 'isFeatured' => $isFeatured, 'thumbnail' => $obj->thumbnail, 'categoryId' => $obj->categoryId, 'price' => $obj->price]);
           
            if($request->hasFile('image') && count($request->file('image'))) {

                if (isset($urls) && count($urls)) {
                    foreach ($urls as $url) {
                        Image::create([
                            'product_id' => $request->id,
                            'url' => $url,
                            'cover' => 0
                        ]);
                    }
                }

             }
             return redirect()->route('allProducts')->with('success', 'Product has been updated successfully.');
    }

    public function viewProduct($id)
    {
        $product = Product::where('id', $id)->first();
        return view('view-product', compact('product'));
    }

    public function deleteProductImage($id)
    {
        Image::where('id',$id)->delete();
        return redirect()->back()->with('success', 'Image has been deleted successfully.');
    }

    public function coverProductImage($image, $id)
    {
        $image = Image::where('id', $image)->first();
        Image::where('product_id', $image->product_id)->where('cover', 1)->update(['cover' => 0]);
        $image->cover = 1;
        $image->save();
        $thumb_name = 'thumbnail_'.time();
        $destination = public_path('uploads/product');
        $img = ImageResize::make($destination.'/'.$image->url)->resize(300, 150, function ($constraint) {
            // $constraint->aspectRatio();
        })->save($destination . '/' . $thumb_name);
        Product::where('id', $id)->update(['thumbnail' => $thumb_name]);
        return redirect()->back()->with('success', 'Thumbnail updated successfully.');
    }

    public function editTranslatedProduct($id, Request $request) {
        $product = Product::findOrFail($id);
        $product_eng = Product::where('translationId', $product->translationId)->where('language', 'EN')->first();

        if ($request->method() == 'GET') {
            return view('edit-translated-product', compact('product', 'product_eng'));
        }

        if ($request->method() == 'POST') {
            $validator = $request->validate([
                'title' => 'required',
            ]);
            $product->title = $request->title;
            $product->nutritionInfo = $request->nutritionInfo;
            $product->ingredients = $request->ingredients;
            $product->save();
            return redirect()->route('allProducts')->with('success', 'Product has been updated successfully.');
        }
    }

    public function addTranslatedProduct($id, Request $request) {
        $product = Product::findOrFail($id);
        if ($request->method() == 'GET') {
            return view('create-translated-product', compact('product'));
        }
        if ($request->method() == 'POST') {
            $validator = $request->validate([
                'title' => 'required',
            ]);
            $saved_product = Product::create([
                        'title' => $request->title,
                        'image' => $product->image,
                        'categoryId' => $product->categoryId,
                        'nutritionInfo' => $request->nutritionInfo,
                        'ingredients' => $request->ingredients,
                        'order' => $product->order,
                        'price' => $product->price
            ]);
            $saved_product->translationId = $product->id;
            $saved_product->language = 'AR';
            $saved_product->isFeatured = $product->isFeatured;
            $saved_product->thumbnail = $product->thumbnail;
            $saved_product->save();
            return redirect()->route('allProducts')->with('success', 'Translation has been created successfully.');
        }
    }

    public function deleteProduct($id)
    {
       $product = Product::where('id', $id)->first();
       $product->tags()->detach();
       $order = $product->order;
       Product::where('id',$id)->delete();
    //    event(new SyncEvent($product->id, 'delete', 'product'));
    //    $products = Product::where('order', '>', $order)->get();
    //    foreach($products as $prod)
    //    {
    //        $prod->order = $prod->order - 1;
    //        $prod->save();
    //    }
       return redirect()->back()->with('success', 'Records Deleted!!');

    }

    public function updateProductOrder(Request $request)
    {
        $order = $request->order;
        $product = Product::where('id', $request->id)->first();
        if($product->order != $order)
        {
            if($product->order > $order)
            {
                //bottom to top
                $products = Product::where('order', '<', $product->order)->where('order', '>=', $order)->get();
                foreach($products as $prod)
                {
                    $prod->order = $prod->order + 1;
                    $prod->save();
                }
                Product::where('id', $product->id)->update(['order' => $order]);
                return redirect()->back()->with('success', 'Products reordered successfully.');
            }
            else{
                //top to bottom
                $products = Product::where('order', '>', $product->order)->where('order', '<=', $order)->get();
                foreach($products as $prod)
                {
                    $prod->order = $prod->order - 1;
                    $prod->save();
                }
                Product::where('id', $product->id)->update(['order' => $order]);
                return redirect()->back()->with('success', 'Products reordered successfully.');
            }
        }
        else{
            return redirect()->back()->with('error', 'Already with same order');
        }
        
    }

    public function addProductsDefaultOrdering()
    {
        $products = Product::where('language', 'EN')->orderby('id', 'desc')->get();
        $i = 1;
        foreach($products as $product)
        {
            Product::where('id', $product->id)->update(['order' => $i]);
            $i++;
        }
        return response()->json(['success' => true]);
    }

    public function activeInactiveProduct($id)
    {
        $product = Product::where('id', $id)->where('language', 'EN')->first();
        $product->is_active = $product->is_active ? 0 : 1;
        $product->save();
        // event(new SyncEvent($product->id, 'update', 'product'));
        return redirect()->back()->with('success', 'Status changed successfully'); 
    }

}
