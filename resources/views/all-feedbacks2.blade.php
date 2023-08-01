<?php
use Spatie\Emoji\Emoji;
$smiley = ['1' => Emoji::angryFace(), '2' => Emoji::confusedFace(), '3' => Emoji::expressionlessFace(), '4' => Emoji::slightlySmilingFace(), '5' => Emoji::smilingFaceWithHeartEyes()];
$percentage = ['1' => '20', '2' => '40', '3' => '60', '4' => '80', '5' => '100'];
$rating_names = ['food_taste' => 'Food', 'environment' => 'Cleanliness', 'service' => 'Service', 'staff_behaviour' => 'Staff'];
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
</style>
<div class="content-wrapper" style="min-height: 375px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Customers Feedback</h1>
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
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <table class="table table-bordered table-striped mt-5" id="dataTable_export">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Invoice</th>
                                    <th>Rating Name</th>
                                    <th>Rating</th>
                                    <th>Comment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($feedbacks))
                                @foreach($feedbacks as $feedback)
                                @foreach($rating_names as $key => $value)
                                <tr>
                                    <td>{{date('d/m/Y',strtotime($feedback->created_at))}}</td>
                                    <td>{{ltrim($feedback->order_code, 'T')}}</td>
                                    <td>{{$value}}</td>
                                    <td style="font-size: 24px;">
                                    <!-- {{$smiley[$feedback->food_taste]}}  -->
                                    <span style="font-size: 1rem;">{{$percentage[$feedback->{$key}]}}</span></td>
                                    <td>{{$feedback->comment != "" ? $feedback->comment : '-'}}</td>
                                    <!-- <td>{{date('d-m-Y',strtotime($feedback->created_at))}}</td> -->
                                </tr>
                                @endforeach

                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection