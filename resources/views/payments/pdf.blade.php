<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @php
        $payment = json_decode($payment);
    @endphp

    <title>Pago #{{ $payment->id }}</title>
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

        .font-bold {
            font-weight: 700;
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

        .rounded {
            border-radius: 0.25rem;
        }

        .rounded-sm {
            border-radius: 0.125rem;
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
        <div id="fecha" class="text-right text-sm mt-2">
            {{ $now }}

        </div>
        <h1 class="text-xl text-center m-1 mb-0">{{ $ticketConfig->company }}</h1>
        <div class="mb-2">
            <p class="mb-0 text-center  ">
                <span>Tel: </span> {{ $ticketConfig->phone_number }}
            </p>
            <p class="mb-0 p-0 mt-0  text-center ">
                <span>Dire: </span> {{ $ticketConfig->address }}
            </p>
        </div>
        <div style="width: 95%;" class="p-1 mx-auto">
            <div class="mb-1"><span class="font-bold">Cliente: </span> {{ $payment->client->name }}</div>
            <div><span class="font-bold">Tel: </span> {{ $payment->client->phone_number }}</div>
        </div>
        <table class="mt-1 mb-0 table-auto rounded">
            <tbody>
                <tr class="py-1 border px-2">
                    <th class="px-2 text-left">Monto</th>
                    <td class="px-2 text-left">
                        {{ $payment->currency_amount }}
                    </td>
                </tr>
                <tr class="py-1 border px-2 ">
                    <th class="px-2 text-left">Total pagado</th>
                    <td class="px-2 text-left">
                        {{ $payment->credit->formatted_amount_paid }}
                    </td>
                </tr>
                <tr class="py-1 border px-2">
                    <th class="px-2 text-left">Saldo</th>
                    <td class=" px-2 text-left">
                        {{ $payment->credit->total_amount_formatted }}
                    </td>
                </tr>

            </tbody>
        </table>
        <div class="mt-0 mb-0">
            <pre style="white-space: pre-line;line-height: 15px" class="text-sm p-4">
                {{ $ticketConfig->footer }}
            </pre>
        </div>
    </div>
</body>

</html>
