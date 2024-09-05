<template>
    <form @submit.prevent="submit" class="p-0 sm:w-64">
        <input type="text" v-model="value" placeholder="Busca por el SKU ó Descripción"
            class="w-full bg-slate-50 sm:rounded-none border-0 text-slate-500 placeholder:text-slate-300 rounded  py-5 focus:outline-none focus:border-o focus:ring-0 sm:mr-4 text-center" />
    </form>
</template>
<script>
export default {
    data() {
        return {
            value: '',
        }
    },
    methods:
    {
        submit() {
            console.log('submit..')
            EventBus.$emit("search-value-added", this.value);
        }
    }
};
</script>
