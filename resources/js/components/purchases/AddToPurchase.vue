<template>
    <form @submit.prevent="submit" v-can="'create purchase'" class="flex justify-center items-center gap-2">
        <input type="hidden" name="product_id" />
        <button class=" p-1 bg-blue-400  text-black rounded-sm shadow hover:bg-gray-300 hover:shadow-none font-bold">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>


        </button>
        <div v-if="qtyPurchase(productExistsInPurchase(product_id))" class="inline-block">
            <span class="bg-blue-600 text-white font-bold rounded-full px-2 py-1 text-xs">{{
                qtyPurchase(productExistsInPurchase(product_id))
            }}</span>
        </div>
    </form>
</template>
<script>
import { mapGetters, mapMutations } from "vuex";
import PurchaseIcon from '../icons/PurchaseIcon.vue';
export default {
    components: { PurchaseIcon },
    props: {
        product_id: {
            type: Number
        },
        purchase_price: {
            type: Number
        }
    },
    data() {
        return {
            purchase_id: null
        };
    },
    mounted() {
        this.purchase_id = document.head.querySelector(
            'meta[name="purchase_id"]'
        ).content;
    },
    methods: {
        ...mapMutations(["setProductsInPurchase"]),
        submit(e) {
            e.target.disabled = true;
            axios
                .post("/purchases", {
                    product_id: this.product_id,
                    purchase_price: this.purchase_price
                })
                .then(res => {
                    var obj = new Object();
                    obj.hasProductsInPurchase = this.hasProductsInPurchase;

                    obj.index = this.productExistsInPurchase(this.product_id);

                    obj.productInPurchase = {
                        qty: res.data.qty,
                        product_id: this.product_id
                    };
                    if (this.purchase_id == "") {
                        EventBus.$emit(
                            "purchase-created",
                            res.data.purchase_id
                        );
                        document.head.querySelector(
                            'meta[name="purchase_id"]'
                        ).content = res.data.purchase_id;
                    }
                    this.setProductsInPurchase(obj);
                })
                .catch(err => {
                    this.getErrors(err);
                });
        }
    },
    computed: {
        ...mapGetters([
            "hasProductsInPurchase",
            "productExistsInPurchase",
            "qtyPurchase"
        ])
    }
};
</script>
