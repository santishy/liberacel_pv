<template>
    <div class="bg-white rounded-sm shadow-md p-4">
        <div class="flex items-center justify-end border-b border-slate-400 pb-2 mb-4">
            <button @click.prevent="cleanCheckout" class="p-1 text-slate-700">
                <svg data-slot="icon" class="w-6 h-6" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
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
    methods: {
        cleanCheckout() {
            EventBus.$emit("clean-checkout");
        }
    }
}
</script>
