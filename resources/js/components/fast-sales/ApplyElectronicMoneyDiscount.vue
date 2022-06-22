<template>
    <form @submit.prevent="submit">
        <button>Aplicar Descuento</button>
    </form>
</template>

<script>
import {mapState} from 'vuex'
export default
{
    methods:{
        async submit(){
            
        }
    },
    computed:{
        ...mapState(["currentFastSale"])
    }
}
</script>
