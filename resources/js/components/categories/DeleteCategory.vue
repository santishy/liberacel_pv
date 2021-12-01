<template>
    <form @submit.prevent="destroy">
        <button
            type="submit"
            class="transition-all rounded border-2 border-red-800 px-2 text-red-700 hover:bg-red-800 hover:text-white"
        >
            <trash-icon></trash-icon>
        </button>
        <information-component :id="category.id">
            <template v-slot:title>Categorías</template>
            <template>
                <p class="text-gray-700 text-xs mt-3">{{ message }}</p>
            </template>
        </information-component>
    </form>
</template>

<script>
import InformationComponent from "../modals/InformationComponent.vue";
import TrashIcon from "../icons/TrashIcon.vue"
export default {
    components: {
        InformationComponent,
        TrashIcon,
    },
    props: {
        category: {
            type: Object
        },
        index: {
            type: Number
        }
    },
    data() {
        return {
            message: null
        };
    },
    methods: {
        destroy() {
            axios.delete(`/categories/${this.category.id}`).then(res => {
                if (res.data.deleted) {
                    return EventBus.$emit("deleted-category", this.index);
                } else {
                    this.message = res.data.message;
                    EventBus.$emit("open-modal-" + this.category.id, true);
                }
            });
        }
    }
};
</script>
