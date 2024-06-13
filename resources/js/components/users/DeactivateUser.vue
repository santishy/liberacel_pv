<template>
    <form @submit.prevent="submit">
        <input type="hidden" v-model="active" />
    </form>
</template>

<script>
export default {
    props: {
        user: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            active: false,
        }
    },
    methods: {
        submit() {
            axios.delete(`/users/${this.user.id}`)
        }
    }
}
</script>
