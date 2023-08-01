<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\SliderLog;
use App\Models\CategoryLog;
use App\Models\ProductLog;
use App\Models\FeedbackLog;

class SyncEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $id = $event->id;
        $type = $event->type;
        $model = $event->model;
        switch($model)
        {
            case "slider":
                $slider_log = SliderLog::where('slider_id', $id)->where('sync', 0)->first();
                if($slider_log)
                {
                    if($type == 'delete')
                    {
                        SliderLog::where('slider_id', $id)->delete();
                        if($slider_log->type != 'add')
                        SliderLog::create(['slider_id' => $id, 'type' => $type, 'sync' => 0]);
                    }
                }
                else{
                    SliderLog::create(['slider_id' => $id, 'type' => $type]);
                }
                break;
            case "category":
                $category_log = CategoryLog::where('category_id', $id)->where('sync', 0)->first();
                if($category_log)
                {
                    if($type == 'delete')
                    {
                        CategoryLog::where('category_id', $id)->delete();
                        if($category_log->type != 'add')
                        CategoryLog::create(['category_id' => $id, 'type' => $type, 'sync' => 0]);
                    }
                }
                else{
                    CategoryLog::create(['category_id' => $id, 'type' => $type]);
                }
                break;
            case "product":
                $product_log = ProductLog::where('product_id', $id)->where('sync', 0)->first();
                if($product_log)
                {
                    if($type == 'delete')
                    {
                        ProductLog::where('product_id', $id)->delete();
                        if($product_log->type != 'add')
                        ProductLog::create(['product_id' => $id, 'type' => $type, 'sync' => 0]);
                    }
                }
                else{
                    ProductLog::create(['product_id' => $id, 'type' => $type]);
                }
                break;
            case "feedback":
                FeedbackLog::create(['feedback_id' => $id, 'type' => $type]);
                break;
        }
    }
}
