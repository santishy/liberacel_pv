<template>
    <div class="flex justify-between items-center rounded border-2 border-gray-200 p-2 " @click="changeFilter">
        <h2 class="text-slate-500 font-thin mr-3">Canceladas</h2>
        <div class="w-14 h-8 flex items-center bg-gray-200 rounded-full p-1 duration-300 ease-in-out border border-sky-500"
            :class="{ 'bg-green-400': toggleActive }">
            <div class="bg-white w-6 h-6 rounded-full shadow-md transform duration-300 ease-in-out border border-sky-500"
                :class="{ 'translate-x-6': toggleActive }"></div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            toggleActive: false,
            status: ''
        };
    },
    methods: {
        changeFilter() {
            this.toggleActive = !this.toggleActive;
            this.status = this.toggleActive ? 'cancelled' : 'completed'
            EventBus.$emit("status-filter-cancelled", this.status);
        }
    }
};
</script>
