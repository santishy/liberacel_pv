<template>
    <layout-component>
        <div class="flex flex-wrap gap-4  mx-auto justify-between ">
            <category-form class="self-start sm:w-6/12 sm:mt-4 mt-0" uri='/categories'></category-form>
            <div class="  sm:w-6/12 flex-1 ">
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
