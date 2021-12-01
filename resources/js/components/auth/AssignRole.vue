<template>
    <div class="bg-white rounded shadow p-4 md:w-4/12">
        <h3 class="text-xl text-center border-b-2 border-gray-300 px-4 py-1 mb-3 font-semibold">
            Asignar roles
        </h3>
        <div v-for="role in roles" :key="role.id">
            <label class="inline-flex items-center justify-center">
                <input
                    type="checkbox"
                    class="form-checkbox"
                    @change="toggleRole($event, role.id)"
                    :checked="isChecked(role)"
                />
                <span class="ml-2">{{ role.name.toUpperCase() }}</span>
            </label>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        roles: {
            type: Array
        },
        hasRoles: {
            type: Array
        }
    },
    methods: {
        toggleRole(event, id) {
            if (event.target.checked) return EventBus.$emit("assign-role", id);
            return EventBus.$emit("remove-role", id);
        },
        isChecked(role) {
            if (this.hasRoles)
                return this.hasRoles.some(element => role.id === element.id);
        }
    },
    computed: {}
};
</script>
