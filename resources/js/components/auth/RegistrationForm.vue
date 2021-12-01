<template>
    <form
        @submit.prevent="submit"
        v-can="definePermission"
        class="md:w-7/12 shadow-lg rounded-lg bg-white md:px-6 md:py-8"
    >
        <div
            class="flex items-center pb-2 pt-0 text-dark text-center justify-center text-xl font-bold"
        >
            {{ getTitle }}
        </div>
        <div class="flex items-center  border-t border-gray-500 py-2 relative">
            <select
                v-model="form.inventory_id"
                name="inventory_id"
                class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 pl-60 leading-tight focus:outline-none"
                placeholder="Nombre completo"
                aria-label="Full name"
            >
                <option value="" disabled selected>Elige un almacén</option>
                <option
                    v-for="inventory in inventories"
                    :key="inventory.id"
                    :value="inventory.id"
                >
                    {{ inventory.name }}
                </option>
            </select>
            <label
                for=""
                class="absolute  pl-0 bg-gray-200 h-full flex items-center w-56 justify-center text-indigo-800 font-mono"
                >Almacenes</label
            >
        </div>
        <div class="flex items-center  border-t border-gray-500 py-2 relative">
            <input
                v-model="form.name"
                name="name"
                class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 pl-60 leading-tight focus:outline-none"
                type="text"
                placeholder="Nombre completo"
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
                v-model="form.email"
                name="email"
                class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 pl-60 leading-tight focus:outline-none"
                type="email"
                placeholder="Correo electronico"
                aria-label="Full name"
            />
            <label
                for=""
                class="absolute  pl-0 bg-gray-200 h-full flex items-center w-56 justify-center text-indigo-800 font-mono"
                >Email</label
            >
        </div>
        <div
            v-if="!editableUser"
            class="flex items-center  border-t border-gray-500 py-2 relative"
        >
            <input
                v-model="form.password"
                name="password"
                class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 pl-60 leading-tight focus:outline-none"
                type="password"
                placeholder="Contraseña"
                aria-label="Full name"
            />
            <label
                for=""
                class="absolute  pl-0 bg-gray-200 h-full flex items-center w-56 justify-center text-indigo-800 font-mono"
                >Contraseña</label
            >
        </div>
        <div
            v-if="!editableUser"
            class="flex items-center  border-t border-b border-gray-500 py-2 relative"
        >
            <input
                v-model="form.password_confirmation"
                name="password_confirmation"
                class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 pl-60 leading-tight focus:outline-none"
                type="password"
                placeholder="Confirmar contraseña"
                aria-label="Full name"
            />
            <label
                for=""
                class="absolute  pl-0 bg-gray-200 h-full flex items-center w-56 justify-center text-indigo-800 font-mono"
                >Confirmar Contraseña</label
            >
        </div>
        <div class="flex items-center">
            <errors-component :errors-found="errors" />
        </div>

        <div class="flex justify-center mt-0 mb-0">
            <button
                class="bg-transparent transition-all duration-500 ease-in-out hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border-b-2 border-blue-500 hover:border-transparent w-full"
            >
                {{ getButtonTitle }}
            </button>
        </div>
    </form>
</template>
<script>
export default {
    props: {
        editableUser: {
            type: Object
        },
        inventories: {
            type: Array
        },
        uri: {
            type: String,
            required: true
        },
        method: {
            type: String,
            required: true
        }
    },
    data: () => ({
        form: {
            inventory_id: ""
        },
        roles: [],
        obj: {
            title: "Usuarios"
        }
    }),
    created() {
        EventBus.$on("assign-role", role => {
            this.roles.push(role);
        });
        EventBus.$on("remove-role", role => {
            let index = this.roles.indexOf(role);
            this.roles.splice(index, 1);
        });
        if (this.editableUser) {
            this.form = this.editableUser;
            this.editableUser.roles.map(({ id }) => {
                this.roles.push(id);
            });
        }
    },
    methods: {
        submit() {
            this.form.roles = this.roles;
            this.form._method = this.method;
            axios["post"](this.uri, this.form)
                .then(res => {
                    if (this.method == "post") {
                        this.form = { inventory_id: "" };
                        this.obj.message = "Usuario agregado correctamente.";
                    } else {
                        this.obj.message = "Usuario modificado correctamente";
                    }
                    this.notify(this.obj);
                })
                .catch(err => {
                    this.getErrors(err);
                });
        }
    },
    computed: {
        getTitle() {
            return !!this.editableUser ? "Modificar usuario" : "Nuevo usuario";
        },
        getButtonTitle() {
            return !!this.editableUser ? "Editar" : "Guardar";
        },
        definePermission() {
            if (this.method.toUpperCase() === "POST") return "create user";
            return "edit user";
        }
    }
};
</script>
