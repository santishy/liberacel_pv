<template>
    <tr>
        <td class="border px-4 py-2">
            {{ setting.name.replace("_", " ").toUpperCase() }}
        </td>
        <td class="border px-4 py-2">
            {{ setting.value }}
        </td>
        <td class="border px-4 py-2">
            {{ setting.status }}
        </td>
        <td class="border px-4 py-2">
            <div class="flex flex-wrap">
                <a
                    href="#"
                    @click.prevent="openForm"
                    class="
                        p-1
                        border border-blue-600
                        rounded-sm
                        text-xs
                        hover:bg-blue-500
                        bg-blue-700
                        text-white
                    "
                >
                    <edit-icon></edit-icon>
                </a>
            </div>
        </td>
    </tr>
</template>

<script>
import EditIcon from "../icons/EditIcon.vue";
export default {
    props: {
        setting: {
            type: Object,
        },
    },
    components: {
        EditIcon,
    },
    methods: {
        openForm() {
            EventBus.$emit('selected-setting',this.setting);
        },
    },
};
</script>
