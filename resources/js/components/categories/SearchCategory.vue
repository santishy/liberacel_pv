<template>
    <form @submit.prevent="submit">
        <div>
            <input type="text" placeholder="Introduce el nombre + enter. Para buscar la categoria" v-model="name"
                class="form-text-input w-full">
        </div>
    </form>
</template>
<script>
export default {
    data() {
        return {
            name: '',
        }
    },
    methods: {
        submit() {
            axios.get('/categories', {
                params: {
                    "filter[search]": this.name
                }
            }).then((res) => {
                if (res?.data?.data?.length) {
                    EventBus.$emit('matching-categories', res.data.data)
                }
            }).catch((error) => {
                this.getErrors(error);
                console.log(error);
            })
        }
    }
}
</script>
