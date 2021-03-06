<!DOCTYPE html>
<html>

    <head>
        <title>{{ env('APP_NAME'), 'Fabios' }}</title>
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap" rel="stylesheet">
    </head>

    <body>
    <form action="https://sadadqa.com/webpurchase"  method="POST">
        <div>
            <div style="text-align: center;">
                <img src="/logo.png" style="max-width: 150px; width: 100%; height: auto;">
                <!-- <h6 style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif; font-weight: 200;">{}</h6>
                <h6 style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif; font-weight: 200;">{}</h6>
                <h6 style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif; font-weight: 200;">{}  {}</h6>
                <h5 style="margin-top: 15px;margin-bottom: 15px;font-family: 'Roboto', sans-serif;">{}</h5> -->
            </div>
            <div>
          
                <table style="width: 100%;">
                    <tr>
                        <td>
                            <!-- <h5 style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif;">merchant_id:  </h5> -->
                            <input type="hidden" id="merchant_id" type="text" class="form-control" name="merchant_id" value="{{$order['merchant_id']}}" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5 style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif;">Order No : </h5>
                            <input type="hidden" id="secret_key" type="text" class="form-control" name="secret_key" value="{{$order['secret_key']}}" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- <h5 style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif;"></h5> -->
                            <input type="hidden" id="amount" type="text" class="form-control" name="TXN_AMOUNT" value="{{$order['TXN_AMOUNT']}}" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- <h5 style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif;"></h5> -->
                            <input type="hidden" id="order_id" type="text" class="form-control " name="ORDER_ID" value="{{$order['ORDER_ID']}}" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- <h5 style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif;">CALLBACK_URL : </h5> -->
                            <input type="hidden" id="callback_url" type="text" class="form-control" name="CALLBACK_URL" value="{{$order['CALLBACK_URL']}}" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- <h5 style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif;">WEBSITE :  </h5> -->
                            <input type="hidden" id="WEBSITE" type="text" class="form-control" name="WEBSITE" value="{{$order['WEBSITE']}}" >
                        </td>
                    </tr>
                      <tr>
                        <td>
                            <!-- <h5 style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif;">MOBILE_NO :</h5> -->
                            <input  type="hidden" id="MOBILE_NO" type="text" class="form-control" name="MOBILE_NO" value="{{$order['MOBILE_NO']}}" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- <h5 style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif;">CUST_ID :</h5> -->
                            <input type="hidden" id="CUST_ID" type="text" class="form-control" name="CUST_ID" value="{{$order['CUST_ID']}}" >
                        </td>
                    </tr>  <tr>
                        <td>
                            <!-- <h5 style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif;">EMAIL : </h5> -->
                            <input type="hidden" id="EMAIL" type="text" class="form-control" name="EMAIL" value="{{$order['EMAIL']}}" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- <h5 style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif;">txnDate : </h5> -->
                            <input type="hidden" id="txnDate" type="text" class="form-control" name="txnDate" value="{{$order['txnDate']}}" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- <h5 style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif;">shipping_rate:  </h5> -->
                            <input type="hidden" id="shipping_rate" type="text" class="form-control" name="shipping_rate" value="{{$order['shipping_rate']}}" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- <h5 style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif;">MODE : </h5> -->
                            <input type="hidden" id="MODE" type="text" class="form-control" name="MODE" value="{{$order['MODE']}}" >
                        </td>
                    </tr>
                </table>
            </div>
            <div>
                <table style="width: 100%;">
                <tr>
                        <td style="border-top: 1px dotted #cccccc;border-bottom: 1px dotted #cccccc;">
                            <h6 style="margin-top: 15px;margin-bottom: 15px;font-family: 'Roboto', sans-serif;">Item</h6>
                        </td>
                        <td style="border-top: 1px dotted #cccccc;border-bottom: 1px dotted #cccccc;">
                            <h6 style="margin-top: 15px;margin-bottom: 15px;font-family: 'Roboto', sans-serif;">Qty</h6>
                        </td>
                        <td style="border-top: 1px dotted #cccccc;border-bottom: 1px dotted #cccccc;">
                            <h6 style="margin-top: 15px;margin-bottom: 15px;font-family: 'Roboto', sans-serif;">Price</h6>
                        </td>
                        <td style="border-top: 1px dotted #cccccc;border-bottom: 1px dotted #cccccc;">
                            <h6 style="margin-top: 15px;margin-bottom: 15px;font-family: 'Roboto', sans-serif;">Sub Amount</h6>
                        </td>
                    </tr>
                    @php
                     $i=0;
                     @endphp
                @foreach ($order->productdetail as $item)
                    <tr>
                        <td>
                            <h6
                                style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif;font-weight: 200;">
                                {{$item->itemname}}   <input  type="hidden" id="itemname" type="text" class="form-control" name="productdetail[{{$i}}][itemname]" value="{{$item->itemname}}">
                                </h6>
                        </td>
                        <td>
                            <h6
                                style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif;font-weight: 200;">
                                {{$item->quantity}} <input type="hidden" id="quantity" type="text" class="form-control" name="productdetail[{{$i}}][quantity]" value="{{$item->quantity}}" >
                                </h6>
                        </td>
                        <td>
                            <h6
                                style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif;font-weight: 200;">
                                {{$item->amount}} <input type="hidden" id="amount" type="text" class="form-control " name="productdetail[{{$i}}][amount]" value="{{$item->amount}}" >
                                </h6>
                        </td>
                        <td>
                            <h6
                                style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif;font-weight: 200;">
                                {{$item->totalamount}}   <input type="hidden" id="totalamount" type="text" class="form-control " name="productdetail[{{$i}}][totalamount]" value="{{$item->totalamount }}" >
                                </h6>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div>
                <table style="width: 100%;">
                    <tr style="padding-top: 15px; padding-bottom: 15px;">
                        <td style="border-top: 1px dotted #cccccc;border-bottom: 1px dotted #cccccc;">
                            <h5
                                style="margin-top: 5px;margin-bottom: 5px; text-align: right;padding-top: 15px; padding-bottom: 15px;font-family: 'Roboto', sans-serif;">
                                 Total : </h5>
                        </td>
                        <td style="border-top: 1px dotted #cccccc;border-bottom: 1px dotted #cccccc;">
                            <h5
                                style="margin-top: 5px;margin-bottom: 5px;padding-top: 15px; padding-bottom: 15px; text-align: center;font-family: 'Roboto', sans-serif;">
                                {{ $order['TXN_AMOUNT'] }}</h5>
                        </td>
                    </tr>
                    <button  type="submit" >Pay by Credit / Debit Card</button>
                </table>
            </div>
            <div>
                <table style="width: 100%;">
                    <tr>
                        <td>
                            <h5
                                style="margin-top: 3px;margin-bottom: 3px;font-family: 'Roboto', sans-serif;font-weight: 200; text-align: center;">
                                Doha, Qatar...</h5>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
       
   </form>
    </body>
    
</html>