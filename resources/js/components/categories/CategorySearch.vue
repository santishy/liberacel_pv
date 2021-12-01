<template>
    <form
        v-if="activeSearchCategory"
        @submit.prevent="search"
        class="w-full max-w-md shadow-lg rounded-lg bg-white md:px-6 md:py-8"
    >
        <div
            class="flex items-center py-2 text-dark text-center justify-center text-xl font-bold border-b border-teal-500"
        >
            Buscar categoría
            <button
                @click.prevent="disableCategorySearch"
                type="button"
                class="ml-4 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-0 px-2 border border-blue-500 hover:border-transparent rounded"
            >
                <i class="fas fa-plus"></i>
            </button>
        </div>
        <div class="flex items-center border-b border-teal-500 py-2">
            <input
                v-model="name"
                name="name"
                class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                :class="[
                    'flex',
                    'items-center',
                    'border-b',
                    this.errors ? 'border-transparent' : 'border-teal-500',
                    'py-2'
                ]"
                type="text"
                placeholder="Nombre de la categoría"
                aria-label="Full name"
            />
        </div>
        <div v-if="errors" class="flex items-center mb-3">
            <errors-component :errors="errors" />
        </div>

        <div class="flex justify-center mt-0 mb-0">
            <button
                class="bg-transparent transition-all duration-500 ease-in-out hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border-b-2 border-blue-500 hover:border-transparent w-full"
            >
                Buscar
            </button>
        </div>
        <div v-if="categories.length" class="mt-4">
            <category-list :categories="categories">
            </category-list>
        </div>
        <notifications group="foo"></notifications>
    </form>
</template>
<script>
import { mapMutations, mapState } from "vuex";
import CategoryList from './CategoryList'
export default {
    data: () => ({
        name: "",
        errors: null,
        categories: []
    }),
    components:{
        'category-list':CategoryList
    },
    computed: {
        ...mapState(["activeSearchCategory"])
    },
    methods: {
        ...mapMutations(["toggleActiveSearchCategory"]),
        disableCategorySearch() {
            this.toggleActiveSearchCategory(false);
        },
        search() {
            axios
                .get("/categories", { params: { "filter[search]": this.name } })
                .then(res => {
                    if (res.data.data.length) {
                        this.categories = res.data.data;
                    }
                })
                .catch(err => {
                    this.getErrors(err);
                });
        }
    }
};
</script>
