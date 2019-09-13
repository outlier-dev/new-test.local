<?php


namespace utility;


class Check
{
    public static function check($what, $msg = 'Assertion failed!')
    {
        if (!$what) {
            die($msg . PHP_EOL);
        }
    }
    public static function checkTrue($what, $msg = 'Assertion failed!')
    {
        if ($what) {
            die($msg . PHP_EOL);
        }
    }
}