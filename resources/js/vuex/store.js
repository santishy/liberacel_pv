import Vue from "vue";
import Vuex from "vuex";
Vue.use(Vuex);

import actions from "./actions";
import mutations from "./mutations";
import getters from "./getters";
import sales from "./modules/sales/"
import clients from "./modules/clients/";
import inventories from "./modules/inventories";
import raffles from "./modules/raffles";

function safeParse(key,fallback) {
    const item = localStorage.getItem(key);
    try {
       return item ? JSON.parse(item) : fallback;
    } catch (e) {
        console.warn(`Error parsing localStorage item "${key}":`, e);
        return fallback;
    }
}

export const store = new Vuex.Store({
    state: {
        productsInPurchase: safeParse("productsInPurchase", []),
        purchaseStatus: "",
        user: {},
        appName: '',
        auth: false,
        salePriceOption: sessionStorage.getItem("salePriceOption"),
        productsInTransaction: [],
        queryType: null,
        modalDataConfirm: {},
        electronicMoney: null,
        currentFastSale: {},
        expenseMethodName: null,
        isInGeneralReport: false,
        currentExpense: null,
        purchaseVisibility:
            window.localStorage
                .getItem("allow-to-buy-new-product")
                ?.toUpperCase() === "TRUE",
    },
    mutations,
    actions,
    getters,
    modules: {
        sales,
        clients,
        inventories,
        raffles
    }
});
