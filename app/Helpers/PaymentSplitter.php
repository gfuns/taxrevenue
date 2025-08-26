<?php
namespace App\Helpers;

use App\Models\Mda;

class PaymentSplitter
{

    public static function mdaShare($mda, $amount)
    {
        $mda = Mda::find($mda);
        if (isset($mda)) {
            if ($mda->mda_percentage > 0) {
                $percentage = (double) ($mda->mda_percentage / 100);
                $mdaShare   = (double) ($percentage * $amount);
                return $mdaShare;
            }

            return 0;
        }

        return -1;
    }

    public static function birsShare($mda, $amount)
    {
        $mda = Mda::find($mda);
        if (isset($mda)) {
            if ($mda->mda_percentage > 0 && $mda->mda_percentage < 100) {
                $percentage = (double) ((100 - $mda->mda_percentage) / 100);
                $birsShare  = (double) ($percentage * $amount);
                return $birsShare;
            }

            return 0;
        }

        return -1;
    }
}
