<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $product->sku }}</title>
    <style>
        @page {
            margin: 0%;
            padding: 0%;
            width: 62mm;
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
        <div class="border border-black m-0 ">
            {!! DNS1D::getBarcodeHTML("$saleID", 'C128') !!}
        </div>
    </div>
</body>

</html>