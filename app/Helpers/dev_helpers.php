<?php

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

?>
