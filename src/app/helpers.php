<?php

if (!function_exists('rupiah')) {
    /**
     * Format angka menjadi format Rupiah.
     *
     * @param int|float $angka
     * @return string
     */
    function rupiah($angka)
    {
        return 'Rp ' . number_format($angka, 0, ',', '.');
    }
}
