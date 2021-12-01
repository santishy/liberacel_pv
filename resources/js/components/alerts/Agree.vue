<template>
    <button @click="action" class="transition-all rounded border-2 border-red-800 text-red-700 p-1 hover:bg-red-800 hover:text-white">
        Aceptar
    </button>
</template>
<script>

export default{
    props:{
        method:{
            type:String
        },
    },
    methods:{
        action(){
            console.log(this.method)
            this.$emit(this.method)
        }
    },
}
</script>
