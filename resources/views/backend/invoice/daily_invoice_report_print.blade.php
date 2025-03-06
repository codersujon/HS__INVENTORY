<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Daily Sales Report - Hypershop.com.bd</title>
    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }
        h1, h2, h3, h4, h5, h6, p, span, label {
            font-family: sans-serif;
            line-height: 1.1
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
            background-color: #0d6efd;
          
        }
        .bg-dark{
            background-color: #212529;  
            color: #fff;
        }
    </style>
</head>
<body>

    <div class="text-center">
        <h2>HYPERSHOP.COM.BD</h2>
        <h4>914, Floor 9(Lift-8), Shah Ali Plaza, Mirpur-10,Dhaka, Bangladesh</h4>
        <span><strong>Mobile No : </strong> +8801822-666664,</span>
        <span><strong>Email: </strong>support@hypershop.com.bd</span>
    </div>

    <table style="margin-top: 20px;">
        <thead>
            <tr>
                <th class="no-border text-start heading bg-dark text-center" colspan="7" style="text-align:center; padding: 10px 0;">
                    DAILY SALES REPORT ({{ date('d-m-Y', strtotime($start_date)) }} to {{ date('d-m-Y', strtotime($end_date))  }})  
                </th>
            </tr>
            <tr class="text-center bg-blue">
                <th style="color: #fff; text-align:center;">#</th>
                <th style="color: #fff; text-align:center;">INVOICE NO</th>
                <th style="color: #fff; text-align:center;">DATE</th>
                <th style="color: #fff; text-align:center;">CUSTOMER NAME</th>
                <th style="color: #fff; text-align:center;">GENDER</th>
                <th style="color: #fff; text-align:center;">PHONE NO</th>
                <th style="color: #fff; text-align:center;">AMMOUNT</th>
            </tr>
        </thead>
        <tbody>

            @php
                $total_sum = '0';
            @endphp

            @foreach ($allData as $key => $item)

            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center"><h4>#{{ $item->invoice_no }}</h4></td>
                <td class="text-center">{{ date('d-m-Y', strtotime($item->date)) }}</td>
                <td class="text-center">{{ ucwords($item['payment']['customer']['customer_name']) }}</td>
                <td class="text-center">{{ ucwords($item['payment']['customer']['c_gender']) }}</td>
                <td class="text-center">{{ $item['payment']['customer']['c_phone'] }}</td>
                <td class="text-end">{{  number_format($item['payment']['total_amount'], 2) }}</td>
            </tr>

            @php
                $total_sum += $item['payment']['total_amount']
            @endphp

            @endforeach

            <tr>
                <td colspan="6" class="total-heading text-end"><strong>Total Sales Amount:</strong></td>
                <td colspan="1" class="total-heading text-end"><strong>{{ number_format($total_sum, 2) }}</strong></td>
            </tr>
        </tbody>
    </table>

    <br>
    <h3 class="text-center">Thank you!</h3>
    <h6 class="text-center">(Reporting Time: {{ $today = now('Asia/Dhaka') }})</h4>

</body>
</html>
