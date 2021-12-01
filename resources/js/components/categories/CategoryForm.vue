<template>
    <form
        @submit.prevent="submit"
        v-can="'create category'"
        class="w-full  shadow-lg rounded-lg bg-white md:px-6 md:py-8  md:mt-0"
        :class="[getWidth]"
    >
        <div
            class="flex items-center py-2 text-dark text-center justify-center text-xl font-bold "
        >
            Añadir categoría
        </div>
        <div
            class="flex items-center border-b border-t border-gray-500 py-2 relative"
        >
            <input
                v-model="form.name"
                name="name"
                class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 pl-32 leading-tight focus:outline-none"
                :class="[
                    'flex',
                    'items-center',
                    'border-b',
                    this.errors ? 'border-transparent' : 'border-teal-500',
                    'py-2'
                ]"
                type="text"
                placeholder="CATEGORÍA"
                aria-label="Full name"
            />
            <label
                for=""
                class="absolute  pl-0 bg-gray-200 h-full flex items-center w-32 justify-center text-indigo-800 font-mono"
                >Nombre</label
            >
        </div>
        <div class="flex items-center ">
            <errors-component :errors-found="errors" />
        </div>

        <div class="flex justify-center mt-0 mb-0">
            <button
                class="bg-transparent transition-all duration-500 ease-in-out hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border-b-2 border-blue-500 hover:border-transparent w-full"
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
        form: {}
    }),
    props: {
        uri: {
            type: String
        }
    },
    created() {
        if (this.$parent.$parent.category) {
            this.form.name = this.$parent.$parent.category.name;
            this.form.id = this.$parent.$parent.category.id;
        }
    },
    methods: {
        submit() {
            if (this.$parent.$parent.method == "put") this.form._method = "put";
            axios
                .post(this.uri, this.form)
                .then(res => {
                    EventBus.$emit("category-created", res.data);
                    let obj = {
                        message: this.form.id
                            ? "Categoría modificada"
                            : "Categoría agregada",
                        title: "Categorías"
                    };
                    if (!this.form.id) this.form = {};

                    this.notify(obj);
                })
                .catch(err => {
                    this.getErrors(err);
                });
        }
    },
    computed: {
        getWidth() {
            if (this.$parent.$parent.method?.toUpperCase() == "PUT")
                return "w-full";
            else return "max-w-md";
        }
    }
};
</script>
