<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Service\LinearInterpolationFeeCalculator;

class FeeCalculatorTest extends TestCase
{
    public function testCalculate()
    {
        $calculator = new LinearInterpolationFeeCalculator();

        $loanProposal1 = new LoanProposal(24, 11500);
        $fee1 = $calculator->calculate($loanProposal1);
        $this->assertEquals(460, $fee1);

        $loanProposal2 = new LoanProposal(12, 19250);
        $fee2 = $calculator->calculate($loanProposal2);
        $this->assertEquals(385, $fee2);

        $loanProposal3 = new LoanProposal(12, 2750);
        $fee3 = $calculator->calculate($loanProposal3);
        $this->assertEquals(90, $fee3);

        $loanProposal2 = new LoanProposal(12, 11350);
        $fee2 = $calculator->calculate($loanProposal2);
        $this->assertEquals(230, $fee2);

        $loanProposal4 = new LoanProposal(24, 9500);
        $fee4 = $calculator->calculate($loanProposal4);
        $this->assertEquals(380, $fee4);

        $loanProposal4 = new LoanProposal(24, 20000);
        $fee4 = $calculator->calculate($loanProposal4);
        $this->assertEquals(800, $fee4);
    }
}