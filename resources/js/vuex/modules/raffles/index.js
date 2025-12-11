export default{
    namespaced:true,
    state:{
        activeRaffle:null,
    },
    mutations:{
        setActiveRaffle(state,raffle){
            state.activeRaffle=raffle;
        }
    },
}
