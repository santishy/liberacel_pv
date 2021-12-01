<template>
    <div class=" ">
        <form
            class="rounded bg-white shadow  p-4"
            @submit.prevent="submit"
            v-can="'create role'"
        >
            <div
                class="flex items-center py-1 text-dark text-center justify-center text-xl font-bold"
            >
                Nuevo Role
            </div>
            <div
                class="flex items-center  border-t border-b border-gray-500 py-2 relative"
            >
                <input
                    v-model="form.name"
                    name="name"
                    class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 pl-48 leading-tight focus:outline-none"
                    type="text"
                    placeholder="NOMBRE"
                    aria-label="Full name"
                />
                <label
                    for=""
                    class="absolute  pl-0 bg-gray-200 h-full flex items-center w-44 justify-center text-indigo-800 font-mono"
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
        <role-list class="mt-4" :roles="roles"></role-list>
    </div>
</template>

<script>
import RoleList from "./RoleList.vue";
import ErrorsComponent from "../ErrorsComponent";

export default {
    data: () => ({
        form: {},
        obj: { title: "Roles", message: "Rol creado correctamente." }
    }),
    props: {
        roles: {
            type: Array
        }
    },
    components: { ErrorsComponent },
    components: { RoleList },
    methods: {
        submit() {
            axios
                .post("/roles", this.form)
                .then(res => {
                    this.notify(this.obj);
                    EventBus.$emit("role-created", res.data);
                })
                .catch(error => {
                    this.getErrors(error);
                });
        }
    }
};
</script>
