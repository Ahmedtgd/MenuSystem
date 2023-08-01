<?php

namespace App\Http\Controllers;

use App\Events\SyncEvent;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Slider;
use App\Models\SliderLog;
use App\Models\CategoryLog;
use App\Models\ProductLog;
use App\Models\FeedbackLog;
use App\Models\Feedbacks;
use Illuminate\Support\Facades\File;
use App\Models\Category;
use App\Models\Device;
use App\Models\AppPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Slider as SliderResource;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Resources\Product as ProductResource;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{

    public function getAllSliders()
    {
        $returnData = [];
        try {
            $sliders = Slider::orderby('updated_at', 'desc')->get();
            return response()->json(['success' => true, 'status' => 200, 'response' => SliderResource::collection($sliders)]);
        } catch (Exception $ex) {
            return response()->json(['success' => true, 'status' => 500, 'error' => $ex->getMessage()]);
        }
    }

    public function getAllCategories()
    {
        $returnData = [];
        try {
            $categories = Category::where('language', 'EN')->where('parentId', null)->with('products', function ($query) {
                $query->where('language', 'EN')->where('is_active', 1)->orderby('order', 'asc');
            })->with('subcategory', function ($query) {
                $query->where('language', 'EN')->orderby('order', 'asc');
            })->orderby('order', 'asc')->get();
            // $categories = Category::where('language', 'EN')->where('parentId', null)->with('subcategory', function($query){
            //     $query->where('language', 'EN')->with('products', function($query){
            //         $query->where('language', 'EN')->orderby('order', 'asc');
            //     })->with('products', function($query){
            //         $query->where('language', 'EN')->orderby('order', 'asc');
            //     })->orderby('order', 'asc');
            // })->orderby('order', 'asc')->get();
            return response()->json(['success' => true, 'status' => 200, 'response' => CategoryResource::collection($categories)]);
        } catch (Exception $ex) {
            return response()->json(['success' => true, 'status' => 500, 'error' => $ex->getMessage()]);
        }
    }

    public function getAllProducts()
    {
        $returnData = [];
        try {
            $products = Product::where('language', 'EN')->where('is_active', 1)->with('images')->orderby('order', 'asc')->get();
            return response()->json(['success' => true, 'status' => 200, 'response' => ProductResource::collection($products)]);
        } catch (Exception $ex) {
            return response()->json(['success' => true, 'status' => 500, 'error' => $ex->getMessage()]);
        }
    }

    public function getProducts($id)
    {
        $returnData = [];
        try {
            $products = Product::where(['language' => 'EN', 'categoryId' => $id, 'is_active' => 1])
                ->with('images')->orderby('order', 'asc')->get();
            return response()->json(['success' => true, 'status' => 200, 'response' => ProductResource::collection($products)]);
        } catch (Exception $ex) {
            return response()->json(['success' => true, 'status' => 500, 'error' => $ex->getMessage()]);
        }
    }

    public function getProduct($id)
    {
        try {
            $product = Product::where(['translationId' => $id, 'language' => 'EN'])
                ->with('images')->get();
            return response()->json(['success' => true, 'status' => 200, 'response' => ProductResource::collection($product)]);
        } catch (Exception $ex) {
            return response()->json(['success' => true, 'status' => 500, 'error' => $ex->getMessage()]);
        }
    }

    public function addFeedbacks(Request $request)
    {
        $previous = Feedbacks::where('order_code', $request->order_code)->count();
        if ($previous > 0) {
            return response()->json(['success' => true, 'status' => 500, 'message' => 'Already saved']);
        }
        $random = $request->order_code;
        $qrcode_name = $random . '_qr.png';
        try {
            $values = [
                'device' => $request->deviceid,
                'order_code' => $request->order_code,
                'qr_code' => $qrcode_name,
                'food_taste' => $request->food_taste,
                'environment' => $request->environment,
                'service' => $request->service,
                // 'phone' => $request->phone,
                'staff_behaviour' => $request->staff_behaviour,
                'average' => ($request->food_taste + $request->environment + $request->service + $request->staff_behaviour) / 4,
                'comment' => $request->comment,
            ];
            $feedback = Feedbacks::create($values);
            event(new SyncEvent($feedback->id, 'add', 'feedback'));
            $path_qrcode = public_path('/uploads/qrcodes/feedbacks');
            File::isDirectory($path_qrcode) or File::makeDirectory($path_qrcode, 0777, true, true);
            file_put_contents($path_qrcode . '/' . $qrcode_name, base64_decode(\DNS2D::getBarcodePNG($random, 'QRCODE', 10, 10)));
            return response()->json(['success' => true, 'status' => 200, 'message' => 'Data Inserted.']);
        } catch (Exception $ex) {
            return response()->json(['success' => true, 'status' => 500, 'error' => $ex->getMessage()]);
        }
    }

    public function syncData()
    {
        $public_path = env('REMOTE_PUBLIC_PATH');
        $return_data = [];
        $slider_count = SliderLog::where('sync', 0)->count();
        $category_count = CategoryLog::where('sync', 0)->count();
        $product_count = ProductLog::where('sync', 0)->count();
        $feedback_count = FeedbackLog::where('sync', 0)->count();
        if ($slider_count) {
            $return_data['slider'] = [];
            $sliderlog = SliderLog::where('sync', 0)->first();
            if ($sliderlog) {
                $return_data['slider'][] = ['id' => $sliderlog->slider_id, 'data' => $sliderlog->slider, 'type' => $sliderlog->type, 'primary_id' => $sliderlog->id, 'created_at' => $sliderlog->created_at];
            }
        }
        if ($category_count) {
            $return_data['category'] = [];
            $categorylog = CategoryLog::where('sync', 0)->first();
            if ($categorylog) {
                $return_data['category'][] = ['id' => $categorylog->category_id, 'data' => $categorylog->category, 'type' => $categorylog->type, 'primary_id' => $categorylog->id, 'created_at' => $categorylog->created_at];
            }
        }
        if ($product_count) {
            $return_data['product'] = [];
            $productlog = ProductLog::where('sync', 0)->first();
            if ($productlog) {
                $product = Product::where('id', $productlog->product_id)->with('images')->first();
                $return_data['product'][] = ['id' => $productlog->product_id, 'data' => $product ? $product : null, 'type' => $productlog->type, 'primary_id' => $productlog->id, 'created_at' => $productlog->created_at];
            }
        }
        if ($feedback_count) {
            $return_data['feedback'] = [];
            $feedbacklog = FeedbackLog::where('sync', 0)->first();
            if ($feedbacklog) {
                $return_data['feedback'][] = ['id' => $feedbacklog->feedback_id, 'data' => $feedbacklog->feedback, 'type' => $feedbacklog->type, 'primary_id' => $feedbacklog->id, 'created_at' => $feedbacklog->created_at];
            }
        }
        return response()->json(['success' => true, 'status' => 200, 'response' => $return_data]);
    }

    public function getFeedbackResponse(Request $request)
    {
        if (isset($request->slider)) {
            SliderLog::where('slider_id', $request->slider)->update(['sync' => 1]);
        }
        if (isset($request->category)) {
            CategoryLog::where('category_id', $request->category)->update(['sync' => 1]);
        }
        if (isset($request->product)) {
            ProductLog::where('product_id', $request->product)->update(['sync' => 1]);
        }
        if (isset($request->feedback)) {
            FeedbackLog::where('feedback_id', $request->feedback)->update(['sync' => 1]);
        }
        return response()->json(['success' => true, 'status' => 200, 'message' => 'successfully updated']);
    }

    public function saveBulkFeedbacks(Request $request)
    {
        $content = Request::createFromGlobals()->getContent();
        $request_data = json_decode($content);
        if (count($request_data->feedbacks)) {
            foreach ($request_data->feedbacks as $feedback) {
                $previous = Feedbacks::where('order_code', $feedback->order_code)->count();
                if ($previous > 0) {
                    // return response()->json(['success' => true, 'status' => 500, 'message' => 'Already saved']);
                } else {
                    $random = $feedback->order_code;
                    $qrcode_name = $random . '_qr.png';
                    $values = [
                        'device' => $request_data->deviceid,
                        'order_code' => $feedback->order_code,
                        'qr_code' => $qrcode_name,
                        'food_taste' => $feedback->food_taste,
                        'environment' => $feedback->environment,
                        'service' => $feedback->service,
                        // 'phone' => $feedback->phone,
                        'staff_behaviour' => $feedback->staff_behaviour,
                        'average' => ($feedback->food_taste + $feedback->environment + $feedback->service + $feedback->staff_behaviour) / 4,
                        'comment' => $feedback->comment,
                    ];
                    $feedback = Feedbacks::create($values);
                    $device = Device::where('device', $request_data->deviceid)->first();
                    if ($device) {
                        Device::where('device', $request_data->deviceid)->update([
                            'device' => $request_data->deviceid,
                            'feedback_time' => Carbon::now()
                        ]);
                    } else {
                        Device::create([
                            'device' => $request_data->deviceid,
                            'feedback_time' => Carbon::now()
                        ]);
                    }
                    $path_qrcode = public_path('/uploads/qrcodes/feedbacks');
                    File::isDirectory($path_qrcode) or File::makeDirectory($path_qrcode, 0777, true, true);
                    file_put_contents($path_qrcode . '/' . $qrcode_name, base64_decode(\DNS2D::getBarcodePNG($random, 'QRCODE', 10, 10)));
                }
            }
            return response()->json(['success' => true, 'status' => 200, 'message' => 'Data Inserted.']);
        }
    }

    public function addDevice(Request $request)
    {
        $device = Device::where('device', $request->deviceid)->first();
        if ($device) {
            $device->apk_time = Carbon::now();
            $device->data_time = Carbon::now();
            $device->save();
            return response()->json(['success' => true, 'status' => 200, 'message' => 'saved successfully']);
        } else {
            $saved = Device::create([
                'device' => $request->deviceid
            ]);
            $saved->data_time = $saved->created_at;
            $saved->apk_time = $saved->created_at;
            $saved->save();
            return response()->json(['success' => true, 'status' => 200, 'message' => 'saved successfully']);
        }
    }

    public function updateDeviceData(Request $request)
    {
        $device = Device::where('device', $request->deviceid)->first();
        if ($device) {
            $device->data_time = Carbon::now();
            $device->save();
            return response()->json(['success' => true, 'status' => 200, 'message' => 'updated']);
        } else {
            return response()->json(['success' => true, 'status' => 404, 'message' => 'device not found']);
        }
    }

    public function beforeInstall(Request $request)
    {
        $get = AppPassword::first();
        $res = Hash::check($request->password, $get->password);
        if ($res) {
            return response()->json(['success' => true, 'status' => 200, 'message' => 'password matched']);
        } else {
            return response()->json(['success' => true, 'status' => 404, 'message' => 'Not found']);
        }
        return response()->json(['success' => true, 'status' => 404, 'message' => 'Not found']);
    }

    public function getAllImages()
    {
        $return_data = [];
        $sliders = Slider::where('language', 'EN')->select('image')->get();
        foreach ($sliders as $slider) {
            $return_data[] = url('public/uploads/slider/' . $slider->image);
        }
        $categories = Category::where('language', 'EN')->select('tab_image', 'thumbnail')->get();
        foreach ($categories as $category) {
            $return_data[] = is_null($category->tab_image) ? url('public/uploads/category/' . $category->thumbnail) : url('public/uploads/category/' . $category->tab_image);
        }
        $products = Product::where('language', 'EN')->where('is_active', 1)->get();
        foreach ($products as $product) {
            $return_data[] = url('public/uploads/product/' . $product->thumbnail);
            if (count($product->images)) {
                foreach ($product->images as $image) {
                    $return_data[] = url('public/uploads/product/' . $image->url);
                }
            }
        }
        $tags = Tag::all();
        foreach ($tags as $tag) {
            $return_data[] = url('public/images/' . $tag->tab_icon);
        }
        return response()->json(['success' => true, 'status' => 200, 'data' => $return_data]);
    }
}
