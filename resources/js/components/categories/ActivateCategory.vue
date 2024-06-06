<template>
    <form @submit.prevent="submit">
        <input type="hidden" v-model="active">
        <button type="submit"
            class="transition-all p-1 rounded border-2 border-emerald-500  text-emerald-700 hover:bg-emerald-800 hover:text-white">
            <svg data-slot="icon" class="w-4 h-4" fill="none" stroke-width="1.5" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"></path>
            </svg>
        </button>
    </form>
</template>

<script>
export default {
    data() {
        return {
            active: true,
        }
    },
    props: {
        category: {
            type: Object,
            default: () => Object
        }
    },
    methods: {
        submit() {
            axios.post(`/categories/${this.category.id}`, {
                ... this.complementaryColumns(),
                "active": this.active
            }).then((res) => {
                EventBus.$emit("updated-category", res.data)
            }).catch(error => {
                console.log(error)
            })
        },
        complementaryColumns() {
            return {
                "_method": 'PUT',
                "name": this.category.name,
            }
        }
    }
}
</script>
