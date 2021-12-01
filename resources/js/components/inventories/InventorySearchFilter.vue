<template>
    <form @submit.prevent="submit">
        <input
            type="text"
            v-model="value"
            placeholder="Busca por el SKU ó Descripción"
            class="w-full  border-l-4 border-purple-500 appearance-none py-5 pl-64 leading-tight focus:outline-none mr-4 text-center"
        />
    </form>
</template>
<script>
export default {
    data(){
        return {
            value:'',
        }
    },
    methods: 
    {
        submit()
        {
            console.log('submit..')
            EventBus.$emit("search-value-added",this.value);
        }
    }
};
</script>
