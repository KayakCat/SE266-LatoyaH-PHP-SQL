<?php
 
require_once 'account.php';

class CheckingAccount extends Account 
{
    const OVERDRAW_LIMIT = -200;

    public function withdrawal($amount) 
    {
        // Check if the withdrawal amount is valid
        if ($amount <= 0) {
            return false; // Invalid withdrawal amount
        }

        // Check if the withdrawal would exceed the overdraft limit
        if ($this->balance - $amount < self::OVERDRAW_LIMIT) {
            return false; // Withdrawal would exceed overdraft limit
        }

        // Perform the withdrawal
        $this->balance -= $amount; // Deduct the amount from the balance
        return true; // Withdrawal successful
    }

    // Freebie. I am giving you this code.
    public function getAccountDetails() 
    {
        $str = "<h2>Checking Account</h2>";
        $str .= "Account ID: {$this->accountId}<br>"; 
        $str .= "Balance: $" . number_format($this->balance, 2) . "<br>";
        $str .= "Account Opened: {$this->startDate}<br>";
        
        return $str;
    }
}

// The code below runs every time this class loads and 
// should be commented out after testing.
/*
$checking = new CheckingAccount ('C123', 1000, '12-20-2019');
$checking->withdrawal(200);
$checking->deposit(500);

echo $checking->getAccountDetails();
echo $checking->getStartDate();
*/
?>
