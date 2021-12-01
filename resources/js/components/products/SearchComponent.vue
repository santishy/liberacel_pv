<template>
    <input
        type="text"
        v-model="sku"
        v-on:keyup.enter="handleSearh"
        placeholder="Busca por el SKU del producto"
        class="shadow border-l-4 border-purple-500 appearance-none py-5 px-4 rounded leading-tight focus:outline-none"
    />
</template>
<script>
import { mapActions } from "vuex";
export default {
    data() {
        return {
            sku: "",
            page: 1
        };
    },
    created() {
        EventBus.$on("selected-inventory", this.addFilter);
    },
    methods: {
        ...mapActions(["search"]),
        handleSearh(e) {
            if (this.sku == "" || this.sku == "") {
                return EventBus.$emit("empty-search");
            }
            return new Promise((resolve, reject) => {
                const params = {
                    "filter[search]": this.sku,
                    page: this.page
                };
                this.search(params)
                    .then(res => {
                        if (this.page == 1) {
                            params.page++;
                            EventBus.$emit("matching-products", {
                                params,
                                products: res.data.data
                            });
                        }
                        resolve(res);
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },
        setPage(page) {
            this.page = page;
        }
    }
};
</script>
