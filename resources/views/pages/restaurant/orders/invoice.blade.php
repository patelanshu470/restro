<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>invoice</title>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
        a {
            color: #0000ee;
            text-decoration: underline;
        }
        @media (max-width: 480px) {
            #u_content_heading_1 .v-font-size {
                font-size: 23px !important;
            }
        }
        @media only screen and (min-width: 570px) {
            .u-row {
                /* width: 550px !important; */
            }
            .u-row .u-col {
                vertical-align: top;
            }
            .u-row .u-col-50 {
                width: 275px !important;
            }

            .u-row .u-col-100 {
                width: 550px !important;
            }
        }
        @media (max-width: 570px) {
            .u-row-container {
                max-width: 100% !important;
                padding-left: 0px !important;
                padding-right: 0px !important;
            }
            .u-row .u-col {
                display: block !important;
            }
            .u-row {
            }
            .u-col {
                width: 100% !important;
            }
            .u-col>div {
                margin: 0 auto;
            }
        }
        body {
            margin: 0;
            padding: 0;
        }
        table,
        tr,
        td {
            vertical-align: top;
            border-collapse: collapse;
        }
        p {
            margin: 0;
        }
        .ie-container table,
        .mso-container table {
            table-layout: fixed;
        }
        * {
            line-height: inherit;
        }
        a[x-apple-data-detectors='true'] {
            color: inherit !important;
            text-decoration: none !important;
        }
    </style>

</head>

<body class="clean-body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;">
    <table
        style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top; Margin: 0 auto;width:100%; "
        cellpadding="0" cellspacing="0">
        <tbody>
            <tr style="vertical-align: top">
                <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                    <div class="u-row-container" style="padding: 0px;background-color: transparent">
                        <div class="u-row"
                            style="Margin: 0 auto; overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                            <div
                                style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                                <div class="u-col u-col-100" style="display: table-cell;vertical-align: top;">
                                    <div style="width: 100% !important;">
                                        <div
                                            style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">

                                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                                border="0">
                                                <tbody>
                                                    <tr>
                                                        <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;"
                                                            align="right">
                                                            <div
                                                                style="color: #000000; line-height: 170%; text-align: center; word-wrap: break-word;">
                                                                <p
                                                                    style="color: #EA6A10; font-size: 38px; font-weight: 700;">
                                                                    {{ $restaurant->restaurant_name }}</p><br>
                                                                <p style="font-size: 16px;">
                                                                    {{ $restaurant_address->street }},
                                                                    {{ $restaurant_address->landmark }},
                                                                    {{ $restaurant_address->cities->name }},
                                                                    {{ $restaurant_address->states->name }},
                                                                    {{ $restaurant_address->pincode }},
                                                                    {{ $restaurant_address->countries->name }}.</p>
                                                                <p
                                                                    style="font-size: 16px; border-bottom:1px solid #ebebeb; padding-bottom: 20px;">
                                                                    Phone:{{ $restaurant->restro_contact_number }}</p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <table cellpadding="0" cellspacing="0" width="100%" role="presentation"
                                                style="">
                                                <tbody>
                                                    <tr>
                                                        <td align="start">
                                                            <h2 style="margin:0; font-weight: 700; font-size: 18px;">
                                                                Name: <span>{{ $order->billing_contact_name }}</span>
                                                            </h2>
                                                            <h2 style="margin:0; font-weight: 400; font-size: 16px;">
                                                                Phone:
                                                                <span>{{ $order->billing_contact_number }}6</span></h2>
                                                        </td>
                                                        <td align="end">
                                                            <h2 style="margin:0; font-weight: 700; font-size: 18px;">
                                                                Order Id. #{{ $order->id }}</h2>
                                                            <h2 style="margin:0; font-weight: 400; font-size: 16px;">
                                                                {{ $order->created_at }}</h2>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <table cellpadding="0" cellspacing="0"
                                                style="border: 1px solid #e3e1e1; width: 100%;">
                                                <thead>
                                                    <tr style="border: 1px solid #ebebeb; text-align: left;">
                                                        <th style="color: #EA6A10; border-right:1px solid #ebebeb"> QTY
                                                        </th>
                                                        <th style="color: #EA6A10; border-right:1px solid #ebebeb">DESC
                                                        </th>
                                                        <th style="text-align: end; color:#EA6A10;">Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <style>
                                                        tr th {
                                                            padding: 15px;
                                                        }

                                                        tr td {
                                                            padding: 15px;
                                                        }
                                                    </style>
                                                    @foreach ($OrderProduct as $product)
                                                        <tr>
                                                            <td style="border-right: 1px solid #ebebeb;">
                                                                {{ $product->quantity }}</td>
                                                            <td class="text-break"
                                                                style="border-right:1px solid #ebebeb">
                                                                {{ $product->getproductsData->name }}
                                                                @if ($product->addon_id != 'null')
                                                                    @php
                                                                        $addons = json_decode($product->addon_id);
                                                                        if ($addons) {
                                                                            $abc = [];
                                                                            foreach ($addons as $addon) {
                                                                                $abc[] = \App\Models\Addons::where('id', $addon)->first();
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    @if ($addons)
                                                                        @foreach ($abc as $addonss)
                                                                            <span class="text-break"
                                                                                style="color: #959895;">({{ $addonss->name }}),
                                                                            </span>
                                                                        @endforeach
                                                                    @endif
                                                                @endif
                                                                <div class="font-size-sm text-body">
                                                                </div>

                                                            </td>
                                                            <td style="text-align: end;">$ {{ $product->price }}</td>
                                                            @php
                                                                $product_total[] = $product->price * $product->quantity;
                                                                $addons_total[] = $product->addons_total;
                                                            @endphp
                                                        </tr>
                                                    @endforeach

                                                    <tr style="border-top: 1px solid #ebebeb;">
                                                        <td colspan="2" style="border-right:1px solid #ebebeb">
                                                            <p style="text-align: right;">Item Price</p>
                                                        </td>
                                                        <td>
                                                            <p style="text-align: end;">
                                                                ${{ array_sum($product_total) }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr style="border-top: 1px solid #ebebeb;">
                                                        <td colspan="2" style="border-right: 1px solid #ebebeb;">
                                                            <p style="text-align: right;">Addon Cost</p>
                                                        </td>
                                                        <td>
                                                            <p style="text-align: end;">${{ array_sum($addons_total) }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr style="border-top: 1px solid #ebebeb;">
                                                        <td colspan="2" style="border-right: 1px solid #ebebeb;">
                                                            @php
                                                                $adons = array_sum($addons_total);
                                                                $products_totals = $order->subtotal;
                                                                $all_subtotal = $adons + $products_totals;
                                                            @endphp
                                                            <p style="text-align: right;">Subtotal</p>
                                                        </td>
                                                        <td>
                                                            <p style="text-align: end;">$ {{ $all_subtotal }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr style="border-top: 1px solid #ebebeb;">
                                                        <td colspan="2" style="border-right: 1px solid #ebebeb;">
                                                            <p style="text-align: right;">Discount</p>
                                                        </td>
                                                        <td>
                                                            <p style="text-align: end;"> - $
                                                                {{ $order->total_discount }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr style="border-top: 1px solid #ebebeb;">
                                                        <td colspan="2" style="border-right: 1px solid #ebebeb;">
                                                            <p style="text-align: right;">Coupon discount</p>
                                                        </td>
                                                        <td>
                                                            <p style="text-align: end;"> - $ 0.00</p>
                                                        </td>
                                                    </tr>
                                                    <tr style="border-top: 1px solid #ebebeb;">
                                                        <td colspan="2" style="border-right: 1px solid #ebebeb;">
                                                            <p
                                                                style="text-align: right; color:#EA6A10; font-weight: 700; font-size: 20px;">
                                                                Total</p>
                                                        </td>
                                                        <td>
                                                            <p
                                                                style="text-align: end; color:#EA6A10; font-weight: 700; font-size: 20px;">
                                                                $ {{ $order->grand_total }}</p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <td>
                                                            <p>Paid By: <span>Card</span> </p>
                                                        </td>
                                                    </tr>

                                                </thead>
                                            </table>
                                            <p
                                                style="text-align: center; border-top: 1px solid #ebebeb; padding: 20px; font-size: 20px; margin:15px">
                                                THANK YOU <br><span style="color: #959895; font-size: 16px;">© 2023
                                                    Veggiegrill. All rights reserved.</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
