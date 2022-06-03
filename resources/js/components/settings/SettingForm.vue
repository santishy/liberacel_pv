<template>
    <form v-if="form.name" >
        <div class="w-full">
            <span>Nombre</span>
            <span></span>
        </div>
        <div class="w-full">
            <label>Valor</label>
            <input type="text" 
                v-model="form.value" 
                placeholder="Nuevo valor" 
                class="px-4 py-2 bg-gray-300"
            />
        </div>
    </form>
</template>

<script>
export default {
    data(){
        return {
            form:{}
        }
    },
    
    
};
</script>
