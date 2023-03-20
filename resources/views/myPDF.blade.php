<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice #{{ $order->id }}</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        span,
        label {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }

        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }

        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }

        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }

        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }

        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }

        .no-border {
            border: 1px solid #fff !important;
        }

        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
    </style>
</head>

<body>

    <table class="order-details">
        <thead>
            <tr>
                <th width="50%" colspan="2">
                    <h2 class="text-start">Ecommerce</h2>
                </th>
                <th width="50%" colspan="2" class="text-end company-data">
                    <span>Invoice Id: #{{ $order->id }}</span> <br>
                    <span>Date: {{ date('d-m-Y') }}</span> <br>
                    <span>phone:{{ $order->phone }} </span> <br>
                    <span>Address: {{ $order->address }}</span> <br>
                </th>
            </tr>
            <tr class="bg-blue">
                <th width="50%" colspan="2">Order Details</th>
                <th width="50%" colspan="2">User Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Order Id:</td>
                <td>{{ $order->id }}</td>

                <td>Full Name:</td>
                <td> {{ $order->first_name . $order->last_name }}</td>
            </tr>
            <tr>
                <td>CompanyName:</td>
                <td>{{ $order->company_name }}</td>

                <td>Email:</td>
                <td>{{ $order->email }}</td>
            </tr>
            <tr>
                <td>Ordered Date:</td>
                <td>{{ $order->created_at->format('d-m-Y h:i A') }}</td>

                <td>Phone:</td>
                <td>{{ $order->phone }}</td>
            </tr>
            <tr>
                <td>CountryState: </td>
                <td>{{ $order->country_state }}</td>

                <td>Address:</td>
                <td>{{ $order->address }}</td>
            </tr>
            <tr>
                <td>City: </td>
                <td>{{$order->city }}</td>

                <td>Governorate:</td>
                <td>{{ $order->client->governorate->name }}</td>
            </tr>
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5">
               Order Products
                </th>
            </tr>
            <tr class="bg-blue">
                <th>Name</th>
                <th>Color</th>
                <th>Size</th>
                <th>Quantity</th>
               
            </tr>
        </thead>
         
        <tbody>
           @foreach($items as $item)
                                          <tr>
                                            <td>{{$item->product->title}}</td>
                                            <td style="width:50%">{{$item->product->productColors[0]->color->name}}</td>
                                            <td style="width:50%">{{$item->product->productSizes[0]->size->size}}</td>
                                            <td>{{$item->quantity}}</td>
                                        </tr>
                                        @endforeach
        </tbody>
    </table>

    <br>

    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5">
               Order Total
                </th>
            </tr>
            <tr class="bg-blue">
                <th>Sub Total</th>
                <th>Total</th>
                
               
            </tr>
        </thead>
           
        <tbody>
          <td>{{ $order->sub_total }}</td>
            <td>{{ $order->total }}</td>
        </tbody>
    </table>
    <br>
    <p class="text-center">
        Thank your for shopping 
    </p>

</body>

</html>
