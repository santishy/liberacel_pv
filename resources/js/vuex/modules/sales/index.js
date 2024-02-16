const module = {
    namespaced: true,
    state() {
        return {
            sale: null,
        }
    },
    getters: {
        currentSale(state) {
            return state.sale;
        }
    },
    mutations: {
        setSale(state, sale) {
            state.sale = sale;
        }
    }

}

export default module;
