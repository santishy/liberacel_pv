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
        },
        index: {
            type: Number
        }
    },
    data() {
        return {
            active: false,
        }
    },
    methods: {
        async submit() {
            try {
                const res = await axios.delete(`/users/${this.user.id}`);
                EventBus.$emit('disabled-user', this.index)
            } catch (error) {
                console.log(error);
            }

        }
    }
}
</script>
