<template>
    <li class="px-4  text-center flex flex-wrap justify-between py-2">
        <p class="text-center">{{ category.name }}</p>
        <div>
            <a
                :href="`/categories/${category.id}/edit`"
                class="transition-all rounded border-2 border-blue-800 px-2 text-blue-700 hover:bg-blue-800 hover:text-white inline-block"
                ><edit-icon></edit-icon
            ></a>
            <delete-category
                :category="category"
                class="inline-block"
                :index="index"
            ></delete-category>
        </div>
    </li>
</template>
<script>
import DeleteCategory from "./DeleteCategory.vue";
import EditIcon from "../icons/EditIcon.vue";
export default {
    
    props: {
        category: {
            type: Object,
            required: true
        },
        index: {
            type: Number
        }
    },
    components: {
        DeleteCategory,
        EditIcon,
    },
    created() {},
    data() {
        return {
            fill: false
        };
    },
    methods: {}
};
</script>
