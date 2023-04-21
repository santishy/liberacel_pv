import Vue from "vue";
import Vuex from "vuex";
Vue.use(Vuex);

import actions from "./actions";
import mutations from "./mutations";
import getters from "./getters";

export const store = new Vuex.Store({
    state: {
        productsInPurchase: JSON.parse(
            localStorage.getItem("productsInPurchase")
        ),
        purchaseStatus: "",
        user: {},
        appName:'',
        auth: false,
        salePriceOption: sessionStorage.getItem("salePriceOption"),
        productsInTransaction: [],
        queryType:null,
        modalDataConfirm: {},
        electronicMoney:null,
        currentFastSale:{},
        expenseMethodName:null,
        currentExpense:null,
        purchaseVisibility:
            window.localStorage
                .getItem("allow-to-buy-new-product")
                ?.toUpperCase() === "TRUE",
    },
    mutations,
    actions,
    getters,
});
