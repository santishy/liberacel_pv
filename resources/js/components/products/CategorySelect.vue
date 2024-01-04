<template>
    <div class="relative ">
        <slot name="labelCategory"> </slot>
        <input v-model="term_search" :class="[inputClass]" class="
                form-text-input
                w-full
            " autocomplete="off" @focus="allCategories" @keyup.prevent="search" @keyup.esc.prevent="close"
            @keyup.down.prevent="nextFocused" @keyup.up.prevent="previousFocused"
            @keyup.exact.enter.prevent="selectedCategory(focusedIndex, $event)" type="text"
            placeholder="Click o Enter para seleccionar | Presione la tecla ESC para limpiar" aria-label="Full name" />

        <button @click.prevent="close"
            class="absolute  right-2 text-gray-700 bg-white text-center  font-semibold px-2 py-0 hover:bg-gray-100 rounded-full shadow">
            X
        </button>
        <div class="
                absolute
                mt-4
                top-10
                w-full
                shadow
                z-5
                bg-white
                rounded
                max-h-64
                overflow-x-auto

            " v-if="items.length">
            <ul class="bg-white w-full relative" ref="dropdown">
                <li class="mt-2" v-for="(item, index) in items" :key="item.id">
                    <a class="
                            pl-4
                            block
                            w-full
                            focus:ring-2
                            focus:bg-gray-300
                            focus:border-transparent
                            font-mono font-light
                            hover:bg-gray-300
                            cursor-pointer
                        " href="#" :class="{ 'bg-gray-300': index == focusedIndex }" @keyup.exact.down="nextFocused"
                        @keyup.exact.up="previousFocused" @click.prevent="selectedCategory(index)">
                        {{ item.name }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        categories: {
            type: Array
        },
        product: {
            type: Object
        },
        inputClass: { type: String }
    },
    mounted() {
        if (this.product) {
            const category = this.categories.find(
                ele => ele.id == this.product.category_id
            );
            if (category) {
                this.term_search = category.name;
            } else {
                console.log("not found category")
            }
        }
        EventBus.$on("clean-search-term", () => {
            this.term_search = "";
        });
    },
    data() {
        return {
            items: [],
            term_search: "",
            category_id: null,
            selectedCategoryId: null,
            focusedIndex: 0
        };
    },
    methods: {
        search(event) {
            if (event.key === "ArrowDown" || event.key === "ArrowUp") return;
            this.focusedIndex = 0;
            if (this.term_search == "") {
                this.items = this.categories;
            } else {
                this.items = this.categories.filter(category => {
                    //var re = this.term_search.replace(/\s/g, '|'); idea nada mas,
                    //podria parter la cadena completa en dos partes mitad|mitad y buscar

                    if (
                        category.name.search(
                            new RegExp(this.term_search, "i")
                        ) != -1
                        //.search(new RegExp(re,'i')) != -1
                    )
                        return category;
                });
            }
        },
        selectedCategory(index, event) {
            if (this.items.length) {
                EventBus.$emit("selected-category", this.items[index].id);
                this.term_search = this.items[index].name.toUpperCase();
                this.items = [];
            }
        },
        close() {
            EventBus.$emit("selected-category", null);
            this.items = [];
            this.term_search = "";
        },
        nextFocused(event) {
            if (this.focusedIndex < this.items.length - 1) {
                this.focusedIndex = this.focusedIndex + 1;
                this.$refs.dropdown.children[
                    this.focusedIndex
                ].children[0].scrollIntoView({ block: "nearest" });
            }
        },
        previousFocused() {
            if (this.focusedIndex > 0) {
                this.focusedIndex = this.focusedIndex - 1;

                this.$refs.dropdown.children[
                    this.focusedIndex
                ].children[0].scrollIntoView({ block: "nearest" });
            }
        },
        allCategories() {
            if (this.term_search == "") {
                this.items = this.categories;
            }
        }
    }
};
</script>
