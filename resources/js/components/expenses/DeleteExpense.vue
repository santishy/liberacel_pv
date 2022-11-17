<template>
    <form @submit.prevent="submit">
        <button class="
        text-red-500
        hover:text-red-700
        shadow-xs
        font-bold
        py-2
        hover:border-red-700
        rounded
    ">
            <trash-icon></trash-icon>
        </button>
    </form>
</template>

<script>

import TrashIcon from "../icons/TrashIcon.vue"
export default {
    components: {
        TrashIcon
    },
    props:{
        expense:{
            type: Object
        },
        index:{
            type:Number
        }
    },
    methods: {
        submit() {
            axios.delete(`/expenses/${this.expense.id}`)
                .then(res => {
                    if(res.status == 204)
                    {
                        EventBus.$emit('expense-removed',this.index);
                    }
                })
                .catch(err => {
                    console.log(err);
                })
        }
    },

}
</script>
