<?php
use App\Models\Category;
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
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <h3 class="m-0 text-center">All Categories</h3>

    <section class="content  table-responsive" style="border-radius: 10px;">
        <div  class="row">
            <div class="col-md-12">
                <div class="box box-primary" style="border-radius: 10px;">
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
                    <div class="box-header with-border" style="border-radius: 10px;">
                        <a class="add-new" href="{{Route('createCategory')}}">
                            <button class="btn btn-primary btn-xs">Add New Category</button>
                        </a>
                    </div>
                    <div class="box-body" style="border-radius: 10px;">
                        <table class="table table-bordered  " style="border-radius: 10px;" id="dataTable">
                            <thead>
                                <tr>
                                    <!-- <th>Update Ordering</th> -->
                                    <th>#</th>
                                    <th>Category Image</th>
                                    <th>Category Name</th>
                                    <th>Arabic Name</th>
                                    <th>Parent Category</th>
                                    <th>Products Count</th>
                                    
                                    <!-- <th>Parent Category</th>  -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tablecontents">
                                @if(isset($categories))
                                <?php $_SESSION['i'] = 0; $color_count = 0;?>
                                @foreach($categories as $category)
                                <?php $_SESSION['i'] = $_SESSION['i'] + 1;
                                $prod_count = Product::where('categoryId', $category->translationId)->where('language', $category->language)->count();
                                $count = Category::where('translationId', $category->translationId)->count();
                                ?>
                                <tr class="row1" data-id="{{ $category->id }}">
                                    <?php $dash = ''; ?>
                                    <!-- <td>
                                    <form action="{{Route('updateOrder')}}" type="POST">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="hidden" name="id" value="{{$category->id}}"/>
                                                    <input class="form-control" placeholder="Order" style="font-size: 12px;" type="number" min="1" max="{{$max}}" name="order"/>
                                                </div>
                                                <div class="col-md-8">
                                                    <button type="submit" class="btn btn-sm btn-success" style="min-height: 38px;">Update Order</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>  
                                    </td> -->
                                    <td><i class="fa fa-sort"></i></td>
                                    <!-- <td>{{$category->order}}</td> -->
                                    <td>
                                    <a href="{{ asset('uploads/category/'.$category->image) }}" data-lightbox="myImg<?php echo $category->id;?>" data-title="{{$category->title}}">
                                        <img src="{{ asset('uploads/category/'.$category->thumbnail) }}" width="150" style="border-radius: 10px;"  data-lightbox="myImg<?php echo $category->id;?>"/>
                                        </a>    
                                </td>
                                    <td>{{$category->title}}</td>
                                    <td>{{$category->title_ar}}</td>
                                    <td>
                                        @if(isset($category->parentId))
                                            {{isset($category->parent->title) ? $category->parent->title : '-'}}
                                        @else
                                            None
                                        @endif
                                    </td>
                                    <td>{{$prod_count}}</td>
                                    <td>
                                        <a href="{{Route('editCategory', $category->id)}}">
                                            <button class="btn btn-sm btn-info">Edit</button>
                                        </a>
                                        &nbsp;&nbsp;
                                        <a onclick="deleteCategory({{$category->id}})" href="#">
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </a>
                                    </td>
                                </tr>
                                @if(count($category->subcategory))
                                     @include('sub-category-list',['subcategories' => $category->subcategory, 'color_count' => $color_count])
                                 @endif

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
@section('ordering_script')
<script>
     function sendOrderToServer() {
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
            url: "/categories/update-order",
                data: {
              order: order,
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
    
    function deleteCategory(id) {

        if(confirm('Are you sure?'))
        {

           window.location.href="{{url('category/delete')}}"+'/'+id;
        // body...
      }

    }

</script>
@endsection