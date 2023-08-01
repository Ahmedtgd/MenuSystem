@extends('layouts.app')
@section('content')
<div class="content-wrapper" style="min-height: 375px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Update Translation</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Update Language</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content" style="padding:20px 10%;">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Update Product</h3>
                    </div>

                    <form role="form" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>Translated title*</label>
                                        <input dir="rtl" type="text" name="title" class="form-control" placeholder="Product name" value="{{$product->title}}" required />
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>English Product title</label>
                                        <input type="text" disabled="disabled" class="form-control" name="title_english" value="{{$product_eng->title}}" />
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>Translated Product Nutrition Info*</label>
                                        <textarea id="nutrition" dir="rtl" class="ckeditor form-control" name="nutritionInfo">{{$product->nutritionInfo}}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>English Product Nutrition Info</label>
                                        <div>
                                        <?php echo $product_eng->nutritionInfo ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>Translated Product Ingredients*</label>
                                        <textarea id="ingredients" dir="rtl" class="ckeditor form-control" name="ingredients">{{$product->ingredients}}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>English Product Ingredients</label>
                                        <div>
                                        <?php echo $product_eng->ingredients ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
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

    function setValue(){

      var checkbox=document.getElementById('isFeatured');
        if (checkbox.checked) {
            checkbox.value=1;
        } else {
             checkbox.value=0;
        }

        
    }
</script>
@endsection