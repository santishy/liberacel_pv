<template>
    <tr v-if="!show" class="
            bg-white
            border-b border-gray-400
            md:border-none
            block
            md:table-row
            cursor-pointer
        ">
        <td @dblclick.prevent="dblclick" class="
                p-2
                md:border md:border-grey-500
                text-left
                block
                md:table-cell
                cursor-pointer
            ">
            <span class="inline-block w-1/3 md:hidden font-bold">Producto/Categoría</span>{{ productBonus.name }}
        </td>
        <td @dblclick.prevent="dblclick" class="
                p-2
                md:border md:border-grey-500
                text-left
                block
                md:table-cell
            ">
            <span class="inline-block w-1/3 md:hidden font-bold">Puntos</span>{{ productBonus.points }}
        </td>
        <td class="
            p-2
            md:border md:border-grey-500
            text-left
            block
            md:table-cell
            cursor-pointer
        ">
            <remove-product-bonus :product-bonus="productBonus" :index="index">
            </remove-product-bonus>
        </td>
    </tr>
    <tr v-else class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
        <td colspan="2" class="border-grey-light border hover:bg-gray-100 p-3">
            <form class="grid grid-cols-2 gap-2" @submit.prevent="submit">
                <input type="text" name="name" v-model="form.name" :class="[inputStyle]" />
                <input type="text" name="points" v-model="form.points" :class="[inputStyle]" />
                <button type="submit"></button>
            </form>
        </td>

    </tr>
</template>
<script>
import axios from "axios";
import RemoveProductBonus from "./RemoveProductBonus.vue";
export default {
    components: {
        RemoveProductBonus
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
            this.show = true;
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
                this.show = false;
            } catch (error) {
                console.log(error.message);
                if (error["response"].status === 419) {
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
