<template>
    <tr v-if="!show" class=" px-6 py-4 ">
        <td class="px-6 py-4">
            {{ productBonus.name }}
        </td>
        <td class="px-6 py-4">
            {{ productBonus.points }}
        </td>
        <td class="px-6 py-4">
            {{
                productBonus.commission_amount
            }}
        </td>
        <td class="px-6 py-4">
            <div class="flex items-center justify-center gap-2">
                <remove-product-bonus :product-bonus="productBonus" :index="index">
                </remove-product-bonus>
                <edit-icon @click.prevent="dblclick"
                    class="cursor-pointer active:ring-2 active:ring-offset-2 active:ring-sky-500 rounded " />
            </div>
        </td>
    </tr>
    <tr v-else class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
        <td colspan="3" class="border-grey-light border hover:bg-slate-100 p-3">
            <form class="grid grid-cols-3 gap-4" @submit.prevent="submit">
                <input type="text" name="name" v-model="form.name" :class="[inputStyle]" />
                <input type="text" name="points" v-model="form.points" :class="[inputStyle]" />
                <input type="text" name="commission_amount" v-model="form.commission_amount" :class="[inputStyle]" />
                <button type="submit"></button>
            </form>
        </td>

    </tr>
</template>
<script>
import axios from "axios";
import RemoveProductBonus from "./RemoveProductBonus.vue";
import EditIcon from "../icons/EditIcon.vue"
export default {
    components: {
        RemoveProductBonus,
        EditIcon
    },
    props: {
        productBonus: Object,
        index: {
            type: Number
        }
    },
    created() {
        this.form = this.productBonus;
    },
    data() {
        return {
            show: false,
            form: {},
        };
    },
    methods: {
        dblclick() {
            this.show = !this.show;
        },
        async submit() {
            try {
                this.form._method = "PUT";
                const res = await axios.post(
                    `/product-bonuses/${this.productBonus.id}`,
                    this.form
                );
                this.productBonus.name = res.data.name;
                this.productBonus.points = res.data.points;
                this.productBonus.commission_amount = res.data.commission_amount;
                this.show = false;
            } catch (err) {
                this.$notify({
                    group: "foo",
                    title: "Cliente",
                    type: "error",
                    text: Object?.values(
                        err?.response?.data?.errors
                    )?.flat()[0]
                });
                if (err["response"].status === 419) {
                    window.location = "/";
                }
            }
        },
    },
    computed: {
        inputStyle() {
            return "mr-1 placeholder-green-300 appearance-none bg-gray-400  rounded py-2 px-2 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent";
        },
    },
};
</script>
