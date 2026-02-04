<?php

namespace App\Helpers;

use Hekmatinasser\Verta\Verta;

class PersianDate
{
    /**
     * تبدیل تاریخ میلادی به شمسی
     */
    public static function toPersian($date, $format = 'Y-m-d H:i')
    {
        if (!$date || $date == '0000-00-00 00:00:00') {
            return '';
        }
        
        try {
            // اگر تاریخ string است به DateTime تبدیل کن
            if (is_string($date)) {
                $date = new \DateTime($date);
            }
            
            // اگر شیء Carbon یا DateTime است
            if ($date instanceof \DateTime) {
                return Verta::instance($date)->format($format);
            }
            
            return '';
        } catch (\Exception $e) {
            return $date;
        }
    }

    /**
     * تاریخ شمسی کنونی
     */
    public static function now($format = 'Y-m-d H:i')
    {
        return Verta::now()->format($format);
    }

    /**
     * زمان گذشته به فارسی
     */
    public static function ago($date)
    {
        if (!$date || $date == '0000-00-00 00:00:00') {
            return '';
        }
        
        try {
            if (is_string($date)) {
                $date = new \DateTime($date);
            }
            
            if ($date instanceof \DateTime) {
                return Verta::instance($date)->formatDifference();
            }
            
            return '';
        } catch (\Exception $e) {
            return '';
        }
    }

    /**
     * تبدیل اعداد انگلیسی به فارسی
     */
    public static function toPersianNumbers($string)
    {
        if (is_null($string)) {
            return '';
        }
        
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        
        return str_replace($english, $persian, (string)$string);
    }

    /**
     * تاریخ شمسی با اعداد فارسی
     */
    public static function toPersianWithNumbers($date, $format = 'Y-m-d H:i')
    {
        $persianDate = self::toPersian($date, $format);
        return self::toPersianNumbers($persianDate);
    }

    /**
     * فقط تاریخ (بدون زمان)
     */
    public static function dateOnly($date, $format = 'Y-m-d')
    {
        return self::toPersian($date, $format);
    }

    /**
     * فقط زمان
     */
    public static function timeOnly($date, $format = 'H:i')
    {
        return self::toPersian($date, $format);
    }

    /**
     * تاریخ با نام ماه
     */
    public static function withMonthName($date)
    {
        return self::toPersian($date, 'd F Y');
    }

    /**
     * تاریخ کامل با نام ماه و ساعت
     */
    public static function fullDateTime($date)
    {
        return self::toPersian($date, 'l d F Y ساعت H:i');
    }
}