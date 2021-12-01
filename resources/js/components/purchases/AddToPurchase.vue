<template>
    <form @submit.prevent="submit" v-can="'create purchase'">
        <input type="hidden" name="product_id" />
        <button
            class="  border-yellow-500 border-b-2 hover:text-yellow-700 border-t-2 shadow-xs hover:border-yellow-700 text-yellow-500 font-bold py-1 px-4 rounded text-2xl"
        >
            <div
                v-if="qtyPurchase(productExistsInPurchase(product_id))"
                class="inline-block"
            >
                <span class="bg-purple-900 rounded-full py-0 px-2 text-xl">{{
                    qtyPurchase(productExistsInPurchase(product_id))
                }}</span>
            </div>
            <purchase-icon></purchase-icon>
        </button>
    </form>
</template>
<script>
import { mapGetters, mapMutations } from "vuex";
import PurchaseIcon from '../icons/PurchaseIcon.vue';
export default {
    components:{PurchaseIcon},
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
