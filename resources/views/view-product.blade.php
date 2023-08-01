@extends('layouts.app')
@section('content')
<div class="content-wrapper" style="min-height: 375px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{$product->title}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Slider</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content" style="padding:50px 20%;">
        <div class="row">
            <div class="col-md-9" style="margin: 0 auto;">
                <div class="box box-primary">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @if(count($product->images))
                            <?php
                                $x = 0;
                            ?>
                            @foreach($product->images as $image)
                            @if($image->cover == 1 && count($product->images) > 1)
                            @else
                            <div class="carousel-item <?= $x == 0 ? 'active' : ''?>">
                            <img style="height: 300px;" class="d-block w-100" src="{{ asset('uploads/product/'.$image->url) }}" alt="">
                            </div>
                            <?php $x++; ?>
                            @endif
                            @endforeach
                            @endif
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        </div>

                        <div class="product-detail" style="background: #fff;
    padding: 15px;
    border: 1px solid lightgray;">
                            <p><b>Product:</b> {{$product->title}}</p>
                            <p><b>Price:</b> IQD {{$product->price}}</p>
                            <p><b>Description.:</b> {{$product->nutritionInfo != "" ? strip_tags($product->nutritionInfo) : "N/A"}}</p>
                            <p><b>Ingredients:</b> {{$product->ingredients != "" ? strip_tags($product->ingredients) : "N/A"}}</p>
                            <p><b>Category:</b> {{$product->category->title}}</p>
                        </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection