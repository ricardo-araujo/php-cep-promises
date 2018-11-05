<?php

if (!function_exists('only_numbers')) {

    function only_numbers($string) {

        return preg_replace('#[^0-9]+#', '', $string);

    }
}

if (!function_exists('cep_padder')) {

    function cep_padder($string) {

        return str_pad($string, 8, '0', STR_PAD_LEFT);

    }
}

if (!function_exists('clean_string')) {

    function clean_string($string) {

        return trim(html_entity_decode(preg_replace('#&nbsp;#', '', htmlentities($string))));

    }
}