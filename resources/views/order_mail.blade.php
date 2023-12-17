<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style type="text/css">
        a {
            color: #0000ee;
            text-decoration: underline;
        }
        @media (max-width: 480px) {
            #u_content_heading_1 .v-font-size {
                font-size: 23px !important;
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

<body>
    @php
        $order = App\Models\Order::where('user_id',auth()->user()->id)->latest()->first();
        $OrderProduct = App\Models\OrderProduct::with('getproductsData')->where('order_id', $order->id)->orderBy('id', 'asc')->get();
        $billing_address = App\Models\Address::where('addresable_id', $order->id)->where('atype', 'billing')->first();
        $shipping_address = App\Models\Address::where('addresable_id', $order->id)->where('atype', 'shipping')->first();
    @endphp

    <table width="100%" cellspacing="0" cellpadding="0"
        style="border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;background-color:#eceff4; padding-top: 50px;">
        <tbody>
            <tr>
                <td valign="top" style="padding:0;Margin:0">
                    <table class="m_-7339135599507116636es-content" cellspacing="0" cellpadding="0" align="center"
                        style="border-collapse:collapse;border-spacing:0px;table-layout:fixed!important;width:100%">
                        <tbody>
                            <tr>
                                <td align="center" style="padding:0;Margin:0">
                                    <table class="m_-7339135599507116636es-content-body"
                                        style="border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px; padding-top: 50px !important;"
                                        cellspacing="0" cellpadding="0" align="center">
                                        <tbody>
                                            <tr>
                                                <td align="left" bgcolor="#ffffff"
                                                    style="padding:20px 0;Margin:0;background-color:#ffffff;border-radius:5px 5px 0px 0px">
                                                    <table width="100%" cellspacing="0" cellpadding="0"
                                                        style="border-collapse:collapse;border-spacing:0px">
                                                        <tbody>
                                                            <tr>
                                                                <td class="m_-7339135599507116636es-m-p0r m_-7339135599507116636es-m-p20b"
                                                                    valign="top" align="center"
                                                                    style="padding:0;Margin:0;border-radius:5px;overflow:hidden;width:560px">
                                                                    <table width="100%" cellspacing="0"
                                                                        cellpadding="0"
                                                                        style="border-collapse:separate;border-spacing:0px;"
                                                                        role="presentation">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="center"
                                                                                    style="padding:0;Margin:0;font-size:0px">
                                                                                    <a href=""
                                                                                        style="text-decoration:underline;color:#022b3a;font-size:14px">
                                                                                        <img src="{{ asset('images/logo1.png') }}"
                                                                                            alt=""
                                                                                            style="display:block;border:0;outline:none;text-decoration:none"
                                                                                            width="200px"
                                                                                            class="CToWUd"
                                                                                            data-bit="iit">
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div
                                                                                        style="width: 100%; height: 0px; background-color:#EA6A10; padding: 8px; margin: 20px 0;">
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="center">
                                                                                    <img src="{{ asset('images/1171952-middle-removebg-preview.png') }}"
                                                                                        alt="" width="120px">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="center"
                                                                                    style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px">
                                                                                    <h1
                                                                                        style="Margin:0;line-height:43px;font-family:Poppins,sans-serif;font-size:24px;font-style:normal;font-weight:bold;color:#000000">
                                                                                        Thanks for your order!</h1>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="center">
                                                                                    <p style="color:#555151">Lorem ipsum
                                                                                        dolor sit amet consectetur
                                                                                        adipisicing elit. </p>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table cellpadding="0" cellspacing="0" class="m_-7339135599507116636es-content" align="center"
                        style="border-collapse:collapse;border-spacing:0px;table-layout:fixed!important;width:100%">
                        <tbody>
                            <tr>
                                <td align="center" style="padding:0;Margin:0">
                                    <table bgcolor="#ffffff" class="m_-7339135599507116636es-content-body"
                                        align="center" cellpadding="0" cellspacing="0"
                                        style="border-collapse:collapse;border-spacing:0px;background-color:#ffffff;width:600px">
                                        <tbody>
                                            <tr>
                                                <td align="left"
                                                    style="Margin:0;padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:40px">
                                                    <table cellpadding="0" cellspacing="0" align="left"
                                                        class="m_-7339135599507116636es-left"
                                                        style="border-collapse:collapse;border-spacing:0px;float:left">
                                                        <tbody>
                                                            <tr>
                                                                <td class="m_-7339135599507116636es-m-p20b"
                                                                    align="center" valign="top"
                                                                    style="padding:0;Margin:0;width:270px">
                                                                    <table cellpadding="0" cellspacing="0"
                                                                        width="100%" role="presentation"
                                                                        style="border-collapse:collapse;border-spacing:0px">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="left"
                                                                                    style="padding:0;Margin:0">
                                                                                    <h3
                                                                                        style="Margin:0;line-height:24px;font-family:Poppins,sans-serif;font-size:20px;font-style:normal;font-weight:600;color:#555151">
                                                                                        {{date('F d, Y',strtotime($order->created_at))}}</h3>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table cellpadding="0" cellspacing="0"
                                                        class="m_-7339135599507116636es-right" align="right"
                                                        style="border-collapse:collapse;border-spacing:0px;float:right">
                                                        <tbody>
                                                            <tr>
                                                                <td align="left"
                                                                    style="padding:0;Margin:0;width:270px">
                                                                    <table cellpadding="0" cellspacing="0"
                                                                        width="100%" role="presentation"
                                                                        style="border-collapse:collapse;border-spacing:0px">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="right"
                                                                                    style="padding:0;Margin:0">
                                                                                    <h3
                                                                                        style="Margin:0;line-height:24px;font-family:Poppins,sans-serif;font-size:20px;font-style:normal;font-weight:600;color:#555151">
                                                                                        Order: #{{ $order->id }}<br></h3>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" style="padding:0;Margin:0">
                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                        style="border-collapse:collapse;border-spacing:0px">
                                                        <tbody>
                                                            <tr>
                                                                <td align="center" valign="top"
                                                                    style="padding:0;Margin:0;width:600px">
                                                                    <table cellpadding="0" cellspacing="0"
                                                                        width="100%" role="presentation"
                                                                        style="border-collapse:collapse;border-spacing:0px">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="center"
                                                                                    style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;font-size:0">
                                                                                    <table border="0"
                                                                                        width="100%" height="100%"
                                                                                        cellpadding="0"
                                                                                        cellspacing="0"
                                                                                        role="presentation"
                                                                                        style="border-collapse:collapse;border-spacing:0px">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td
                                                                                                    style="padding:0;Margin:0;border-bottom:1px solid #b0b2b2;background:unset;height:1px;width:100%;margin:0px">
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left"
                                                    style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px">
                                                    <table cellpadding="0" cellspacing="0"
                                                        style="border-collapse:collapse;border-spacing:0px;width:560px">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="top" style="padding:0;Margin:0">
                                                                    <table cellpadding="0" cellspacing="0"
                                                                        align="left"
                                                                        class="m_-7339135599507116636es-left"
                                                                        style="border-collapse:collapse;border-spacing:0px;float:left">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="start"
                                                                                    style="padding:0;Margin:0; width: 150px;">
                                                                                    <p
                                                                                        style="Margin:0;font-family:Poppins,sans-serif;line-height:21px;color:#000000;font-size:14px">
                                                                                        <b style="font-size: 16px;">Billing
                                                                                            Details:</b> &nbsp; </p>
                                                                                    <p
                                                                                        style="padding-top: 10px; line-height: 20px;">
                                                                                        {{$order->billing_contact_name}} <br>{{$order->billing_contact_number}}
                                                                                    </p>
                                                                                </td>

                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                                <td>
                                                                </td>
                                                                <td valign="top" style="padding:0;Margin:0">
                                                                    <table cellpadding="0" cellspacing="0"
                                                                        class="m_-7339135599507116636es-right"
                                                                        align="right"
                                                                        style="border-collapse:collapse;border-spacing:0px;float:right">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="right"
                                                                                    style="padding:0;Margin:0;width:270px">
                                                                                    <table cellpadding="0"
                                                                                        cellspacing="0" width="100%"
                                                                                        role="presentation"
                                                                                        style="border-collapse:collapse;border-spacing:0px">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td align="end"
                                                                                                    style="padding:0;Margin:0; width: 150px;">
                                                                                                    <p
                                                                                                        style="Margin:0;font-family:Poppins,sans-serif;line-height:21px;color:#000000;font-size:14px">
                                                                                                        <b
                                                                                                            style="font-size: 16px;">Payment
                                                                                                            Method</b>
                                                                                                        &nbsp; </p>
                                                                                                    <p
                                                                                                        style="padding-top: 10px; line-height: 20px;">
                                                                                                        Online<br> Amount: ${{ number_format($order->grand_total, 2, '.', ',') }}
                                                                                                    </p>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" style="padding:0;Margin:0">
                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                        style="border-collapse:collapse;border-spacing:0px">
                                                        <tbody>
                                                            <tr>
                                                                <td align="center" valign="top"
                                                                    style="padding:0;Margin:0;width:600px">
                                                                    <table cellpadding="0" cellspacing="0"
                                                                        width="100%" role="presentation"
                                                                        style="border-collapse:collapse;border-spacing:0px">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="center"
                                                                                    style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;font-size:0">
                                                                                    <table border="0"
                                                                                        width="100%" height="100%"
                                                                                        cellpadding="0"
                                                                                        cellspacing="0"
                                                                                        role="presentation"
                                                                                        style="border-collapse:collapse;border-spacing:0px">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td
                                                                                                    style="padding:0;Margin:0;border-bottom:1px solid #b0b2b2;background:unset;height:1px;width:100%;margin:0px">
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h3
                                                        style="padding-left: 20px;font-family: Poppins; font-weight: 600; margin:0">
                                                        Product Details</h3>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table cellpadding="0" cellspacing="0" width="94.4%"
                                                        bgcolor="#ea6a10"
                                                        style="border-collapse:separate;border-spacing:0px;border-left:1px solid #ea6a10;border-right:1px solid #ea6a10;border-top:1px solid #ea6a10;border-bottom:1px solid #ea6a10;background-color:#ea6a100f;border-radius:5px; padding: 15px; margin: 15px;"
                                                        role="presentation">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <table cellpadding="0" cellspacing="0"
                                                                        width="100%"
                                                                        style="border-collapse:collapse;border-spacing:0px">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Product</th>
                                                                                <th>Addons</th>
                                                                                <th>Price</th>
                                                                                <th>Qty.</th>
                                                                                <th>Discount</th>
                                                                                <th>Total</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($OrderProduct as $product)
                                                                            <tr>
                                                                                <td align="center"
                                                                                    style="padding-top:15px">{{ $product->getproductsData->name }}</td>
                                                                                <td align="center"
                                                                                    style="padding-top:15px">
                                                                                    @if ($product->addon_id != 'null')
                                                                                    @php
                                                                                    $addons = json_decode($product->addon_id);
                                                                                    if ($addons) {
                                                                                        $abc = [];
                                                                                        foreach ($addons as $addon) {
                                                                                            $abc[] = \App\Models\Addons::where('id', $addon)
                                                                                                ->get()
                                                                                                ->first();
                                                                                        }
                                                                                    }
                                                                                    @endphp
                                                                                    @if ($addons)
                                                                                        @foreach ($abc as $addonss)
                                                                                            {{ $addonss->name }} (${{ $addonss->price }}),
                                                                                        @endforeach
                                                                                    @endif
                                                                                    @else
                                                                                        -
                                                                                    @endif
                                                                                </td>
                                                                                <td align="center"
                                                                                    style="padding-top:15px">${{number_format($product->price,2)}}
                                                                                </td>
                                                                                <td align="center"
                                                                                    style="padding-top:15px"> {{$product->quantity}}</td>
                                                                                <td align="center"
                                                                                    style="padding-top:15px">${{number_format($product->discount,2)}}</td>
                                                                                <td align="center"
                                                                                    style="padding-top:15px">${{number_format($product->total_price,2)}}
                                                                                </td>
                                                                            </tr>
                                                                            @endforeach
                                                                            {{-- <tr>
                                                                                <td align="center"
                                                                                    style="padding:10px">xyz</td>
                                                                                <td align="center"
                                                                                    style="padding:10px">200.00</td>
                                                                                <td align="center"
                                                                                    style="padding:10px"> 1</td>
                                                                                <td align="center"
                                                                                    style="padding:10px">20.00</td>
                                                                                <td align="center"
                                                                                    style="padding:10px">180.00 </td>
                                                                            </tr> --}}
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left"
                                                    style="padding:0;Margin:0;padding-left:20px;padding-right:20px">
                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                        style="border-collapse:collapse;border-spacing:0px">
                                                        <tbody>
                                                            <tr>
                                                                <td align="left"
                                                                    style="padding:0;Margin:0;width:560px">
                                                                    <table cellpadding="0" cellspacing="0"
                                                                        width="100%" role="presentation"
                                                                        style="border-collapse:collapse;border-spacing:0px">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="center"
                                                                                    class="m_-7339135599507116636es-m-txt-l"
                                                                                    style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px">
                                                                                    <h3
                                                                                        style="Margin:0;line-height:24px;font-family:Poppins,sans-serif;font-size:20px;font-style:normal;font-weight:bold;color:#000000">
                                                                                        <b>Order summary</b></h3>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left"
                                                    style="padding:0;Margin:0;padding-top:5px;padding-left:20px;padding-right:20px">
                                                    <table cellpadding="0" cellspacing="0"
                                                        style="border-collapse:collapse;border-spacing:0px;width:560px">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="top" style="padding:0;Margin:0">
                                                                    <table cellpadding="0" cellspacing="0"
                                                                        align="left"
                                                                        class="m_-7339135599507116636es-left"
                                                                        style="border-collapse:collapse;border-spacing:0px;float:left">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="left"
                                                                                    style="padding:0;Margin:0;width:270px">
                                                                                    <table cellpadding="0"
                                                                                        cellspacing="0" width="100%"
                                                                                        role="presentation"
                                                                                        style="border-collapse:collapse;border-spacing:0px">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td align="right"
                                                                                                    class="m_-7339135599507116636es-m-txt-l"
                                                                                                    style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px">
                                                                                                    <p
                                                                                                        style="Margin:0;font-family:Poppins,sans-serif;line-height:21px;color:#000000;font-size:14px">
                                                                                                        Subtotal:</p>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td align="right"
                                                                                                    class="m_-7339135599507116636es-m-txt-l"
                                                                                                    style="padding:0;Margin:0;padding-bottom:5px">
                                                                                                    <p
                                                                                                        style="Margin:0;font-family:Poppins,sans-serif;line-height:21px;color:#000000;font-size:14px">
                                                                                                        Discount:</p>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td align="right"
                                                                                                    class="m_-7339135599507116636es-m-txt-l"
                                                                                                    style="padding:0;Margin:0;padding-bottom:5px">
                                                                                                    <p
                                                                                                        style="Margin:0;font-family:Poppins,sans-serif;line-height:21px;color:#000000;font-size:14px">
                                                                                                        Addons Total:</p>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td align="right"
                                                                                                    class="m_-7339135599507116636es-m-txt-l"
                                                                                                    style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px">
                                                                                                    <h3
                                                                                                        style="Margin:0;line-height:24px;font-family:Poppins,sans-serif;font-size:20px;font-style:normal;font-weight:bold;color:#000000">
                                                                                                        TOTAL:</h3>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                                <td style="padding:0;Margin:0;width:20px"></td>
                                                                <td valign="top" style="padding:0;Margin:0">
                                                                    <table cellpadding="0" cellspacing="0"
                                                                        class="m_-7339135599507116636es-right"
                                                                        align="right"
                                                                        style="border-collapse:collapse;border-spacing:0px;float:right">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="left"
                                                                                    style="padding:0;Margin:0;width:270px">
                                                                                    <table cellpadding="0"
                                                                                        cellspacing="0" width="100%"
                                                                                        role="presentation"
                                                                                        style="border-collapse:collapse;border-spacing:0px">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td align="left"
                                                                                                    style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px">
                                                                                                    <p
                                                                                                        style="Margin:0;line-height:21px;color:#000000;font-size:14px">
                                                                                                        ${{ number_format($order->subtotal, 2, '.', ',') }}</p>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td align="left"
                                                                                                    style="padding:0;Margin:0;padding-bottom:5px">
                                                                                                    <p
                                                                                                        style="Margin:0;line-height:21px;color:#000000;font-size:14px">
                                                                                                        ${{ number_format($order->total_discount, 2, '.', ',') }}</p>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td align="left"
                                                                                                    style="padding:0;Margin:0;padding-bottom:5px">
                                                                                                    <p
                                                                                                        style="Margin:0;line-height:21px;color:#000000;font-size:14px">
                                                                                                        ${{ number_format($order->addons_total, 2, '.', ',') }}</p>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td align="left"
                                                                                                    style="padding:0;Margin:0;padding-bottom:5px">
                                                                                                    <p
                                                                                                        style="Margin:0;line-height:24px;font-size:20px;font-style:normal;font-weight:bold;color:#000000;padding-top:3px">
                                                                                                        ${{ number_format($order->grand_total, 2, '.', ',') }}</p>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>

                                                                        </tbody>
                                                                    </table>
                                                                </td>

                                                            </tr>

                                                        </tbody>
                                                    </table>
                                            <tr>
                                                <td>
                                                    <div
                                                        style="width: 97.5%; height: 0px; background-color:#EA6A10; padding: 8px; margin: 20px 0;">
                                                    </div>
                                                </td>
                                            </tr>
                                </td>

                            </tr>
                            <tr>
                                <td align="center" style="font-size: 20px; padding: 15px;">
                                    CONNECT WITH US
                                </td>
                            </tr>
                            <tr></tr>
                            <tr>
                            <tr>
                                <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;"
                                    align="left">
                                    <div align="center">
                                        <div style="display: table; max-width:167px;">
                                            <table align="left" border="0" cellspacing="0" cellpadding="0"
                                                width="32" height="32"
                                                style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 10px">
                                                <tbody>
                                                    <tr style="vertical-align: top">
                                                        <td align="left" valign="middle"
                                                            style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                                                            <a href="https://facebook.com/" title="Facebook"
                                                                target="_blank">
                                                                <img src="https://cdn.tools.unlayer.com/social/icons/circle/facebook.png"
                                                                    alt="Facebook" title="Facebook" width="32"
                                                                    style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <table align="left" border="0" cellspacing="0" cellpadding="0"
                                                width="32" height="32"
                                                style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 10px">
                                                <tbody>
                                                    <tr style="vertical-align: top">
                                                        <td align="left" valign="middle"
                                                            style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                                                            <a href="https://linkedin.com/" title="LinkedIn"
                                                                target="_blank">
                                                                <img src="https://cdn.tools.unlayer.com/social/icons/circle/linkedin.png"
                                                                    alt="LinkedIn" title="LinkedIn" width="32"
                                                                    style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <table align="left" border="0" cellspacing="0" cellpadding="0"
                                                width="32" height="32"
                                                style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 10px">
                                                <tbody>
                                                    <tr style="vertical-align: top">
                                                        <td align="left" valign="middle"
                                                            style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                                                            <a href="https://instagram.com/" title="Instagram"
                                                                target="_blank">
                                                                <img src="https://cdn.tools.unlayer.com/social/icons/circle/instagram.png"
                                                                    alt="Instagram" title="Instagram" width="32"
                                                                    style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <table align="left" border="0" cellspacing="0" cellpadding="0"
                                                width="32" height="32"
                                                style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 0px">
                                                <tbody>
                                                    <tr style="vertical-align: top">
                                                        <td align="left" valign="middle"
                                                            style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                                                            <a href="https://youtube.com/" title="YouTube"
                                                                target="_blank">
                                                                <img src="https://cdn.tools.unlayer.com/social/icons/circle/youtube.png"
                                                                    alt="YouTube" title="YouTube" width="32"
                                                                    style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;"
                                    align="left">
                                    <div
                                        style="color: #333333; line-height: 150%; text-align: center; word-wrap: break-word;">
                                        <p style="font-size: 14px; line-height: 150%;"><span
                                                style="font-family: Lato, sans-serif; font-size: 14px; line-height: 21px;">Lorem
                                                ipsum dolor sit amet, consectetur adipiscing elit, </span></p>
                                        <p style="font-size: 14px; line-height: 150%;"><span
                                                style="font-family: Lato, sans-serif; font-size: 14px; line-height: 21px;">sed
                                                do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span>
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;"
                                    align="left">
                                    <div
                                        style="color: #34495e; line-height: 140%; text-align: center; word-wrap: break-word;">
                                        <p style="font-size: 14px; line-height: 140%;"><span
                                                style="font-family: Lato, sans-serif; font-size: 14px; line-height: 19.6px;">©
                                                All rights reserved The Diners Club</span></p>
                                    </div>
                                </td>
                            </tr>
            </tr>

        </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
</body>
</html>
