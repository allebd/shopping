<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->load->helper("generalusage");
        require FCPATH.'vendor/autoload.php';
    }


    public function createpayment()
    {
        $amount = $_POST['amount-to-pay'];
        $customer_email = $this->session->userdata('current_user_mail');
        $paystack_lib_object = \MAbiola\Paystack\Paystack::make();

        //create transaction
        try {
            $authorization = $paystack_lib_object->startOneTimeTransaction($amount, $customer_email);
            //we should probably save the reference and email here so we can match/update records
            //redirect to payment authorization URL
            header('Location: ' . $authorization['authorization_url']);
        } catch (Exception $e) {
            header("Location: error.php?error={$e->getMessage()}");
        }

    }

    // Check if User is logged in
    public function is_logged_in()
    {
        $is_logged_in = $this->session->userdata('is_logged_in');

        if(!isset($is_logged_in) || $is_logged_in != true)
        {
            redirect(base_url());
        }
    }

}
