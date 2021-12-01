<template>
    <div class="max-h-screen overflow-x-hidden overflow-h-auto mb-1">
        <table class="table-auto text-center">
            <thead class="bg-purple-200">
                <tr>
                    <th class="p-3">SKU</th>
                    <th class="p-3">Descripción</th>
                    <th class="p-3">Cantidad</th>
                    <th class="p-3">Precio</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="product.id">
                    <td class="border px-4 py-2">{{ product.sku }}</td>
                    <td class="border px-4 py-2">{{ product.description }}</td>
                    <td class="border px-4 py-2">
                        {{ product[`${transaction.transactionType}_quantity`] }}
                    </td>
                    <td class="border px-4 py-2">
                        {{ product[`${transaction.transactionType}_price`] }}
                    </td>
                </tr>
            </tbody>
            <infinite-loading @infinite="getProducts"></infinite-loading>
        </table>
    </div>
</template>
<script>
export default {
    props: {
        transaction: {
            type: Object
        }
    },
    data() {
        return {
            page: 1,
            products: []
        };
    },
    methods: {
        getProducts($state) {
            axios
                .get(`/transaction-products`, {
                    params: {
                        id: this.transaction.id,
                        transactionType: this.transaction.transactionType,
                        page: this.page
                    }
                })
                .then(res => {
                    console.log(res.data);
                    if (res.data.products.length) {
                        this.page += 1;
                        this.products.push(...res.data.products);
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                })
                .catch(err => {
                    $state.complete();
                    this.getErrors(err);
                });
        }
    }
};
</script>
