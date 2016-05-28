<?php
namespace phpreboot\tddworkshop;

use phpreboot\tddworkshop\Calculator;

class CalculatorTest extends \PHPUnit_Framework_TestCase
{
    private $calculator;
    
    /**
     * Data provider for invalid array provider
     *
     * @return array
     */
    public function invalidNumberProvider()
    {
        $numbers = "4,a,b,c";
        return $numbers;
    }
    
    /**
     * Data provider for invalid array provider
     *
     * @return array
     */
    public function numberProvider()
    {
        return [["4,7,3,4,7,3,5,6,7,4,3,2,5,7,5,3,4,6,7,8,9,5,5,5,4,3,2"]];
    }
    
    /**
     * Data provider for invalid separator
     *
     * @return array
     */
    public function invalidSeparatorProvider()
    {
        return [
            ['2,3,4', '%']
        ];
    }

    public function setUp()
    {
        $this->calculator = new Calculator();
    }

    public function tearDown()
    {
        $this->calculator = null;
    }

    public function testAddReturnsAnInteger()
    {
        $result = $this->calculator->add();

        $this->assertInternalType('integer', $result, 'Result of `add` is not an integer.');
    }
    
    public function testAddWithSingleNumberReturnsSameNumber()
    {
        $result = $this->calculator->add('3');
        $this->assertSame(3, $result, 'Add with single number do not returns same number');
    }
    
    public function testAddWithTwoParametersReturnsTheirSum()
    {
        $result = $this->calculator->add('2,4');

        $this->assertSame(6, $result, 'Add with two parameter do not returns correct sum');
    }
    
    /**
      * @expectedException \InvalidArgumentException
      */
    public function testAddWithNonStringParameterThrowsException()
    {
        $this->calculator->add(5, 'Integer parameter do not throw error');
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddWithNonNumbersThrowException()
    {
        $this->calculator->add('1,a', 'Invalid parameter do not throw exception');
    }
    
    /**
     * Testcase for task2
     * @dataProvider invalidNumberProvider
     * @expectedException \InvalidArgumentException
     */
    public function testAddWithStringOfNumbersReturnsTheirSumThrowException($numbers)
    {
        $this->calculator->add($numbers, 'Invalid parameter do not throw exception');
    }
    
    /**
     * Test case to add array of numbers
     * Testcase for task2
     * @dataProvider numberProvider
     */
    public function testAddWithStringOfNumbersReturnsTheirSum($numbers)
    {
        $result = $this->calculator->add($numbers);
        $this->assertSame(133, $result, 'Invalid parameter should throw exception');
    }   
    
    /**
     * Testcase for task3
     * @dataProvider invalidSeparatorProvider
     * @expectedException \InvalidArgumentException
     */
    public function testAddWithInvalidSeparatorThrowException($numbers, $delimeter)
    {
        $this->calculator->add($numbers, $delimeter, 'Invalid separator throw exception');
    }
}
