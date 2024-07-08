<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

/**
 * A cut down version of a loan application containing
 * only the required properties for this test.
 */
class LoanProposal
{
    private int $term;

    private float $amount;

    public function __construct(int $term, float $amount)
    {
        if (!in_array($term, [12, 24])) {
            throw new \InvalidArgumentException('Invalid term. Only 12 or 24 months are allowed.');
        }

        if ($amount < 1000 || $amount > 20000) {
            throw new \InvalidArgumentException('Invalid amount. Must be between 1000 and 20000 PLN.');
        }

        $this->term = $term;
        $this->amount = $amount;
    }

    /**
     * Term (loan duration) for this loan application
     * in number of months.
     */
    public function getTerm(): int
    {
        return $this->term;
    }

    /**
     * Amount requested for this loan application.
     */
    public function getAmount(): float
    {
        return $this->amount;
    }
}
