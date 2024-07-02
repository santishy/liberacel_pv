<template>
    <tr class="py-2 px-1">
        <td class="py-1 px-2 text-xs">
            {{ note.createdAt }}
        </td>
        <td class="py-2 px-2">
            {{ note.id }}
        </td>
        <td class="py-1 px-2">
            {{ note.status }}
        </td>
        <td class="py-1 px-2">
            {{ note.typeOfSale }}
        </td>
        <td class="py-1 px-2 text-green-800">
            {{ note.total }}
        </td>
    </tr>
</template>

<script>
export default {
    props: {
        note: {
            type: Object
        },
        index: {
            type: Number
        }
    },

    methods: {

    }
}
</script>
