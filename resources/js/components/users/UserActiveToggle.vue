<template>
    <form @submit.prevent="submit">
        <button v-if="userItem.active" type="submit"
            class="transition-all p-1 rounded text-red-700 hover:bg-red-800 hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
            </svg>
        </button>
        <button v-else type="submit"
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
    props: {
        userItem: {
            type: Object,
            default: () => Object,
            required: true
        },
        index: {
            type: Number
        }
    },
    methods: {
        submit() {
            axios.post(`/users/${this.userItem.id}`, {
                "_method": "PUT",
                "active": !this.userItem.active
            }).then((res) => {
                EventBus.$emit("user-active-toggle", { user: res.data.data, index: this.index });
            }).catch(error => {
                console.log(error)
            })
        },

    }
}
</script>
