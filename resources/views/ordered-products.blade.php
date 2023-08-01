<?php
use App\Models\Product;
?>
@extends('layouts.app')
@section('content')
<style>
    .content-wrapper{
        background-color: white;
    }
    .filters-heading
    {
        color: cadetblue;
    }
    .custom-form-control{
        font-size: 15px;
    }
    .pagination{
        float: right;
    }
   
    .ck-editor__editable {
    min-height: 265px;
}

    .preview {
overflow: hidden;
width: 234px !important; 
height: 121px !important;
margin: 10px;
border: 1px solid red;
}
.container {
  box-shadow: 5px 5px 5px 0px rgba(0, 0, 0, 0.5);
  border-radius: 10px;
}

</style>
<div class="container">
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
    <h3 class="m-0 text-center">Ordered Products</h3>
    </br>
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
                        <form action="{{route('orderedProducts')}}" name="ordered-products" method="post">
                            @csrf
                        <label>Select Category to load Products</label>
                        <select class="form-control" name="category" id="parent">
                            <option value="">---Select one---</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}" {{$category->id == $cat ? 'selected' : ''}}>{{$category->title}}</option>
                            @endforeach
                        </select>
                        <br>
                        <label>Select sub category</label>
                        <select class="form-control" name="subcategory" id="subcategory">
                            <option value="">---Select one---</option>
                        </select>
                        <br>
                        <button type="submit" class="btn btn-success">Search</button>
                        <br>
                    </div>
                    <div class="box-body mt-4">
                    <table id="dataTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <!-- <th>Update Ordering</th> -->
                                    <th>#</th>
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
                            <tbody id="tablecontents">
                            @if(isset($products) && count($products))
                                <?php $_SESSION['i'] = 0;?>
                                @foreach($products as $product)
                                <?php $_SESSION['i'] = $_SESSION['i'] + 1; 
                                ?>
                                <tr class="row1" data-id="{{ $product->id }}">
                                    <?php $dash = ''; ?>
                                    <td><i class="fa fa-sort"></i></td>
                                    <td><a href="{{Route('viewProduct', $product->id)}}">{{$product->title}}</a></td>
                                    <td>{{$product->title_ar}}</td>
                                    <td>
                                        @if($product->thumbnail)
                                        <a href="{{ asset('uploads/product/'.$product->thumbnail) }}"  style="border-radius: 10px;" data-lightbox="myImg<?php echo $product->id;?>" data-title="{{$product->title}}">
                                        <img src="{{ asset('uploads/product/'.$product->thumbnail) }}"  style="border-radius: 10px;" width="240" height="120" data-lightbox="myImg<?php echo $product->id;?>"/>
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
                                        <a href="{{Route('editProduct', $product->id)}}">
                                            <button class="btn btn-sm btn-info">Edit</button>
                                        </a>
                                        <a href="#"  onclick="deleteProduct({{$product->id}})">
                                            <button  class="btn btn-sm btn-danger">Delete</button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                <?php unset($_SESSION['i']); ?>
                                @else
                                <td valign="top" colspan="9" class="dataTables_empty">No data available in table</td>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
@section('ordering_script')
<script>
     function sendOrderToServer() {
         var cat_id = '';
         if($('#subcategory').val() != "")
         {
             cat_id = $('#subcategory').val();
         }
         else{
             cat_id = $('#parent').val();
         }
          var order = [];
          var token = $('meta[name="csrf-token"]').attr('content');
          $('tr.row1').each(function(index,element) {
            order.push({
              id: $(this).attr('data-id'),
              position: index+1
            });
          });

          $.ajax({
            type: "POST", 
            dataType: "json", 
            url: "/products/update-order",
                data: {
              order: order,
              cat_id: cat_id,
              _token: token
            },
            success: function(response) {
                toastr.success(response.message);
                  console.log(response);
            }
          });
        }
</script>
@endsection
<script type="text/javascript">
    function deleteProduct(id) {
        if(confirm('Are you sure?')){
          window.location.href="{{url('product/delete')}}"+'/'+id;
        }
    }
</script>
@endsection