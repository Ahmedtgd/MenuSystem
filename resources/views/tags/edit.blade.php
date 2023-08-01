@extends('layouts.app')
@section('content')
<style>
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
<style>
.ck-editor__editable {
min-height: 265px;
}
</style>
<div class="container" >
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
                        <li class="breadcrumb-item active">Update Tag</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <h3 class="m-0 text-center">Update Tag</h3>

    <section class="content" style="padding:20px 30%;">
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
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        
                    </div>

                    <form role="form" action="{{route('tags.update', ['tag' => $tag])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Tag title*</label>
                                        <input type="text" name="title" class="form-control" placeholder="Tag name" value="{{$tag->title}}" required />
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Tag title (Arabic)*</label>
                                        <input type="text" name="title_ar" class="form-control" placeholder="Tag name (Arabic)" value="{{$tag->title_ar}}" required />
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <img src="{{ asset('images/'.$tag->tab_icon) }}" style="width: 30px;"/>
                                        <label>Tab Icon (30 x 25)</label>
                                        <input id="tab_icon" type="file" name="tab_icon" class="input is-large image" style="height: 60px !important;margin-bottom:13px">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <img src="{{ asset('images/'.$tag->web_icon) }}" style="width: 30px;" />
                                        <label>Web Icon (30 x 25)</label>
                                        <input id="web_icon" type="file" name="web_icon" class="input is-large image" style="height: 60px !important;margin-bottom:13px">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Default Option</label>
                                        <input id="default" {{$tag->default ? 'checked' : ''}} type="checkbox" name="default">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
@endsection