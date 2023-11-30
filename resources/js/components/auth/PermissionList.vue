<template>
    <div class="rounded bg-white shadow py-2 px-4 flex flex-wrap justify-center items-center">
        <div v-if="role != null" class="w-full text-xl border-gray-300 border-b-2 pb-1 col-span-3 mb-2">
            Agregar permisos al rol:
            <span v-if="!!role" class="text-dark font-semibold">{{
                role.name.toUpperCase()
            }}</span>
        </div>
        <div
            class="flex p-2 scroll-smooth scrollbar-track-transparent scrollbar-thumb-teal-800 scrollbar-thin md:max-h-96 flex-col overflow-y-hidden w-full border flex-wrap gap-4">
            <div v-for="permission in permissions" :key="permission.id"
                class="md:w-48 bg-teal-50 border border-teal-700 w-full p-1 px-4 justify-start rounded-sm flex items-center">
                <label class="flex items-center cursor-pointer">
                    <input @change="togglePermission(permission, $event)" type="checkbox"
                        class="form-checkbox border border-teal-700" :checked="isChecked(permission.name)" />
                    <span class="ml-2 text-teal-700 text-xs font-semibold">{{
                        permission.translate.toUpperCase()
                    }}</span>
                </label>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        permissions: {
            type: Array,
        },
    },
    data: () => ({
        role: false,
    }),
    created() {
        EventBus.$on("permissions-found", (role) => {
            Vue.set(this.$data, "role", role.data);
        });
    },
    methods: {
        isChecked(name) {
            if (!!this.role) {
                return this.role.permissions.some((permission, index) => {
                    if (permission.name == name) {
                        return true;
                    }
                });
            }
        },
        togglePermission(permission, event) {
            let method = "post";
            var params = { permission_id: permission.id };
            if (!event.target.checked) {
                method = "delete";
                params = { data: params };
            }
            axios[method](`/roles/${this.role.id}/permissions`, params)
                .then((res) => {
                    this.role.permissions = res.data.permissions;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
};
</script>
