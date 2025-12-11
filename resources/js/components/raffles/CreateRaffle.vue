<template>
    <layout-component >
        <div class="flex justify-center items-center flex-col w-full px-4">
            <raffle-form></raffle-form>
        </div>
    </layout-component>
</template>
<script>

import RaffleForm from './RaffleForm.vue';
export default {
    name: "CreateRaffle",
    components: { RaffleForm },
     mounted() {
        this.$store.dispatch('inventories/fetchInventories');
       },

    data() {
        return {  }
    },
    methods: {  }

}
</script>
