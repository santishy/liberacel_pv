<template>
    <form @submit.prevent="assignRaffleNumber" class="flex flex-col gap-4">
        <div>
            <span
                class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 inset-ring inset-ring-green-600/20"
                >Rifa activa</span
            >
            <span
                class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-sky-700 inset-ring inset-ring-sky-600/20"
                >Télefono para rifa opcional</span
            >
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <div
                v-if="currentFastSale.customer_phone && !editing"
                class="flex flex-wrap items-center space-x-2 text-slate-700"
            >
                <span>Nota #{{ currentFastSale?.id }} </span>
                <span
                    class="block size-2 animate-ping bg-emerald-500 rounded-full"
                ></span>
                <span class="font-semibold text-xs">
                    Tel: {{ currentFastSale?.customer_phone }}
                </span>
                <button
                    type="button"
                    @click.prevent="changePhoneNumber"
                    class="px-4 py-1 bg-blue-500 text-white rounded hover:bg-blue-700"
                >
                    Cambiar número tel.
                </button>
            </div>
            <div class="flex items-center space-x-2" v-else>
                <text-input
                    v-model="customer_phone"
                    classes="w-full md:w-96 p-1"
                    placeholder="Agregar Número de teléfono  (Opcional) "
                ></text-input>
                <button
                    class="px-4 py-2 bg-sky-400 text-white rounded hover:bg-sky-600"
                >
                    Guardar
                </button>
            </div>

            <button
                v-if="currentFastSale?.customer_phone"
                type="button"
                @click.prevent="removePhoneNumber"
                class="px-4 py-1 bg-slate-700 text-white rounded hover:bg-slate-900"
            >
                Quitar
            </button>
        </div>
    </form>
</template>

<script>
import TextInput from "../ui/TextInput.vue";
import { mapState, mapMutations } from "vuex";
export default {
    components: { TextInput },
    data() {
        return {
            customer_phone: null,
            editing: false,
        };
    },
    mounted() {
        this.customer_phone = this.currentFastSale?.customer_phone;
    },
    methods: {
        ...mapMutations(["SET_CURRENT_FAST_SALE"]),
        assignRaffleNumber() {
            if (this.currentFastSale?.customer_phone === this.customer_phone) {
                this.editing = false;
                return;
            }
            this.$emit("assign-raffle-number", this.customer_phone);
        },
        omitRaffle() {
            this.$emit("skip-raffle");
        },
        removePhoneNumber() {
            this.$emit("assign-raffle-number", null);
            this.customer_phone = null;
        },
        changePhoneNumber() {
            this.editing = true;
        },
    },
    watch: {
        "currentFastSale.customer_phone": function (newValue, oldValue) {
            this.editing = false;
        },
    },
    computed: {
        ...mapState(["currentFastSale"]),
    },
};
</script>
