<template>
    <form @submit.prevent="submit">
        <input type="hidden" v-model="active" />
        <button :class="[getClasses]"
            class="bg-white w-full mt-4 rounded shadow-sm transition-all duration-500 ease-in-out  font-semibold hover:text-white py-1 px-8 border  hover:border-transparent">
            {{ getButtonText }}
        </button>
    </form>
</template>

<script>
export default {
    data() {
        return {
            active: false,
        }
    },
    methods: {

        submit() {
            axios.get(`/categories`, {
                params: {
                    "filter[isActive]": this.active
                }
            }).then(res => {
                EventBus.$emit("matching-categories", res.data.data)
            }).catch((error) => console.log(error)
            ).finally(() => {
                this.active = !this.active;
            })
        },
    },

    computed: {
        getButtonText() {
            return this.active ? "Listar Categorías Activas" : "Listar Categorías Desactivadas";
        },
        getClasses() {
            return this.active ? "border-sky-500 hover:bg-sky-700 text-sky-700" : "border-red-500 hover:bg-red-700 text-red-700"
        }
    }
}
</script>
