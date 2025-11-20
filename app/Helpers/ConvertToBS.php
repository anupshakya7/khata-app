<?php

namespace App\Helpers;

class ConvertToBS{
   public static function convert($date){
        $months = [
            1=> 'बैशाख',
            2=> 'जेठ',
            3=> 'असार',
            4=> 'साउन',
            5=> 'भदौ',
            6=> 'आश्विन',
            7=> 'कार्तिक',
            8=> 'मंसिर',
            9=> 'पौष',
            10=> 'माघ',
            11=> 'फाल्गुण',
            12=> 'चैत्र'
        ];
        
        [$y,$m,$d] = explode('-',$date);
        $m = (int)$m;

        $formatted = "$d $months[$m], $y";

        return $formatted;
   } 
}

?>