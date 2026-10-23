<template>
    <div v-if="params" class="table-container-responsive">
        <table class="report-table">
            <thead class="report-table-thead">
                <tr class="bg-green-200">
                    <th class="py-2 px-2">Nota</th>
                    <th class="py-2 px-2">Usuario</th>
                    <th class="py-2 px-2">Fecha</th>
                    <th class="py-2 px-2">Descripción</th>
                    <th class="py-2 px-2">Precio</th>
                    <th class="py-2 px-2">Cantidad</th>
                    <th class="py-2 px-2">Subtotal</th>
                    <th class="py-2 px-2">Total Venta Completa</th>
                    <th
                        class="py-2 px-2 text-left sm:text-center"
                        width="110px"
                    >
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="flex-1 sm:flex-none">
                <product-sold
                    v-for="(product, index) in structureTheData"
                    :key="index"
                    :transaction="product"
                    :index="index"
                    @selected-sale="onSelectedSale"
                ></product-sold>
            </tbody>
            <infinite-loading
                v-if="!firstLoad.length"
                @infinite="infiniteHandler"
                :identifier="infiniteId"
                ref="infiniteLoading"
            ></infinite-loading>
        </table>
        <authentication-form
            model="FastSale"
            :uri="`/fast-sales/${selectedFastSaleId}/associated-users`"
            modal-id="nota"
        ></authentication-form>
        <information-component id="edit-raffle-number">
            <template #title> Agregar teléfono </template>
            <add-raffle-phone-form
                :uri="addRafflePhoneUri"
                :key="rafflePhoneFormKey"
                :customer-phone="selectedFastSaleForRafflePhone?.customer_phone"
                @raffle-phone-number-saved="updateProductList"
            />
        </information-component>
    </div>
</template>

<script>
import InfiniteLoading from "vue-infinite-loading";
import AuthenticationForm from "../auth/AuthenticationForm.vue";
import ProductSold from "./ProductSold.vue";
import AddRafflePhoneForm from "../raffle-numbers/AddRafflePhoneForm.vue";
import InformationComponent from "../modals/InformationComponent.vue";

import axios from "axios";
import _ from "lodash";

export default {
    props: {
        firstLoad: {
            type: Array,
            default: () => [],
        },
    },
    components: {
        InfiniteLoading,
        ProductSold,
        AuthenticationForm,
        AddRafflePhoneForm,
        InformationComponent,
    },
    data() {
        return {
            products: [],
            page: 1,
            params: null,
            infiniteId: 1,
            uri: "/fast-sales",
            nota: null,
            selectedFastSaleId: null,
            selectedFastSaleForRafflePhone: null,
            isSearchById: false,
            selectedSale: null,
            rafflePhoneFormKey: 0,
        };
    },
    mounted() {
        EventBus.$on("search-result-by-id", this.showSaleResultById);
        EventBus.$on("id-for-authentication-form", (id) => {
            this.selectedFastSaleId = id;
        });
        EventBus.$on("set-parameters", (data) => {
            this.changeParams(data);
        });
        EventBus.$on("associated-user", (id) => {
            EventBus.$emit("open-modal", false);
            this.products = this.products.filter(
                (product) => product.id !== id
            );
        });
    },
    watch: {
        firstLoad: {
            handler(newValue) {
                if (!Array.isArray(newValue)) {
                    throw new Error("It is not an array");
                }
                if (!newValue.length) {
                    return;
                }
                this.products = newValue;
                this.page = 2;
            },
            deep: true,
        },
    },
    methods: {
        showSaleResultById(params) {
            this.isSearchById = true;
            this.changeParams(params);
        },
        updateProductList({ raffle_number, customer_phone }) {
            const product = this.products.find(
                (product) =>
                    product.id === this.selectedFastSaleForRafflePhone.id
            );
            if (raffle_number) {
                product["raffle_number_code"] = raffle_number.code;
            }
            product["customer_phone"] = customer_phone;
        },
        infiniteHandler($state) {
            const params = this.getParams; // Forzar evaluación de la propiedad computada
            axios
                .get(this.uri, { params })
                .then((res) => {
                    if (this.page == 1) {
                        EventBus.$emit("calculated-total", res.data.total);
                    }
                    if (res.data.data.length) {
                        this.page += 1;
                        this.products.push(...res.data.data);
                        if (this.isSearchById) {
                            EventBus.$emit(
                                "sale-status-by-id",
                                res.data.data[0].status
                            );
                        }
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.isSearchById = false;
                });
        },
        changeParams(value) {
            this.params = { ...value };
            this.page = 1;
            this.products = [];
            this.infiniteId += 1;
        },
        onSelectedSale(value) {
            this.rafflePhoneFormKey++;
            this.selectedFastSaleForRafflePhone = value;
            EventBus.$emit("open-modal-edit-raffle-number", true);
        },
    },
    computed: {
        getRelationships() {
            return { include: "user,raffleNumber" };
        },
        addRafflePhoneUri() {
            return `/fast-sales/${this.selectedFastSaleForRafflePhone?.id}/customer-phone`;
        },
        getParams() {
            const params = {
                isFastSale: true,
                page: this.page,
                ...this.params,
                ...this.getRelationships,
            };
            return this.isSearchById
                ? params
                : {
                      ...params,
                      "filter[isCredit]": false,
                  };
        },
        structureTheData() {
            let newStructure = [];
            this.products.forEach((item) => {
                let {
                    products,
                    created_at,
                    total,
                    status,
                    id,
                    user_name,
                    raffle_number_code,
                    customer_phone,
                } = item;
                newStructure.push(
                    ...products.map((product) => {
                        return {
                            created_at,
                            id,
                            status,
                            user_name,
                            raffle_number_code,
                            customer_phone,
                            total,
                            description: product.description,
                            qty: product.qty,
                            price: product.price,
                        };
                    })
                );
            });
            return newStructure;
        },
    },
};
</script>
