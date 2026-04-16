export default {
    namespaced: true,
    state: {
        activeRaffle: null,
        customerPhone: null,
    },
    actions: {
        getRaffles: async ({ commit }, params) => {
            const resp = await axios.get('/raffles', { params });
            return resp.data
        },
        getRaffleNumbers: async ({ commit }, params) => {
            const resp = await axios.get('/raffle-numbers', { params });
            return resp.data
        }
    },
    mutations: {
        setActiveRaffle(state, value) {
            state.activeRaffle = value;
        },
        setCustomerPhone(state, value) {
            state.customerPhone = value;
        },

    },
    getters: {
        hasActiveRaffle(state) {
            return !!state.activeRaffle
        },
        getCustomerPhone(state) {
            return state.customerPhone;
        },
    }
}
