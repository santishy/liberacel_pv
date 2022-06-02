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
    </nav-component>
</template>

<script>
import NavComponent from "../NavComponent.vue";
import SettingList from "./SettingList.vue";

export default {
    components: {
        NavComponent,
        SettingList,
    },
    props: {
        settings: {
            type: Array,
        },
    },
};
</script>
