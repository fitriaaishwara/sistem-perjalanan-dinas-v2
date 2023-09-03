<?php

namespace App\Traits;

Trait CurrencyFormat {

    /**
     * Format rupiah
     *
     * @param int $nominal
     * @return void
     */
    function rupiah_format(int $nominal) {
        $rupiah = 'Rp. ' . number_format($nominal, 0, ',', '.');
        return $rupiah;
    }

}