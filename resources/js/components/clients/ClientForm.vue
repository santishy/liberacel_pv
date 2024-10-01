<template>
    <layout-component>
        <div class="w-full sm:max-w-2xl mx-auto flex justify-center bg-transparent">
            <form @submit.prevent="submit" v-can="definePermission"
                class="w-full shadow rounded bg-white px-6 py-4 space-y-4">
                <div class="flex items-center py-2 text-dark justify-start text-xl font-bold">
                    {{ getTitle }}
                </div>
                <errors-component />
                <div>
                    <label for="" class="form-label">Nombre</label>
                    <input v-model="form.name" name="name" class="form-text-input w-full" type="text"
                        placeholder="NOMBRE" aria-label="Full name" />
                </div>
                <div>
                    <label for="" class="form-label">Dirección</label>
                    <input v-model="form.address" name="address" class="form-text-input w-full" type="text"
                        placeholder="DIRECCION" aria-label="Full name" />
                </div>
                <div>
                    <label for="" class="form-label">Telefono</label>
                    <input v-model="form.phone_number" name="phone_number" class="form-text-input w-full" type="text"
                        placeholder="NUMERO DE TELEFONO" aria-label="Full name" />
                </div>
                <div>
                    <label for="" class="form-label">Email</label>
                    <input v-model="form.email" name="email" class="form-text-input w-full" type="email"
                        placeholder="EMAIL" aria-label="Full name" />
                </div>
                <div class="max-w-full">
                    <label for="" class="form-label">Precio
                        asignado</label>
                    <select name="assigned_price" v-model="form.assigned_price"
                        plahceholder="Asigna un precio al cliente" class="form-text-input w-full">
                        <option disabled value="" selected class="text-slate-500">Asignar un precio</option>
                        <option value="retail_price">Precio al por menor</option>
                        <option value="wholesale_price">Precio al por mayor</option>
                    </select>
                </div>
                <div class="w-full overflow-x-hidden">
                    <label for="" class="form-label">Empresa</label>
                    <input v-model="form.company" name="distributor_price" class="form-text-input w-full" type="text"
                        placeholder="EMPRESA O NEGOCIO" aria-label="Full name" />
                </div>



                <div class="flex justify-center mt-0 mb-0">
                    <button class="primary-button w-full">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </layout-component>
</template>

<script>
// import NavComponent from "../NavComponent.vue";
export default {
    // components: { NavComponent },
    data() {
        return {
            form: { assigned_price: '' },
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
                    EventBus.$emit('an-error-ocurred', err);
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
