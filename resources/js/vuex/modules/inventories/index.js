import axios from "axios";

export default {
    namespaced: true,
    state: {
        items: [],
    },
    mutations: {
        setInventories(state, inventories) {
            state.items = inventories;
        }
    },
    actions: {
        async fetchInventories(state) {
            const response = await axios.get('/inventories');
            state.commit('setInventories', response.data.data);
        }
    },
    getters:{
        inventories(state){
            return state.items;
        }
    }
};
