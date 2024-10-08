<template>
    <div
        class="relative overflow-x-auto bg-white scroll-smooth scrollbar-track-transparent  scrollbar-thumb-sky-700 scrollbar-thin">
        <table class="w-full text-sm text-left text-slate-500 ">
            <thead class=" text-slate-700 uppercase bg-slate-100">
                <tr>
                    <th class="px-2 py-2">Fecha</th>
                    <th class="px-2 py-2">Nota</th>
                    <th class="p-2">Status</th>
                    <th class="px-2 py-2">Tipo</th>
                    <th class="px-2 py-2">Total</th>
                </tr>
            </thead>
            <tbody>
                <note-list-item v-for="(note, index) in notes" :key="note.id" :note="note" :index="index">
                </note-list-item>
            </tbody>
        </table>
        <infinite-loading @infinite="getNotes" :identifier="infiniteId"></infinite-loading>
    </div>
</template>
<script>
import NoteListItem from './NoteListItem.vue';
export default {
    mounted() {
        EventBus.$on('show-credit-notes', () => {
            this.changeParams();
        });
    },
    props: {
        credit: {
            type: Object
        }
    },
    data() {
        return {
            notes: [],
            page: 1,
            infiniteId: 1,
            params: {
                "filter[getNotesByStatus]": "completed",
            }
        };
    },
    components: {
        NoteListItem,
    },
    methods: {
        getNotes($state) {
            axios
                .get(`/credits/${this.credit.id}/notes`, {
                    params: {
                        page: this.page,
                        ...this.params
                    }
                })
                .then((res) => {
                    if (res.data.notes.length) {
                        this.page += 1;
                        this.notes.push(...res.data.notes);
                        $state.loaded();
                    }
                    else {
                        $state.complete();
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        changeParams(value = "completed") {
            this.params["filter[getNotesByStatus]"] = value;
            this.page = 1;
            this.notes = [];
            this.infiniteId += 1;
        },
    },
    computed: {
        formattedCurrency() {
            return new Intl.NumberFormat("mx-MX", {
                style: "currency",
                currency: "MXN",
            })
        }
    }
};

</script>
