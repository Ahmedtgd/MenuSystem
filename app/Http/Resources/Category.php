<?php
  
namespace App\Http\Resources;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Resources\Product as ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'parentId' => $this->parentId,
            'title' => $this->title,
            'title_ar' => is_null($this->title_ar) ? "" : $this->title_ar,
            'thumbnail' => is_null($this->tab_image) ? url('public/uploads/category/'. $this->thumbnail) : url('public/uploads/category/' . $this->tab_image),
            'image' => is_null($this->image) ? "" : url('public/uploads/category/'. $this->image),
            'language' => is_null($this->language) ? "" : $this->language,
            'translationId' => $this->translationId,
            'order' => $this->order,
            'subcategory' => count($this->subcategory) ? CategoryResource::collection($this->subcategory) : [],
            'products' => count($this->products) ? ProductResource::collection($this->products) : [],
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
            'updated_at' => date('d-m-Y'), strtotime($this->updated_at)
        ];
    }
    
}