<template>
    <ul class="w-full">
        <li
            v-for="user in users"
            :key="user.id"
            class="bg-white  border border-gray-300"
        >
            <a href="#" @click="getCommissions(user.id)" class="flex justify-between items-center px-2 py-3">
                {{ user.name }}
                <span
                    class="
                        rounded-lg
                        text-sm
                        py-1
                        px-2
                        bg-yellow-400
                        text-gray-800
                    "
                    >{{ user.username }}</span
                >
            </a>
        </li>
    </ul>
</template>
<script>
export default {
    props: {
        users: {
            type: Array,
        },
    },
};
</script>
