<?php
use Spatie\Emoji\Emoji;
$smiley = ['1' => Emoji::angryFace(), '2' => Emoji::confusedFace(), '3' => Emoji::expressionlessFace(), '4' => Emoji::slightlySmilingFace(), '5' => Emoji::smilingFaceWithHeartEyes()];
$percentage = ['1' => '20', '2' => '40', '3' => '60', '4' => '80', '5' => '100'];
?>
@extends('layouts.app')
<title>{{ 'Customer Feedback - ' }}</title>
@section('content')
<style>
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
<div class=" content-wrapper" style="min-height: 375px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">feedbacks</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <h3 class="m-0 text-center">Customers Feedback</h3>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <form id="filters-form" name="form-filter" method="post" action="{{route('allFeedbacks')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                @if ($errors->any())
                                    <div>
                                        @foreach ($errors->all() as $error)
                                        <li class="alert alert-danger">{{ $error }}</li>
                                        @endforeach
                                    </div>
                                @endif
                                </div>
                                <div class="col-md-12 mt-3">
                                    <h5 class="filters-heading">Date Filter</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Date From</label>
                                            <input max="<?php echo date("Y-m-d"); ?>" class="form-control custom-form-control date-inputs" type="date" name="datefrom" placeholder="Date from" value="{{isset($datefrom) ? $datefrom : ''}}"/>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Date To</label>
                                            <input max="<?php echo date("Y-m-d"); ?>" class="form-control custom-form-control date-inputs" type="date" name="dateto" placeholder="Date to" value="{{isset($dateto) ? $dateto : ''}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <h5 class="filters-heading">Food Taste Filter</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <select class="form-control custom-form-control" name="food[operator]">
                                                <option {{isset($food) && $food['operator'] == '' ? 'selected' : ''}} value="">Operator</option>
                                                <option {{isset($food) && $food['operator'] == '>=' ? 'selected' : ''}} value=">=">>=</option>
                                                <option {{isset($food) && $food['operator'] == '<=' ? 'selected' : ''}} value="<="><=</option>
                                                <option {{isset($food) && $food['operator'] == '=' ? 'selected' : ''}} value="=">=</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            
                                            <select class="form-control custom-form-control" name="food[value]">
                                                <option {{isset($food) && $food['value'] == '' ? 'selected' : ''}} value="">Value</option>
                                                <option {{isset($food) && $food['value'] == '1' ? 'selected' : ''}} value="1">20</option>
                                                <option {{isset($food) && $food['value'] == '2' ? 'selected' : ''}} value="2">40</option>
                                                <option {{isset($food) && $food['value'] == '3' ? 'selected' : ''}} value="3">60</option>
                                                <option {{isset($food) && $food['value'] == '4' ? 'selected' : ''}} value="4">80</option>
                                                <option {{isset($food) && $food['value'] == '5' ? 'selected' : ''}} value="5">100</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <h5 class="filters-heading">Cleanliness Filter</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            
                                            <select class="form-control custom-form-control" name="clean[operator]">
                                                <option {{isset($clean) && $clean['operator'] == '' ? 'selected' : ''}} value="">Operator</option>
                                                <option {{isset($clean) && $clean['operator'] == '>=' ? 'selected' : ''}} value=">=">>=</option>
                                                <option {{isset($clean) && $clean['operator'] == '<=' ? 'selected' : ''}} value="<="><=</option>
                                                <option {{isset($clean) && $clean['operator'] == '=' ? 'selected' : ''}} value="=">=</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            
                                            <select class="form-control custom-form-control" name="clean[value]">
                                                <option {{isset($clean) && $clean['value'] == '' ? 'selected' : ''}} value="">Value</option>
                                                <option {{isset($clean) && $clean['value'] == '1' ? 'selected' : ''}} value="1">20</option>
                                                <option {{isset($clean) && $clean['value'] == '2' ? 'selected' : ''}} value="2">40</option>
                                                <option {{isset($clean) && $clean['value'] == '3' ? 'selected' : ''}} value="3">60</option>
                                                <option {{isset($clean) && $clean['value'] == '4' ? 'selected' : ''}} value="4">80</option>
                                                <option {{isset($clean) && $clean['value'] == '5' ? 'selected' : ''}} value="5">100</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <h5 class="filters-heading">Service Filter</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            
                                            <select class="form-control custom-form-control" name="service[operator]">
                                                <option {{isset($service) && $service['operator'] == '' ? 'selected' : ''}} value="">Operator</option>
                                                <option {{isset($service) && $service['operator'] == '>=' ? 'selected' : ''}} value=">=">>=</option>
                                                <option {{isset($service) && $service['operator'] == '<=' ? 'selected' : ''}} value="<="><=</option>
                                                <option {{isset($service) && $service['operator'] == '=' ? 'selected' : ''}} value="=">=</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            
                                            <select class="form-control custom-form-control" name="service[value]">
                                                <option {{isset($service) && $service['value'] == '' ? 'selected' : ''}} value="">Value</option>
                                                <option {{isset($service) && $service['value'] == '1' ? 'selected' : ''}} value="1">20</option>
                                                <option {{isset($service) && $service['value'] == '2' ? 'selected' : ''}} value="2">40</option>
                                                <option {{isset($service) && $service['value'] == '3' ? 'selected' : ''}} value="3">60</option>
                                                <option {{isset($service) && $service['value'] == '4' ? 'selected' : ''}} value="4">80</option>
                                                <option {{isset($service) && $service['value'] == '5' ? 'selected' : ''}} value="5">100</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <h5 class="filters-heading">Staff Filter</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            
                                            <select class="form-control custom-form-control" name="staff[operator]">
                                                <option {{isset($staff) && $staff['operator'] == '' ? 'selected' : ''}} value="">Operator</option>
                                                <option {{isset($staff) && $staff['operator'] == '>=' ? 'selected' : ''}} value=">=">>=</option>
                                                <option {{isset($staff) && $staff['operator'] == '<=' ? 'selected' : ''}} value="<="><=</option>
                                                <option {{isset($staff) && $staff['operator'] == '=' ? 'selected' : ''}} value="=">=</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            
                                            <select class="form-control custom-form-control" name="staff[value]">
                                                <option {{isset($staff) && $staff['value'] == '' ? 'selected' : ''}} value="">Value</option>
                                                <option {{isset($staff) && $staff['value'] == '1' ? 'selected' : ''}} value="1">20</option>
                                                <option {{isset($staff) && $staff['value'] == '2' ? 'selected' : ''}} value="2">40</option>
                                                <option {{isset($staff) && $staff['value'] == '3' ? 'selected' : ''}} value="3">60</option>
                                                <option {{isset($staff) && $staff['value'] == '4' ? 'selected' : ''}} value="4">80</option>
                                                <option {{isset($staff) && $staff['value'] == '5' ? 'selected' : ''}} value="5">100</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <h5 class="filters-heading">Average Rating Filter</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <select class="form-control custom-form-control" name="average[operator]">
                                                <option {{isset($average) && $average['operator'] == '' ? 'selected' : ''}} value="">Operator</option>
                                                <option {{isset($average) && $average['operator'] == '>=' ? 'selected' : ''}} value=">=">>=</option>
                                                <option {{isset($average) && $average['operator'] == '<=' ? 'selected' : ''}} value="<="><=</option>
                                                <option {{isset($average) && $average['operator'] == '=' ? 'selected' : ''}} value="=">=</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control custom-form-control" name="average[value]">
                                                <option {{isset($average) && $average['value'] == '' ? 'selected' : ''}} value="">Value</option>
                                                <option {{isset($average) && $average['value'] == '1' ? 'selected' : ''}} value="1">20</option>
                                                <option {{isset($average) && $average['value'] == '2' ? 'selected' : ''}} value="2">40</option>
                                                <option {{isset($average) && $average['value'] == '3' ? 'selected' : ''}} value="3">60</option>
                                                <option {{isset($average) && $average['value'] == '4' ? 'selected' : ''}} value="4">80</option>
                                                <option {{isset($average) && $average['value'] == '5' ? 'selected' : ''}} value="5">100</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top: 48px;">
                                    <input type="submit" class="w-100 btn btn-info" name="submit-filters" value="Filter"/>
                                </div>
                            </div>
                        </form>
                        <a class="btn btn-primary" href="{{route('feedbacks.export', ['post' => json_encode(request()->post())])}}">Export Excel (Format 1)</a>
                        <a class="btn btn-warning" href="{{route('feedbacks.export', ['format' => true, 'post' => json_encode(request()->post())])}}">Export Excel (Format 2)</a>
                        <!-- <a href="{{route('exportFeedback2')}}" class="btn btn-warning">Export in Excel format 2</a> -->
                        <table class="table table-bordered table-striped mt-5">
                            <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Date</th>
                                    <th>Order code</th>
                                    <th>Device</th>
                                    <th>Qr code</th>
                                    <th>Food</th>
                                    <th>Cleanliness</th>
                                    <th>Service</th>
                                    <th>Staff</th>
                                    <th>Comments</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($feedbacks))
                                <?php $_SESSION['i'] = 0; ?>
                                @foreach($feedbacks as $feedback)
                                <?php $_SESSION['i'] = $_SESSION['i'] + 1; ?>
                                <tr>
                                    <?php $dash = ''; ?>
                                    <td>{{$_SESSION['i']}}</td>
                                    <td>{{date('d-m-Y',strtotime($feedback->created_at))}}</td>
                                    <td>{{ltrim($feedback->order_code, 'T')}}</td>
                                    <td>{{$feedback->device}}</td>
                                    <td>
                                    <a href="{{ asset('uploads/qrcodes/feedbacks/'.$feedback->qr_code) }}" data-lightbox="myImg<?php echo $feedback->id;?>" data-title="{{$feedback->order_code}}">
                                        <img src="{{ asset('uploads/qrcodes/feedbacks/'.$feedback->qr_code) }}" width="80" data-lightbox="myImg<?php echo $feedback->id;?>"/>
                                        </a> 
                                    </td>
                                    <td style="font-size: 24px;">
                                    <!-- {{$smiley[$feedback->food_taste]}}  -->
                                    <span style="font-size: 1rem;">{{$percentage[$feedback->food_taste]}}</span></td>
                                    <td style="font-size: 24px;">
                                    <!-- {{$smiley[$feedback->environment]}}  -->
                                    <span style="font-size: 1rem;">{{$percentage[$feedback->environment]}}</span></td>
                                    <td style="font-size: 24px;">
                                    <!-- {{$smiley[$feedback->service]}} -->
                                     <span style="font-size: 1rem;">{{$percentage[$feedback->service]}}</span></td>
                                    <td style="font-size: 24px;">
                                    <!-- {{$smiley[$feedback->staff_behaviour]}} -->
                                     <span style="font-size: 1rem;">{{$percentage[$feedback->staff_behaviour]}}</span></td>
                                    <td>{{$feedback->comment != "" ? $feedback->comment : '-'}}</td>
                                    <!-- <td>{{date('d-m-Y',strtotime($feedback->created_at))}}</td> -->
                                </tr>

                                @endforeach
                                <?php unset($_SESSION['i']); ?>
                                @endif
                            </tbody>
                        </table>
                        {!! $feedbacks->appends(request()->input())->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>

@endsection