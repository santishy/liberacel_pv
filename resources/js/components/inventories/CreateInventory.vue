<template>
    <layout-component>
        <div class="overflow-hidden flex justify-center bg-transparent ">
            <form @submit.prevent="submit" v-can="'create warehouse'"
                class="block w-full sm:w-6/12 shadow rounded-lg border  bg-white p-4 ">
                <div class="flex items-center p-2 text-dark  text-xl font-semibold font-roboto">
                    Crear Almacén
                </div>
                <errors-component />
                <div class=" py-2 w-full">
                    <label for="" class="form-label mb-1">Nombre</label>
                    <input-text v-model="form.name" input-class="w-full" aria-label="Full name" />
                </div>
                <div class=" py-2 w-full">
                    <label class="form-label mb-1">Dirección</label>
                    <input v-model="form.address" name="address" class="form-text-input w-full" type="text"
                        placeholder="Sor Juana Inés #34 " aria-label="Full name" />
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

    </layout-component>
</template>

<script>
//import NavComponent from "../NavComponent.vue";
import DatabaseIcon from "../icons/DatabaseIcon.vue";
import InputText from "../partials/InputText.vue";
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
    components: { DatabaseIcon, InputText },
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
                    EventBus.$emit('an-error-ocurred', err);
                });
        }
    }
};
</script>
