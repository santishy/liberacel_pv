<template>
    <nav-component>
        <div
            class="md:w-11/12 mx-auto grid grid-cols-8 gap-4 grid-flow-col auto-cols-auto auto-rows-auto"
            v-can="'create role'"
        >
            <create-new-role class="col-span-3" :roles="roles">
            </create-new-role>
            <permission-list class="col-span-5" :permissions="permissions">
            </permission-list>
        </div>
    </nav-component>
</template>
<script>
import NavComponent from "../NavComponent.vue";
export default {
    components: { NavComponent },
    props: {
        permissions: {
            type: Array
        },
        roles: {
            type: Array
        }
    }
};
</script>
