export default {
    namespaced: true,
    state: {
        phoneNumber: null
    },
    mutations: {
        setPhoneNumber(state, phoneNumber) {
            state.phoneNumber = phoneNumber;
        }
    },
    getters: {
        getPhoneNumber(state) {
            return state.phoneNumber;
        }
    }
};
