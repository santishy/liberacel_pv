<template>
    <div class="bg-white rounded-sm shadow-md p-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">{{ saleDetails?.client_name }}</h2>
            <span class="text-sm text-gray-600">{{ saleDetails.created_at }}</span>
        </div>
        <div>
            <span class="text-sm text-gray-600">Tipo de venta: </span>
            <span class="text-sm font-semibold capitalize text-gray-700">{{ saleDetails.typeOfSale }}</span>
        </div>
        <div>
            <span class="text-sm text-gray-600">Nota #:</span>
            <span class="text-lg font-semibold text-gray-900">#{{ saleDetails.id }}</span>
        </div>
        <div>
            <span class="text-sm text-gray-600">Status: </span>
            <span class="text-sm font-semibold capitalize text-blue-600">{{ saleDetails.status }}</span>
        </div>
        <div class="mt-2">
            <span class="text-sm text-gray-600">Total: </span>
            <span class="text-lg font-semibold text-green-600">${{ saleDetails.total }}</span>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        saleDetails: {
            type: Object,
        }
    },
}
</script>
