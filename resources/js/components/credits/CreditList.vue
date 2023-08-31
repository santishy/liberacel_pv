<template>
    <div class="shadow-sm bg-white">
        <table class="table-auto w-full">
            <thead class="bg-blue-700">
                <tr class="text-white font-extralight">
                    <th class="px-1 py-2">FECHA CREDITO</th>
                    <th class="px-1 py-2">ClIENTE</th>
                    <th class="px-1 py-2">MONTO PAGADO</th>
                    <th class="px-1 py-2">TOTAL</th>
                    <th class="px-1 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <credit-list-item v-for="(credit, index) in credits" :key="credit.id" :credit="credit" :index="index">
                </credit-list-item>
            </tbody>
        </table>
        <infinite-loading @infinite="getCredits"></infinite-loading>
    </div>
</template>
<script>
export default {
    data() {
        return {
            credits: [],
            page: 1,
        };
    },
    created() {
        EventBus.$on('credit-removed', (index) => {
            if (index) {
                this.credits.splice(index, 1);
            }
        })
    },
    methods: {
        getCredits($state) {
            axios
                .get("/credits", {
                    params: {
                        page: this.page,
                    }
                },)
                .then((res) => {
                    if (res.data.data.length) {
                        this.page += 1;
                        this.credits.push(...res.data.data);
                        $state.loaded();
                    }
                    else {
                        $state.complete();
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
};

</script>