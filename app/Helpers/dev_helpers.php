<?php
namespace App\Helper;

if (!function_exists('print_pre')) {
    /**
     *
     *
     * @param  array $array
     * @param bool $exit
     * @param null $__FILE__
     * @param null $__LINE__
     * @param null $__METHOD__
     * @return void
     */
    function print_pre($array, $exit = false, $__FILE__ = NULL, $__LINE__ = NULL, $__METHOD__ = NULL)
    {
        echo "<pre>";
        echo $__FILE__ . '<br>';
        if (is_array($array)) {
            echo "<hr>";
            echo "Records \t:" . (count($array, 0));
            echo "<br>";
            echo "Data \t\t:" . (count($array, 1));

            echo "<hr>";
        } else {
            strlen($array);
        }
        print_r($array);
        echo $__FILE__ . '<br>';
        echo $__LINE__ . '<br>';
        echo $__METHOD__ . '<br>';


        if ($exit) {
            exit("</pre>");
        } else {
            echo "</pre>";
        }
    }
}

class Helper{

    public static function IDGenerator($model,$trow,$length = 5, $prefix){
        $data =$model::orderBy('id','desc')->first();
        if($data){
            $og_length = $length;
            $last_number ='';
        }else{
            $code =substr($data->$trow, strlen($prefix+1));
            $actial_last_number = ($code/1) * 1;
            $increment_last_number =$actial_last_number + 1;
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
?>
