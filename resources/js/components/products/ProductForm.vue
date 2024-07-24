<template>
    <layout-component>
        <div class="p-4 w-9/12 mx-auto bg-white shadow rounded-lg ">
            <div class="flex flex-wrap justify-between rounded-sm gap-4 bg-gray-100 p-2">
                <toggle-purchase-visibility class="w-56" :method="method"></toggle-purchase-visibility>
                <button @click.prevent="cleanForm"
                    class="rounded bg-indigo-200 text-black shadow hover:bg-indigo-500 hover:font-bold hover:shadow-none hover:text-white   font-mono text-xs p-2 transition-all">
                    Limpiar
                </button>
            </div>
            <h1 class="flex items-center pb-2 mt-4 text-dark  justify-start text-xl font-bold">
                {{ title }}
            </h1>
            <form id="product-form" @submit.prevent="submit" @keyup.enter.prevent="" @keydown.enter.prevent=""
                @keypress.enter.prevent="" v-can="definePermission" class="w-full grid grid-cols-2 gap-4">
                <div v-if="src" class="flex flex-wrap col-span-2 justify-center w-full bg-gray-200 p-2">
                    <div class="w-8/12 sm:w-6/12 px-4">
                        <img :src="src" alt="Imagen a subir" class="rounded max-w-full h-auto align-middle border-none" />
                    </div>
                    <div class="ml-2">
                        <p class="text-lg font-mono text-gray-700">
                            Presiona guardar para que se reflejen los cambios
                        </p>
                    </div>
                </div>
                <div>
                    <category-select inputClass="w-full" :categories="categories" :product="product">
                        <template slot="labelCategory">
                            <!-- <label for="" :class="[labelStyle]">Categoría</label> -->
                            <label for="" class="form-label">Categoría</label>
                        </template>
                    </category-select>
                </div>
                <div>
                    <input type="hidden" name="category_id" v-model="form.category_id" />
                    <div>
                        <label class="form-label">Imagen
                            <span class="text-xs text-gray-600 block mt-0">(Opcional)</span></label>
                        <input type="file" name="image" id="image" @change="onFileSelected"
                            class="form-text-input w-full file:appearance-none file:rounded-sm file:text-xs file:m-0 file:mr-2 file:border-transparent file:shadow file:bg-gray-800 file:text-white"
                            placeholder="Subir imagen" aria-label="Full name" />
                    </div>
                </div>
                <div>
                    <label class="form-label">SKU</label>
                    <input v-model="form.sku" name="sku" class="form-text-input w-full" type="text" placeholder="SKU"
                        aria-label="Full name" />
                </div>
                <div>
                    <label class="form-label">Comisión</label>
                    <input v-model="form.commission_amount" name="commission_amount" class="form-text-input w-full"
                        type="text" placeholder="Monto de la comisión" aria-label="Full name" />
                </div>
                <div class="">
                    <label for="" class="form-label">Descripción</label>
                    <input v-model="form.description" name="description" class="form-text-input w-full" type="text"
                        placeholder="DESCRIPCIÓN DEL PRODUCTO" aria-label="Full name" />
                </div>

                <div>
                    <label for="" class="form-label">Precio al por mayor</label>
                    <input v-model="form.wholesale_price" name="wholesale_price" class="form-text-input w-full" type="text"
                        placeholder="PRECIO AL POR MAYOR" aria-label="Full name" />
                </div>
                <div>
                    <label for="" class="form-label">Precio al por menor</label>
                    <input v-model="form.retail_price" name="retail_price" class="form-text-input w-full" type="text"
                        placeholder="PRECIO AL POR MENOR" aria-label="Full name" />
                </div>
                <div>
                    <label for="" class="form-label">Precio proveedor</label>
                    <input v-model="form.distributor_price" name="distributor_price" class="form-text-input w-full"
                        type="text" placeholder="PRECIO PROVEEDOR" aria-label="Full name" />
                </div>
                <div class="col-span-2" v-if="purchaseVisibility && method.toUpperCase() == 'POST'">
                    <div>
                        <label for="" class="form-label">Cantidad de compra
                            <span class="text-xs text-gray-600 block mt-0">(Opcional)</span></label>
                        <input v-model="form.qty" name="qty" class="form-text-input w-full" type="text"
                            placeholder="CANTIDAD DE COMPRA (OPCIONAL)" aria-label="Full name" />
                    </div>
                    <div v-if="this.inventories.length > 1" class="mt-4">
                        <label class="form-label">Almacen
                            <span class="text-xs text-gray-600 block mt-0">(Opcional)</span></label>
                        <div class="flex gap-4">
                            <div v-for="warehouse in inventories" :key="warehouse.id">
                                <label class="inline-flex items-center rounded bg-gray-300 px-1 py-2">
                                    <input type="radio" class="form-radio" name="inventory_id" :value="warehouse.id"
                                        v-model="form.inventory_id" />
                                    <span class="ml-2 text-gray-600">{{
                                        warehouse.name.toUpperCase()
                                    }}</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-2">
                    <div class="flex items-center w-full">
                        <errors-component :errors-found="errors" />
                    </div>
                    <button
                        class="bg-blue-500 rounded shadow-sm transition-all duration-500 ease-in-out hover:bg-blue-700 text-gray-100 font-semibold hover:text-white py-2 px-8 border-b-2 border-blue-500 hover:border-transparent">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </layout-component>
</template>

<script>
//import NavComponent from "../NavComponent.vue";
import TogglePurchaseVisibility from "./TogglePurchaseVisibility.vue";
import { mapState } from "vuex";
import CategorySelect from "./CategorySelect.vue";
export default {
    components: {
        //NavComponent,
        TogglePurchaseVisibility,
        CategorySelect,
    },
    data() {
        return {
            form: {
                category_id: "",
                commission_amount: 5
            },
            category_name: "",
            src: null,
            frutsi: null,
        };
    },
    mounted() {
        if (!!this.product) {
            this.form = this.product;
        }
        EventBus.$on("selected-category", (id) => {
            this.form.category_id = id;
        });
    },
    props: {
        title: { type: String, required: true },
        method: {
            type: String,
            required: true,
        },
        product: {
            type: Object,
        },
        categories: {
            type: Array,
        },
        inventories: {
            type: Array,
        },
    },
    methods: {
        async submit() {
            let message = { message: "EL producto se creo correctamente" };
            var url = "/products";
            var formData = new FormData(
                document.querySelector("#product-form")
            );

            if (this.method == "put") {
                message = { message: "El producto se modifico correctamente" };
                formData.append("_method", "put");
                formData.append("id", this.product.id);
                url = `/products/${this.product.id}`;
            } else {
                if (this.inventories.length == 1)
                    formData.append("inventory_id", this.inventories[0].id);
            }
            axios["post"](url, formData, {
                headers: {
                    "Content-Type": "multipart/form-data",
                    Accept: "application/json",
                },
            })
                .then((res) => {
                    let obj = { title: "Productos", ...message };
                    this.notify(obj);
                    if (this.method == "post")
                        this.form = {
                            sku: this.form.sku,
                            category_id: this.form.category_id,
                        };
                    this.errors = null;
                })
                .catch((err) => {
                    this.getErrors(err);
                });
        },
        onFileSelected(event) {
            this.form.image = event.target.files[0];
            if (event.target.files[0]) {
                const fileReader = new FileReader();
                fileReader.readAsDataURL(event.target.files[0]);

                fileReader.addEventListener("load", this.showImage);
            }
        },
        showImage(e) {
            this.src = e.target.result;
        },
        cleanForm() {
            this.form = {};
            EventBus.$emit("clean-search-term");
            this.src = null;
            document.querySelector("#image").value = null;
        },
    },
    computed: {
        ...mapState(["purchaseVisibility"]),
        categoryName() {
            return this.category_name;
        },
        hidden() {
            return this.form.category_id ? "" : "hidden";
        },
        definePermission() {
            if (this.method.toUpperCase() === "POST") return "create product";
            return "edit product";
        },
        labelStyle() {
            return "absolute pl-0 bg-gray-200 h-full flex items-center w-56 justify-center text-indigo-800 font-mono font-semibold";
        },
        inputStyle() {
            return "appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 pl-60 leading-tight focus:outline-none";
        },
        controlsContainerStyle() {
            return "flex items-center border-t border-gray-500 py-2 relative";
        },
    },
};
</script>
