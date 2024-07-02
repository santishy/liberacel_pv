<template>
    <div class="flex flex-col gap-2">
       <!--  <div class="font-mono text-lg text-slate-600 text-start">{{ credit.client.name }}</div>
        <div class="flex flex-wrap justify-end gap-2 p-1 rounded-sm bg-green-200 font-mono text-slate-500">
            <span>Total pagado</span>{{ credit.formatted_amount_paid }}
        </div>
        <div class="flex flex-wrap justify-end gap-2 bg-orange-400 p-1 rounded-sm font-mono text-white">
            <span>Saldo</span>{{ credit.total_amount_formatted }}
        </div> -->
        <note-list class="!bg-green-100 !shadow-none" :credit="credit">
        </note-list>
    </div>
</template>
<script>
import NoteList from "./NoteList.vue";
export default {
    components:{
        NoteList
    },
    props: {
        credit: {
            type: Object,
            required: true
        }
    },
    name:"credit-notes"
}
</script>
