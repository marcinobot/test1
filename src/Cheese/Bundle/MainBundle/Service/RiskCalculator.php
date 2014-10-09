<?php

namespace Cheese\Bundle\MainBundle\Service;

/**
 * Description of RiskCalculator
 *
 * @author marcin
 */
class RiskCalculator
{
    protected $age;

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function getRisk()
    {
        return round((log10($this->age)-1)*100);
    }
    
    public function getMortgageRisk()
    {
        return round((1 + 5 - 3 + 100 - 300 * log10(log10($this->age)-1)) /10);
    }
}
