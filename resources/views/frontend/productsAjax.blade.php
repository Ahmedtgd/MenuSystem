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
<style>
    .product-item{
        padding: 0px;
    }
    .product-image{
        height: 220px;
    }
    .product-detail{
        padding: 14px;
    }
    .product-item .product-image{
        border-radius: 0px;
    }
    @media screen and (max-width: 575px) {
        .product-image{
            height: 100%;
        }
        .product-item{
            min-height: 97px;
        }
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="products-listing-home">
            <h3 class="current-category-title text-center">{{$category_title}}</h3>
                <!-- <h5 class="current-category-desc text-center">(All prices are inclusive of 5% VAT)</h5> -->
        </div>    
    </div>
</div>
@if(count($products))
@foreach($products as $product)
    <div class="row mt-4">
        <div class="col-md-12">
            <a class="product-link" href="{{route('productDetail', $product->translationId)}}">
                <div class="product-item">
                    <div class="row">
                        <div class="col-md-7 col-lg-8 col-7 <?= $locale == 'ar' ? 'order-3' : ''?> {{$align_class}}">
                            <div class="product-detail">
                                <h4 class="product-title">{{$locale == 'en' ? ucwords($product->title) : $product->title_ar}}</h4>
                                <!-- <p class="prodcut-desc">{{$locale == 'en' ? ($product->nutritionInfo != "" ? \Illuminate\Support\Str::limit(strip_tags(html_entity_decode($product->nutritionInfo)), 200) : "") : ($product->nutritionInfo_ar != "" ? \Illuminate\Support\Str::limit(strip_tags(html_entity_decode($product->nutritionInfo_ar)), 200) : "")}}</p> -->
                                <p class="product-price">{{number_format($product->price)}} IQD</p>
                                @if(count($product->tags))
                                    <p class="product-price">
                                        @foreach($product->tags as $tag)
                                        <img src="{{asset('images/'.$tag->web_icon)}}" style="width: 35px;"/>
                                        @endforeach
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-5 col-lg-4 col-5">
                            @php
                            $url = asset('uploads/product/'.$product->thumbnail);
                            @endphp
                            <div class="product-image" style="background-image: url('{{$url}}'); background-repeat: no-repeat; background-position: center; background-size: cover;"></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @endforeach
@else
<h3 class="text-center">{{__('site.no_products_found')}} {{$category_title}}</h3>
@endif