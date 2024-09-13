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
                    text-slate-700
                    text-start
                    py-1
                    font-mono
                ">Nombre</label>
            <input v-model="form.name" name="name" class="
                    appearance-none
                    bg-slate-200
                    rounded-sm
                    w-full
                    text-slate-600
                    py-1
                    leading-tight
                    focus:outline-none
                " type="text" placeholder="CATEGORÍA" aria-label="Full name" />
        </div>
        <div class="
                flex
                flex-col
                py-2
            ">
            <label for="" class="
                    text-slate-700
                    text-start
                    py-1
                    font-mono
                ">Puntos</label>
            <input v-model="form.points" name="points" class="
                    appearance-none
                    bg-slate-200
                    rounded-sm
                    w-full
                    text-slate-600
                    py-1
                    leading-tight
                    focus:outline-none
                " type="number" placeholder="NOM PUNTOS" aria-label="Full name" />
        </div>
        <div class="
                flex
                flex-col
                py-2
            ">
            <label for="" class="
                    text-slate-700
                    text-start
                    py-1
                    font-mono
                ">Comisión</label>
            <input v-model="form.commission_amount" name="commission_amount" class="
                    appearance-none
                    bg-slate-200
                    rounded-sm
                    w-full
                    text-slate-600
                    py-1
                    leading-tight
                    focus:outline-none
                " type="number" placeholder="Valor de comisión en pesos" aria-label="Full name" />
        </div>


        <div class="flex justify-center mt-0 mb-0">
            <button class="
                    bg-transparent
                    transition-all
                    duration-500
                    ease-in-out
                    hover:bg-blue-500
                    text-blue-700
                    font-semibold
                    hover:text-white
                    py-2
                    px-4
                    border-b-2 border-blue-500
                    hover:border-transparent
                    w-full
                ">
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
