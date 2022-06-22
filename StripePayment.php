<?php
namespace PhpPot\Service;

require_once 'vendor/autoload.php';

use \Stripe\Stripe;
use \Stripe\Customer;
use \Stripe\ApiOperations\Create;
use \Stripe\Charge;

class StripePayment
{

    private $apiKey;

    private $stripeService;

    public function __construct()
    {
        require_once "web-config.php";

        $this->apiKey = STRIPE_SECRET_KEY;
        $this->stripeService = new \Stripe\Stripe();
        $this->stripeService->setVerifySslCerts(false);
        $this->stripeService->setApiKey($this->apiKey);
    }

    public function addCustomer($customerDetailsAry)
    {
        
        $customer = new Customer();
        
        $customerDetails = $customer->create($customerDetailsAry);
        
        return $customerDetails;
    }

    public function chargeAmountFromCard($cardDetails)
    {
        $customerDetailsAry = array(
			'name' => $cardDetails['cardHolderName'],
            'email' => $cardDetails['emailAddressCard'],
            'source' => $cardDetails['token'],
			'address' => array("city" => 'Noida', "country" => "US", "line1" => "B-55 sector 64", "postal_code" => "201307", "state" => "CA")
        );
        $customerResult = $this->addCustomer($customerDetailsAry);
        $charge = new Charge();
        $cardDetailsAry = array(
            'customer' => $customerResult->id,
            'amount' => $cardDetails['amount']*100 ,
            'currency' => $cardDetails['currency_code'],
            'description' => $cardDetails['item_name'],
            'metadata' => array(
                'order_id' => $cardDetails['item_number']
            ),
			//"address" => array("city" => 'Noida', "country" => "INDIA", "line1" => "B 55 sector 64", "postal_code" => "201307", "state" => "UP"),
        );
        $result = $charge->create($cardDetailsAry);

        return $result->jsonSerialize();
    }
}
