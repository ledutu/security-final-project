<?php

namespace App\Utils;


class Helpers
{
    //
    public function splitNameCode($string)
    {
        $string = explode(' ', $string);
        $result = '';
        foreach ($string as $item) {
            $result = $result . substr($item, 0, 1);
        }
        return strtoupper($result);
    }
}
