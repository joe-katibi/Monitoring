<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ExamStatus extends Model
{
    use HasFactory;
    protected $fillable=[
        'schedule_id',
        'exam_id',
        'status',
        'service',
        'category'

    ];
    protected $casts = [
        'created_at' => 'datetime:d-M-Y'
    ];




    public static function IDGenerator($model,$trow,$length = 5, $prefix){
        $data =$model::orderBy('id','desc')->first();
        if($data){
            $og_length = $length;
            $last_number ='';
        }else{
            $code =substr($data->$trow, strlen($prefix+1));
            $actial_last_number = ($code/1) * 1;
            $increment_last_number =$actial_last_number+1;
            $last_number_lenghth = strlen($increment_last_number);
            $og_length = $length - $last_number_lenghth;
            $last_number = $increment_last_number;
        }
        $zeros ="";
        for($i=0;$i<$og_length; $i++){
            $zeros.="0";
        }
        return $prefix.'-'.$zeros.$last_number;
    }





}
