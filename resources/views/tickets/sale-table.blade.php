@php
    $total = 0;
@endphp
@foreach ($products as $product)
    <tr class="text-sm">
        <td class="border-b border-gray-400 py-1">
            {{ $product->sku }}
        </td>
        <td class="border-b border-gray-400 py-1">
            {{ $product->pivot->qty }}
        </td>
        <td class="border-b border-gray-400 py-1">
            {{ $product->pivot->qty * $product->pivot->sale_price }}
        </td>
    </tr>
    @php
        $total += $product->pivot->qty * $product->pivot->sale_price;
    @endphp
@endforeach
<tr>
    <td class="bg-gray-400"> TOTAL</td>
    <td colspan="2">
        $
        {{ number_format($total, 2) }}
    </td>
</tr>
