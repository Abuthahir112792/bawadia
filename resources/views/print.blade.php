<!DOCTYPE html>
<html>

    <head>
        <title>{{ env('APP_NAME'), 'SimplistQ Solution' }}</title>
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap" rel="stylesheet">
    </head>

    <body>
        <div>
            <div style="text-align: center;">
                <img src="/logo.png" style="max-width: 150px; width: 100%; height: auto;">
                <h6 style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif; font-weight: 200;">{{$order->branch->name ?? ''}}</h6>
                <h6 style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif; font-weight: 200;">{{$order->branch->address ?? ''}}</h6>
                <h6 style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif; font-weight: 200;">{{$order->branch->contact_1 ?? ''}} | {{$order->branch->contact_2 ?? ''}}</h6>
                <h5 style="margin-top: 15px;margin-bottom: 15px;font-family: 'Roboto', sans-serif;">{{$order->type ?? ''}}</h5>
            </div>
            <div>
                <table style="width: 100%;">
                    <tr>
                        <td>
                            <h5 style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif;">Order No : {{$order->id ?? ''}}
                            </h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h6
                                style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif;font-weight: 200;">
                                Date : {{ date('d-M-y', strtotime($order->created_at)) }}</h6>
                        </td>
                        <td>
                            <h6
                                style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif;font-weight: 200;">
                                Time : {{ date('h:i:s A', strtotime($order->created_at)) }}</h6>
                        </td>
                    </tr>
                    {{-- <tr>
                        <td>
                            <h6
                                style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif;font-weight: 200;">
                                Shift : LUNCH</h6>
                        </td>
                        <td>
                            <h5 style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif;">Captain :
                                Kiran</h5>
                        </td>
                    </tr> --}}
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
                            <h6 style="margin-top: 15px;margin-bottom: 15px;font-family: 'Roboto', sans-serif;">Amount</h6>
                        </td>
                    </tr>
                    @foreach ($order->product as $item)
                    <tr>
                        <td>
                            <h6
                                style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif;font-weight: 200;">
                                {{$item->name}}</h6>
                        </td>
                        <td>
                            <h6
                                style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif;font-weight: 200;">
                                {{$item->quantity}}</h6>
                        </td>
                        <td>
                            <h6
                                style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif;font-weight: 200;">
                                {{$item->product_price}}</h6>
                        </td>
                        <td>
                            <h6
                                style="margin-top: 5px;margin-bottom: 5px;font-family: 'Roboto', sans-serif;font-weight: 200;">
                                {{$item->total}}</h6>
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
                                Grand Total : </h5>
                        </td>
                        <td style="border-top: 1px dotted #cccccc;border-bottom: 1px dotted #cccccc;">
                            <h5
                                style="margin-top: 5px;margin-bottom: 5px;padding-top: 15px; padding-bottom: 15px; text-align: center;font-family: 'Roboto', sans-serif;">
                                {{$order->total}}</h5>
                        </td>
                    </tr>
                    <tr style="padding-top: 15px; padding-bottom: 15px;">
                        <td style="border-top: 1px dotted #cccccc;border-bottom: 1px dotted #cccccc;">
                            <h5
                                style="margin-top: 5px;margin-bottom: 5px; text-align: right;padding-top: 15px; padding-bottom: 15px;font-family: 'Roboto', sans-serif;">
                                Total Qty : </h5>
                        </td>
                        <td style="border-top: 1px dotted #cccccc;border-bottom: 1px dotted #cccccc;">
                            <h5
                                style="margin-top: 5px;margin-bottom: 5px;padding-top: 15px; padding-bottom: 15px; text-align: center;font-family: 'Roboto', sans-serif;">
                                {{count($order->product)}}</h5>
                        </td>
                    </tr>
                </table>
            </div>
            <div>
                <table style="width: 100%;">
                    <tr>
                        <td>
                            <h5 style="margin-top: 3px;margin-bottom: 3px;font-family: 'Roboto', sans-serif;">Customer: {{ $order->customer_name }}</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5 style="margin-top: 3px;margin-bottom: 3px;font-family: 'Roboto', sans-serif;">Address: {{ $order->address1 }} ,  {{ $order->city?$order->city:'' }}</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5 style="margin-top: 3px;margin-bottom: 3px;font-family: 'Roboto', sans-serif;">Number: {{ $order->contact }}</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5
                                style="margin-top: 3px;margin-bottom: 3px;font-family: 'Roboto', sans-serif;font-weight: 200; text-align: center;">
                                Thank You, Please Visit again</h5>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <script type="text/javascript">
            window.print();
        </script>
    </body>
    
</html>