<template>
    <form class="grid grid-rows-3 grid-flow-col  w-full" @submit.prevent="submit">
        <div :class="[controlsContainerStyle]">
            <label :class="[labelStyle]">Descripción</label>
            <textarea name="description" :class="[inputStyle]" placeholder="Descripción del producto o servicio"></textarea>
        </div>
        <div :class="controlsContainerStyle">
            <label :class="[labelStyle]">Precio</label>
            <input type="text" name="price" :class="[inputStyle]" placeholder="Precio">
        </div>
        <div :class="[controlsContainerStyle]">
            <label :class="[labelStyle]">Cantidad</label>
            <input type="text" name="qty" :class="[inputStyle]" placeholder="Cantidad de venta">
        </div>
        <div class=" flex justify-center items-center w-full row-span-3 ">
            <button class="h-24 w-24 rounded-full hover:bg-blue-500 bg-blue-700 text-white font-mono font-bold ">Crear</button>
        </div>
        
    </form>
</template>

<script>
export default {
    computed:{
        labelStyle() {
            return " w-3/12 text-right";
        },
        inputStyle() {
            return "shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-7/12 p-2.5 dark:bg-gray-700";
        },
        controlsContainerStyle() {
            return "flex flex-wrap flex-row  justify-center items-center w-full ";
        }
    }
}
</script>