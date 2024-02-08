<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota #{{ $sale->id }}</title>
    <style type="text/css">
        html,
        body {
            margin: 0%;
            margin-right: 4pt;
            margin-left: 4pt;
        }

        table {
            border-collapse: collapse !important;
            border-spacing: 0 !important;
            display: table;
            width: 100%;
        }

        *,
        ::before,
        ::after {
            box-sizing: border-box;
            border-width: 0;
            border-style: solid;
            border-color: currentColor;
        }

        table::before {
            box-sizing: border-box;
            border-width: 0;
            border-style: solid;
            border-color: #e2e8f0;
        }

        table::after {
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

        .flex {
            display: flex;
        }

        .justify-center {
            justify-content: center;
        }

        .text-center {
            text-align: center;
        }

        .text-xl {
            font-size: 18px;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-sm {
            font-size: 0.7em;
        }

        .text-justify {
            text-align: justify;
        }

        .text-xs {
            font-size: 0.5em;
        }

        .mt-2 {
            margin-top: 2em;
        }

        .mt-1 {
            margin-top: 1em;
        }

        .mt-0 {
            margin-top: 0px;
        }

        .m-0 {
            margin: 0%;
        }

        .mb-0 {
            margin-bottom: 0px !important;
        }

        .mb-1 {
            margin-bottom: 0.25rem;
        }

        .mb-2 {
            margin-bottom: .5rem;
        }

        .mb-4 {
            margin-bottom: 1rem;
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

        .text-xl {
            font-size: 1.5em;
        }

        .text-sm {
            font-size: 0.875rem
                /* 14px */
            ;
            line-height: 1.25rem
                /* 20px */
            ;
        }

        .text-center {
            text-align: center;
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
        document.querySelector('#fecha').style.background = 'blue';
    </script>
</head>

<body>
    <div class="p-1">
        <div id="fecha" class="text-right text-sm">
            {{ $now }}
        </div>
        <h1 class="text-xl text-center m-1 mb-0">{{ $ticketConfig->company }}</h1>
        <div class="mb-4 ">
            <p class="mb-0 text-center  ">
                <span>Tel: </span> {{ $ticketConfig->phone_number }}
            </p>
            <p class="mb-0 p-0 mt-0  text-center ">
                <span>Dire: </span> {{ $ticketConfig->address }}
            </p>

        </div>
        <div style="width: 75%;" class="text-center  text-xl rounded border border-black mx-auto">
            Nota #{{ $sale->id }}
        </div>
        <div class="mb-2 mt-1 flex justify-center text-center">{!! DNS1D::getBarcodeHTML("$typeOfSale-$sale->id", 'C128', 1, 20) !!}</div>
        <table class="mt-1 mb-0 table-auto text-center rounded">
            <thead>
                <tr class="bg-gray-400 px-2">
                    <th>Cod.</th>
                    <th>Prod.</th>
                    <th>Cant.</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @if ($typeOfSale == 'stock')
                    @include('tickets.sale-table')
                @elseif($typeOfSale == 'express')
                    @include('tickets.fast-sale-table')
                @endif
            </tbody>
        </table>
        <div class="mt-0 mb-0">
            <pre style="white-space: pre-line;" class="text-sm">
                {{ $ticketConfig->footer }}
            </pre>
        </div>
        <div class="p-1 text-sm font-bold border-b text-center">
            {{ $user->name }}
        </div>
    </div>
</body>

</html>
