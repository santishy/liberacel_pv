<template>
    <div class="relative">
        <input
            type="text"
            class="outline-none focus:border-blue-500"
            v-model="query"
            :class="[inputClass]"
            @blur="searchResultsVisible = false"
            @focus="searchResultsVisible = true"
            @keydown.esc="searchResultsVisible = false"
            @input="searchResultsVisible = true"
        />
        <div class="absolute right-0 top-0 h-full text-red-500 bg-gray-300">
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
            >
                <a
                    v-for="item in collection"
                    :key="item.id"
                    href="#"
                    class="p-2 hover:bg-gray-400"
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
        };
    },
    methods: {
        reset() {
            this.query = "";
        },
    },
};
</script>
