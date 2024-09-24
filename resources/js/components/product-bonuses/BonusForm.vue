<template>
    <form @submit.prevent="submit" class="w-full  md:mt-0">
        <errors-component />
        <div class="
                flex
                gap-2
                flex-col
                py-1
            ">
            <label for="" class="
                    form-label
                ">Nombre</label>
            <input v-model="form.name" name="name" class="
                    form-text-input w-full
                " type="text" placeholder="CATEGORÍA" aria-label="Full name" />
        </div>
        <div class="
                flex
                flex-col
                py-2
            ">
            <label for="" class="
                    form-label
                ">Puntos</label>
            <input v-model="form.points" name="points" class="
                    form-text-input w-full
                " type="number" placeholder="NOM PUNTOS" aria-label="Full name" />
        </div>
        <div class="
                flex
                flex-col
                py-2
            ">
            <label for="" class="
                    form-label
                ">Comisión</label>
            <input v-model="form.commission_amount" name="commission_amount" class="
                form-text-input w-full
                " type="number" placeholder="Valor de comisión en pesos" aria-label="Full name" />
        </div>
        <div class="flex justify-center mt-2 mb-0">
            <button class="primary-button w-full">
                Guardar
            </button>
        </div>
    </form>
    <!-- </div> -->
</template>
<script>
export default {
    data: () => ({
        form: {},
    }),
    props: {
        uri: {
            type: String,
        },
    },

    methods: {
        submit() {
            axios
                .post(`/product-bonuses`, this.form)
                .then((res) => {
                    EventBus.$emit("bonus-created", res.data)
                })
                .catch((err) => {
                    EventBus.$emit('an-error-ocurred', err);
                });
        },
    },
    computed: {},
};
</script>
