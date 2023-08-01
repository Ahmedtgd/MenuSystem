@extends('layouts.app')
@section('content')
<style>
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
.preview {
overflow: hidden;
width: 150px !important; 
height: 100px !important;
margin: 50px;
border: 1px solid red;
}
.container {
  box-shadow: 5px 5px 5px 0px rgba(0, 0, 0, 0.5);
  border-radius: 10px;
}
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
                        <li class="breadcrumb-item active">Edit Product</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <h3 class="m-0 text-center">Edit Product</h3>

    <section class="content" style="padding:20px 1%;">
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
                    
                    </div>
                   
                    <form role="form" action="{{route('updateProduct')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <div class="box-body">
                            @if(count($tags))
                            @php
                            $tag_ids = [];
                            if(count($product->tags))
                            {
                                foreach($product->tags as $ptag)
                                {
                                    $tag_ids[] = $ptag->id;
                                }
                            }
                            @endphp
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Tags for Product</label>
                                </div>
                                @foreach($tags as $tag)
                                    <div class="col-sm-2">
                                        <label>{{$tag->title}}</label>
                                        <input type="checkbox" value="{{$tag->id}}" {{in_array($tag->id, $tag_ids) ? 'checked' : ''}} name="tags[]" />
                                    </div>
                                @endforeach
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Today's special?</label>
                                        <input name="isFeatured" value="1" id="isFeatured" onclick="setValue()" type="checkbox"  {{$product->isFeatured==1?"checked":""}} />
                                    </div>
                                </div>
                               
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label>Status</label>
                                        <select type="text" name="is_active" class="form-control">
                                            <option value="1" {{$product->is_active ? 'selected' : ''}}>Active</option>
                                            <option value="0" {{!$product->is_active ? 'selected' : ''}}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Select category*</label>
                                        <select type="text" name="categoryId" class="form-control">
                                            <option value="">None</option>
                                            @if($categories)
                                            @foreach($categories as $category)
                                            <?php $dash = ''; ?>
                                            @if(count($category->subcategory) < 1)
                                            <option value="{{$category->id}}" {{$category->id==$product->categoryId?'selected':""}}>{{$category->title}}</option>
                                            @else
                                            @if(count($category->subcategory) >= 1)
                                            @include('sub-category-list-option-for-update',['subcategories' => $category->subcategory, 'product' => $product])
                                            @endif
                                            @endif
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Product Price (Max 10 Million)*</label>
                                        <input type="number" min="1" max="100000000" name="price" class="form-control" placeholder="Product price" value="{{$product->price}}" required />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Product title*</label>
                                        <input  type="text" name="title" class="form-control" placeholder="Product name" value="{{$product->title}}" required />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Arabic title*</label>
                                        <input  type="text" name="title_ar" class="form-control" placeholder="Arabic name" value="{{$product->title_ar}}" required />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Product Description*</label>
                                        <textarea class="ckeditor form-control" name="nutritionInfo">{{$product->nutritionInfo}}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Arabic Description*</label>
                                        <textarea id="nutrition" class="form-control" name="nutritionInfo_ar">{{$product->nutritionInfo_ar}}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Product Ingredients*</label>
                                        <textarea class="ckeditor form-control" name="ingredients">{{$product->ingredients}}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Arabic Ingredients*</label>
                                        <textarea id="ingredients" class="form-control" name="ingredients_ar">{{$product->ingredients_ar}}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-5 mb-2">
                                            <label>Cover Image</label>
                                            <br>
                                            <img class="product-image" style="width: 240px;height: 120px;border: 1px solid silver;border-radius: 8px;" src="{{ asset('uploads/product/'.$product->thumbnail) }}"/>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm12">
                                            <input type="file" name="thumbnail" class="form-control" accept="image/*"/>
                                            <span> (300px X 150px)</span>
                                            <br>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Images*</label>
                                        <br>
                                        @if(count($product->images))
                                        <div class="row">
                                        @foreach($product->images as $img)
                                        @if($img->cover == 1 && count($product->images) > 1)
                                        @else
                                        <div class="col-sm-3">
                                        <img class="product-image" style="display:block;width: 240px;height: 120px;border: 1px solid silver;border-radius: 8px;" src="{{ asset('uploads/product/'.$img->url) }}">
                                        @if(count($product->images) > 1)
                                        <a class="product-delete btn btn-sm btn-danger" style="font-size: 10px;" href="{{Route('deleteProductImage', $img->id)}}">
                                        Delete
                                        </a>
                                        @endif
                                        <!-- <a class="product-delete btn btn-sm btn-info" style="font-size: 10px;" href="{{Route('coverProductImage', [$img->id, $product->translationId])}}">
                                        Make cover
                                        </a> -->
                                        </div>
                                        @endif
                                        @endforeach
                                        </div>
                                        @endif
                                        <br><br>
                            <input multiple type="file" name="image[]" max="5" class="form-control">
                            <span>1908px X 1101px</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>

                        </div>
                    </form>

                   
                </div>
            </div>
        </div>
    </section>
</div>
</div>

<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">

    function setValue(){

      var checkbox=document.getElementById('isFeatured');
        if (checkbox.checked) {
            checkbox.value=1;
        } else {
             checkbox.value=0;
        }

        
    }
</script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/ckeditor.js') }}"></script>
<script src="{{ asset('js/ar.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        ClassicEditor
    .create( document.querySelector( '#nutrition' ), {
        language: {
            ui: 'ar',
            content: 'ar'
        }
    } )
    .then( editor => {
        window.editor = editor;
    } )
    .catch( err => {
        console.error( err.stack );
    } );
    ClassicEditor
    .create( document.querySelector( '#ingredients' ), {
        language: {
            ui: 'ar',
            content: 'ar'
        }
    } )
    .then( editor => {
        window.editor = editor;
    } )
    .catch( err => {
        console.error( err.stack );
    } );
    });
    </script>
@endsection