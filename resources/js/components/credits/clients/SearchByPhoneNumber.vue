<template>
    <form class="bg-white w-96 mb-4 rounded-sm py-2 flex flex-nowrap items-center px-4 gap-4" @submit.prevent="">
        <label class="text-slate-600" for="phone_number">Buscar</label>
        <input v-model="phoneNumber" @keyup.enter.prevent="submit" placeholder="3531004304"
            class="bg-slate-100 w-full placeholder:text-slate-400 px-2 py-1 rounded-sm" />
    </form>
</template>
<script>
import { mapActions } from "vuex";
export default {
    data() {
        return {
            phoneNumber: null,
        };
    },
    methods: {
        ...mapActions(["searchCreditByClient"]),
        async submit() {
            try {
                const res = await this.searchCreditByClient({
                    "filter[searchByPhoneNumber]": this.phoneNumber,
                });
                EventBus.$emit('fetch-client-credit', res.data);
            } catch (err) {
                console.log(err);
            }
            this.phoneNumber = null;
        },
    },
};
</script>
