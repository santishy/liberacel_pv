<template>
    <div class="p-4 bg-white rounded shadow" v-can="'view roles'">
        <ul class="list-inside bg-gray-200">
            <li v-for="role in localRoles" :key="role.id">
                <a
                    href="#"
                    @click.prevent="getPermissions(role.id)"
                    class="block w-full p-2 border-b-2 border-white "
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
            try{

                const response = await axios.get(`/roles/${id}`, {
                    params: {
                        include: "permissions"
                    }
                });
               
                await EventBus.$emit("permissions-found", response.data);
            }catch(err){
                console.log(err)
            }
            
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
