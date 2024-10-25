<?php
// This is the base class for checking and savings accounts
// It is declared **abstract** so that it can not be instantiated
// Child classes must be derived that 
// implement the withdrawal and getAccountDetails methods

/* Note:
	You should implement all other methods in the class
*/

abstract class Account 
{
	protected $accountId;
	protected $balance;
	protected $startDate;

    //function to be used in child classes to get the protected account info
    abstract public function getAccountDetails();
	
	public function __construct ($id, $bal, $startDt) 
	{
	   // initialize the account properties with the values passed to the constructor
       $this->accountId = $id;
       $this->balance = $bal;
       $this->startDate = $startDt;
	} // end constructor
	
	public function deposit ($amount) 
	{
		// add the deposit amount to the balance
        $this->balance += $amount;
	} // end deposit

	// This is an abstract method. 
	// This method must be defined in all classes
	// that inherit from this class
	abstract public function withdrawal($amount);
	
	public function getStartDate() 
	{
		// return the start date of the account
        return $this->startDate;
	} // end getStartDate

	public function getBalance() 
	{
		//return the current account balance
        return $this->balance;
	} // end getBalance

	public function getAccountId() 
	{
		// return the account ID
        return $this->accountID;
	} // end getAccountId


	
} // end account

//code to test classes
/*$checking = new CheckingAccount ('C123', 1000, '12-20-2019');
$checking->withdrawal(200);
$checking->deposit(500);

$savings = new SavingsAccount('S123', 5000, '03-20-2020');
echo $checking->getAccountDetails();
echo $savings->getAccountDetails();
echo $checking->getStartDate();*/

?>
