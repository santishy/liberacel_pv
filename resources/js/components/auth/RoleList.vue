<template>
    <div class="bg-white rounded shadow p-4" v-can="'view roles'">
        <ul class="list-inside bg-gray-200">
            <li v-for="role in localRoles" :key="role.id">
                <a
                    href="#"
                    @click.prevent="getPermissions(role.id)"
                    class="w-full p-2 block border-white border-b-2 "
                    >{{ role.name }}</a
                >
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    data: () => ({
        localRoles: []
    }),
    props: {
        roles: {
            type: Array
        }
    },
    mounted() {
        this.localRoles = this.roles;
        EventBus.$on("role-created", role => {
            this.roles.unshift(role);
        });
    },
    methods: {
        async getPermissions(id) {
            const response = await axios.get(`/roles/${id}`, {
                params: {
                    include: "permissions"
                }
            });
            // response.then(response => {
            await EventBus.$emit("permissions-found", response.data);
            //this.unchekedAll();
            //});
        },
        // deselecciona todos los checkbox que se encuentren en ese momento
        unchekedAll() {
            document.querySelectorAll(".form-checkbox").forEach(element => {
                element.checked = "";
            });
        }
    }
};
</script>
