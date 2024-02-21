<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{trans('labels.print')}}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{Helper::admininfo()->favicon}}"><!-- Favicon icon -->
    <style type="text/css">
        body {
            width: 88mm;
            height: 100%;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            --webkit-font-smoothing: antialiased;
        }
        #printDiv {
            font-weight: 600;
            margin: 0;
            padding: 0;
            background: #ffffff;
        }
        #printDiv div,
        #printDiv p,
        #printDiv a,
        #printDiv li,
        #printDiv td {
            -webkit-text-size-adjust: none;
        }
        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }
        @media print {
            @page {
                margin: 0;
            }
            body {
                margin: 1.6cm;
            }
            #btnPrint {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div id="printDiv">
        <div class="">
            <table width="90%" border="0" cellpadding='2' cellspacing="2" align="center" bgcolor="#ffffff" style="padding-top:4px;">
                <tbody>
                    <tr>
                        <td style="font-size: 15px;color: #fffffff; font-family: 'Open Sans', sans-serif; line-height:18px; vertical-align: bottom; text-align: center;">
                            <h3 style="margin-top: 2px;margin-bottom: 2px;">{{Helper::webinfo(Auth::user()->id)->website_title}}</h3>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 13px;color: #fffffff; font-family: 'Open Sans', sans-serif; line-height:18px; vertical-align: bottom; text-align: center;">
                            #{{$order->order_number}}
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 13px;color: #fffffff; font-family: 'Open Sans', sans-serif; line-height:18px; vertical-align: bottom; text-align: center;">
                            {{ trans('labels.order_type') }} : {{ $order->order_type == '1' ? trans('labels.delivery') : trans('labels.pickup') }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">
                <tbody>
                    <tr>
                        <td style="font-size: 12px; color: #fffffff;  font-family: 'Open Sans', sans-serif; line-height:18px; vertical-align: bottom; text-align: center;">
                            {{trans('labels.name')}} : {{$order->customer_name}}
                            <br>{{trans('labels.email')}} : {{$order->customer_email}}
                            <br>{{trans('labels.mobile')}} : {{$order->mobile}}
                            @if($order->order_type == 1)
                            <br> {{trans('labels.address')}} : {{$order->address}}
                            @endif

                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- /Header -->
            <!-- Table Total -->
            <table width="90%" border="0" cellpadding="2" cellspacing="2" align="center" class="fullPadding">
                <tbody>
                    @if ($order->order_notes != "")
                    <div style="padding: 5px 10px 5px 15px;">
                        <h5 style="margin-top: 2px;margin-bottom: 2px;">{{trans('labels.notes')}} : <small style="color: gray">{{$order->order_notes}}</small></h5>
                    </div>
                    @endif

                    <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center" style="padding-top:2px">
                        <thead>
                            <tr>
                                <th style="font-size:15px;font-family:'Open Sans',sans-serif;color:#fffffff;font-weight:normal;line-height:1;vertical-align:top;padding-bottom:5px;text-align:left;" width="50%">{{trans('labels.item')}}</th>
                                <th style="font-size:15px;font-family:'Open Sans',sans-serif;color:#fffffff;font-weight:normal;line-height:1;vertical-align:top;padding-bottom:5px;text-align:right;" width="10%">{{trans('labels.qty')}}</th>
                                <th style="font-size:15px;font-family:'Open Sans',sans-serif;color:#fffffff;font-weight:normal;line-height:1;vertical-align:top;padding-bottom:5px;text-align:right;" width="40%">{{trans('labels.total')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orderdetails as $odata)
                            <tr>
                                <td style="font-size:15px;font-family:'Open Sans',sans-serif;color:#fffffff;line-height:1;vertical-align:top;padding-bottom:5px;text-align:left;" width="50%">
                                    @if ($odata->variants_id != "")
                                    {{$odata->item_name}} - {{$odata->variants_name}}
                                    @else

                                    {{$odata->item_name}}
                                    @endif


                                    @if ($odata->extras_id != "")
                                    <?php

                                    $extras_id = explode(",", $odata->extras_id);
                                    $extras_name = explode(",", $odata->extras_name);
                                    $extras_price = explode(",", $odata->extras_price);
                                    ?>
                                    @foreach($extras_id as $key => $addons)
                                    <b>{{$extras_name[$key]}}</b> : {{Helper::currency_format($extras_price[$key],Auth::user()->id)}}<br>
                                    @endforeach

                                    @endif


                                </td>
                                <td style="font-size:15px;font-family:'Open Sans',sans-serif;color:#fffffff;=line-height:1;vertical-align:top;padding-bottom:5px;text-align:right;" width="10%">{{$odata->qty}}</td>
                                <td style="font-size:15px;font-family:'Open Sans',sans-serif;color:#fffffff;line-height:1;vertical-align:top;padding-bottom:5px;text-align:right;" width="40%">
                                    @if ($odata->variants_id != "")
                                    {{Helper::currency_format($odata->qty*$odata->variants_price,Auth::user()->id)}}
                                    @else

                                    {{Helper::currency_format($odata->qty*$odata->price,Auth::user()->id)}}
                                    @endif

                                </td>
                            </tr>
                            <?php

                            $data[] = array(
                                "total_price" => $odata->qty * $odata->price,
                            );
                            $order_total = array_sum(array_column(@$data, 'total_price'));
                            ?>
                            @endforeach

                        </tbody>
                    </table>
                    <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">
                        <tbody>
                            <tr>
                                <td style="font-size: 15px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right;" width="70%"><strong>{{trans('labels.sub_total')}}</strong></td>
                                <td style="font-size: 15px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right;" width="30%"><strong>{{Helper::currency_format($order_total,Auth::user()->id)}}</strong></td>
                            </tr>
                            <tr>
                                <td style="font-size: 15px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right;" width="70%"><strong>{{trans('labels.tax')}}</strong></td>
                                <td style="font-size: 15px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right;" width="30%"><strong>{{Helper::currency_format($order->tax_amount,Auth::user()->id)}}</strong></td>
                            </tr>
                            @if ($order->discount_amount > 0 && $order->discount_amount != 'NaN')
                            <tr>
                                <td style="font-size: 15px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right;" width="70%"><strong>{{trans('labels.discount')}} {{ $order->offer_code != "" ? '('.$order->offer_code.')' : '' }}</strong></td>
                                <td style="font-size: 15px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right;" width="30%"><strong>{{Helper::currency_format($order->discount_amount,Auth::user()->id)}}</strong></td>
                            </tr>
                            @endif

                            @if ($order->delivery_charge > 0)
                            <tr>
                                <td style="font-size: 15px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right;" width="70%"><strong>{{trans('labels.delivery_charge')}}</strong></td>
                                <td style="font-size: 15px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right;" width="30%"><strong>{{Helper::currency_format($order->delivery_charge,Auth::user()->id)}}</strong></td>
                            </tr>
                            @endif

                            <tr>
                                <td style="font-size: 15px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right;" width="70%"><strong>{{trans('labels.grand_total')}}</strong></td>
                                <td style="font-size: 15px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right;" width="30%"><strong>{{Helper::currency_format($order->grand_total,Auth::user()->id)}}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </tbody>
            </table>
        </div>
    </div>
    <button id="btnPrint" class="hidden-print center">{{trans('labels.print')}}</button>
    <script>
        const $btnPrint = document.querySelector("#btnPrint");
        $btnPrint.addEventListener("click", () => {
            window.print();
        });
    </script>
</body>