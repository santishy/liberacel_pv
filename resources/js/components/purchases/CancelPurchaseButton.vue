<template>
    <button
        class="rounded px-4 py-1 bg-red-600 hover:bg-red-400 text-white"
        @click="cancelPurchase"
    >
        <i class="far fa-times-circle"></i> Cancelar compra
    </button>
</template>
<script>
export default {
    data(){
        return {
            inventory_id:null
        }
    },
    props: {
        id: {
            type: Number
        }
    },
    mounted(){
        console.log(this.transaction)
        EventBus.$on('selected-inventory',(id)=>{
            this.inventory_id = id;
        })
    },
    methods: {
        cancelPurchase() {
            axios
                .delete("/purchases/" + this.id,{
                    params:{
                        inventory_id:this.inventory_id,
                        factor:-1
                    }
                })
                .then(res => {
                    if (res.data.status == "cancelled") {
                        localStorage.removeItem('productsInPurchase');
                        window.location.replace("/products");
                    }
                })
                .catch(err => {
                    this.getErrors(err);
                });
        }
    }
};
</script>
