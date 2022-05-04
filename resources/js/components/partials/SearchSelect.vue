<template>
    <div class="relative">
        <input
            type="text"
            class="outline-none focus:border-blue-500"
            v-model="query"
            :class="[inputClass]"
            @blur="searchResultsVisible = false"
            @focus="fillItems"
            @keydown="search"
            @keydown.esc="searchResultsVisible = false"
            @keydown.enter.prevent="selectedItem"
            @input="searchResultsVisible = true"
            @keyup.up="highligthPrevious"
            @keyup.down="highlightNext"
        />
        <div
            v-if="searchResultsVisible"
            class="absolute right-0 top-0 h-full text-gray-700 bg-gray-300"
        >
            <a
                href="#"
                class="h-full flex items-center p-1"
                @click.prevent="reset"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                </svg>
            </a>
        </div>
        <div
            v-if="searchResultsVisible"
            class="
                absolute
                top-12
                left-0
                right-0
                w-full
                z-10
                rounded
                bg-gray-100
                shadow
            "
        >
            <div
                class="
                    flex flex-col
                    divide-y-2 divide-gray-400
                    max-h-64
                    overflow-y-auto
                "
                ref="results"
            >
                <a
                    v-for="(item, index) in items"
                    :key="item.id"
                    href="#"
                    class="p-2 hover:bg-gray-400"
                    @mousedown.prevent="searchResultsVisible = true"
                    :class="{ 'bg-gray-400': highlightedIndex === index }"
                >
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
            this.query = "";
            this.highlightedIndex = 0;
        },
        fillItems() {
            this.searchResultsVisible = true;
            //this.items = this.collection;
            this.search();
        },
        search(event) {
            console.log('entro');
            if(event)
                if (event.key === "ArrowDown" || event.key === "ArrowUp") { return;}
            this.highlightedIndex = 0;
            if (this.query == "") {
                this.items = this.collection;
                return;
            }
            this.items = this.collection.filter((item) => {
                //var re = this.term_search.replace(/\s/g, '|'); idea nada mas,
                //podria parter la cadena completa en dos partes mitad|mitad y buscar

                if (
                    item.name.search(new RegExp(this.query.trim(), "i")) != -1
                    //.search(new RegExp(re,'i')) != -1
                )
                    return item;
            });
        },
        highligthPrevious() {
            console.log("hola ");
            if (this.highlightedIndex >= 0) {
                this.highlightedIndex -= 1;
                this.scrollIntoView();
            }
        },
        highlightNext() {
            if (this.highlightedIndex < this.items.length) {
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
            this.$refs.results.children[this.highlightedIndex].scrollIntoView({
                block: "nearest",
            });
        },
        selectedItem() {
            let item = this.items[this.highlightedIndex];
            this.searchResultsVisible=false;
            this.query = this.items[this.highlightedIndex].name;
            if (item) EventBus.$emit("selected-item", item);
        },
    },
};
</script>
