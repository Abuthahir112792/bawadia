<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SadadResponse;
use Carbon\Carbon;



class SadadController extends Controller
{
  
    public function sadadPayment()
    {
        $order=array();
        // $order=$request;
        $order['merchant_id']='6939791';
        $order['secret_key']='NVbhCjzWqOhinGeN';
        $order['CALLBACK_URL']='http://staff.tas-taz.com/app/paymentinvoice/callback';
        $order['WEBSITE']='staff.tas-taz.com';
        $order['txnDate']=Carbon::now();
        $order['shipping_rate']='0';
        $order['MODE']='yes';
        $order['TXN_AMOUNT']=0;
        $order['ORDER_ID']='sdef';
        $order['MOBILE_NO']='123';
        $order['CUST_ID']='123';
        $order['EMAIL']='123';
        $order['productdetail']['itemname']='';
        
        return view("payment",compact('order'));
        // return view("payment");
    }


    public function sadadResponse(Request $request)
    {
        $create=sadadResponse::create(
            [
                'website_ref_no'=> $request->website_ref_no,
                'transaction_status'=> $request->transaction_status,
                'transaction_number'=> $request->transaction_number,
                'MID'=> $request->MID,
                'RESPCODE'=>  $request->RESPCODE,
                'RESPMSG'=>  $request->RESPMSG,
                'ORDERID'=>  $request->ORDERID,
                'STATUS'=>  $request->STATUS,
                'TXNAMOUNT'=>  $request->TXNAMOUNT,
            ]
        );

        return view('successfulpayment');
    }

   
  
}
