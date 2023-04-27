<template>
    <li class="px-4  gap-2 text-center flex flex-wrap items-center justify-between py-2">
        <p class="text-center">{{ category.name }}</p>
        <div class=" flex items-center justify-center">
            <a :href="`/categories/${category.id}/edit`"
                class="transition-all mr-2 rounded border-2 border-blue-800 p-1 text-blue-700 hover:bg-blue-800 hover:text-white ">
                <svg
                    xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
            </a>
            <delete-category :category="category" class="inline-block" :index="index"></delete-category>
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
    created() { },
    data() {
        return {
            fill: false
        };
    },
    methods: {}
};
</script>
