const module = {
    namespaced: true,
    state() {
        return {
            sale: null,
        }
    },
    getters: {
        currentSale: (state) => {
            return state.sale;
        }
    },
    mutations: {
        setSale: (state, sale) => {
            console.log("set sale", sale)
            state.sale = sale;
        }
    }

}

export default module;
