<template>
    <ul class="w-full max-h-96 sm:max-h-max overflow-y-auto sm:overflow-auto rounded-lg shadow bg-white p-4 divide-y divide-light-blue-400 text-gray-700"
        v-can="'view categories'" v-cloak>
        <category-list-item v-for="(category, index) in categories" :category="category" :index="index"
            :key="category.id"></category-list-item>
    </ul>
</template>
<script>
import CategoryListItem from "./CategoryListItem.vue";
export default {
    components: { "category-list-item": CategoryListItem },
    data() {
        return {
            categories: []
        };
    },
    created() {
        EventBus.$on("category-created", category => {
            this.categories.unshift(category);
        });
        EventBus.$on("matching-categories", this.setCategories)
        axios.get("/categories?ALL=TRUE", {
            params: {
                'filter[isActive]': true
            }
        }).then(res => {
            this.categories = res.data.data;
        });
        EventBus.$on('deleted-category', this.removeCategory);
    },
    methods: {
        removeCategory(index) {
            // EventBus.$emit("open-modal-" + this.categories[index].id, true);
            this.categories.splice(index, 1);
        },
        setCategories(data) {
            this.categories = data;
        }
    }
};
</script>
