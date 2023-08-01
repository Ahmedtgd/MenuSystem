@extends('layouts.app')
@section('content')

<div class="content-wrapper" style="min-height: 375px;">
    <!-- Content Header (Page header) -->
    
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                
                <div class="col-sm-6">
                                </div>
                
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Sliders</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <h3 class="m-0 text-center">All Sliders</h3>

    <section class="content">
        <div class="row table-responsive "     style="border-radius: 10px;">
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
                        <a class="add-new" href="{{Route('createSlider')}}">
                            <button class="btn btn-primary btn-xs">Add New Slider</button>
                        </a>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped" style="border-radius: 10px;" id="dataTable">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <!-- <th>Language</th> -->
                                    <th>Slider Title</th>
                                    <!-- <th>Slider Description</th> -->
                                    <th>Slider App Image</th>
                                    <!-- <th>Slider Website Image</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($sliders))
                                <?php $_SESSION['i'] = 0; ?>
                                @foreach($sliders as $slider)
                                <?php $_SESSION['i'] = $_SESSION['i'] + 1; ?>
                                <tr>
                                    <?php $dash = ''; ?>
                                    <td>{{$_SESSION['i']}}</td>
                                    <!-- <td>{{$slider->language}}</td> -->
                                    <td>{{$slider->title}}</td>
                                    <!-- <td>{{$slider->description != "" ? $slider->description : 'N/A'}}</td> -->
                                    <td>
                                    <a href="{{ asset('uploads/slider/'.$slider->image) }}" data-lightbox="myImg<?php echo $slider->id;?>" data-title="{{$slider->title}}">
                                        <img src="{{ asset('uploads/slider/'.$slider->image) }}" width="150"  style="border-radius: 10px;"  data-lightbox="myImg<?php echo $slider->id;?>"/>
                                        </a> 
                                    </td>
                                    <!-- <td>
                                    <a href="{{ asset('uploads/slider/'.$slider->web_image) }}" data-lightbox="myImg<?php echo $slider->id+1;?>" data-title="{{$slider->title}}">
                                        <img src="{{ asset('uploads/slider/'.$slider->web_image) }}" width="50" data-lightbox="myImg<?php echo $slider->id+1;?>"/>
                                        </a> 
                                    </td> -->
                                    <td>                  
                                        <!-- @if($slider->language == 'EN')                 -->
                                        <a href="{{Route('editSlider', $slider->id)}}">
                                            <button class="btn btn-sm btn-info">Edit</button>
                                        </a>
                                        &nbsp;
                                        &nbsp;
                                        <!-- @else
                                        <a href="{{Route('editTranslatedSlider', $slider->id)}}">
                                            <button class="btn btn-sm btn-info">Edit</button>
                                        </a>
                                        @endif -->
                                        <!-- @if($slider->language == 'EN') -->
                                        <a onclick="deleteSlider({{$slider->id}})" href="#">
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </a>
                                        <!-- @endif -->
                                        <!-- @if($slider->duplicate == false)
                                        <a href="{{Route('addTranslatedSlider', $slider->id)}}">
                                            <button class="btn btn-sm btn-warning">Add Translation</button>
                                        </a>
                                        @endif -->
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

    function deleteSlider(id) {

        if(confirm('Are you sure?')){
            window.location.href="{{url('slider/delete')}}"+'/'+id;
        }

    }

</script>
@endsection