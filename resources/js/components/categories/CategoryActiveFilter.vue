<template>
    <form @submit.prevent="submit">
        <input type="hidden" v-model="active"/>
        <button>{{ getButtonText }}</button>
    </form>
</template>

<script>
export default {
data(){
    return {
        active:false,
    }
},

computed:{
    getButtonText(){
        return this.active ? "Categorías Activas" : "Categorías Desactivadas";
    }
}
}
</script>