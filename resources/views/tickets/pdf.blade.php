<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota #{{$sale->id}}</title>
    <style type="text/css">
       
        html, body {
            margin:0%;
            margin-right: 4pt;
            margin-left: 4pt;
        }
        table {
            border-collapse: collapse !important; 
            border-spacing: 0 !important;
            display: table;
            width: 100%;
        }
        *,::before,::after{
            box-sizing: border-box;
            border-width: 0;
            border-style: solid;
            border-color:currentColor;
        }
        table::before{
            box-sizing: border-box;
            border-width: 0;
            border-style: solid;
            border-color: #e2e8f0;
        }
        table::after{
            box-sizing: border-box;
            border-width: 0;
            border-style: solid;
            border-color: #e2e8f0;
        }
        
        .border-gray-400 {
            border-color: #cbd5e0;     
        }
        .bg-gray-400 {
            background-color: #cbd5e0; 
        }
        .text-center {
            text-align: center;
        }
        .text-xl{
            font-size: 18px;
        }
        .text-left{
            text-align: left;
        }
        .text-right{
            text-align: right;
        }
        .text-sm{
            font-size: 0.7em;
        }
        .text-justify{
            text-align: justify;
        }
        .text-xs{
            font-size: 0.5em;
        }
        .mt-2{
            margin-top: 2em;
        }
        .mt-1{
            margin-top: 1em;
        }
        .mt-0{
            margin-top: 0px;
        }
        .m-0{
            margin:0%;
        }
        .mb-0{
            margin-bottom: 0px !important;
        }
        .mb-1 {
            margin-bottom: 0.25rem;
        }
        .mb-2 {
            margin-bottom: .5rem;
        }
        .mb-4{
            margin-bottom:1rem;
        }
        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }
        .border {
            border-width: 1px;
        }
        .border-b {
            border-bottom-width: 1px;
        }
        .border-solid {
            border-style: solid;
        }
        .border-black {
            border-color: black;
        }
        .bg-blue-700 {
            background-color: #2529BD;
        }
        .p-1 {
            padding: 0.25rem;
        }

        .p-2 {
            padding: 0.5rem;
        }

        .p-3 {
            padding: 0.75rem;
        }

        .p-4 {
            padding: 1rem;
        }
        .py-0 {
            padding-top: 0px;
            padding-bottom: 0px;
        }

        .py-1 {
            padding-top: 0.25rem;
            padding-bottom: 0.25rem;
        }

        .py-2 {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
        .py-3 {
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }
        .text-xl{
            font-size: 1.5em;
        }
        .rounded {
            border-radius: 0.25rem;
        }
        .table-auto {
            table-layout: auto;
        }
        .px-2 {
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }
    </style>
    <script type="text/javascript">
        document.querySelector('#fecha').style.background='blue';
    </script>
</head>
<body>
    <div class="p-1">
        <div id="fecha" class="text-right text-sm mt-2">
            {{$now}}
        </div>
        <h1 class="text-xl text-center m-1 mb-0">{{$ticketConfig->company}}</h1>
        <div class="mb-4 ">
            <p class="mb-0 text-center  ">
                <span>Tel: </span> {{$ticketConfig->phone_number}}
            </p>
            <p class="mb-0 p-0 mt-0  text-center ">
                <span>Dire: </span> {{$ticketConfig->address}}
            </p>
        </div>
        <div 
            style="width: 75%;"
            class="text-center  text-xl rounded border border-black mx-auto"
        >
            Nota #{{$sale->id}}
        </div>
        <table class="mt-1 mb-0 table-auto text-center rounded">
            <thead>
                <tr class="bg-gray-400 px-2">
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $total = 0;
                @endphp
                @foreach ($products as $product )
                    <tr class="text-sm">
                        <td class="border-b border-gray-400 py-1">
                            {{$product->sku}}
                        </td>
                        <td class="border-b border-gray-400 py-1">
                            {{$product->pivot->qty}}
                        </td>
                        <td class="border-b border-gray-400 py-1">
                            {{ $product->pivot->qty * $product->pivot->sale_price}}
                        </td>
                    </tr>
                    @php
                        $total += $product->pivot->qty * $product->pivot->sale_price;
                    @endphp
                @endforeach
                <tr>
                    <td class="bg-gray-400"> TOTAL</td>
                    <td  colspan="2">
                        $
                        {{
                            number_format(
                                $total,
                                2
                            )
                        }}
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="mt-0 mb-0">
            <p style="white-space: pre-line;line-height: 15px" class="text-sm p-4">
                {{$ticketConfig->footer}}
            </p>
        </div>
    </div>
</body>
</html>