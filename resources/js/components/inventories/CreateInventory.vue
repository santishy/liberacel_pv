<template>
    <nav-component>
        <div class="w-full px-4  flex justify-center bg-transparent ">
            <form @submit.prevent="submit" v-can="'create warehouse'"
                class="w-6/12 shadow rounded-lg border  bg-white p-4 ">
                <div class="flex items-center p-2 text-dark  text-xl font-semibold font-roboto">
                    Crear Almacén
                </div>
                <div class=" py-2 w-full">
                    <label for=""
                        class="form-label">Nombre</label>
                    <input v-model="form.name" name="name"
                        class="form-text-input"
                        type="text" placeholder="Jiquilpan " aria-label="Full name" />

                </div>
                <div class=" py-2 w-full">
                    <label
                        class="form-label">Dirección</label>
                    <input v-model="form.address" name="address"
                        class="form-text-input"
                        type="text" placeholder="Sor Juana Inés #34 " aria-label="Full name" />
                </div>
                <div class="flex items-center ">
                    <errors-component :errors-found="errors" />
                </div>

                <div class="flex items-center mt-2 mb-0">
                    <button
                        class="bg-blue-500 rounded shadow-sm transition-all duration-500 ease-in-out hover:bg-blue-700 text-gray-100 font-semibold hover:text-white py-2 px-8 border-b-2 border-blue-500 hover:border-transparent ">
                        Guardar
                    </button>
                </div>
                <notifications group="foo"></notifications>
            </form>
        </div>

    </nav-component>
</template>

<script>
import NavComponent from "../NavComponent.vue";
import DatabaseIcon from "../icons/DatabaseIcon.vue";
export default {
    created() {
        if (!!this.inventory) {
            this.form = this.inventory;
        }
    },
    props: {
        method: {
            type: String
        },
        inventory: {
            type: Object
        },
        uri: {
            type: String
        }
    },
    components: { NavComponent, DatabaseIcon },
    data() {
        return {
            form: {},
            errors: null,
            obj: { title: "Almacenes" }
        };
    },
    methods: {
        submit() {
            if (this.method == "put") {
                this.form._method = "put";
                this.obj.message = "EL almacen se modifico correctamente";
            } else this.obj.message = "EL almacen se creo correctamente";
            axios["post"](this.uri, this.form)
                .then(res => {
                    this.notify(this.obj);
                    if (this.method != "put") this.form = {};
                    this.errors = null;
                })
                .catch(err => {
                    this.getErrors(err);
                });
        }
    }
};
</script>
