const module = {
    namespaced: true,
    state() {
        return {
            sale: null,
        }
    },
    getters: {
        currentSale: (state) => {
            console.log(state.sale)
            return state.sale;
        }
    },
    mutations: {
        setSale: (state, sale) => {
            console.log("set sale", sale)
            state.sale = { ...sale }; // Mutar el objeto completo
            console.log({ state })
        }
    }
}

export default module;
