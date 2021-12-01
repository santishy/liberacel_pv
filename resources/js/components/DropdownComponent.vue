<template>
    <a
        href="#responsive-header"
        class="block  transition-all duration-500 ease-in-out mt-4 lg:inline-block lg:mt-0 text-gray-200 md:hover:text-white mr-4"
        :class="getZ"
    >
        <div
            @click="isOpen = !isOpen"
            class="relative md:text-base text-lg"
            :class="getZ"
        >
            {{ name }}
            <svg
                aria-hidden="true"
                focusable="false"
                data-prefix="fas"
                data-icon="chevron-down"
                class="inline-block"
                role="img"
                height="1em"
                width="1em"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 448 512"
            >
                <path
                    fill="currentColor"
                    d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"
                ></path>
            </svg>
        </div>
        <button
            v-if="isOpen"
            tabindex="-1"
            @click="isOpen = false"
            class="hidden sm:block fixed inset-0 h-full w-full bg-black opacity-50 cursor-default md:z-5"
        ></button>
        <div
            v-if="isOpen"
            class="bg-transparent w-full md:bg-white static md:w-40 rounded-md md:absolute md:z-10 md:shadow-md md:mt-3 md:p-2 md:text-center"
        >
            <a
                v-for="item in items"
                :key="item.name"
                :href="item.url"
                class="md:pl-1 text-gray-700 bg-red-400 font-bold block md:text-gray-800 md:mt-0 py-2 md:border-none border-b border-red-500  md:bg-transparent md:p-1 md:hover:text-red-400"
            >
                {{ item.name }}
            </a>
        </div>
    </a>
</template>
<script>
export default {
    data() {
        return {
            isOpen: false
        };
    },
    props: {
        items: {
            type: Array
        },
        name: {
            type: String
        }
    },
    created() {
        const handleEscape = e => {
            if (e.key == "Esc" || e.key == "Escape") {
                this.isOpen = false;
            }
        };

        document.addEventListener("keydown", handleEscape);

        this.$once("hook:beforeDestroy", () => {
            document.removeEventListener("keydown", handleEscape);
        });
        EventBus.$on("open", name => {
            if (name != this.name) this.isOpen = false;
        });
    },
    watch: {
        isOpen() {
            EventBus.$emit("open", this.name);
        }
    },
    computed: {
        getZ() {
            if (
                navigator.userAgent.match(/Android/i) ||
                navigator.userAgent.match(/webOS/i) ||
                navigator.userAgent.match(/iPhone/i) ||
                navigator.userAgent.match(/iPad/i) ||
                navigator.userAgent.match(/iPod/i) ||
                navigator.userAgent.match(/BlackBerry/i) ||
                navigator.userAgent.match(/Windows Phone/i)
            )
                return ["z-10"];

            return this.isOpen ? ["z-10"] : ["z-0"];
        }
    }
};
</script>
