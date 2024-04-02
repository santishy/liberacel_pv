<template>
    <div class="relative">
        <input v-model="query" type="text" ref="search-select" placeholder="Selecciona un producto"
            :class="[inputClass]" @blur="searchResultsVisible = false" @focus="fillItems" @keyup="search($event)"
            @keydown.esc="searchResultsVisible = false" @keyup.enter.exact="selectedItem"
            @input="searchResultsVisible = true" @keyup.up="highligthPrevious" @keyup.down="highlightNext" />
        <div v-if="searchResultsVisible || query.length"
            class="absolute top-0 right-0 h-full text-gray-700 bg-gray-300">
            <a href="#" class="relative z-10 flex items-center h-full p-1" @click.prevent="reset">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </a>
        </div>
        <div v-if="searchResultsVisible" class="
                absolute
                left-0
                right-0
                z-10
                w-full
                bg-gray-100
                rounded
                shadow
                top-12
            ">
            <div class="
                    flex flex-col
                    overflow-y-auto
                    divide-y-2 divide-gray-400
                    max-h-64
                " ref="results">
                <a v-for="(item, index) in items" :key="item.id" href="#" class="p-2 hover:bg-gray-400"
                    @mousedown.prevent="searchResultsVisible = true" @click.prevent="selectedItem(index, $event)"
                    :class="{ 'bg-gray-400': highlightedIndex === index }">
                    {{ item.name }}
                </a>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        collection: { type: Array },
        inputClass: { type: String, default: "" },
    },
    created() {

    },
    mounted() {
        EventBus.$on("reset-search-select", this.reset);
        EventBus.$on("focus-search-select", () => {
            if (!this.$refs?.["search-select"]) return;
            this.$refs["search-select"].focus();
        });
    },
    data() {
        return {
            query: "",
            searchResultsVisible: false,
            items: [],
            highlightedIndex: 0,
        };
    },
    methods: {
        reset() {
            Vue.set(this.$data, "query", "");
            this.highlightedIndex = 0;
            this.items = [];
        },
        fillItems(event) {
            this.searchResultsVisible = true;
            this.search(event);
        },

        search(event) {
            if (
                event.key === "ArrowDown" ||
                event.key === "ArrowUp" ||
                event.key == "Enter"
            ) {
                return;
            }

            this.highlightedIndex = 0;
            if (this.query === "") {
                this.items = this.collection;
                EventBus.$emit("selected-item", null);
                return;
            }
            this.items = this.collection.filter((item) => {
                if (item.name.search(new RegExp(this.query.trim(), "i")) != -1)
                    return item;
            });
        },
        highligthPrevious() {
            if (this.highlightedIndex > 0) {
                this.highlightedIndex -= 1;
                this.scrollIntoView();
            }
        },
        highlightNext() {
            if (this.highlightedIndex < this.items.length - 1) {
                this.highlightedIndex += 1;
                this.scrollIntoView();
            }
        },
        scrollIntoView() {
            if (!this.items[this.highlightedIndex]) {
                if (this.highlightedIndex < this.items.length)
                    this.highlightedIndex = this.items.length - 1;
                else this.highlightedIndex = 0;
            }
            if (this.$refs.results)
                this.$refs.results.children[
                    this.highlightedIndex
                ].scrollIntoView({
                    block: "nearest",
                });
        },

        selectedItem(index = "", event) {
            if (!this.items.length) return;
            if (!isNaN(index)) {
                this.highlightedIndex = index;
            }
            let item = this.items[this.highlightedIndex];
            this.searchResultsVisible = false;
            this.query = this.items[this.highlightedIndex].name;
            this.items = [];
            this.highlightedIndex = 0;
            if (item) EventBus.$emit("selected-item", item);
        },
    },
};
</script>
