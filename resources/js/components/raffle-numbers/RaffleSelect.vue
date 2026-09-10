<template>
    <div class="w-1/3">
        <select
            name="raffles"
            @change="selectedRaffle"
            class="input-style w-full"
            v-model="selectedRaffleId"
        >
            <option
                v-for="(raffle, index) in raffles"
                :key="raffle.id"
                :value="raffle.id"
            >
                {{ raffle.name }}
            </option>
        </select>
    </div>
</template>
<script>
import { mapActions } from "vuex";
export default {
    data() {
        return {
            raffles: [],
            selectedRaffleId: null,
        };
    },
    async mounted() {
        const { data: raffles } = await this.getRaffles();
        if (raffles.length > 0) {
            this.selectedRaffleId = raffles[0].id;
        }
        this.raffles = raffles;
    },
    methods: {
        ...mapActions("raffles", ["getRaffles"]),
        selectedRaffle() {
            this.$emit("selected-raffle", this.selectedRaffleId);
        },
    },
};
</script>
