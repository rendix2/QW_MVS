<?php

namespace QW\FW\Math;

use QW\FW\Basic\IllegalArgumentException;

final class MathDiscreet
{

    private static function __construct()
    {
    }

    public static function isPrime($number)
    {
        if ($number <= 1) return false;
        if ($number == 2) return true;
        if ($number % 2 == 2) return false;

        for ($i = 3; $i < Math::squareRoot($number); $i += 2) {
            if ($number % $i == 0) return false;
        }
        return true;
    }

    public static function sieveOfEratosthenes($number)
    {
        $sieve = array();
        $sieve[0] = $sieve[1] = true;

        for ($i = 2; $i <= Math::squareRoot($number); $i++) {
            if ($sieve[$i] == true) continue;
            for ($j = 2 * $i; $j < $number; $j += $i) {
                $sieve[$j] = true;
            }
        }

        return $sieve;
    }

    public static function isPerfect($number)
    {
        if ($number % 2 == 1) return false;

        $result = 1;
        $i = 2;

        while ($i * $i <= $number) {
            if ($number % $i == 0) {
                $result += $i;
                $result += $number / $i;
            }
            $i++;
        }
        if ($i * $i == $number) $result -= $i;
        return $result == $number;
    }

    public static function lcm($a, $b)
    {
        if ($a == 0 || $b == 0) return 0;
        return ($a * $b) / self::gcd($a, $b);
    }

    public static function gcd($a, $b)
    {
        if ($a < 1 || $b < 1) throw new IllegalArgumentException();

        while ($b != 0) {
            $tmp = $a;
            $a = $b;
            $b = $tmp % $b;
        }

        return $a;
    }
}