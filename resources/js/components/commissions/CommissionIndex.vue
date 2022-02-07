<template>
    <nav-component>
        <div  class="w-full px-4 mx-auto mt-24 md:mt-32 flex" v-can="'view commissions'">
            <div class="w-3/12">
                <commission-list :users="users"></commission-list>
            </div>
        </div>
    </nav-component>
</template>

<script>

import NavComponent from "../NavComponent.vue";
import CommissionList from "./CommissionList.vue";
export default {
    components: { NavComponent, CommissionList },
    props: {
        users: {
            type: Array
        }
    }
};
</script>