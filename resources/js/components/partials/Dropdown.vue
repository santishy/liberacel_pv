<template>
    <div>
        <a href="#" @click.prevent="toggle" class=" w-full flex text-xl font-normal" :class="[titleFontColor]">
            <span class="mr-2">
                <slot name="icon"></slot>
            </span>
            {{ title }}</a>
        <hr v-if="isOpen" class="border-slate-100 mt-2 mb-3">
        <transition name="expand" @enter="enter" @after-enter="afterEnter" @leave="leave">
            <ul v-if="isOpen" class="bg-white space-y-1">
                <li v-for="item in menu" :key="item.url"
                    class="pl-2 rounded  bg-slate-100 hover:bg-sky-500 duration-100">
                    <a :href="item.url"
                        class="block w-full px-0 py-1 font-normal text-slate-600 sm:text-sm hover:font-semibold hover:text-white duration-100"
                        :class="[itemFontColor]">
                        {{ item.name }}
                    </a>
                </li>
            </ul>
        </transition>
    </div>
</template>
<script>
export default {
    props: ["title", "menu", "titleFontColor", "item-font-color"],
    created() {
        EventBus.$on('close-dropdown', () => {
            this.isOpen = false;
            console.log('close-dropdown')
        })
    },
    data() {
        return {
            isOpen: false,
        };
    },
    methods: {

        toggle() {
            this.isOpen = !this.isOpen;
        },
        enter(el) {
            el.style.height = "auto";
            const height = getComputedStyle(el).height;
            el.style.height = 0;
            //getComputedStyle(el);
            setTimeout(() => {
                el.style.height = height;
            });
        },
        afterEnter(el) {
            el.style.height = "auto";
        },
        leave(el) {
            el.style.height = getComputedStyle(el).height;
            // getComputedStyle(el);
            setTimeout(() => {
                el.style.height = 0;
            });
        },
    },
};
</script>
