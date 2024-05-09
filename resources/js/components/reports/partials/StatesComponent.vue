<template>
    <div class="flex flex-wrap gap-4">
        <div>
            <input type="radio" @change="handleStatusChange" value="completed" :checked="true" id="completed_status"
                v-model="selectedOption" name="filter" class="hidden peer">
            <label for="completed_status"
                class="flex gap-2 items-center justify-around w-full p-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:bg-slate-700 peer-checked:text-white hover:text-gray-600 hover:bg-gray-100 ">
                <div class="block">
                    <div class="w-full text-sm leading-tight"><span class="font-bold">Status:</span> Completado</div>
                </div>
                <svg class="w-6 h-6 text-emerald-500" data-slot="icon" fill="none" stroke-width="1.5"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                </svg>
            </label>
        </div>
        <div>
            <input type="radio" @change="handleStatusChange" value="pending" v-model="selectedOption"
                id="pending_status" name="filter" class="hidden peer">
            <label for="pending_status"
                class="flex items-center justify-around w-full p-2 gap-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:bg-slate-700 peer-checked:text-white hover:text-gray-600 hover:bg-gray-100 ">
                <div class="block">
                    <div class="w-full text-sm leading-tight"><span class="font-bold">Status:</span> Pendiente</div>
                </div>
                <svg data-slot="icon" class="w-6 h-6  text-yellow-500" fill="none" stroke-width="1.5"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z">
                    </path>
                </svg>
            </label>
        </div>
        <div>
            <input type="radio" @change="handleStatusChange" value="cancelled" id="cancelled_status"
                v-model="selectedOption" name="filter" class="hidden peer">
            <label for="cancelled_status"
                class="flex gap-2 items-center justify-around w-full p-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:bg-slate-700 peer-checked:text-white hover:text-gray-600 hover:bg-gray-100 ">
                <div class="block">
                    <div class="w-full text-sm leading-tight"><span class="font-bold">Status:</span> Cancelado</div>
                </div>
                <svg data-slot="icon" class="w-6 h-6 text-red-500" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                </svg>
            </label>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            selectedOption: 'completed'
        }
    },
    methods: {
        handleStatusChange() {
            EventBus.$emit('changed-status', this.selectedOption)
        }
    }
}
</script>
