<template>
    <nav-component>
        <div
            class="md:w-9/12 mx-auto px-4  flex justify-center bg-transparent md:mt-32 mt-24"
        >
            <form
                @submit.prevent="submit"
                class="w-full  shadow-lg rounded-lg bg-white px-6 py-8"
            >
                <div
                    class="flex items-center pb-1 text-dark text-center justify-center text-xl font-bold "
                >
                    Modificar contenido del ticket
                </div>
                <div class="flex items-center  border-t border-b border-gray-500 py-2 relative">
                    <input
                        v-model="form.company"
                        name="companty"
                        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 pl-60 leading-tight focus:outline-none"
                        type="text"
                        placeholder="COMPAÑIA"
                        aria-label="Full name"
                    />
                    <label
                    for=""
                    class="absolute  pl-0 bg-gray-200 h-full flex items-center w-44 justify-center text-indigo-800 font-mono"
                    >Compañia</label
                >
                </div>
                <div class="flex items-center  border-t border-b border-gray-500 py-2 relative">
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
                    class="absolute  pl-0 bg-gray-200 h-full flex items-center w-44 justify-center text-indigo-800 font-mono"
                    >Dirección</label
                >
                </div>
                <div class="flex items-center  border-t border-b border-gray-500 py-2 relative">
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
                    class="absolute  pl-0 bg-gray-200 h-full flex items-center w-44 justify-center text-indigo-800 font-mono"
                    >Telefono</label
                >
                </div>
                <div class="flex items-center  border-t border-b border-gray-500 py-2 relative">
                    <textarea
                        v-model="form.footer"
                        name="footer"
                        rows="5"
                        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 pl-60 leading-tight focus:outline-none"
                        type="text"
                        placeholder="PIE DE PAGINA"
                        aria-label="Full name"
                    />
                    <label
                    for=""
                    class="absolute  pl-0 bg-gray-200 h-full flex items-center w-44 justify-center text-indigo-800 font-mono"
                    >Pie de pagina</label
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
                <notifications group="foo"></notifications>
            </form>
        </div>
    </nav-component>
</template>

<script>
import NavComponent from "../NavComponent.vue";

export default {
    created() {
        this.form = this.ticket;
    },
    props: {
        ticket: {
            type: Object
        }
    },
    components: { NavComponent },
    data() {
        return {
            form: {},
            errors: null,
            obj: { title: "Tickets" }
        };
    },
    methods: {
        submit() {
            this.obj.message = "EL ticket se modifico correctamente";
            this.form._method='put';
            axios["post"](`/tickets/${this.ticket.id}`, this.form)
                .then(res => {
                    this.notify(this.obj);
                    this.errors = null;
                })
                .catch(err => {
                    this.getErrors(err);
                });
        }
    }
};
</script>
