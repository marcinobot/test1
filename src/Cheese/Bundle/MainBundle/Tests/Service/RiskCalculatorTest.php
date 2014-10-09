<?php

namespace Cheese\Bundle\MainBundle\Tests\Service;

use Cheese\Bundle\MainBundle\Service\RiskCalculator;

/**
 * @author marcin
 */
class RiskCalculatorTest extends \PHPUnit_Framework_TestCase
{
    public function testNewCalculator() 
    {
        $calc = new RiskCalculator();
        $calc->setAge(20);
        
        $this->assertInstanceOf(
                'Cheese\Bundle\MainBundle\Service\RiskCalculator', $calc);
    }   
    
    public function testGetRisk()
    {
        $calc = new RiskCalculator();
        $calc->setAge(34);
        $result = $calc->getRisk();
                
        $this->assertEquals(53, $result);
    }
    
    public function testMortgageRisk()
    {
        $calc = new RiskCalculator();
        $calc->setAge(34);
        $result = $calc->getMortgageRisk();
                
        $this->assertEquals(19, $result);
    }
        
}
