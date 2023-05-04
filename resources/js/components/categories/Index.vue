<template>
    <nav-component>
        <div class="flex flex-wrap  md:w-10/12 mx-auto justify-center">
            <category-form
                class="self-start w-6/12"
                uri='/categories'
            ></category-form>
            <div class="ml-6 w-6/12 ">
                <category-list class="w-full" ></category-list>
            </div>
        </div>
    </nav-component>
</template>
<script>

import NavComponent from "../NavComponent.vue";

export default {
    components: {
        NavComponent
    }
};
</script>
