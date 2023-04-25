<?php

namespace App\Helpers;

class PrimeNumbers
{
    public static function isPrime($number)
    {
        if ($number % 2 == 0) {
            return false;
          }

          for ($i = 3; $i <= sqrt($number); $i += 2) {
            if ($number % $i == 0) {
              return false;
            }
          }
          return true;
    }
}
