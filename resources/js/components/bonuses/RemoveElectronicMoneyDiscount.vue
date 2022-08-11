<template>
    <form @submit.prevent="submit">
        <button type="submit" class="border-2 p-1 ml-2 rounded-full flex flex-box items-center  hover:bg-gray-300 hover:text-red-700 bg-white text-center border-gray-300 text-red-500">
            <trash-icon></trash-icon>
        </button>
    </form>
</template>

<script>
import { mapState, mapMutations } from 'vuex';
import TrashIcon from '../icons/TrashIcon.vue';
export default{
    components:{
        TrashIcon
    },
    methods:{
        ...mapMutations(["SET_CURRENT_FAST_SALE"]),
        async submit(){
            try
            {
                const res = await axios.delete(`/fast-sales/${this.currentFastSale.id}/customer-bonuses`);
                console.log(res);
                if(res.data.fastSale){
                    this.SET_CURRENT_FAST_SALE(res.data.fastSale);
                }
            }
            catch(e){
                this.getErrors(e);
                console.log(e)
            }
        }
    },
    computed:{
        ...mapState(['currentFastSale'])
    }
}
</script>