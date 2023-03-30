<template>
    <div>
        <a
            href="#"
            @click.prevent="toggle"
            class="w-full flex text-xl font-semibold"
            :class="[titleFontColor]"
        >
            <span class="mr-2">
                <slot name="icon"></slot>
            </span>
            {{ title }}</a
        >
        <transition
            name="expand"
            @enter="enter"
            @after-enter="afterEnter"
            @leave="leave"
        >
            <ul v-if="isOpen" class="bg-white rounded p-1">
                <li
                    v-for="item in menu"
                    :key="item.url"
                    class="pl-8 pr-2w-full bg-white hover:bg-gray-200 duration-100 border-b border-gray-300 last:border-b-0"
                >
                    <a
                        :href="item.url"
                        class="block w-full px-0 py-1 font-normal hover:font-semibold text-sm  hover:text-gray-800 duration-100"
                        :class="[itemFontColor]"
                    >
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
    created(){
        EventBus.$on('close-dropdown',() => {
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
