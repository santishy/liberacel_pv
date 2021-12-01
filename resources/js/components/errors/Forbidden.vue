<template>
    <nav-component>
        <div
            class="mt-24 md:mt-32 md:w-1/3 w-full mx-auto bg-orange-400 rounded shadow-md p-8 flex fex-wrap justify-center items-center flex-col"
        >
            <i class="fas fa-lock text-gray-700  text-6xl mb-4"></i>
            <h3 class="w-full text-3xl text-center text-gray-700">
                Acción no permitida
            </h3>
        </div>
    </nav-component>
</template>
<script>
import NavComponent from "../NavComponent.vue";
export default {
    components: { NavComponent }
};
</script>
