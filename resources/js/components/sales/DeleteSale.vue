<template>
    <button
        class="transition-all rounded border-2 border-red-800 text-red-700 p-1 hover:bg-red-800 hover:text-white"
        @click.prevent="destroy"
    >
        <i class="fas fa-trash"></i> Borrar nota
    </button>
</template>

<script>
export default {
    props: {
        sale: {type:Object},
    },
    methods: {
        destroy() {
            axios.delete("/sales/" + this.sale.id ).then(res => {
                if(res.data.saleDeleted){
                    EventBus.$emit('sale-deleted',res.data.saleDeleted)
                }
            });
        }
    }
};
</script>
