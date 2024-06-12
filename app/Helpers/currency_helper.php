<?php

if (!function_exists('format_rupiah')) {
    function formatRupiah($number)
    {
        return 'Rp. ' . number_format($number, 0, ',', '.');
    }
}
