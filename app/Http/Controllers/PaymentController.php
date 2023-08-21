<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Omnipay\Omnipay;
use Illuminate\Http\Request;
use App\Models\Payment;
use Exception;

class PaymentController extends Controller
{
    private $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true); //set it to 'false' when go live
    }
    /**
     * Initiate a payment on PayPal.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function charge(Request $request)
    {
        $totalToPay = $request->input('total_to_pay');
        if (!is_numeric($totalToPay) || $totalToPay <= 0) {
            return response()->json(['error' => 'Invalid total to pay'], 400);
        }
        if ($totalToPay) {
            $userId = auth()->user()->id;
            try {
                $response = $this->gateway->purchase(array(
                    'amount' => $totalToPay,
                    'currency' => env('PAYPAL_CURRENCY'),
                    'returnUrl' => route('payment.success', ['user_id' => $userId]),
                    'cancelUrl' => route('payment.error'),
                ))->send();

                if ($response->isRedirect()) {
                    $response->redirect(); // this will automatically forward the customer
                } else {
                    // not successful
                    return response()->json(['error' => $response->getMessage()], 500);
                }
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }

    /**
     * Charge a payment and store the transaction.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function success(Request $request)
    {
        // Once the transaction has been approved, we need to complete it.
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();

            if ($response->isSuccessful()) {
                // The customer has successfully paid.
                $arr_body = $response->getData();
                $userId = $request->input('user_id');
                $cart = Cart::where('user_id', $userId)->pluck('cart_id');
                // Insert transaction data into the database
                $payment = new Payment;
                $payment->user_id = $userId;
                $payment->payer_name = $arr_body['transactions'][0]['item_list']['shipping_address']['recipient_name'];
                $payment->transaction_id = $arr_body['id'];
                $payment->payment_method = $arr_body['payer']['payment_method'];
                $payment->payer_id = $arr_body['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr_body['payer']['payer_info']['email'];
                $payment->total_amount = $arr_body['transactions'][0]['amount']['total'];
                $payment->payment_status = $arr_body['state'];
                date_default_timezone_set('Asia/Bangkok');
                $payment->transaction_date = now();
                $payment->save();
                $username = auth()->user()->name;
                Cart::whereIn('cart_id', $cart)->update(['payment_status' => 1]);
                return redirect()->route('user.index')->with('success', 'Your support means the world to us! Your products are on their way and will arrive right on time. Thank you '. $username . ' for choosing us.!');;
            } else {
                return $response->getMessage();
            }
        } else {
            return 'Transaction is declined';
        }
    }

    /**
     * Error Handling.
     */
    public function error()
    {
        return redirect()->route('user.index');
    }
}
