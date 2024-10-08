<template>
    <tr class="py-2 px-1">
        <td class="py-1 px-2 text-xs">
            {{ note.createdAt }}
        </td>
        <td class="py-2 px-2 font-bold">
            {{ note.note }}
        </td>
        <td class="py-1 px-2">
            {{ note.status }}
        </td>
        <td class="py-1 px-2 flex ">
            <span :class="getClasses" class="rounded-lg px-2 py-1 text-xs font-semibold  text-slate-900">{{
                note.typeOfSale
            }}</span>
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

    },
    computed: {
        getClasses() {
            if (this.note?.typeOfSale)
                if (this.note.typeOfSale.toUpperCase() == "VENTA EXPRES") {
                    return "bg-sky-500";
                }
            return "bg-yellow-500"
        }
    }
}
</script>
