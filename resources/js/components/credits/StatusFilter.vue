<template>
    <ul class="flex sm:flex-wrap sm:gap-4 gap-2 sm:flex-row flex-col w-full sm:w-auto">
        <li class="sm:w-auto w-full bg-red-50">
            <input type="radio" id="pending" name="filter" @input="getParams(pending)" class="hidden peer">
            <label for="pending"
                class="inline-flex items-center justify-between w-full p-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 ">
                <div class="block">
                    <div class="w-full text-xs font-semibold">STATUS</div>
                    <div class="w-full ">PENDIENTE</div>
                </div>
                <svg fill="none" class="w-6 h-6 ml-4" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 4.5h14.25M3 9h9.75M3 13.5h9.75m4.5-4.5v12m0 0l-3.75-3.75M17.25 21L21 17.25"></path>
                </svg>
            </label>
        </li>
        <li class="sm:w-auto w-full bg-red-50">
            <input type="radio" id="paid" name="filter" @input="getParams(paid)" class="hidden peer">
            <label for="paid"
                class="inline-flex items-center justify-between w-full p-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer  peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 ">
                <div class="block">
                    <div class="w-full text-xs font-semibold">STATUS</div>
                    <div class="w-full">PAGADO</div>
                </div>
                <svg fill="none" class="w-6 h-6 ml-4" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 4.5h14.25M3 9h9.75M3 13.5h9.75m4.5-4.5v12m0 0l-3.75-3.75M17.25 21L21 17.25"></path>
                </svg>
            </label>
        </li>
        <li class="sm:w-auto w-full bg-red-50">
            <input type="radio" id="cancelled" name="filter" @input="getParams(cancelled)" class="hidden peer">
            <label for="cancelled"
                class="inline-flex items-center justify-between w-full p-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer  peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100">
                <div class="block">
                    <div class="w-full text-xs font-semibold">STATUS</div>
                    <div class="w-full">CANCELADO</div>
                </div>
                <svg fill="none" class="w-6 h-6 ml-4" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 4.5h14.25M3 9h9.75M3 13.5h9.75m4.5-4.5v12m0 0l-3.75-3.75M17.25 21L21 17.25"></path>
                </svg>
            </label>
        </li>
    </ul>
</template>
<script>
export default {
    data() {
        return {
            cancelled: {
                "filter[withStatus]": "cancelled"
            },
            paid: {
                "filter[withStatus]": "paid"
            },
            pending: {
                "filter[withStatus]": "pending"
            }
        }
    },
    methods: {
        getParams(params) {
            EventBus.$emit('filter-credits', params);
        }
    }
}
</script>
