<template>
    <layout-component>
        <div class="w-6/12 mx-auto">
            <category-form class="w-full" :uri="`/categories/${category.id}`"> </category-form>
        </div>
    </layout-component>
</template>
<script>

import CategoryForm from "./CategoryForm.vue";

export default {
    components: {
        CategoryForm
    },
    props: {
        method: {
            type: String
        },
        category: {
            type: Object
        }
    }
};
</script>
