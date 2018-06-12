<?php
/**
 * Created by IntelliJ IDEA.
 * User: brynnlow
 * Date: 12/06/18
 * Time: 8:17
 */

namespace AppBundle\Helper;


class Finance
{
    static function computePriceWithVAT($price, $vatRate) {
        return $price * (1 + ($vatRate / 100));
    }
}