<template>
    <layout-component>
        <div class="md:w-11/12 mx-auto grid grid-cols-8 gap-4 grid-flow-col auto-cols-auto auto-rows-auto"
            v-can="'create role'">
            <create-new-role class="col-span-3" :roles="roles">
            </create-new-role>
            <permission-list class="col-span-5" :permissions="permissions">
            </permission-list>
        </div>
    </layout-component>
</template>
<script>
import CreateNewRole from "./CreateNewRole.vue"
import PermissionList from "./PermissionList.vue"
export default {
    components: { CreateNewRole, PermissionList },
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
