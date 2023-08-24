<template>
    <form id="fastSaleForm" ref="quickSaleForm" class="grid w-full grid-cols-2 gap-4" @submit.prevent="submit">
        <credit-status :form="form" class="col-span-2"></credit-status>
        <div>
            <label class="form-label">Descripción</label>
            <input name="description" ref="description" v-model="form.description" @keydown.down.exact.prevent="nextFocus"
                @keydown.ctrl.space.exact.prevent="openModal" @click.prevent="focusedIndex = 0"
                class="form-text-input w-full" placeholder="Descripción del producto o servicio" autocomplete="off" />
        </div>
        <div>
            <label class="form-label">Categoría</label>
            <search-select class="w-full" :collection="productBonuses" input-class="form-text-input w-full"></search-select>
        </div>
        <div>
            <label class="form-label">Precio</label>
            <input type="text" ref="price" name="price" v-model="form.price" class="form-text-input w-full"
                placeholder="Precio" @click.prevent="focusedIndex = 1" @keydown.enter="submit"
                @keydown.down.exact.prevent="nextFocus" @keydown.up.exact.prevent="previousFocus"
                @keydown.ctrl.space.exact.prevent="openModal" autocomplete="off" />
        </div>
        <div>
            <label class="form-label">Cantidad</label>
            <input type="text" name="qty" ref="qty" v-model="form.qty" class="form-text-input w-full"
                placeholder="Cantidad de venta" @keydown.enter="submit" @click.prevent="focusedIndex = 2"
                @keydown.up.exact.prevent="previousFocus" @keydown.ctrl.space.exact.prevent="openModal"
                autocomplete="off" />
        </div>

        <div class="flex items-center justify-start w-full col-span-2">
            <div class="flex items-center w-full">
                <errors-component :errors-found="errors" />
            </div>
        </div>
    </form>
</template>

<script>
import { mapMutations } from "vuex";
import SearchSelect from "../partials/SearchSelect.vue";
import CreditStatus from "../credits/CreditStatus.vue";

export default {
    components: {
        SearchSelect,
        CreditStatus,
    },
    props: {
        productBonuses: {
            type: Array,
        },
    },
    data() {
        return {
            form: {},
            focusedIndex: 0,
        };
    },
    mounted() {
        this.focusDescription();
        EventBus.$on("focus-description", this.focusDescription);
        EventBus.$on("selected-item", (item) => {
            this.form.product_bonus_id = item?.id;
        });
        EventBus.$on("sale-to-client", (res) => {
            console.log(res.data)
            this.form.client_id = res.data.id;
        })
    },
    methods: {
        ...mapMutations(['SET_CURRENT_FAST_SALE']),
        async submit() {
            try {
                //this.toggleDisabled();
                const {
                    data: { data },
                } = await axios.post("/fast-sales", this.form);

                EventBus.$emit("fast-sale", data);

                this.SET_CURRENT_FAST_SALE(data);

                EventBus.$emit("reset-search-select");

                this.form = {};

                this.notify({
                    title: "Venta rapida",
                    message: "Producto agregado",
                });

            }
            catch (err) {
                this.getErrors(err);
            }
            //this.toggleDisabled();
            this.focusedIndex = 0;
            this.$refs.description.focus();
        },
        toggleDisabled() {
            const fields = document.getElementById("fastSaleForm").elements;
            for (let i = 0; i < fields.length; i++) {
                fields[i].disabled = !fields[i].disabled;
            }
        },
        nextFocus(e) {
            this.focusedIndex += 1;
            this.itemFocus();
        },
        previousFocus() {
            this.focusedIndex -= 1;
            this.itemFocus();
        },
        itemFocus() {
            this.$refs.quickSaleForm.children[
                this.focusedIndex
            ].children[1].focus();
        },
        openModal() {
            EventBus.$emit("open-modal", true);
        },
        focusDescription() {
            this.$refs.description.focus();
        },
    },
    computed: {
        labelStyle() {
            return " w-3/12 text-center text-gray-700 font-serif font-semibold mr-2 rounded-sm py-3 px-6";
        },
        inputStyle() {
            return " placeholder:italic font-font-light placeholder-gray-500 placeholder-shown:border-gray-500 appearance-none bg-gray-300  rounded w-8/12 py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent";
        },
        controlsContainerStyle() {
            return "flex flex-wrap flex-row  justify-center items-center w-full ";
        },
    },
};
</script>
<style scoped>
.bg-stripes-pink {
    background-color: #f472b61a;
    background-image: linear-gradient(135deg,
            #ec489980 10%,
            transparent 0,
            transparent 50%,
            #ec489980 0,
            #ec489980 60%,
            transparent 0,
            transparent);
    background-size: 7.07px 7.07px;
}
</style>
