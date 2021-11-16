<?php

namespace App\Services;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class Random{

    protected $max;
    protected $min;
    protected $string;
    protected $result;
    public function __construct($min=0, $max=30){
        $this->min=$min;
        $this->max=$max;
    }

    /**
     * @return string
     *
     * Get a randomly generated string and set result
     */
    public function getString()
    {
        $firstDigit = mt_rand($this->min, $this->max);
        $operation = (mt_rand() % 2) ? '+' : '-';
        $secondDigit = mt_rand($this->min, $this->max);
        $this->string = $firstDigit . $operation . $secondDigit;
        $this->result = $operation=="+"?$firstDigit+$secondDigit:$firstDigit-$secondDigit;
        return $this->string;
    }
    public function getResult()
    {
        return $this->result;
    }
}
