import Vue from "vue";
import Vuex from "vuex";
Vue.use(Vuex);

import actions from "./actions";
import mutations from "./mutations";
import getters from "./getters";
import sales from "./modules/sales"

export const store = new Vuex.Store({
    state: {
        productsInPurchase: JSON.parse(
            localStorage.getItem("productsInPurchase")
        ),
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
    modules:{
        sales,
    }
});
