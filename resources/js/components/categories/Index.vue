<template>
    <layout-component>
        <div class="flex flex-wrap  md:w-10/12 mx-auto justify-center">
            <category-form class="self-start w-6/12" uri='/categories'></category-form>
            <div class="ml-6 w-6/12 ">
                <category-filter />
                <category-list class="w-full mt-4"></category-list>
            </div>
        </div>
    </layout-component>
</template>
<script>

import CategoryFilter from "./CategoryFilter.vue"
import CategoryForm from "./CategoryForm.vue";
import CategoryList from "./CategoryList.vue";
export default {
    components: {
        CategoryFilter,
        CategoryForm,
        CategoryList,
    }
};
</script>
