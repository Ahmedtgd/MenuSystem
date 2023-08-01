@extends('frontend.layouts.new')
@section('content')
@php
$locale = App::getLocale();
$align_class = $locale == 'en' ? 'text-left' : 'text-right';
$rtl = false;
if($locale == 'en')
{
    $rtl = 'rtl: false,';
}
if($locale == 'ar')
{
    $rtl = 'rtl: true,';
}
@endphp
@if(count($product->images))
@php
if(count($product->images) == 1)
$url = asset('uploads/product/'.$product->images[0]->url);
else{
    foreach($product->images as $img)
    {
        if($img->cover != 1)
        $url = asset('uploads/product/'.$img->url);
    }
}
@endphp
<div class="product-image product-detail-image" style="background-image: url('{{$url}}'); background-repeat: no-repeat; background-size: cover; background-position: center;">
</div>
@endif
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="product-detail text-center p-3">
                <p class="product-detail-title">{{$locale == 'en' ? $product->title : $product->title_ar}}</p>
                <p class="font-weight-bold product-detail-price">{{number_format($product->price)}} IQD</p>
                <p class="product-price">
                                    @if($product->chilli)
                                        <img src="{{asset('images/chilli.png')}}" style="width: 40px;"/>
                                    @endif
                                    @if($product->halal)
                                        <img src="{{asset('images/halal.png')}}" style="width: 35px;"/>
                                    @endif
                                    @if($product->popular)
                                        <img src="{{asset('images/popular.png')}}" style="width: 20px;"/>
                                    @endif
                                    @if($product->vageterian)
                                        <img src="{{asset('images/vageterian.png')}}" style="width: 35px;"/>
                                    @endif
                                </p>
                <p class="prodcut-desc">{{$locale == 'en' ? ($product->nutritionInfo != "" ? \Illuminate\Support\Str::limit(strip_tags(html_entity_decode($product->nutritionInfo)), 200) : "") : ($product->nutritionInfo_ar != "" ? \Illuminate\Support\Str::limit(strip_tags(html_entity_decode($product->nutritionInfo_ar)), 200) : "")}}</p>

                <!-- <p class="product-detail-desc">{{$product->description}}</p> -->
            </div>
        </div>
    </div>
</div>
@endsection