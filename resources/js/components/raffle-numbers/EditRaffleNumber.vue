<template>
    <layout-component>
        <div class="flex justify-center items-center flex-col w-full px-4">
            <raffle-number-form method="put" />
        </div>
    </layout-component>
</template>
<script>

import RaffleNumberForm from './RaffleNumberForm.vue';

export default {
    name: "EditRaffle",
    components: { RaffleNumberForm },
    props: {
        raffleNumber: {
            type: Object,
            required: true
        }
    },
    provide() {
        return { raffleNumberCtx: this.raffleNumberCtx }
    },
    mounted() {
        //this.$store.dispatch('inventories/fetchInventories');

    },

    data() {
        return {
            raffleNumberCtx: {
                raffleNumber: this.raffleNumber || null,
            }
        }
    },
    watch: {
        raffleNumber: {
            immediate: true,
            handler(val) {
                this.raffleNumberCtx.raffle = val || null;
            }
        }
    },

}
</script>
