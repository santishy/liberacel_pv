<template>
    <nav-component>
        <div class="p-2 flex flex-wrap items-baseline md:w-9/12 mx-auto bg-white shadow-sm rounded">
            <h3 class="p-2 text-center w-full font-mono text-2xl">Crear venta</h3>
            <fast-sale-form></fast-sale-form>
        </div>
    </nav-component>
</template>
<script>

import NavComponent from "../NavComponent.vue";
import FastSaleForm from "./FastSaleForm.vue";

export default {
    components: {
        NavComponent,
        FastSaleForm
    }
};
</script>