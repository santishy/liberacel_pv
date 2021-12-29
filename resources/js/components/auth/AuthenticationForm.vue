<template>
<div class="bg-white w-full">
    <information-component>
        <template slot="title">
            <span class="text-xl font-mono font-semibold text-blue-700">
                Completar venta
            </span>
        </template>
        <form @submit.prevent="submit" class="px-2">
            <div class="mb-1 px-2">
                <input
                    name="email"
                    ref="email"
                    class="
                        border-2
                        placeholder-gray-600
                        bg-gray-100
                        rounded
                        relative
                        rounded-bl-none rounded-br-none
                        appearance-none
                        w-full
                        py-3
                        px-3
                        text-gray-700
                        leading-tight
                        focus:outline-none
                        focus:ring-indigo-500
                        focus:border-indigo-500
                        focus:z-10
                    "
                    id="email"
                    v-model="form.email"
                    type="email"
                    placeholder="Email..."
                />
            </div>
            <div class="mb-0 px-2">
                <input
                    name="password"
                    class="
                        border-2
                        placeholder-gray-600
                        bg-gray-100
                        relative
                        appearance-none
                        rounded rounded-tl-none rounded-tr-none
                        w-full
                        py-3
                        px-3
                        text-gray-700
                        leading-tight
                        focus:outline-none
                        focus:ring-indigo-500
                        focus:border-indigo-500
                        focus:z-10
                    "
                    id="password"
                    type="password"
                    v-model="form.password"
                    placeholder="Contraseña..."
                />
            </div>
            <div class="mb-0 px-2">
                <button
                    type="submit"
                    class="
                        bg-transparent
                        transition-all
                        duration-500
                        ease-in-out
                        hover:bg-blue-500
                        text-white
                        rounded-sm
                        mt-1
                        font-semibold
                        hover:text-white
                        py-2
                        px-4
                        bg-blue-500
                        hover:border-transparent
                        w-full
                    "
                >
                    Enviar
                </button>
            </div>
        </form>
        <template slot="button">
            <label
                class="
                    inline-flex
                    items-start
                    mt-3
                    border-2
                    p-2
                    rounded-sm
                    border-gray-200
                "
            >
                <input
                    type="checkbox"
                    @change="toggleStatus"
                    class="
                        form-checkbox
                        h-5
                        w-5
                        text-pink-600
                        checked:bg-red-500
                    "
                /><span class="ml-2 text-red-700 text-sm font-bold"
                    >Cancelar venta</span
                >
            </label>
        </template>
    </information-component></div>
</template>
<script>
import InformationComponent from "../modals/InformationComponent.vue";
export default {
    props: {
        model: {
            type: String,
        },
        id: {
            type: Number,
        },
    },
    components:{
        InformationComponent
    },
    data() {
        return {
            form: {
                status: "completed",
            },
        };
    },

    // mounted() {
    //     EventBus.$on("toggle-status", (value) => {
    //         this.form.status = value;
    //     });
    // },

    methods: {
        async submit() {
            try {
                this.form.model = this.model;
                this.form.id = this.id;
                const res = await axios.post("/user-relationship", this.form);
                if (res.status === 200) {
                    EventBus.$emit("fast-sale", { products: [] });
                    EventBus.$emit("open-modal", false);
                    if (this.form.status == "completed")
                        window.open("/fast-sale-tickets/" + this.id, "_blank");
                    this.form = {};
                }
            } catch (err) {
                console.log(err);
            }
        },
        toggleStatus(event){
            if(event.target.checked){
                this.status = "cancelled";
            }
            else{
                this.status = "completed";
            }
        }
    },
};
</script>
