<!DOCTYPE html>
<html lang="en">
<head>
	<title> Transaction </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="{{ asset('css/payment.css') }}">
</head>
<body>
	<div class="limiter">
		<div class="container">
			<div class="wrap">
				<div class="tick-pic" data-tilt>
					<img src="{{ asset('css/cross.png') }}" alt="IMG">
                </div>
                
                <div class="text-center p-t-50">
                    <span class="transtext">
                        Transaction Unsuccessful!
                    </span>
                </div>

                <div class="container-form-btn">
                    <a href="{{url('/invoice/invoicelist')}}" style="text-decoration: none" class="done-btn2">
                        Done
                    </a>
                </div>
				
			</div>
		</div>
	</div>
</body>
</html>