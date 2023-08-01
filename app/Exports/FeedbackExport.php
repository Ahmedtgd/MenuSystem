<?php

namespace App\Exports;

use App\Models\Feedbacks;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class FeedbackExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    protected $post = "";
    public function __construct($post)
    {
        if($post != '[]')
        $this->post = $post;
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = Feedbacks::query();
        if($this->post)
        {
            $post_data = json_decode($this->post);
            if(isset($post_data->datefrom) && !is_null($post_data->datefrom))
            {
                $datefrom = Carbon::parse($post_data->datefrom)->toDateTimeString();
                $query->where('created_at', '>=', $datefrom);
            }
            if( isset($post_data->dateto) && !is_null($post_data->dateto))
            {
                $dateto = Carbon::parse($post_data->dateto)->addDay()->toDateTimeString();
                $query->where('created_at', '<=', $dateto);
            }
            if(isset($post_data->food) && !is_null($post_data->food->value) && !is_null($post_data->food->operator))
            {
                $query->where('food_taste', $post_data->food->operator, $post_data->food->value);
            }
            if(isset($post_data->clean) && !is_null($post_data->clean->value) && !is_null($post_data->clean->operator))
            {
                $query->where('environment', $post_data->clean->operator, $post_data->clean->value);
            }
            if(isset($post_data->service) && !is_null($post_data->service->value) && !is_null($post_data->service->operator))
            {
                $query->where('service', $post_data->service->operator, $post_data->service->value);
            }
            if(isset($post_data->staff) && !is_null($post_data->staff->value) && !is_null($post_data->staff->operator))
            {
                $query->where('staff_behaviour', $post_data->staff->operator, $post_data->staff->value);
            }
            if(isset($post_data->average) && !is_null($post_data->average->value) && !is_null($post_data->average->operator))
            {
                $query->where('average', $post_data->average->operator, $post_data->average->value);
            }
        }
        $data = $query->get();
        $count = 1;
        $map_Array = ['1' => 20, '2' => 40, '3' => 60, '4' => 80, '5' => 100];
        foreach($data as $feedback)
        {
            $feedbacks[] = array(
                'Sr.'       => $count,
                'Date'      => date('d-m-Y', strtotime($feedback->created_at)),
                'Order Code' => ltrim($feedback->order_code, 'T'),
                // 'Device'      => $feedback->device,
                // 'Qr Code' => url('uploads/qrcodes/feedbacks/'.$feedback->qr_code),
                'Food' =>  $map_Array[$feedback->food_taste],
                'Cleanliness' => $map_Array[$feedback->environment],
                'Service' => $map_Array[$feedback->service],
                'Staff' => $map_Array[$feedback->staff_behaviour],
                'Comments'=> $feedback->comment,
                );
                $count++;

        }
        if(isset($feedbacks))
        {
            $collection = collect($feedbacks);
        }
        else
        {
            $feedbacks = [];
            $collection = collect($feedbacks);

        }

        return $collection;
    }

    public function headings(): array
    {
        return [
            'Sr.',
            'Date',
            'Order Code',
            // 'Device',
            // 'QR Code',
            'Food',
            'Cleanliness',
            'Service',
            'Staff',
            'Comments'
        ];
    }
}
