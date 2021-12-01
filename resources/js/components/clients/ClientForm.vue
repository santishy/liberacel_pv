<template>
    <nav-component>
        <div class="w-9/12 mx-auto px-4  flex justify-center bg-transparent">
            <form
                @submit.prevent="submit"
                v-can="definePermission"
                class="w-full shadow-lg rounded-lg bg-white px-6 py-8"
            >
                <div
                    class="flex items-center py-2 text-dark text-center justify-center text-xl font-bold"
                >
                    {{ getTitle }}
                </div>
                <div class="flex items-center  border-t border-gray-500 py-2 relative">
                    <input
                        v-model="form.name"
                        name="name"
                        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 pl-60 leading-tight focus:outline-none"
                        type="text"
                        placeholder="NOMBRE"
                        aria-label="Full name"
                    />
                    <label
                        for=""
                        class="absolute  pl-0 bg-gray-200 h-full flex items-center w-56 justify-center text-indigo-800 font-mono"
                        >Nombre</label
                    >
                </div>
                <div class="flex items-center  border-t border-gray-500 py-2 relative">
                    <input
                        v-model="form.address"
                        name="address"
                        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 pl-60 leading-tight focus:outline-none"
                        type="text"
                        placeholder="DIRECCION"
                        aria-label="Full name"
                    />
                    <label
                        for=""
                        class="absolute  pl-0 bg-gray-200 h-full flex items-center w-56 justify-center text-indigo-800 font-mono"
                        >Dirección</label
                    >
                </div>
                <div class="flex items-center  border-t border-gray-500 py-2 relative">
                    <input
                        v-model="form.phone_number"
                        name="phone_number"
                        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 pl-60 leading-tight focus:outline-none"
                        type="text"
                        placeholder="NUMERO DE TELEFONO"
                        aria-label="Full name"
                    />
                    <label
                        for=""
                        class="absolute  pl-0 bg-gray-200 h-full flex items-center w-56 justify-center text-indigo-800 font-mono"
                        >Telefono</label
                    >
                </div>
                <div class="flex items-center  border-t border-gray-500 py-2 relative">
                    <input
                        v-model="form.email"
                        name="email"
                        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 pl-60 leading-tight focus:outline-none"
                        type="email"
                        placeholder="EMAIL"
                        aria-label="Full name"
                    />
                    <label
                        for=""
                        class="absolute  pl-0 bg-gray-200 h-full flex items-center w-56 justify-center text-indigo-800 font-mono"
                        >Email</label
                    >
                </div>
                <div class="flex items-center  border-t border-gray-500 py-2 relative">
                    <select
                        name="assigned_price"
                        v-model="form.assigned_price"
                        plahceholder="Asigna un precio al cliente"
                        class="block appearance-none w-full bg-white hover:border-gray-500 px-4 pl-60 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline"
                    >
                        <option disabled value="" selected class="text-gray-600"
                            >Asignar un precio</option
                        >
                        <option value="retail_price">Precio al por menor</option>
                        <option value="wholesale_price">Precio al por mayor</option>
                    </select>
                    <label
                        for=""
                        class="absolute  pl-0 bg-gray-200 h-full flex items-center w-56 justify-center text-indigo-800 font-mono"
                        >Precio asignado</label
                    >
                </div>
                <div
                    class="flex items-center  border-t border-gray-500 py-2 relative"
                    :class="[
                        'flex',
                        'items-center',
                        'border-b',
                        this.errors ? 'border-transparent' : 'border-gray-500',
                        'py-2'
                    ]"
                >
                    <input
                        v-model="form.company"
                        name="distributor_price"
                        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 pl-60 leading-tight focus:outline-none"
                        type="text"
                        placeholder="EMPRESA O NEGOCIO"
                        aria-label="Full name"
                    />
                    <label
                        for=""
                        class="absolute  pl-0 bg-gray-200 h-full flex items-center w-56 justify-center text-indigo-800 font-mono"
                        >Empresa</label
                    >
                </div>
                <div  class="flex items-center ">
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
        </div>
    </nav-component>
</template>

<script>
import NavComponent from "../NavComponent.vue";
export default {
    components: { NavComponent },
    data() {
        return {
            form: {assigned_price:''},
            errors: null
        };
    },
    mounted() {
        if (!!this.client) {
            this.form = this.client;
        }
    },
    props: {
        method: {
            type: String,
            required: true
        },
        client: {
            type: Object
        }
    },
    methods: {
        submit() {
            var obj = {
                title: "Clientes",
                message: "EL cliente se creo correctamente"
            };
            var url = "/clients";
            if (this.method == "put") {
                obj.message = "El cliente se modifico correctamente";
                this.form._method = "put";
                url = `/clients/${this.client.phone_number}`;
            }
            axios["post"](url, this.form)
                .then(res => {
                    this.notify(obj);
                    if (this.method == "post") this.form = {};
                    this.errors = null;
                })
                .catch(err => {
                    this.getErrors(err);
                });
        }
    },
    computed: {
        definePermission() {
            if (this.method.toUpperCase() === "POST") return "create client";
            return "edit client";
        },
        getTitle() {
            if (this.method.toUpperCase() === "POST") return "Nuevo cliente";
            return "Modificar cliente";
        }
    }
};
</script>
