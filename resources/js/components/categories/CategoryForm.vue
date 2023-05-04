<template>
    <form @submit.prevent="submit" v-can="'create category'"
        class="w-full  shadow rounded-lg bg-white p-4 md:mt-0" :class="[getWidth]">
        <div class="flex items-center py-2 text-dark text-xl font-bold ">
            Crear categoría
        </div>
        <div class="w-full">
            <label for=""
                class="form-label">Nombre</label>
            <input v-model="form.name" name="name"
                class="form-text-input w-full"
                :class="[
                        'flex',
                        'items-center',
                        'border-b',
                        this.errors ? 'border-transparent' : 'border-teal-500',
                        'py-2'
                    ]" type="text" placeholder="CATEGORÍA" aria-label="Full name" />
        </div>
        <div class="flex items-center ">
            <errors-component :errors-found="errors" />
        </div>

        <div class="flex mt-4 mb-0">
            <button
                class="bg-blue-500 rounded shadow-sm transition-all duration-500 ease-in-out hover:bg-blue-700 text-gray-100 font-semibold hover:text-white py-2 px-8 border-b-2 border-blue-500 hover:border-transparent ">
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
