<template>
    <ul
        class="w-full rounded shadow bg-white p-4 divide-y divide-light-blue-400 text-gray-700"
        v-can="'view categories'"
        v-cloak
    >
        <li class="px-4  bg-purple-400 text-center py-2 text-gray-900 font-semibold">
            Categorías
        </li>
        <category-list-item
            v-for="(category,index) in categories"
            :category="category"
            :index="index"
            :key="category.id"
        ></category-list-item>
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
        axios.get("/categories?ALL=TRUE").then(res => {
            this.categories = res.data.data;
        });
        EventBus.$on('deleted-category',this.removeCategory);
    },
    methods:{
        removeCategory(index){
            this.categories.splice(index,1);
        }
    }
};
</script>
