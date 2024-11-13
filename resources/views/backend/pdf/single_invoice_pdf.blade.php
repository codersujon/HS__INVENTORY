<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice #{{ $data['invoice']['invoice_no'] }}</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }
        h1,h2,h3,h4,h5,h6,p,span,label {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }
        table thead th {
            height: 22px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 6px;
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

    <div class="text-center">
        <h2>HYPERSHOP.COM.BD</h2>
        <p>914, Floor 9(Lift-8), Shah Ali Plaza, Mirpur-10,Dhaka, Bangladesh</p>
    </div>

    <table class="order-details">
        <thead>
            <tr>
                <th width="50%" colspan="2">
                    <h2>INVOICE ID:</strong> #{{ $data['invoice']['invoice_no'] }}</h2>
                </th>
                <td width="50%" colspan="2" class="text-end company-data">
                    <span><strong>Date:</strong>{{ date('d-m-Y', strtotime($data['invoice']['date'])) }}</span> <br>
                    <span><strong>Mobile No :</strong> +8801822-666664</span> <br>
                    <span><strong>Address:</strong>914, Floor 9(Lift-8), Shah Ali Plaza, Mirpur-10,Dhaka, Bangladesh</span> <br>
                    <span><strong>Email:</strong>support@hypershop.com.bd</span> <br>
                </td>
            </tr>
            <tr class="bg-blue">
                <th width="50%" colspan="2" style="color: #fff;">Order Details</th>
                <th width="50%" colspan="2" style="color: #fff;">Customer Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Order Id:</td>
                <td>{{ $data['invoice']['invoice_no'] }}</td>

                <td>Full Name:</td>
                <td>{{ $data['payment']['customer']['customer_name'] }}</td>
            </tr>
            <tr>
                <td>Order Status:</td>
                <td>
                    @if($data['invoice']['status'] == '0')
                        Processing
                    @elseif($data['invoice']['status'] == '1')
                        On Delivery
                    @elseif($data['invoice']['status'] == '2')
                        Delivered
                    @endif
                </td>

                <td>Email Id:</td>
                <td>
                    @if (empty($data['payment']['customer']['c_email']))
                        N/A
                    @else
                        {{ $data['payment']['customer']['c_email'] }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Ordered Date:</td>
                <td>{{ date('d-m-Y h:i:s', strtotime($data['invoice']['created_at'])) }}</td>

                <td>Phone:</td>
                <td>{{ $data['payment']['customer']['c_phone'] }}</td>
            </tr>
            <tr>
                <td>Payment Mode:</td>
                <td>Cash On Delivery</td>

                <td>Address:</td>
                <td>{{ ucwords($data['invoice']['description']) }}</td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading bg-blue text-center" colspan="6" style="text-align:center; padding: 10px 0;">
                    ORDER ITEMS
                </th>
            </tr>
            <tr class="text-center bg-blue">
                <th style="color: #fff; text-align:center;">Id</th>
                <th style="color: #fff; text-align:center;">Category</th>
                <th style="color: #fff; text-align:center;">Product Name</th>
                <th style="color: #fff; text-align:center;">Quantity</th>
                <th style="color: #fff; text-align:center;">Unite Price</th>
                <th style="color: #fff; text-align:center;">Total Price</th>
            </tr>
        </thead>
        <tbody>

            @php
             $total_sum = '0';
             $x = 1;
            @endphp
            @foreach ($data['invoice']['invoice_details'] as $key => $item )

            <tr>
                <td>{{ $x++ }}</td>
                <td>
                    {{ $item['category']['category_name'] }}
                </td>
                <td>{{ $item['product']['product_name'] }}</td>
                <td class="text-center">{{ $item->selling_qty }}</td>
                <td class="fw-bold text-end">{{ number_format($item->unit_price, 2) }}</td>
                <td class="fw-bold text-end">{{ number_format($item->selling_price, 2) }}</td>
            </tr>

            @php
            $total_sum += $item->selling_price
            @endphp

            @endforeach



            <tr>
                <td colspan="5" class="total-heading text-end">Subtotal:</td>
                <td colspan="1" class="total-heading text-end">{{ number_format($total_sum, 2) }}</td>
            </tr>
            <tr>
                <td colspan="5" class="text-end">Shipping Charge</td>
                <td colspan="1" class="text-end">{{number_format($data['payment']['shipping_charge'], 2) }}</td>
            </tr>
            <tr>
                <td colspan="5" class="text-end">Discount Amount:</td>
                <td colspan="1" class="text-end">{{ number_format($data['payment']['discount_amount'], 2) }}</td>
            </tr>
            <tr>
                <td colspan="5" class="text-end">Paid Amount:</td>
                <td colspan="1" class="text-end">{{ number_format($data['payment']['paid_amount'], 2) }}</td>
            </tr>
            <tr>
                <td colspan="5" class="text-end">Due Amount:</td>
                <td colspan="1" class="text-end">{{ number_format($data['payment']['due_amount'], 2) }}</td>
            </tr>
            <tr>
                <td colspan="5" class="total-heading text-end">Grand Total:</td>
                <td colspan="1" class="total-heading text-end">{{ number_format($data['payment']['total_amount'], 2) }}</td>
            </tr>
        </tbody>
    </table>

    <br>
    <p class="text-center">
        Thank your for shopping with Hypershop.com.bd
    </p>

</body>
</html>
