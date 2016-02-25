<?php
require_once('stripe/init.php');
require_once('conf.php');

\Stripe\Stripe::setAPiKey($conf['stripe_key']);

$code = isset($_GET['code']) ? $_GET['code'] : false;

$code_found = false;

if($code)
{
    $matches = [];
    preg_match('/[0-9]/', $code, $matches, PREG_OFFSET_CAPTURE);
    
    if(count($matches) > 0)
    {
        $code = strtolower(substr($code, $matches[0][1]));
        
        $coupons = \Stripe\Coupon::all();
    
        $coupons = $coupons->data;
    
        foreach($coupons as $coupon)
        {
            $c_code = strtolower($coupon->id);
        
            if($c_code == $code)
            {
                $return = ['percent_off' => $coupon->percent_off, 'amount_off' => $coupon->amount_off];
                $code_found = true;
                echo json_encode($return, JSON_NUMERIC_CHECK);
                break;
            }
        }
    }
}

if(!$code_found)
    echo json_encode(false);