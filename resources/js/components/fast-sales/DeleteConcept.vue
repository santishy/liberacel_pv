<template>
    <form @submit.prevent="submit">
        <button
            type="submit"
            class="bg-red-500 hover:bg-red-700 text-white h-9 w-9 rounded-full"
        >
            <trash-icon></trash-icon>
        </button>
    </form>
</template>
<script>
import TrashIcon from "../icons/TrashIcon.vue";

export default {
    components: { TrashIcon },

    props:{
        sale:{
            type:Object
        },
        index:{type:Number}
    },
    methods:{
        submit(){
            axios.delete('/fast-sales/' + this.sale.id,{
                params:{
                    'remove[deleteConcept]':this.index
                }
            });
        }
    }
};
</script>
