<template>
    <tr
        v-if="!show"
        class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0"
    >
        <td
            @dblclick.prevent="show = true"
            class="border-grey-light border hover:bg-gray-100 p-3"
        >
            {{ product.description }}
        </td>
        <td
            @dblclick.prevent="show = true"
            class="border-grey-light border hover:bg-gray-100 p-3"
        >
            <span>{{ product.price }}</span>
        </td>
        <td
            @dblclick.prevent="show = true"
            class="border-grey-light border hover:bg-gray-100 p-3"
        >
            <span>{{ product.qty }}</span>
        </td>
        <td
            class="
                border-grey-light border
                hover:bg-gray-100
                p-3
                text-red-400
                hover:text-red-600 hover:font-medium
                cursor-pointer
            "
        >
            <delete-concept></delete-concept>
        </td>
    </tr>
    <tr v-else class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
        <td colspan="4" class="border-grey-light border hover:bg-gray-100 p-3">
            <form class="grid grid-cols-3 gap-2" @submit.prevent="submit">
                <input
                    type="text"
                    name="description"
                    v-model="form.description"
                    :class="[inputStyle]"
                />
                <input
                    type="text"
                    name="price"
                    v-model="form.price"
                    :class="[inputStyle]"
                />
                <input
                    type="text"
                    name="qty"
                    v-model="form.qty"
                    :class="[inputStyle]"
                />
                <button type="submit"></button>
            </form>
        </td>
    </tr>
</template>

<script>
import DeleteConcept from "./DeleteConcept.vue";
export default {
    components: { DeleteConcept },
    props: ["product", "sale","index"],
    data() {
        return {
            show: false,
            form: this.product,
        };
    },
    created() {
        this.form = this.product;
    },
    watch: {
        product() {
            this.form = this.product;
            this.show = false;
        },
    },
    computed: {
        inputStyle() {
            return "mr-1 placeholder-green-300 appearance-none bg-gray-300  rounded py-2 px-2 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent";
        },
    },
    methods: {
        async submit() {
            console.log("entro?")
            try {
                const res = await axios.post(`/fast-sales/${this.sale.id}`, {
                    ...this.form,
                    _method: "put",
                    index:this.index,
                });
            } catch (e) {
                console.log(e);
            }
            this.show = false;
        },
    },
};
</script>
