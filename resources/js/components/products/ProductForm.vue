<template>
    <!-- <div class="w-full  flex justify-center mt-20 bg-transparent"> -->
    <nav-component>
        <div
            class="
                flex
                justify-center
                items-center
                flex-wrap
                px-4
                w-9/12
                mx-auto
            "
        >
            <form
                id="product-form"
                @submit.prevent="submit"
                @keyup.enter.prevent=""
                @keydown.enter.prevent=""
                @keypress.enter.prevent=""
                v-can="definePermission"
                class="
                    w-full
                    shadow-lg
                    rounded-lg
                    bg-white
                    md:px-6 md:py-6 md:mt-0
                    mt-10
                    md:mb-0
                "
            >
                <div class="flex flex-wrap justify-between">
                    <toggle-purchase-visibility
                        class="w-56"
                        :method="method"
                    ></toggle-purchase-visibility>
                    <button
                        @click.prevent="cleanForm"
                        class="rounded-lg bg-white border hover:text-white hover:bg-pink-500
                                border-pink-500 font-mono font-extralight text-xs p-2 transition-all"
                    >
                        Limpiar
                    </button>
                </div>
                <div
                    class="
                        flex
                        items-center
                        pb-2
                        text-dark text-center
                        justify-center
                        text-xl
                        font-bold
                    "
                >
                    Nuevo producto
                </div>
                <div
                    v-if="src"
                    class="flex flex-wrap justify-center w-full bg-gray-200 p-2"
                >
                    <div class="w-8/12 sm:w-6/12 px-4">
                        <img
                            :src="src"
                            alt="Imagen a subir"
                            class="
                                rounded
                                max-w-full
                                h-auto
                                align-middle
                                border-none
                            "
                        />
                    </div>
                    <div class="ml-2">
                        <p class="text-lg font-mono text-gray-700">
                            Presiona guardar para que se reflejen los cambios
                        </p>
                    </div>
                </div>
                <category-select class="border-t border-gray-500" inputClass="pl-60" :categories="categories" :product="product">
                    <template slot="labelCategory">
                        <label
                            for=""
                            :class="[labelStyle]"
                            >Categoría</label
                        >
                    </template>
                </category-select>

                <input
                    type="hidden"
                    name="category_id"
                    v-model="form.category_id"
                />
                <div
                    class="
                        flex
                        items-center
                        border-t border-gray-500
                        py-2
                        relative
                    "
                >
                    <input
                        type="file"
                        name="image"
                        id="image"
                        @change="onFileSelected"
                        :class="[inputStyle]"
                        placeholder="Subir imagen"
                        aria-label="Full name"
                    />
                    <label :class="labelStyle" class="flex-col"
                        >Imagen
                        <span class="text-xs text-gray-600 block mt-0"
                            >(Opcional)</span
                        ></label
                    >
                </div>
                <div :class="[controlsContainerStyle]">
                    <input
                        v-model="form.sku"
                        name="sku"
                        :class="[inputStyle]"
                        type="text"
                        placeholder="SKU"
                        aria-label="Full name"
                    />
                    <label :class="[labelStyle]">SKU</label>
                </div>
                <div :class="[controlsContainerStyle]">
                    <textarea
                        v-model="form.description"
                        name="description"
                        :class="[inputStyle]"
                        type="text"
                        placeholder="DESCRIPCIÓN DEL PRODUCTO"
                        aria-label="Full name"
                    >
                    </textarea>
                    <label for="" :class="[labelStyle]">Descripción</label>
                </div>
                <div :class="[controlsContainerStyle]">
                    <input
                        v-model="form.wholesale_price"
                        name="wholesale_price"
                        :class="[inputStyle]"
                        type="text"
                        placeholder="PRECIO AL POR MAYOR"
                        aria-label="Full name"
                    />
                    <label for="" :class="[labelStyle]"
                        >Precio al por mayor</label
                    >
                </div>
                <div :class="[controlsContainerStyle]">
                    <input
                        v-model="form.retail_price"
                        name="retail_price"
                        :class="[inputStyle]"
                        type="text"
                        placeholder="PRECIO AL POR MENOR"
                        aria-label="Full name"
                    />
                    <label for="" :class="[labelStyle]"
                        >Precio al por menor</label
                    >
                </div>
                <div :class="[controlsContainerStyle]">
                    <input
                        v-model="form.distributor_price"
                        name="distributor_price"
                        :class="[inputStyle]"
                        type="text"
                        placeholder="PRECIO PROVEEDOR"
                        aria-label="Full name"
                    />
                    <label for="" :class="[labelStyle]">Precio proveedor</label>
                </div>
                <div
                    v-if="purchaseVisibility && method.toUpperCase() == 'POST'"
                >
                    <div :class="[controlsContainerStyle]">
                        <input
                            v-model="form.qty"
                            name="qty"
                            :class="[inputStyle]"
                            type="text"
                            placeholder="CANTIDAD DE COMPRA (OPCIONAL)"
                            aria-label="Full name"
                        />
                        <label for="" :class="[labelStyle]" class="flex-col"
                            >Cantidad de compra
                            <span class="text-xs text-gray-600 block mt-0"
                                >(Opcional)</span
                            ></label
                        >
                    </div>
                    <div
                        v-if="this.inventories.length > 1"
                        :class="[
                            this.errors
                                ? 'border-transparent'
                                : 'border-gray-500',
                            controlsContainerStyle
                        ]"
                    >
                        <div class="pl-60 flex-wrap flex">
                            <div
                                v-for="warehouse in inventories"
                                :key="warehouse.id"
                                class="ml-2 mb-1"
                            >
                                <label
                                    class="
                                        inline-flex
                                        items-center
                                        border
                                        rounded
                                        bg-gray-300
                                        px-1
                                        py-2
                                    "
                                >
                                    <input
                                        type="radio"
                                        class="form-radio"
                                        name="inventory_id"
                                        :value="warehouse.id"
                                        v-model="form.inventory_id"
                                    />
                                    <span class="ml-2 text-gray-600">{{
                                        warehouse.name.toUpperCase()
                                    }}</span>
                                </label>
                            </div>
                        </div>
                        <label class="flex-col" :class="[labelStyle]"
                            >Almacen
                            <span class="text-xs text-gray-600 block mt-0"
                                >(Opcional)</span
                            ></label
                        >
                    </div>
                </div>

                <div class="flex items-center">
                    <errors-component :errors-found="errors" />
                </div>

                <div class="flex justify-center mt-0 mb-0">
                    <button
                        class="
                            bg-transparent
                            transition-all
                            duration-500
                            ease-in-out
                            hover:bg-blue-500
                            text-blue-700
                            font-semibold
                            hover:text-white
                            py-2
                            px-4
                            border-b-2 border-blue-500
                            hover:border-transparent
                            w-full
                        "
                    >
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </nav-component>
</template>

<script>
import NavComponent from "../NavComponent.vue";
import TogglePurchaseVisibility from "./TogglePurchaseVisibility.vue";
import { mapState } from "vuex";
import CategorySelect from "./CategorySelect.vue";
export default {
    components: {
        NavComponent,
        TogglePurchaseVisibility,
        CategorySelect
    },
    data() {
        return {
            form: {
                category_id: ""
            },
            category_name: "",
            src: null,
            frutsi: null
        };
    },
    mounted() {
        if (!!this.product) {
            this.form = this.product;
        }
        EventBus.$on("selected-category", id => {
            this.form.category_id = id;
        });
    },
    props: {
        method: {
            type: String,
            required: true
        },
        product: {
            type: Object
        },
        categories: {
            type: Array
        },
        inventories: {
            type: Array
        }
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
                    Accept: "application/json"
                }
            })
                .then(res => {
                    let obj = { title: "Productos", ...message };
                    this.notify(obj);
                    if (this.method == "post")
                        this.form = {
                            sku: this.form.sku,
                            category_id: this.form.category_id
                        };
                    this.errors = null;
                })
                .catch(err => {
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
        }
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
        }
    }
};
</script>
