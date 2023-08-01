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
                        <li class="breadcrumb-item active">Tags</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <h3 class="m-0 text-center">All Tags</h3>

    <section class="content">
        <div class="row">
            <div class="col-md-12  table-responsive">
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
                        <a class="add-new" href="{{Route('tags.create')}}">
                            <button class="btn btn-primary btn-xs">Add New Tag</button>
                        </a>
                    </div>
                    <div class="box-body ">
                        <table class="table table-bordered table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Tag Title</th>
                                    <th>Tag Title (Arabic)</th>
                                    <th>Slider App Icon</th>
                                    <th>Slider Web Icon</th>
                                    <!-- <th>Status</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tags as $tag)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$tag->title}}</td>
                                    <td>{{$tag->title_ar}}</td>
                                    <td>
                                    <a href="{{ asset('images/'.$tag->tab_icon) }}"  data-lightbox="myImg<?php echo $tag->id;?>" data-title="{{$tag->title}}">
                                        <img src="{{ asset('images/'.$tag->tab_icon) }}"  style="border-radius: 10px;" width="240" height="120" data-lightbox="myImg<?php echo $tag->id;?>"/>
                                        </a> 
                                    </td>
                                    <td>
                                    <a href="{{ asset('images/'.$tag->web_icon) }}"       data-lightbox="myImg<?php echo $tag->id;?>" data-title="{{$tag->title}}">
                                        <img src="{{ asset('images/'.$tag->web_icon) }}"  style="border-radius: 10px;"        width="240" height="120"  data-lightbox="myImg<?php echo $tag->id;?>"/>
                                        </a> 
                                    </td>
                                    {{-- <td>{{$tag->active ? 'Active' : 'Inactive'}}</td> --}}
                                    <td>                  
                                        <a href="{{Route('tags.edit', ['tag' => $tag])}}">
                                            <button class="btn btn-sm btn-info">Edit</button>
                                        </a>
                                        {{--<form action="{{ route('tags.destroy', ['tag' => $tag]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>--}}
                                    </td> 
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection