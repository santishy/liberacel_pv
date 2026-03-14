<template>
    <layout-component>
        <div class="flex justify-center items-center flex-col w-full px-4">
            <raffle-form method="put"></raffle-form>
        </div>
    </layout-component>
</template>
<script>

import RaffleForm from './RaffleForm.vue';
import { mapMutations } from 'vuex';
export default {
    name: "EditRaffle",
    components: { RaffleForm },
    props: {
        raffle: {
            type: Object,
            required: true
        }
    },
    provide() {
        return { raffleCtx: this.raffleCtx }
    },
    mounted() {
        this.$store.dispatch('inventories/fetchInventories');

    },

    data() {
        return {
            raffleCtx: {
                raffle: this.raffle || null,
            }
        }
    },
    watch: {
        raffle: {
            immediate: true,
            handler(val) {
                this.raffleCtx.raffle = val || null;
            }
        }
    },
    methods: {
        ...mapMutations('raffles', ['setSelectedRaffle'])
    }

}
</script>
