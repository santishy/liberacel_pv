<template>
    <div class="flex flex-col gap-2">
        <note-list class="!bg-green-100 !shadow-none" :credit="credit">
        </note-list>
    </div>
</template>
<script>
import NoteList from "./NoteList.vue";
import StateComponent from "../../reports/partials/StatesComponent.vue";
export default {
    components: {
        NoteList,
        StateComponent,
    },
    props: {
        credit: {
            type: Object,
            required: true
        }
    },
    name: "credit-notes"
}
</script>
