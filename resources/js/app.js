require('./bootstrap');
window.Vue = require('vue');
window.EventBus = new Vue();
import Vuex from 'vuex'

Vue.use(Vuex)
import Notifications from 'vue-notification'
Vue.component('notifications', Notifications);
Vue.use(Notifications);
import { store } from './vuex/store.js';
import Errors from "./mixins/Errors";
import Notify from "./mixins/Notify";

//await store.dispatch('getUser');
store.commit('SET_USER');
Vue.mixin(Errors);
Vue.mixin(Authorizations);
Vue.mixin(Notify);

Vue.component('nav-component', require('./components/NavComponent.vue').default)
Vue.component('errors-component', require('./components/ErrorsComponent.vue').default)
Vue.component('dropdown-component', require('./components/DropdownComponent.vue').default);
Vue.component('product-form', require('./components/products/ProductForm.vue').default);
Vue.component('products-index', require('./components/products/IndexComponent.vue').default);
Vue.component('purchase-component', require('./components/purchases/PurchaseComponent.vue').default)
//Vue.component('product-in-purchase', require('./components/purchases/ProductInPurchase.vue').default)
Vue.component('client-form', require('./components/clients/ClientForm.vue').default)
Vue.component('client-list', require('./components/clients/ClientList.vue').default)

//CATEGORIES COMPONENTS
Vue.component('category-form', require('./components/categories/CategoryForm.vue').default)
Vue.component('category-list', require('./components/categories/CategoryList.vue').default)
Vue.component('category-index', require('./components/categories/Index.vue').default)
Vue.component('edit-category', require('./components/categories/EditCategory.vue').default)

//VENTAS COMPONENTES
Vue.component('sale-component', require('./components/sales/SaleComponent').default)
Vue.component('transaction-report', require('./components/reports/Transactions').default)


//transactions
Vue.component('transaction-list', require('./components/reports/TransactionList.vue').default);

//auth
Vue.component('registration-form', require('./components/auth/RegistrationForm.vue').default);
Vue.component('register', require('./components/auth/Register.vue').default);

//roles
Vue.component('create-new-role', require('./components/auth/CreateNewRole.vue').default);
Vue.component('assign-role', require('./components/auth/AssignRole.vue').default);
Vue.component('role-component', require('./components/auth/RoleComponent.vue').default)

//permissions
Vue.component('permission-list', require('./components/auth/PermissionList.vue').default);

//users 
Vue.component('user-list', require('./components/users/UserList.vue').default);

//inventories
Vue.component('create-inventory', require('./components/inventories/CreateInventory.vue').default)
Vue.component('inventory-stocks', require('./components/inventories/InventoryStocks.vue').default)
Vue.component('edit-warehouse',require('./components/warehouses/EditWarehouse.vue').default);

//Inventories -> warehouses

Vue.component('warehouse-list',require('./components/warehouses/WarehouseList.vue').default);

//dashboard
Vue.component('dashboard', require('./components/Dashboard.vue').default);

//errors
Vue.component('forbidden',require('./components/errors/Forbidden.vue').default);

/**
 * tickets
 */
Vue.component('ticket-form',require('./components/tickets/TicketForm.vue').default);

Vue.directive('can',
    async function (el, binding) {
        if (store.getters.isAdmin || store.state.user?.permissions?.includes(binding.value))
            return;
        el.style.display = 'none';
    }
);


import Vue from 'vue';
import Authorizations from './mixins/Authorizations.js';
const app = new Vue({
    el: "#app",
    store,
});