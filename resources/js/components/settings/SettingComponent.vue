<template>
    <nav-component>
        <div
            class="
                w-full
                px-4
                flex
                justify-center
                bg-transparent
                md:mt-32
                mt-24
            "
        >
            <setting-list :settings="settings"></setting-list>
        </div>
        <information-component>
            <template slot="title"> Editar Dato </template>
            <setting-form
            ></setting-form>
        </information-component>
    </nav-component>
</template>

<script>
import NavComponent from "../NavComponent.vue";
import SettingList from "./SettingList.vue";
import SettingForm from "./SettingForm.vue";
import InformationComponent from "../modals/InformationComponent.vue";
export default {
    components: {
        NavComponent,
        SettingList,
        InformationComponent,
        SettingForm,
    },
    props: {
        settings: {
            type: Array,
        },
    },
    
};
</script>
