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
                        name="username"
                        ref="username"
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
                        id="username"
                        v-model="form.username"
                        type="text"
                        placeholder="Nombre de usuario..."
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
                        ref="submit"
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
                        :disabled="getStatus"
                    >
                        Enviar
                    </button>
                    <div
                        v-if="form.status == 'cancelled'"
                        class="
                            bg-orange-100
                            border-l-4 border-orange-500
                            text-orange-700
                            p-2
                            mt-2
                        "
                        role="alert"
                    >
                        <p class="font-bold">Cancellar nota # {{ local_id }}</p>
                        <p class="text-sm">
                            Esta a punto de cancelar la venta completa.
                        </p>
                    </div>
                    <div class="flex items-center mt-2">
                        <errors-component :errors-found="errors" />
                    </div>
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
        </information-component>
    </div>
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
    components: {
        InformationComponent,
    },
    data() {
        return {
            form: {
                status: "completed",
            },
            local_id: null,
            disabled: false,
        };
    },
    created() {},
    mounted() {
        console.log('cuantas veces entra al mounted?')
        this.local_id = this.id;
        EventBus.$on("id-for-authenticacion-form", (id) => {
            this.local_id = id;
        });
        EventBus.$on("open-modal", (val) => {
            if (val) {
                this.$nextTick(() => {
                    if (this.$refs?.username) 
                        this.$refs.username.focus();
                    console.log('cuantas veces entra?')
                });
            }
        });
    },
    methods: {
        async submit() {
            // this.$refs.submit.disabled = true
            //this.disabled = true;
            try {
                this.form.model = this.model;
                this.form.id = this.local_id ? this.local_id : this.id;
                const res = await axios.post("/user-relationship", this.form);
                if (res.status === 200) {
                    // this.disabled = false;
                    EventBus.$emit("associated-user", this.form.id);
                    this.form.id = null;
                    this.form.username='';
                    this.form.password='';
                }
            } catch (err) {
                this.getErrors(err);
            }
            this.disabled = false;
        },
        toggleStatus(event) {
            if (event.target.checked) {
                Vue.set(this.form, "status", "cancelled");
            } else {
                Vue.set(this.form, "status", "completed");
            }
        },
    },
    computed: {
        getStatus() {
            return this.disabled;
        },
    },
};
</script>
