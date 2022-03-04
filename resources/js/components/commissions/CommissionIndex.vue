<template>
    <nav-component>
        <div
            class="w-full px-4 mx-auto mt-24 md:mt-32 flex"
            v-can="'view user commissions'"
        >
            <div class="w-3/12">
                <user-list :users="users"></user-list>
            </div>
            <div class="w-full ml-0 md:ml-2">
                <commission-list></commission-list>
            </div>
        </div>
    </nav-component>
</template>

<script>
import NavComponent from "../NavComponent.vue";
import UserList from "./UserList.vue";
import CommissionList from "./CommissionList.vue";
export default {
    components: { NavComponent, UserList, CommissionList },
    props: {
        users: {
            type: Array,
        },
    },
};
</script>
