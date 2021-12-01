const setProductsInPurchase = (state, data) => {
    var localProductsInPurchase = JSON.parse(localStorage.getItem('productsInPurchase'));
    if (data.hasProductsInPurchase) {
        if (data.index != -1) {
            localProductsInPurchase[data.index].qty = data.productInPurchase.qty;
        } else {
            localProductsInPurchase.push(data.productInPurchase);
        }
    }
    else {
        localProductsInPurchase = [];
        localProductsInPurchase.push(data.productInPurchase)
    }
    localStorage.setItem('productsInPurchase', JSON.stringify(localProductsInPurchase));
    state.productsInPurchase = JSON.parse(localStorage.getItem('productsInPurchase'));
}

const deleteProductInPurchase = (state, index) => {
    var products = JSON.parse(localStorage.getItem('productsInPurchase'));
    products.splice(index, 1);
    localStorage.setItem('productsInPurchase', JSON.stringify(products));
    state.productsInPurchase = JSON.parse(localStorage.getItem('productsInPurchase'));
}

const setModalDataConfirm = (state,value) => {
    state.modalDataConfirm = value;
}

const setSalePriceOption = (state, value) => {
    state.salePriceOption = value;
}

const addToTransaction = (state, data) => {
    state.productsInTransaction.unshift(data);
}
const removeTransactionProduct = (state,id) => {
    const index = state.productsInTransaction.findIndex(product => product.id == id)
    if(index)
        state.productsInTransaction.splice(index,1);
}
const SET_USER = (state,user) => 
{
    state.user = JSON.parse( document.head.querySelector("meta[name='current_user']").content);
    state.auth = Boolean(user);
}
const SET_PURCHASE_VISIBILITY = (state,value) =>{
    state.purchaseVisibility = value;
    window.localStorage.setItem('allow-to-buy-new-product',value);
}
export default {
    setProductsInPurchase,
    SET_USER,
    setSalePriceOption,
    deleteProductInPurchase,
    addToTransaction,
    removeTransactionProduct,
    setModalDataConfirm,
    SET_PURCHASE_VISIBILITY,
}