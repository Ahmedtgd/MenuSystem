<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Slider;
class HomeController extends Controller
{

    public function home(){
        if(env('IS_DEMO'))
        {
        return view('frontend/commingsoon');
        }
        else{
            $categories = Category::where('language', 'EN')->where('parentId', null)->with('products', function ($query) {
                $query->where('language','=','EN')->where('is_active', 1)->orderby('order', 'asc');
            })->with('subcategory', function($query){
                $query->where('language', 'EN')->orderby('order', 'asc');
            })->orderby('order', 'asc')->get();
            $products = [];
            if(count($categories))
            {
                $products = Product::where('language', 'EN')->where('is_active', 1)->orderby('order', 'asc')->where('categoryId', $categories[0]->id)->get();
            }
    
            // $products = Product::where('language', 'EN')->where('isFeatured', true)->orderby('updated_at', 'desc')->get();
            
            return view('frontend/home',compact('products', 'categories'));
        }
        
    }
    public function getCategoryProducts($id)
    {
        $category = Category::where('id', $id)->with('subcategory', function($query){
            $query->where('language', 'EN')->with('products', function($query){
                $query->where('language', 'EN')->where('is_active', 1)->orderby('order', 'asc');
            })->orderby('order', 'asc');
        })->first();
        if(count($category->subcategory))
        {
            return view::make('frontend/subcategoriesAjax')->with('category', $category);
        }
        else{
            $category_title = App::getLocale('language') == 'en' ? ucwords($category->title) : $category->title_ar;
            $category_id = $category->id;
            $products = Product::where('language', 'EN')->where('is_active', 1)->where('categoryId', $category->translationId)->with('category', function ($query) {
                $query->where('language','=','EN');
            })->orderby('order', 'asc')->get();
            return View::make('frontend/productsAjax')->with('products', $products)->with('category_title', $category_title)->with('category_id', $category_id);
        }
    }

    public function template(){
        $products = Product::where('language', 'EN')->where('is_active', 1)->where('isFeatured', true)->orderby('order', 'asc')->get();
        $sliders = Slider::where('language', 'EN')->orderby('updated_at', 'desc')->get();
        
        return view('frontend/template',compact('products', 'sliders'));
    }
    public function detail(){
        return view('frontend/detail');
    }

    public function productDetail($id){
        $product = Product::where('translationId', $id)->where('language', 'EN')->first();
        return view('frontend/product-detail',compact('product'));
    }

    public function contact(){
        return view('frontend/contact');
    }

    public function about(){
        return view('frontend/about');
    }
}
