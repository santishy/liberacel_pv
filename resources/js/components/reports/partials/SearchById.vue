<template>
    <form @submit.prevent="submit">
        <div class="relative flex items-center text-slate-400">
            <svg class="w-5 h-5 absolute ml-3 pointer-events-none" data-slot="icon" fill="none" stroke-width="1.5"
                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"></path>
            </svg>
            <input type="search" v-model="id"
                class="focus-within:text-slate-600 border-none placeholder:text-slate-400 bg-slate-100 font-semibold pl-10 px-4 py-2 block w-full ring-2 ring-purple-300 focus:ring-purple-500 focus:ring-2 rounded "
                placeholder="Buscar por número de nota" />
        </div>
    </form>
</template>

<script>
export default {
    props: {
        uri: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            filter: 'filter[searchById]',
            id: null
        }
    },
    methods: {
        submit() {
            axios.get(this.uri, {
                params: {
                    'filter[searchById]': this.id,
                }
            }).then((res) => {
                this.id = null;
                EventBus.$emit("search-result-by-id", res.data.data)
            }).catch(error => {
                console.log(error)
            })
        }
    }
}
</script>
