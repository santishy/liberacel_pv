
import {mapMutations} from 'vuex';
export default  {
    
    mouted(){
        
    },
    methods:{
        /**
         * Donde se implemente este metodo, require el ID del producto y el INDEX de su array 
         * Requiere la importacion de {mapMutations}
         */
        addProductToTranscation(){
            this.addToTransaction({index:this.index,id:this.product.id});
        },
        ...mapMutations(['addToTransaction'])
    }
}