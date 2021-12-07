<template>
    <form>
        <button
            class="bg-red-500 hover:bg-red-700 text-white h-9 w-9 rounded-full"
        >
            <trash-icon></trash-icon>
        </button>
    </form>
</template>
<script>
import TrashIcon from "../icons/TrashIcon.vue";

export default {
    components: { TrashIcon },
};
</script>
