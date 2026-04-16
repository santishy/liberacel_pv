<template>
    <div class="flex gap-2">
        <button class="primary-button px-4 py-1" @click="setFilter(null)">Todos</button>
        <button class="secondary-button px-4 py-1" @click="setFilter('available')">Disponibles</button>
        <button class="warning-button px-4 py-1" @click="setFilter('assigned')">Asignados</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            filter: 'all'
        }
    },
    methods: {
        setFilter(filter) {
            this.filter = filter;
            this.$emit('filter-changed', filter);
        }
    }
}
</script>