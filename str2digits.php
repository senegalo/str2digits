<?php

/**
 * Converts numbers writen in english to actual digits
 *
 * @author senegalo
 */
class Str2Digits {

    private $numbers = array(
        'zero' => 0,
        'one' => 1,
        'two' => 2,
        'three' => 3,
        'four' => 4,
        'five' => 5,
        'six' => 6,
        'seven' => 7,
        'eight' => 8,
        'nine' => 9,
        'ten' => 10,
        'eleven' => 11,
        'twelve' => 12,
        'thirteen' => 13,
        'fourteen' => 14,
        'fifteen' => 15,
        'sixteen' => 16,
        'seventeen' => 17,
        'eighteen' => 18,
        'nineteen' => 19,
        'twenty' => 20,
        'thirty' => 30,
        'forty' => 40,
        'fourty' => 40, // common misspelling
        'fifty' => 50,
        'sixty' => 60,
        'seventy' => 70,
        'eighty' => 80,
        'ninety' => 90,
        'hundred' => 100,
        'thousand' => 1000,
        'million' => 1000000,
        'billion' => 1000000000);

    public function parse($str) {
        $str = strtolower(preg_replace("/[^a-zA-Z]+/", " ", $str));
        
        $words = explode(" ", $str);

        $total = 1;
        $force_addition = false;
        $last_digit = null;
        $init_digit = false;
        $final_sum = array();
        $final_result = array();

        foreach ($words as $word) {

            if (!isset($this->numbers[$word]) && $word != "and") {
                if ($init_digit) {
                    $final_sum[] = $total;
                    $final_result[] = array_sum($final_sum);

                    $init_digit = false;
                    $last_digit = null;
                    $total = 1;
                    $final_sum = array();
                    $force_addition = false;
                }
                continue;
            }
            $init_digit = true;
            

            if ($word == "and") {
                if ($last_digit === null) {
                    $total = 0;
                }
                $force_addition = true;
            } else {
                if ($force_addition) {
                    $total += $this->numbers[$word];
                    $force_addition = false;
                } else {
                    if ($last_digit !== null && $last_digit > $this->numbers[$word]) {
                        $total += $this->numbers[$word];
                    } else {
                        if($last_digit === null){
                            $total = 1;
                        }
                        $total *= $this->numbers[$word];
                    }
                }
            }

            $last_digit = $this->numbers[$word];

            if ($this->numbers[$word] >= 1000) {
                $final_sum[] = $total;
                $last_digit = null;
                $force_addition = false;
                $total = 0;
            }
        }
        if ($init_digit) {
            $final_sum[] = $total;
            $final_result[] = array_sum($final_sum);
        }
        return $final_result;
    }

}

?>
