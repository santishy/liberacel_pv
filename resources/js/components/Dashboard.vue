<template>
    <layout-component>
        <div class="container mx-auto flex justify-center">
            <div class="text-center bg-white rounded-sm shadow-sm p-8 sm:w-1/3 w-svw">
                Bienvenido {{ user.name }}
            </div>
        </div>
    </layout-component>
</template>

<script>
//import NavComponent from "./NavComponent.vue";
export default {
    components: {
        // NavComponent
    }
};
</script>
