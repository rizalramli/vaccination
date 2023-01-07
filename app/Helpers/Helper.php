<?php

namespace App\Helpers;

class Helper
{
    public static function getDayNameIndonesian($date)
    {
        switch($date){
            case 'Sun':
                $day = "Minggu";
            break;
    
            case 'Mon':			
                $day = "Senin";
            break;
    
            case 'Tue':
                $day = "Selasa";
            break;
    
            case 'Wed':
                $day = "Rabu";
            break;
    
            case 'Thu':
                $day = "Kamis";
            break;
    
            case 'Fri':
                $day = "Jumat";
            break;
    
            case 'Sat':
                $day = "Sabtu";
            break;
            
            default:
                $day = "Tidak di ketahui";		
            break;
        }
 
	    return $day;
    }
}