<?php 
namespace phpreboot\tddworkshop;

class Calculator
{
    public function add($numbers = '', $delimeter = '')
    {
        if (empty($numbers)) {
            return 0;
        }
        
        if (!is_string($numbers)) {
            throw new \InvalidArgumentException('Parameters must be a string');
        }
        
        if (!empty($delimeter) && ( $delimeter != '\n' || $delimeter != '\\')) {
            throw new \InvalidArgumentException('Separators string must contain only new line characters');
        } 
        
        $numbers = str_replace(array("\r\n","\r","\n","\\r","\\n","\\r\\n", "\\", ";"),",",$numbers);
        $numbers = stripslashes($numbers);
        $numbersArray = array_filter(explode(",", $numbers));
        
        if (array_filter($numbersArray, 'is_numeric') !== $numbersArray) {
            throw new \InvalidArgumentException('Parameters string must contain numbers');
        }

        return array_sum($numbersArray);
    }

}
