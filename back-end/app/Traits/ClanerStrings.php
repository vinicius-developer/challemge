<?php

namespace App\Traits;

trait ClanerStrings {

    public function onlyNumbers($string) 
    {
        return preg_replace('/[^0-9]/', '',$string);
    }

    public function onlyNumbersInAllItens($arr)
    {
        $newNumbers = [];

        foreach($arr as $item) {
            array_push($newNumbers ,preg_replace('/[^0-9]/', '', $item));
        }

        return $newNumbers;
    }

    public function sanitize($string): string
    {
        return preg_replace('/[^\d]/', '', $string);
    }

}