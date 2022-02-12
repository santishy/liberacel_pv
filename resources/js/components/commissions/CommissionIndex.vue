<template>
    <nav-component>
        <div  class="w-full px-4 mx-auto mt-24 md:mt-32 flex" v-can="'view commissions'">
            <div class="w-3/12">
                <user-list :users="users"></user-list>
            </div>
        </div>
    </nav-component>
</template>

<script>

import NavComponent from "../NavComponent.vue";
import UserList from "./UserList.vue";
export default {
    components: { NavComponent, UserList },
    props: {
        users: {
            type: Array
        }
    }
};
</script>