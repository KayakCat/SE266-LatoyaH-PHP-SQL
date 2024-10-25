<?php

require_once 'account.php';

class SavingsAccount extends Account 
{
    
    public function withdrawal($amount) 
    {
        // Check if the withdrawal amount is valid
        if ($amount <= 0) {
            return false; // Invalid withdrawal amount
        }

        // can only withdraw the amount in the account
        if ($this->balance - $amount < 0) {
            return false; 
        }

        // Perform the withdrawal
        $this->balance -= $amount; // Deduct the amount from the balance
        return true; // Withdrawal successful
    }

    public function deposit($amount) 
    {
        if ($amount > 0) {
            $this->balance += $amount; // Add the amount to the balance
            return true; // Deposit successful
        }
        return false; // Invalid deposit amount
    }

    public function getAccountDetails() 
    {
        $str = "<h2>Savings Account</h2>";
        $str .= "Account ID: {$this->accountId}<br>";
        $str .= "Balance: \${$this->balance}<br>";
        $str .= "Account Opened: {$this->startDate}<br>";
        return $str;
    }
}

// The code below runs every time this class loads and 
// should be commented out after testing.
/*$savings = new SavingsAccount('S123', 5000, '03-20-2020');
echo $savings->getAccountDetails();*/

?>
