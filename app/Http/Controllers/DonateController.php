<?php

namespace App\Http\Controllers;
use App\Models\User;
use Omnipay\Omnipay;
use App\Models\Payment;
use App\Models\Configuration;

use Illuminate\Http\Request;

class DonateController extends Controller
{
    private $gateway;
   
    public function __construct()
    {
        $this->clientId = Configuration::where('key', 'paypal_client_id')->first();
        $this->clientSecret = Configuration::where('key', 'paypal_client_secret')->first();
        $this->useSandbox = Configuration::where('key', 'paypal_sandbox_enabled')->first();
        $this->currency = Configuration::where('key', 'donation_currency')->first();
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId($this->clientId->value);
        $this->gateway->setSecret($this->clientSecret->value);
        $this->gateway->setTestMode($this->useSandbox->value ? true : false); //set it to 'false' when go live

        // SteamID Fix
        $this->steamid = auth()->check() ? auth()->user()->steamid : NULL;
    }

    public function index()
    {
        $users = User::whereHas("roles", function($query){ $query->where("name", "Donator");})->get();

        return view('donate', ['recents' => $users]);
    }

    public function charge(Request $request)
    {
        if($request->input('submit'))
        {
            try {
                $response = $this->gateway->purchase(array(
                    'amount' => $request->input('amount'),
                    'items' => array(
                        array(
                            'name' => '',
                            'price' => $request->input('amount'),
                            'description' => 'Get access to premium courses.',
                            'quantity' => 1
                        ),
                    ),
                    'currency' => $this->currency->value,
                    'returnUrl' => url('/donate/success'),
                    'cancelUrl' => url('/donate/error'),
                ))->send();
            
                if ($response->isRedirect()) {
                    $response->redirect(); // this will automatically forward the customer
                } else {
                    // not successful
                    return $response->getMessage();
                }
            } catch(Exception $e) {
                return $e->getMessage();
            }
        }
    }

    public function success(Request $request)
    {
        $donatorSteamId = $request->get('steamid');
        $users = User::whereHas("roles", function($query){ $query->where("name", "Donator");})->get();
        // Once the transaction has been approved, we need to complete it.
        if ($request->input('paymentId') && $request->input('PayerID'))
        {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();
           
            if ($response->isSuccessful())
            {
                // The customer has successfully paid.
                $arr_body = $response->getData();
           
                // Insert transaction data into the database
                $payment = new Payment;
                $payment->payment_id = $arr_body['id'];
                $payment->payer_id = $arr_body['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr_body['payer']['payer_info']['email'];
                $payment->amount = $arr_body['transactions'][0]['amount']['total'];
                $payment->currency = $this->currency->value;
                $payment->steamid = $this->steamid;
                $payment->payment_status = $arr_body['state'];
                $payment->save();

                if(auth()->check()){
                    auth()->user()->assignRole('donator');
                    return redirect()->route('donate');
                } else {
                    return redirect()->route('donate');
                }
            } else {
                return redirect()->route('donate');
            }
        } else {
            return redirect()->route('donate');
        }
    }
   
    /**
     * Error Handling.
     */
    public function error()
    {
        return route('donate');
    }
}
