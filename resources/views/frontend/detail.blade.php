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
<div class="product-image" style="background-image: url('https://finedine.imgix.net/SJu6h7GeW/068932b9-131c-49fe-8f22-b184a259c9cb.jpg?fit=crop&auto=format&w=903&h=null'); background-repeat: no-repeat; background-size: cover; background-position: center;height: 700px;">
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="product-detail text-center p-3">
                <p class="product-detail-title">Kenafah Cheese Cake</p>
                <p class="font-weight-bold product-detail-price">53.00 IQD</p>
                <p class="product-detail-desc">Sphere of strawberry sauce stuffed vanilla cheesecake rolled in golden fried kenaefah served with lotus sauce and strawberry sauce.</p>
            </div>
        </div>
    </div>
</div>
@endsection