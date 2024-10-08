<template>
    <div v-if="inventory" class="justify-center">
        <div class="
                flex flex-wrap
                justify-center
                items-center
                mb-4
            ">
            <h3 class="
                    hidden
                    flex-1
                    sm:block
                    w-64
                    h-full
                    text-slate-700
                    font-mono font-semibold
                    text-center
                    bg-white
                    left-0
                    py-5
                    px-4
                ">
                <warehouse-icon></warehouse-icon> {{ inventory.name }}
            </h3>
            <inventory-search-filter class="w-full sm:w-auto flex-1"></inventory-search-filter>
        </div>
        <div class="relative overflow-x-auto bg-white rounded-lg">
            <table v-if="inventory" class="w-full text-sm text-left text-slate-500 ">
                <thead class="text-xs text-slate-700 uppercase bg-slate-100 ">
                    <th scope="col" class="px-6 py-3">Categoría</th>
                    <th scope="col" class="px-6 py-3">SKU</th>
                    <th scope="col" class="px-6 py-3">Descripción</th>
                    <th scope="col" class="px-6 py-3">Existencias</th>
                </thead>
                <transition-group tag="tbody" name="bounce" @after-leave="afterLeave">
                    <produc-list-item v-for="(product, index) in products" :key="product.id" :index="index"
                        :product="product" :inventory="inventory">
                    </produc-list-item>
                </transition-group>
            </table>
        </div>
        <infinite-loading :identifier="infiniteId" @infinite="getProducts" ref="infiniteLoading"></infinite-loading>
    </div>
</template>
<script>
import SearchComponent from "../products/SearchComponent.vue";
import InventorySearchFilter from "./InventorySearchFilter.vue";
import ProducListItem from "./ProducListItem.vue";
import WarehouseIcon from "../icons/WarehouseIcon.vue";
export default {
    props: {
        index: {
            type: Number,
        },
    },
    components: {
        ProducListItem,
        SearchComponent,
        InventorySearchFilter,
        WarehouseIcon,
    },
    data() {
        return {
            products: [],
            inventory: null,
            page: 1,
            infiniteId: +new Date(),
            filters: {},
        };
    },
    created() {
        EventBus.$on("selected-inventory", (inventory) => {
            this.filters = {};
            this.inventory = inventory;
            this.reloadIndex();
        });
        EventBus.$on("updated-stock", (data) => {
            this.products[data.index].stock = data.newStock;
        });
        EventBus.$on("search-value-added", this.addFilterSearch);
    },
    methods: {
        getProducts($state) {
            axios
                .get(`/inventories/${this.inventory.id}`, {
                    params: {
                        page: this.page,
                        inventory_id: this.inventory.id,
                        ...this.filters,
                    },
                })
                .then((res) => {
                    if (res.data.data.length) {
                        this.page += 1;
                        this.products.push(...res.data.data);
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                })
                .catch((err) => {
                    $state.complete();
                    this.getErrors(err);
                });
        },
        reloadIndex() {
            /**
             * New learning, uso $nexTick(), por que no me actualizaba el infinite
             * loading, ya que al parecer no detectava que se borraban los elementos
             * del DOM y no ejecutaba la llamada asincrona para llenar el siguiente
             * inventario, aun cuando cambiaba el inifiniteID, asi que nexTick
             * devuelve la version mas actual del DOM donde ya no hay elementos y
             * dispara la llamada asincrona
             */
            this.page = 1;
            this.products = [];
            this.infiniteId++;
            /*setTimeout(()=>{
                this.$refs.infiniteLoading.stateChanger.reset();
            },1000)*/
        },
        afterLeave() {
            this.$nextTick(() => {
                if (!this.$refs.infiniteLoading.status) {
                    this.$refs.infiniteLoading.stateChanger.reset();
                }
            });
        },
        addFilterSearch(value) {
            this.filters["filter[search]"] = value;
            this.reloadIndex();
        },
    },
};
</script>
