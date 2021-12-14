<template>
    <nav-component>
        <div
            class="
                p-2
                border-l-4 border-blue-500
                flex flex-wrap
                items-baseline
                md:w-9/12
                mx-auto
                bg-white
                shadow-sm
                rounded
            "
        >
            <h3
                class="
                    p-2
                    border-b border-gray-300
                    text-center
                    w-full
                    font-mono
                    text-2xl
                "
            >
                Crear venta
            </h3>
            <fast-sale-form class="mt-4"></fast-sale-form>
        </div>
        <concepts-list :sale="sale" class="mt-4"></concepts-list>
        <information-component>
            <template slot="title">
                Completar venta
            </template>
            <authentication-form></authentication-form>
        </information-component>
    </nav-component>
</template>
<script>
import InformationComponent from "../modals/InformationComponent.vue";
import AuthenticationForm from "../auth/AuthenticationForm.vue";
import NavComponent from "../NavComponent.vue";
import FastSaleForm from "./FastSaleForm.vue";
import ConceptsList from "./ConceptsList.vue";

export default {
    components: {
        NavComponent,
        FastSaleForm,
        AuthenticationForm,
        InformationComponent,
        ConceptsList,
    },
    props: {
        sale: {
            type: Object,
        },
    },
};
</script>
