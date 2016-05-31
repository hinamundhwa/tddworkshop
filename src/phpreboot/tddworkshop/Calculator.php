<?php 
namespace phpreboot\tddworkshop;

class Calculator
{
    /**
     * Add function which returns sum of array elements
     * 
     * @param type $numbers
     * @param type $delimeter
     * @return integer
     */
    public function add($numbers = '', $delimeter = '')
    {
        if (empty($numbers)) {
            return 0;
        }
        
        $result = $this->validate($numbers, $delimeter);
        return array_sum($result);
    }
    
    /**
     * Multiplication function which returns multiplication of array elements
     * 
     * @param type $numbers
     * @param type $delimeter
     * @return integer
     */
    public function multiply($numbers = '', $delimeter = '')
    {   
        if (empty($numbers)) {
            return 0;
        }
        
        $result = $this->validate($numbers, $delimeter);
        return array_product($result);
    }
    
    /**
     * Function to do initial operations and check weather data is valid for sum or multiplication or not.
     * 
     * @param type $numbers
     * @param type $delimeter
     * @return array
     * @throws \InvalidArgumentException
     */
    public function validate($numbers, $delimeter)
    {
        
        if (!is_string($numbers)) {
            throw new \InvalidArgumentException('Parameters must be a string');
        }
        
        if (!empty($delimeter) && ( $delimeter != '\n' || $delimeter != '\\')) {
            throw new \InvalidArgumentException('Separators string must contain only new line characters');
        } 
        
        $numbers = str_replace(array("\r\n","\r","\n","\\r","\\n","\\r\\n", "\\", ";"),",",$numbers);
        
        $numbers = stripslashes($numbers);
        
        $numbersArray = array_filter(explode(",", $numbers), function ($value) {
            return ($value < 1000);
        });
        
        if (array_filter($numbersArray, 'is_numeric') !== $numbersArray) {
            throw new \InvalidArgumentException('Parameters string must contain numbers');
        }
        
        $negativeNumbers = array_filter($numbersArray, function ($element) {
            return $element < 0;
        });
        
        if (!empty($negativeNumbers)) {
            throw new \InvalidArgumentException('Negative numbers are not allowed ('.implode($negativeNumbers, ",").') ');
        }
        
        if (array_filter($numbersArray, function ($value) {return ($value >= 1000) ? false : true;}) == false) {
            throw new \InvalidArgumentException('Large Numbers not allowed');
        }
        
        return $numbersArray;
    }

}
