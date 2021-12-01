<template>
    <nav-component>
        <div class="container mx-auto flex justify-center">
            <div class="text-center bg-white rounded-sm shadow-sm p-8 w-1/3">
                Bienvenido {{ user.name }}
            </div>
        </div>
    </nav-component>
</template>

<script>
import NavComponent from "./NavComponent.vue";
export default {
    components: {
        NavComponent
    }
};
</script>
