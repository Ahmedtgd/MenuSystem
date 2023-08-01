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
                        <li class="breadcrumb-item active">Add Product</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <h3 class="m-0 text-center">Add New Product</h3>
     
    <section class="content" style="padding:20px 1%;">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        
                    </div>

                    <form role="form" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="box-body">
                            @if(count($tags))
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Tags for Product</label>
                                </div>
                                @foreach($tags as $tag)
                                    <div class="col-sm-2">
                                        <label>{{$tag->title}}</label>
                                        <input type="checkbox" name="tags[]" value="{{$tag->id}}" {{$tag->default ? 'checked' : ''}} />
                                    </div>
                                @endforeach
                            </div>
                            @endif
                            <div class="row">
                            <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Today's special?</label>
                                        <input onclick="setValue()" type="checkbox" value="{{old('isFeatured')}}" name="isFeatured" value="1" id="isFeatured"  />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Select category*</label>
                                        <select required type="text" name="categoryId" class="form-control">
                                            <option value="">None</option>
                                            @if($categories)
                                            @foreach($categories as $category)
                                            <?php $dash = ''; ?>
                                            @if(count($category->subcategory) < 1)
                                            <option value="{{$category->id}}">{{$category->title}}</option>
                                            @else
                                            @if(count($category->subcategory))
                                            @include('subcategoryList-option',['subcategories' => $category->subcategory])
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
                                        <input type="number" min="1" max="100000000" name="price" class="form-control" placeholder="Product price" value="{{old('price')}}" required />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Product title*</label>
                                        <input type="text" name="title" class="form-control" placeholder="Product name" value="{{old('title')}}" required />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Arabic title*</label>
                                        <input type="text" name="title_ar" class="form-control" placeholder="Arabic name" value="{{old('title_ar')}}" required />
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Cover Image*</label>
                                        <input type="file" name="thumbnail" class="form-control" required>
                                        <span> (300px X 150px)</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Image*</label>
                                        <input multiple type="file" name="image[]" max="5" class="form-control" required>
                                        <span> (1908px X 1101px)</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Product Description</label>
                                        <textarea class="ckeditor form-control" name="nutritionInfo">{{old('nutritionInfo')}}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Arabic Description</label>
                                        <textarea id="nutrition" class="form-control" name="nutritionInfo_ar">{{old('nutritionInfo_ar')}}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Product Ingredients</label>
                                        <textarea class="ckeditor form-control" name="ingredients">{{old('ingredients')}}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Arabic Ingredients</label>
                                        <textarea id="ingredients" class="form-control" name="ingredients_ar">{{old('ingredients_ar')}}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Create</button>

                        </div>
                    </form>

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
                </div>
            </div>
        </div>
    </section>
</div>
</div>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });

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