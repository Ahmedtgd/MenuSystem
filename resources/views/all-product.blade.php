<?php
use App\Models\Product;
?>
@extends('layouts.app')
@section('content')

<div class="content-wrapper" style="min-height: 375px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <h3 class="m-0 text-center">All Products</h3>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                @if ($errors->any())
                    <div>
                        @foreach ($errors->all() as $error)
                        <li class="alert alert-danger">{{ $error }}</li>
                        @endforeach
                    </div>
                    @endif

                    @if(\Session::has('error'))
                    <div>
                        <li class="alert alert-danger">{!! \Session::get('error') !!}</li>
                    </div>
                    @endif

                    @if(\Session::has('success'))
                    <div>
                        <li class="alert alert-success">{!! \Session::get('success') !!}</li>
                    </div>
                    @endif
                    <div class="box-header with-border">
                        <a class="add-new" href="{{Route('createProduct')}}">
                            <button class="btn btn-primary btn-xs">Add New Product</button>
                        </a>
                    </div>
                    <div class="box-body">
                        <table id="dataTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <!-- <th>Update Ordering</th> -->
                                    <th>Ordering</th>
                                    <th>Status</th>
                                    <th>Product Title</th>
                                    <th>Arabic Title</th>
                                    <th>Product Thumbnail</th>
                                    <th>Product Price</th>
                                    <th>Today's special</th>
                                    <th>Category</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($products))
                                <?php $_SESSION['i'] = 0;?>
                                @foreach($products as $product)
                                <?php $_SESSION['i'] = $_SESSION['i'] + 1; 
                                ?>
                                <tr>
                                    <?php $dash = ''; ?>
                                    <!-- <td>
                                    <form action="{{Route('updateProductOrder')}}" type="POST">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6 pr-0">
                                                    <input type="hidden" name="id" value="{{$product->id}}"/>
                                                    <input class="form-control" placeholder="Order" style="font-size: 12px;" type="number" min="1" max="{{$max}}" name="order"/>
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-sm btn-success" style="min-height: 38px;font-size: 12px;">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                    </td> -->
                                    <td>{{$product->order}}</td>
                                    <td><label class="badge {{$product->is_active ? 'badge-success' : 'badge-info'}}">{{$product->is_active ? 'Active' : 'Inactive'}}</label></td>
                                    <td><a href="{{Route('viewProduct', $product->id)}}">{{$product->title}}</a></td>
                                    <td>{{$product->title_ar}}</td>
                                    <td>
                                        @if($product->thumbnail)
                                        <a href="{{ asset('uploads/product/'.$product->thumbnail) }}" data-lightbox="myImg<?php echo $product->id;?>" data-title="{{$product->title}}">
                                        <img src="{{ asset('uploads/product/'.$product->thumbnail) }}" width="240" height="120" style="border-radius: 10px;" data-lightbox="myImg<?php echo $product->id;?>"/>
                                        </a>
                                        @else
                                        <h6>-</h6>
                                        @endif
                                    <!-- </div> -->
                                        
                                        
                                    </td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->isFeatured == 0 ? '-' : 'YES'}}</td>
                                    <td>{{isset($product->category->title) ? $product->category->title : 'n/a'}}</td>
                                    <td>{{date('d-m-Y', strtotime($product->created_at))}}</td>
                                    <td>
                                        <a href="{{Route('activeInactiveProduct', $product->id)}}">
                                            <button class="btn btn-sm btn-success">Change status</button>
                                        </a>
                                        </br></br>
                                        <a href="{{Route('editProduct', $product->id)}}">
                                            <button class="btn btn-sm btn-info">Edit</button>
                                        </a>
                                        </br></br>
                                        <a href="#"  onclick="deleteProduct({{$product->id}})">
                                            <button  class="btn btn-sm btn-danger">Delete</button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                <?php unset($_SESSION['i']); ?>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    function deleteProduct(id) {
        if(confirm('Are you sure?')){
          window.location.href="{{url('product/delete')}}"+'/'+id;
        }
    }
</script>
@endsection