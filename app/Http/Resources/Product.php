<?php
  
namespace App\Http\Resources;
use App\Http\Resources\Image as ImageResource;
use App\Http\Resources\Tag as TagResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'categoryId' => $this->categoryId,
            'title' => $this->title,
            'title_ar' => is_null($this->title_ar) ? "" : $this->title_ar,
            'thumbnail' => url('public/uploads/product/'. $this->thumbnail),
            'image' => is_null($this->image) ? "" : $this->image,
            'price' => $this->price,
            'chilli' => $this->chilli,
            'halal' => $this->halal,
            'popular' => $this->popular,
            'vageterian' => $this->vageterian,
            'isFeatured' => $this->isFeatured,
            'nutritionInfo' => is_null($this->nutritionInfo) ? "" : $this->nutritionInfo,
            'ingredients' => is_null($this->ingredients) ? "" : $this->ingredients,
            'translationId' => $this->translationId,
            'nutritionInfo_ar' => is_null($this->nutritionInfo_ar) ? "" : $this->nutritionInfo_ar,
            'ingredients_ar' => is_null($this->ingredients_ar) ? "" : $this->ingredients_ar,
            'language' => is_null($this->language) ? "" : $this->language,
            'order' => $this->order,
            'images' => ImageResource::collection($this->images),
            'tags' => count($this->tags) ? TagResource::collection($this->tags) : [],
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
            'updated_at' => date('d-m-Y'), strtotime($this->updated_at)
        ];
    }
    
}