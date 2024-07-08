<?php


namespace PragmaGoTech\Interview\Service;

use PragmaGoTech\Interview\FeeCalculator;
use PragmaGoTech\Interview\Model\LoanProposal;

class LinearInterpolationFeeCalculator implements FeeCalculator
{
    private FeeStructure $feeStructure;

    public function __construct()
    {
        $this->feeStructure = new FeeStructure();
    }

    public function calculate(LoanProposal $loanProposal): float
    {
        $term = $loanProposal->getTerm();
        $amount = $loanProposal->getAmount();

        $structure = $this->feeStructure->getFees()[$term];

        if (isset($structure[$amount])) {
            return $structure[$amount];
        }

        $lowerBound = 0;
        $upperBound = 0;
        foreach ($structure as $key => $value) {
            if ($key < $amount) {
                $lowerBound = $key;
            }
            if ($key > $amount) {
                $upperBound = $key;
                break;
            }
        }

        $lowerFee = $structure[$lowerBound];
        $upperFee = $structure[$upperBound];
        $interpolatedFee = $lowerFee + (($amount - $lowerBound) * ($upperFee - $lowerFee) / ($upperBound - $lowerBound));

        $total = $interpolatedFee + $amount;
        $fee = ceil($total / 5) * 5 - $amount;

        return $fee;
    }
}
