<?php
// Include the necessary files
require_once 'checking.php';
require_once 'savings.php';

// Get the balances submitted via hidden inputs or use defaults if not set
$checkingBalance = isset($_POST['checkingBalance']) ? (float)$_POST['checkingBalance'] : 1000;
$savingsBalance = isset($_POST['savingsBalance']) ? (float)$_POST['savingsBalance'] : 5000;

// Instantiate the account objects with the current balance
$checking = new CheckingAccount('C123', $checkingBalance, '12-20-2019');
$savings = new SavingsAccount('S123', $savingsBalance, '03-20-2020');


// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check for checking account deposit/withdrawal
    if (isset($_POST['withdrawChecking'])) {
        $amount = $_POST['checkingWithdrawAmount'];
        if ($amount > 0) {
            if ($checking->withdrawal($amount)) {
                echo "<script>alert('Withdrawal successful from Checking Account');</script>";
            } else {
                echo "<script>alert('Withdrawal failed. Check your balance or limit.');</script>";
            }
        }
    }
    
    if (isset($_POST['depositChecking'])) {
        $amount = $_POST['checkingDepositAmount'];
        if ($amount > 0) {
            $checking->deposit($amount);
            echo "<script>alert('Deposit successful to Checking Account');</script>";
        }
    }

    // Check for savings account deposit/withdrawal
    if (isset($_POST['withdrawSavings'])) {
        $amount = $_POST['savingsWithdrawAmount'];
        if ($amount > 0) {
            if ($savings->withdrawal($amount)) {
                echo "<script>alert('Withdrawal successful from Savings Account');</script>";
            } else {
                echo "<script>alert('Withdrawal failed. Check your balance.');</script>";
            }
        }
    }
    
    if (isset($_POST['depositSavings'])) {
        $amount = $_POST['savingsDepositAmount'];
        if ($amount > 0) {
            $savings->deposit($amount);
            echo "<script>alert('Deposit successful to Savings Account');</script>";
        }
    }
}

// The HTML output follows
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATM</title>
    <style type="text/css">
        body {
            margin-left: 120px;
            margin-top: 50px;
        }
        .wrapper {
            display: grid;
            grid-template-columns: 300px 300px;
            gap: 20px; 
        }
        .account {
            border: 1px solid black;
            padding: 10px;
        }
        .label {
            text-align: right;
            padding-right: 10px;
            margin-bottom: 5px;
        }
        label {
            font-weight: bold;
        }
        .input-group {
            display: flex;
            align-items: center;
            margin-top: 10px; 
        }
        input[type=text], input[type=submit] {
            margin-right: 10px; 
            width: 120px; 
        }
        .error {color: red;}
        .accountInner {
            margin-left: 10px; 
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>ATM</h1>
    <form method="post">
        <div class="wrapper">
            <div class="account">
                
                <p><?php echo $checking->getAccountDetails(); ?></p>

                <!-- Hidden input to pass current checking balance -->
                <input type="hidden" name="checkingBalance" value="<?php echo $checking->getBalance(); ?>" />
                
                <!-- Withdrawal section -->
                <div class="input-group">
                    <input type="text" name="checkingWithdrawAmount" placeholder="Withdraw" />
                    <input type="submit" name="withdrawChecking" value="Withdraw" />
                </div>
                
                <!-- Deposit section -->
                <div class="input-group">
                    <input type="text" name="checkingDepositAmount" placeholder="Deposit" />
                    <input type="submit" name="depositChecking" value="Deposit" />
                </div>
            </div>

            <div class="account">
                
                <p><?php echo $savings->getAccountDetails(); ?></p>

                <!-- Hidden input to pass current savings balance -->
                <input type="hidden" name="savingsBalance" value="<?php echo $savings->getBalance(); ?>" />
                
                <!-- Withdrawal section -->
                <div class="input-group">
                    <input type="text" name="savingsWithdrawAmount" placeholder="Withdraw" />
                    <input type="submit" name="withdrawSavings" value="Withdraw" />
                </div>
                
                <!-- Deposit section -->
                <div class="input-group">
                    <input type="text" name="savingsDepositAmount" placeholder="Deposit" />
                    <input type="submit" name="depositSavings" value="Deposit" />
                </div>
            </div>
        </div>
    </form>
</body>
</html>
