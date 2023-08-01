<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ImageResize;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Models\Image;
use App\Models\Feedbacks;
use App\Models\FeedbackLog;
use App\Models\SliderLog;
use App\Models\CategoryLog;
use App\Models\ProductLog;
use App\Models\Product;
use App\Models\Slider;
use App\Models\AppPassword;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $food_count = round(Feedbacks::avg('food_taste'));
        $service_count = round(Feedbacks::avg('service'));
        $environment_count = round(Feedbacks::avg('environment'));
        $behaviour_count = round(Feedbacks::avg('staff_behaviour'));
        $avg_count = ($food_count+$service_count+$environment_count+$behaviour_count)/4;
        $avg_count = round($avg_count);
        return view('home', compact('food_count', 'service_count', 'environment_count', 'behaviour_count', 'avg_count'));
    }

    public function updateApkPassword(Request $request)
    {
        if($request->method() == 'POST')
        {
            $request->validate([
                'new_password' => 'required|alpha_num|min:6|max:12'
            ],
            [
            'new_password.required' => 'New password is required',
            'new_password.alpha_num' => 'New password must be Alpha Numeric',
            'new_password.min' => 'New password must be at least 6 characters long',
            'new_password.max' => 'New password must be maximum 12 characters long'
            ]
        );
            $old_password = AppPassword::first();
            $old_password->password = Hash::make($request->new_password);
            $old_password->old_password = $request->new_password;
            $old_password->save();
            return redirect()->back()->with('success', 'Password updated successfully.');
        }
        else
        {
            $old_password = AppPassword::first();
            return view('update-apk-password', compact('old_password'));
        }
    }

    public function syncData()
    {
        $remote_public_path = env('REMOTE_PUBLIC_PATH');
        $response = $this->getData();
        if($response->status == 200)
        {
            $again = false;
            $response = $response->response;
                if(isset($response->slider) && count($response->slider))
                {
                    $again = true;
                    foreach($response->slider as $slider)
                    {
                        $data = $slider->data;
                        $got_slider = SliderLog::where('primary_id', $slider->id)->where('sync', 1)->first();
                        if(!$got_slider)
                        {
                            switch($slider->type)
                            {
                                case "add":
                                Slider::create([
                                    'title' => $data->title,
                                    'image' => $data->image,
                                    'translationId' => $data->translationId,
                                    'language' => $data->language,
                                    'primary_id' => $data->id
                                ]);
                                $img = file_get_contents($remote_public_path. '/'.'slider'.'/'.$data->image);
                                file_put_contents(public_path().'/uploads/slider/'.$data->image, $img);
                                // $img = ImageResize::make($remote_public_path . '/slider/'. $data->image);
                                // $img->resize(626, 367, function ($constraint) {
                                //     //   $constraint->aspectRatio();
                                // })->resizeCanvas(626, 367)->save(public_path().'/uploads/slider/'.$data->image);
                                    break;
                                case "update":
                                    $local_slider = Slider::where('primary_id', $data->id)->first();
                                    if($local_slider->image != $data->image)
                                    {
                                        $img = file_get_contents($remote_public_path. '/'.'slider'.'/'.$data->image);
                                        file_put_contents(public_path().'/uploads/slider/'.$data->image, $img);
                                        // $img = ImageResize::make($remote_public_path . '/slider/'. $data->image);
                                        // $img->resize(626, 367, function ($constraint) {
                                        //     //   $constraint->aspectRatio();
                                        // })->resizeCanvas(626, 367)->save(public_path().'/uploads/slider/'.$data->image);
                                    }
                                    $local_slider->update([
                                        'title' => $data->title,
                                        'image' => $data->image,
                                    ]);
                                    break;
                                case "delete":
                                    Slider::where('primary_id', $slider->id)->delete();
                                    break;
                            }
                            SliderLog::create([
                                'slider_id' => $slider->id,
                                'type' => $slider->type,
                                'primary_id' => $slider->primary_id,
                                'sync' => 1
                            ]);
                        }
                    }
                }
                if(isset($response->category) && count($response->category))
                {
                    $again = true;
                    foreach($response->category as $category)
                    {
                        $data = $category->data;
                        $got_category = CategoryLog::where('primary_id', $category->id)->where('sync', 1)->first();
                        if(!$got_category)
                        {
                            switch($category->type)
                            {
                                case "add":
                                    Category::create([
                                        'title' => $data->title,
                                        'title_ar' => $data->title_ar,
                                        'parentId' => $data->parentId,
                                        'image' => $data->image,
                                        'thumbnail' => $data->thumbnail,
                                        'tab_image' => $data->tab_image,
                                        'order' => $data->order,
                                        'translationId' => $data->translationId,
                                        'language' => $data->language,
                                        'primary_id' => $data->id
                                    ]);
                                    $img = file_get_contents($remote_public_path. '/'.'category'.'/'.$data->image);
                                    file_put_contents(public_path().'/uploads/category/'.$data->image, $img);
                                    $img = file_get_contents($remote_public_path. '/'.'category'.'/'.$data->tab_image);
                                    file_put_contents(public_path().'/uploads/category/'.$data->tab_image, $img);
                                    $img = file_get_contents($remote_public_path. '/'.'category'.'/'.$data->thumbnail);
                                    file_put_contents(public_path().'/uploads/category/'.$data->thumbnail, $img);
                                    break;
                                case "update":
                                    $local_category = Category::where('primary_id', $data->id)->first();
                                    if($local_category->image != $data->image)
                                    {
                                        $img = file_get_contents($remote_public_path. '/'.'category'.'/'.$data->image);
                                        file_put_contents(public_path().'/uploads/category/'.$data->image, $img);
                                    }
                                    if($local_category->tab_image != $data->tab_image)
                                    {
                                        $img = file_get_contents($remote_public_path. '/'.'category'.'/'.$data->tab_image);
                                        file_put_contents(public_path().'/uploads/category/'.$data->tab_image, $img);
                                    }
                                    if($local_category->thumbnail != $data->thumbnail)
                                    {
                                        $img = file_get_contents($remote_public_path. '/'.'category'.'/'.$data->thumbnail);
                                        file_put_contents(public_path().'/uploads/category/'.$data->thumbnail, $img);
                                    }
                                    $local_category->update([
                                        'title' => $data->title,
                                        'title_ar' => $data->title_ar,
                                        'parentId' => $data->parentId,
                                        'image' => $data->image,
                                        'thumbnail' => $data->thumbnail,
                                        'tab_image' => $data->tab_image,
                                        'order' => $data->order,
                                        'translationId' => $data->translationId,
                                        'language' => $data->language
                                    ]);
                                    break;
                                case "delete":
                                    $local_cat = Category::where('primary_id', $category->id)->where('language', 'EN')->first();
                                    Product::where('categoryId', $local_cat->id)->where('language', 'EN')->delete();
                                    $subcategories = Category::where('parentId', $local_cat->id)->get();
                                    if(count($subcategories))
                                    {
                                        foreach($subcategories as $subcat)
                                        {
                                            Product::where('categoryId', $subcat->translationId)->delete();
                                            $subcat->delete();
                                        }
                                    }
                                    Category::where('primary_id', $category->id)->delete();
                                    break;
                            }
                            CategoryLog::create([
                                'category_id' => $category->id,
                                'type' => $category->type,
                                'primary_id' => $category->primary_id,
                                'sync' => 1
                            ]);
                        }
                    }
                }
                if(isset($response->product) && count($response->product))
                {
                    $again = true;
                    foreach($response->product as $product)
                    {
                        $data = $product->data;
                        $got_product = ProductLog::where('primary_id', $product->id)->where('sync', 1)->first();
                        if(!$got_product)
                        {
                            switch($product->type)
                            {
                                case "add":
                                Product::create([
                                    'title' => $data->title,
                                    'title_ar' => $data->title_ar,
                                    'categoryId' => $data->categoryId,
                                    'image' => $data->image,
                                    'thumbnail' => $data->thumbnail,
                                    'price' => $data->price,
                                    'is_active' => $data->is_active,
                                    'isFeatured' => $data->isFeatured,
                                    'nutritionInfo' => $data->nutritionInfo,
                                    'nutritionInfo_ar' => $data->nutritionInfo_ar,
                                    'ingredients' => $data->ingredients,
                                    'ingredients_ar' => $data->ingredients_ar,
                                    'order' => $data->order,
                                    'translationId' => $data->translationId,
                                    'language' => $data->language,
                                    'primary_id' => $data->id
                                ]);
                                $img = file_get_contents($remote_public_path. '/'.'product'.'/'.$data->thumbnail);
                                file_put_contents(public_path().'/uploads/product/'.$data->thumbnail, $img);
                                if(count($data->images))
                                {
                                    foreach($data->images as $image)
                                    {
                                        Image::create([
                                            'product_id' => $image->product_id,
                                            'url' => $image->url
                                        ]);
                                        $img = file_get_contents($remote_public_path. '/'.'product'.'/'.$image->url);
                                        file_put_contents(public_path().'/uploads/product/'.$image->url, $img);
                                    }
                                }
                                    break;
                                case "update":
                                    $local_product = Product::where('primary_id', $data->id)->with('images')->first();
                                    if($local_product->thumbnail != $data->thumbnail)
                                    {
                                        $img = file_get_contents($remote_public_path. '/'.'product'.'/'.$data->thumbnail);
                                        file_put_contents(public_path().'/uploads/product/'.$data->thumbnail, $img);
                                    }
                                    if(count($data->images))
                                    {
                                        foreach($data->images as $image)
                                        {
                                            $found = false;
                                            foreach($local_product->images as $local_image)
                                            {
                                                if($image->url == $local_image->url)
                                                {
                                                    $found = true;
                                                }
                                            }
                                            if($found == false)
                                            {
                                                Image::create([
                                                    'product_id' => $data->id,
                                                    'url' => $image->url
                                                ]);
                                                $img = file_get_contents($remote_public_path. '/'.'product'.'/'.$image->url);
                                                file_put_contents(public_path().'/uploads/product/'.$image->url, $img);
                                            }
                                        }
                                    }
                                    // dd($data);
                                    Product::where('primary_id', $data->id)->update([
                                        'title' => $data->title,
                                        'title_ar' => $data->title_ar,
                                        'categoryId' => $data->categoryId,
                                        'image' => $data->image,
                                        'thumbnail' => $data->thumbnail,
                                        'price' => $data->price,
                                        'is_active' => $data->is_active,
                                        'isFeatured' => $data->isFeatured,
                                        'nutritionInfo' => $data->nutritionInfo,
                                        'nutritionInfo_ar' => $data->nutritionInfo_ar,
                                        'ingredients' => $data->ingredients,
                                        'ingredients_ar' => $data->ingredients_ar,
                                        'order' => $data->order,
                                    ]);
                                    break;
                                case "delete":
                                    Product::where('primary_id', $product->id)->delete();
                                    break;
                            }
                            ProductLog::create([
                                'product_id' => $product->id,
                                'type' => $product->type,
                                'primary_id' => $product->primary_id,
                                'sync' => 1
                            ]);
                        }
                    }
                }
                if(isset($response->feedback) && count($response->feedback))
                {
                    $again = true;
                    foreach($response->feedback as $feedback)
                    {
                        $data = $feedback->data;
                        $got_feedback = FeedbackLog::where('primary_id', $feedback->id)->where('sync', 1)->first();
                        if(!$got_feedback)
                        {
                            switch($feedback->type)
                            {
                                case "add":
                                Feedbacks::create([
                                    'order_code' => $data->order_code,
                                    'qr_code' => $data->qr_code,
                                    'food_taste' => $data->food_taste,
                                    'prices' => $data->prices,
                                    'environment' => $data->environment,
                                    'service' => $data->service,
                                    'staff_behaviour' => $data->staff_behaviour,
                                    'comment' => $data->comment,
                                    'primary_id' => $data->id
                                ]);
                                $path_qrcode = public_path('/uploads/qrcodes/feedbacks');
                                File::isDirectory($path_qrcode) or File::makeDirectory($path_qrcode, 0777, true, true);
                                file_put_contents($path_qrcode.'/'.$data->qr_code, base64_decode(\DNS2D::getBarcodePNG($data->order_code, 'QRCODE', 10, 10)));
                                    break;
                                case "update":
                                    break;
                                case "delete":
                                    break;
                            }
                            FeedbackLog::create([
                                'feedback_id' => $feedback->id,
                                'type' => $feedback->type,
                                'primary_id' => $feedback->primary_id,
                                'sync' => 1
                            ]);
                        }
                    }
                }
                if($again == true)
                {
                    // echo 'here'.'<br>';
                    $sent_reponse = $this->sendFeedbackResponse($response);
                    if(isset($sent_reponse->success) && $sent_reponse->success)
                    {
                        // echo 'no'. '<br>';
                        $this->syncData();
                    }
                    else{
                        return redirect()->back()->with('error', 'Something went wrong');
                    }
                }
                else{
                    echo 'hereee';
                    return redirect()->back()->with('success', 'Data synchronized successfully');
                }
            }
            else{
                return redirect()->back()->with('error', 'Something went wrong');
            }
       
    }

    public function sendFeedbackResponse($data)
    {
        $post = [];
        if(isset($data->slider))
        {
            $post['slider'] = $data->slider[0]->id;
        }
        if(isset($data->category))
        {
            $post['category'] = $data->category[0]->id;
        }
        if(isset($data->product))
        {
            $post['product'] = $data->product[0]->id;
        }
        if(isset($data->feedback))
        {
            $post['feedback'] = $data->feedback[0]->id;
        }
        $remote_url = env('REMOTE_API_BASE_URL');
        $ch = curl_init($remote_url . '/get-feedback-response');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response);
    }

    public function getData()
    {
        $curl = curl_init();
        $remote_url = env('REMOTE_API_BASE_URL');
        curl_setopt_array($curl, array(
            CURLOPT_URL => $remote_url . '/sync-data',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return json_decode($response);
        }
    }
}
