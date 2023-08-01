<?php

namespace App\Http\Controllers;

use App\Exports\Feedback2Export;
use App\Exports\FeedbackExport;
use Illuminate\Http\Request;
use App\Models\Feedbacks;
use ImageResize;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Excel;

class FeedbacksController extends Controller
{

    public function allFeedbacks(Request $request) {
        $limit = $request->limit ? $request->limit: 10;
        if($request->isMethod('get'))
        {
            $query = Feedbacks::query();
            if(isset($request->datefrom) && !is_null($request->datefrom))
            {
                $datefrom = Carbon::parse($request->datefrom)->toDateTimeString();
                $query->where('created_at', '>=', $datefrom);
            }
            if( isset($request->dateto) && !is_null($request->dateto))
            {
                $dateto = Carbon::parse($request->dateto)->addDay()->toDateTimeString();
                $query->where('created_at', '<=', $dateto);
            }
            if($request->has('food') && $request->food['value'] != '' && $request->food['operator'] != '')
            {
                $query->where('food_taste', $request->food['operator'], $request->food['value']);
            }
            if($request->has('clean') && $request->clean['value'] != '' && $request->clean['operator'] != '')
            {
                $query->where('environment', $request->clean['operator'], $request->clean['value']);
            }
            if($request->has('service') && $request->service['value'] != '' && $request->service['operator'] != '')
            {
                $query->where('service', $request->service['operator'], $request->service['value']);
            }
            if($request->has('staff') && $request->staff['value'] != '' && $request->staff['operator'] != '')
            {
                $query->where('staff_behaviour', $request->staff['operator'], $request->staff['value']);
            }
            if($request->has('average') && $request->average['value'] != '' && $request->average['operator'] != '')
            {
                $query->where('average', $request->average['operator'], $request->average['value']);
            }
            $feedbacks = $query->orderby('created_at', 'desc')->orderby('device', 'asc')->paginate($limit);
            return view('all-feedbacks', compact('feedbacks'));
        }
        if($request->isMethod('post'))
        {
            $dateToRules = 'nullable';
            if ($request->datefrom) {
                $dateToRules .= '|after_or_equal:datefrom';
            }
            $request->validate([
                'datefrom' => 'nullable',
                'dateto' => $dateToRules,
            ],
            [
                'datefrom.before_or_equal' => 'From date must be less than or equal to To date',
                'dateto.after_or_equal' => 'To date must be greater than or equal to From date'
            ]);
            $query = Feedbacks::query();
            $datefrom = Carbon::parse(request()->datefrom)->toDateTimeString();
            $dateto = Carbon::parse(request()->dateto)->addDay()->toDateTimeString();
            if($request->food['operator'] != '' && $request->food['value'] != '')
            {
                $query->where('food_taste', $request->food['operator'], $request->food['value']);
            }
            if($request->clean['operator'] != '' && $request->clean['value'] != '')
            {
                $query->where('environment', $request->clean['operator'], $request->clean['value']);
            }
            if($request->service['operator'] != '' && $request->service['value'] != '')
            {
                $query->where('service', $request->service['operator'], $request->service['value']);
            }
            if($request->staff['operator'] != '' && $request->staff['value'] != '')
            {
                $query->where('staff_behaviour', $request->staff['operator'], $request->staff['value']);
            }
            if($request->average['operator'] != '' && $request->average['value'] != '')
            {
                $query->where('average', $request->average['operator'], $request->average['value']);
            }
            $query->when($request->datefrom, function($query) use ($datefrom) {
                return $query->where('created_at', '>=', $datefrom);
            });
            $query->when($request->dateto, function($query) use ($dateto) {
            return $query->where('created_at', '<=', $dateto);
            });
            $feedbacks = $query->orderby('created_at', 'desc')->orderby('device', 'asc')->paginate($limit);
            return view('all-feedbacks', 
            [
                'datefrom' => $request->datefrom, 
                'dateto' => $request->dateto, 
                'food' => $request->food, 
                'clean' => $request->clean, 
                'service' => $request->service, 
                'staff' => $request->staff, 
                'average' => $request->average,
                'feedbacks' => $feedbacks
            ]);
        }
    }

    public function searchFeedbacks(Request $request)
    {
        $feedbacks = Feedbacks::where('created_at', '>=', $request->datefrom)
        ->where('created_at', '<=', $request->dateto)
        ->orderby('device', 'asc')
        ->orderby('created_at', 'desc')
        ->get();
        return view('all-feedbacks', compact('feedbacks'));
    }
    public function saveAverage()
    {
        $feedbacks = Feedbacks::all();
        foreach($feedbacks as $feedback)
        {
            $feedback->average = ($feedback->food_taste + $feedback->service + $feedback->environment + $feedback->staff_behaviour)/4;
            $feedback->save();
        }
    }

    public function feedbacks2()
    {
        return redirect()->back();
        $feedbacks = Feedbacks::orderby('created_at', 'desc')->orderby('device', 'asc')->get();
        return view('all-feedbacks2', compact('feedbacks'));
    }

    public function exportFeedback(Request $request) 
    {
        if($request->has('format') && $request->format)
        {
            return Excel::download(new Feedback2Export($request->post), 'Customer Feedback - menu.xlsx');
        }
        else{
            return Excel::download(new FeedbackExport($request->post), 'Customer Feedback - menu.xlsx');
        }
    }
}
