<template>
    <tr v-if="!show" class="bg-white border-b ">
        <th @dblclick.prevent="dbClick('description', $event)" scope="row"
            class="px-6 py-4 font-medium text-slate-700 whitespace-nowrap">
            {{ product.description }}
        </th>
        <td @dblclick.prevent="dbClick('price')" class="px-6 py-4">
            {{ product.price }}
        </td>
        <td @dblclick.prevent="dbClick('qty')" class="px-6 py-4">
            {{ product.qty }}
        </td>
        <td class="px-6 py-4">
            <delete-concept :index="index" :id="id"></delete-concept>
        </td>
    </tr>
    <tr v-else class="bg-white border-b ">
        <td colspan="4" class="border-grey-light border hover:bg-gray-100 p-3">
            <form class="grid grid-cols-3 gap-2" @submit.prevent="submit">
                <input type="text" name="description" v-model="form.description" :class="[inputStyle]" />
                <input type="text" name="price" v-model="form.price" :class="[inputStyle]" />
                <input type="text" name="qty" v-model="form.qty" :class="[inputStyle]" />
                <button type="submit"></button>
            </form>
        </td>
    </tr>
</template>

<script>
import DeleteConcept from "./DeleteConcept.vue";
export default {
    components: { DeleteConcept },
    props: ["product", "id", "index"],
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
            try {
                const {
                    data: { data },
                } = await axios.post(`/fast-sales/${this.id}`, {
                    ...this.form,
                    _method: "put",
                    index: this.index,
                });
                EventBus.$emit("fast-sale", data);
            } catch (e) {
                EventBus.$emit("errors-found", e);
            }
            this.show = false;
        },
        dbClick(name, event) {
            this.show = true;
        },
    },
};
</script>
