<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $sale_id }}</title>
    <style>
        @page {
            margin: 0%;
            padding: 0%;
            width: 62mm;
        }

        .text-slate-700 {
            --tw-text-opacity: 1;
            color: rgb(51 65 85 / var(--tw-text-opacity));

        }

        html,
        body {
            width: 62mm;
            margin: 2px;
            padding: 0%;
        }
    </style>
</head>

<body class="m-0">
    <div class="w-full ">
        <div style="padding:3px 3px 3px 3px" class="border border-black m-0 text-slate-700 ">
            <span style="display:block;text-align:center;margin-bottom:2px;">{{ $type_of_sale }} - {{ $sale_id }}
            </span>
            {!! DNS1D::getBarcodeHTML("$type_of_sale-$sale_id", 'C128') !!}
        </div>
    </div>
</body>

</html>
