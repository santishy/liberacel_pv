<template>
    <layout-component>
        <div
            class="
                w-full
                flex
                justify-center
                bg-transparent

            "
        >
            <setting-list :settings="settings"></setting-list>
        </div>
        <information-component>
            <template slot="title"> Editar Dato </template>
            <setting-form
            ></setting-form>
        </information-component>
    </layout-component>
</template>

<script>
//import NavComponent from "../NavComponent.vue";
import SettingList from "./SettingList.vue";
import SettingForm from "./SettingForm.vue";
import InformationComponent from "../modals/InformationComponent.vue";
export default {
    components: {
      //  NavComponent,
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
