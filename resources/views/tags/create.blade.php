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
                        <li class="breadcrumb-item active">Add Tag</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
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
                    <h3 class="m-0 text-center">Add New Tag</h3>
                        </br>

                    <form role="form" action="{{route('tags.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Tag title*</label>
                                        <input type="text" name="title" class="form-control" placeholder="Tag name" value="{{old('title')}}" required />
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Tag title (Arabic)*</label>
                                        <input type="text" name="title_ar" class="form-control" placeholder="Tag name (Arabic)" value="{{old('title_ar')}}" required />
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Tab Icon (30 x 25)</label>
                                        <input id="tab_icon" type="file" name="tab_icon" class="input is-large image" style="height: 60px !important;margin-bottom:13px" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Web Icon (30 x 25)</label>
                                        <input id="web_icon" type="file" name="web_icon" class="input is-large image" style="height: 60px !important;margin-bottom:13px" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Default Option</label>
                                        <input id="default" type="checkbox" name="default">
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