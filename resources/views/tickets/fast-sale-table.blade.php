@php
    $total = 0;
@endphp
@foreach ($products as $product)
    <tr class="text-sm">
        <td class="border-b border-gray-400 ">
            {{ $product['qty'] * $product['commission_amount'] }}
        </td>
        <td class="border-b border-gray-400 py-1">
            {{ $product['description'] }}
        </td>
        <td class="border-b border-gray-400 py-1">
            {{ $product['qty'] }}
        </td>
        <td class="border-b border-gray-400 py-1">
            {{ $product['qty'] * $product['price'] }}
        </td>
    </tr>
    {{-- @php
        $total += $product['qty'] * $product['price'];
    @endphp --}}
@endforeach
<tr>
    <td class="bg-gray-400"> Descuento</td>
    <td colspan="3">
        $
        {{ number_format($sale->electronic_money_discount, 2) }}
    </td>
</tr>
<tr>
    <td class="bg-gray-400"> TOTAL</td>
    <td colspan="3">
        $
        {{ number_format($sale->total, 2) }}
    </td>
</tr>
