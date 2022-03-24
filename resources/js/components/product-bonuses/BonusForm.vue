<template>
    <form
        @submit.prevent="submit"
        class="w-full  md:mt-0"
    >
        <div
            class="
                flex
                items-center
                border-b border-t border-gray-500
                py-2
                relative
            "
        >
            <input
                v-model="form.name"
                name="name"
                class="
                    appearance-none
                    bg-transparent
                    border-none
                    w-full
                    text-gray-700
                    mr-3
                    py-1
                    pl-32
                    leading-tight
                    focus:outline-none
                "
                :class="[
                    'flex',
                    'items-center',
                    'border-b',
                    'border-teal-500',
                    'py-2',
                ]"
                type="text"
                placeholder="CATEGORÍA"
                aria-label="Full name"
            />
            <label
                for=""
                class="
                    absolute
                    pl-0
                    bg-gray-200
                    h-full
                    flex
                    items-center
                    w-32
                    justify-center
                    text-indigo-800
                    font-mono
                "
                >Nombre</label
            >
        </div>
        <div
            class="
                flex
                items-center
                border-b border-t border-gray-500
                py-2
                relative
            "
        >
            <input
                v-model="form.points"
                name="points"
                class="
                    appearance-none
                    bg-transparent
                    border-none
                    w-full
                    text-gray-700
                    mr-3
                    py-1
                    pl-32
                    leading-tight
                    focus:outline-none
                "
                :class="[
                    'flex',
                    'items-center',
                    'border-b',
                    this.errors ? 'border-transparent' : 'border-teal-500',
                    'py-2',
                ]"
                type="number"
                placeholder="CATEGORÍA"
                aria-label="Full name"
            />
            <label
                for=""
                class="
                    absolute
                    pl-0
                    bg-gray-200
                    h-full
                    flex
                    items-center
                    w-32
                    justify-center
                    text-indigo-800
                    font-mono
                "
                >Puntos</label
            >
        </div>
        <div class="flex items-center">
            <errors-component :errors-found="errors" />
        </div>

        <div class="flex justify-center mt-0 mb-0">
            <button
                class="
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
                "
            >
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
            // if (this.method == "put") this.form._method = "put";
            axios
                .post(`/product-bonuses`, this.form)
                .then((res) => {
                    if(res.data.productBonus){
                        EventBus.$on("bonus-created",res.data.productBonus)
                    }
                })
                .catch((err) => {
                    this.getErrors(err);
                });
        },
    },
    computed: {},
};
</script>
