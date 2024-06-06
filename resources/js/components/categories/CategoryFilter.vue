<template>
    <div class="p-4 bg-white rounded">
        <search-category />
        <category-active-filter />
    </div>
</template>

<script>
import SearchCategory from "./SearchCategory.vue";
import CategoryActiveFilter from "./CategoryActiveFilter.vue";
export default {
    components: {
        SearchCategory
    }
}
</script>
