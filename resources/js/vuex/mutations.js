const setProductsInPurchase = (state, data) => {
    var localProductsInPurchase = JSON.parse(
        localStorage.getItem("productsInPurchase")
    );
    if (data.hasProductsInPurchase) {
        if (data.index != -1) {
            localProductsInPurchase[data.index].qty =
                data.productInPurchase.qty;
        } else {
            localProductsInPurchase.push(data.productInPurchase);
        }
    } else {
        localProductsInPurchase = [];
        localProductsInPurchase.push(data.productInPurchase);
    }
    localStorage.setItem(
        "productsInPurchase",
        JSON.stringify(localProductsInPurchase)
    );
    state.productsInPurchase = JSON.parse(
        localStorage.getItem("productsInPurchase")
    );
};

const deleteProductInPurchase = (state, index) => {
    var products = JSON.parse(localStorage.getItem("productsInPurchase"));
    products.splice(index, 1);
    localStorage.setItem("productsInPurchase", JSON.stringify(products));
    state.productsInPurchase = JSON.parse(
        localStorage.getItem("productsInPurchase")
    );
};

const setModalDataConfirm = (state, value) => {
    state.modalDataConfirm = value;
};

const setSalePriceOption = (state, value) => {
    state.salePriceOption = value;
};

const addToTransaction = (state, data) => {
    state.productsInTransaction.unshift(data);
};
const removeTransactionProduct = (state, id) => {
    const index = state.productsInTransaction.findIndex(
        (product) => product.id == id
    );
    if (index) state.productsInTransaction.splice(index, 1);
};
const SET_USER = (state, user) => {
    state.user = JSON.parse(
        document.head.querySelector("meta[name='current_user']").content
    );
    state.auth = Boolean(user);
};

const SET_APP_NAME = (state) => {
    state.appName = document.head.querySelector("meta[name='app_name']").content
}
const SET_PURCHASE_VISIBILITY = (state, value) => {
    state.purchaseVisibility = value;
    window.localStorage.setItem("allow-to-buy-new-product", value);
};

const SET_CURRENT_FAST_SALE = (state, value) => {
    state.currentFastSale = value;
}
const SET_QUERY_TYPE = (state, value) => {
    state.queryType = value;
}
const SET_CURRENT_EXPENSE = (state, value) => {
    state.currentExpense = value;
}
const SET_EXPENSE_METHOD_NAME = (state, value) => {
    state.expenseMethodName = value;
}
const SET_IS_IN_GENERAL_REPORT = (state, value) => {
    state.isInGeneralReport = value;
}
export default {
    SET_EXPENSE_METHOD_NAME,
    SET_CURRENT_EXPENSE,
    SET_CURRENT_FAST_SALE,
    SET_IS_IN_GENERAL_REPORT,
    setProductsInPurchase,
    SET_USER,
    SET_QUERY_TYPE,
    setSalePriceOption,
    deleteProductInPurchase,
    addToTransaction,
    removeTransactionProduct,
    setModalDataConfirm,
    SET_PURCHASE_VISIBILITY,
    SET_APP_NAME
};
