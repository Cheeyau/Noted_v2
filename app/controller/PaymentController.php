<?php
require_once APPROOT . "/lib/mollie_api/vendor/autoload.php";
require_once APPROOT . "/lib/mollie_api/src/CompatibilityChecker.php";
require_once APPROOT . "/lib/mollie_api/src/MollieApiClient.php";


class PaymentController extends Autoloader {

    public function __construct() {
    }
    
    public function index() {
        
    }

    public function proceedCheckOut() {
        if(!isset($_SESSION['userId'])) {
            header("Location: " . URLROOT . "/pages/login", 301);
            exit();
        } else {
            $data['errorMess'] = '';
            $this->view('pages/paymentMethod', $data);
        }
    }
    
    public function checkPaymentMethod() {
        // issuer = choice
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $selectedPay = $_POST['payment'];
            $_SESSION['paymentMethod'] = $selectedPay;
            // $this->Payment($selectedPay);
            if(isset($_SESSION['userId'])) { 
                if(isset($_SESSION['paymentMethod'])) {
                    
                    $data['errorMess'] = '';
                    $this->view('payment/paymentOverview', $data);
                } else {
                    $data['errorMess'] = 'Something went wrong, please try again.';
                    $this->view('payment/paymentMethod', $data);
                }
            } else {
                header("Location: " . URLROOT . "/pages/login");
            }
        }
    }

    public function finishCheckOut() {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data['donateIdId'] = $_GET['donateIdId'];
            $this->view('payment/paymentPayed', $data);
            
        }
    }

    public function ini() {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $mollie = new \Mollie\Api\MollieApiClient();
        $mollie->setApiKey(PAYMENTKEY);
        return $mollie;
    }   
    
    public function Payment() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $selectPay = $_SESSION['paymentMethod'];
            $selectPayment = '';
            if($selectPay === 'ideal') {
                $selectPayment = \Mollie\Api\Types\PaymentMethod::IDEAL;
            } elseif ($selectPay === 'paypal') {
                $selectPayment = \Mollie\Api\Types\PaymentMethod::PAYPAL;
            } else {
                $selectPayment = \Mollie\Api\Types\PaymentMethod::CREDITCARD;
            }
            $price = number_format((float) $_POST['totalPrice'], 2);;
            try {
                $mollie = $this->ini();
                
                $tempId = $this->invoiceModel->makeInvoiceId();
                if(empty($tempId->id)) {
                    $tempId = 1;
                } else {
                    $tempId = $tempId->id;
                }
                $donateId = $tempId; 
                $totalPrice = '';
                
                // Determine the url parts to these example files.
                $payment = $mollie->payments->create([
                    "amount" => [
                        "currency" => "EUR",
                        "value" => (string)$price,
                    ],
                    "method" => $selectPayment,
                    "description" => "Haarlem Festival Ticket order #{$donateId}",
                    
                    // // test
                    // "redirectUrl" => REMOTEURLROOT . "/Payment/finishCheckOut?orderId={$orderId}",
                    // "webhookUrl" => REMOTEURLROOT . "/Webhook/checkWebhook",
                    
                    "redirectUrl" => URLROOT . "/Payment/finishCheckOut?orderId={$donateId}",
                    "webhookUrl" => URLROOT . "/Webhook/checkWebhook",
                    
                    
                    
                    "metadata" => [
                        "donate_id" => $donateId,
                    ],
                    "issuer" => ! empty($_POST["issuer"]) ? $_POST["issuer"] : null,
                ]);
                // In this example we store the order with its payment status in a database.
                
                header("Location: " . $payment->getCheckoutUrl(), true, 303);
            } catch (\Mollie\Api\Exceptions\ApiException $e) {
                echo "API call failed: " . \htmlspecialchars($e->getMessage());
            }
        }
        
    }
}
