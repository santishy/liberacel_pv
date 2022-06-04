<template>
    <form class="text-left mt-2" @submit.prevent="submit">
        <div class="w-full flex flex-wrap mb-4">
            <span class="w-4/12 px-4 py-2">Nombre</span>
            <span class="w-7/12 rounded-sm bg-gray-300 px-4 py-2">{{
                    name
            }}</span>
        </div>
        <div class="w-full flex flex-wrap">
            <label class="w-4/12 text-left px-4 py-2">Valor</label>
            <input type="text" v-model="form.value" placeholder="Nuevo valor"
                class="px-4 py-2 bg-gray-300 w-7/12 rounded-sm text-left" />
        </div>
        <div class="px-2 mt-4">
            <button class="
                    px-2
                    py-2
                    bg-blue-700
                    hover:bg-blue-500
                    shadow-sm
                    rounded-sm
                    w-full
                    text-white
                ">
                Guardar cambios
            </button>
        </div>
        <div class="flex items-center mt-2">
            <errors-component :errors-found="errors" />
        </div>
    </form>
</template>

<script>
export default {
    data() {
        return {
            form: {},
            name: null,
            id: null,
            index: null,
        };
    },
    mounted() {
        EventBus.$on("selected-setting", (obj) => {
            Vue.set(this.form, 'name', obj.setting.name)
            Vue.set(this.form, 'value', obj.setting.value)
            this.id = obj.setting.id;
            this.name = obj.setting.name.replace("_", " ").toUpperCase();
            this.index = obj.index;
            console.log(obj.setting)
        });
    },
    methods: {
        async submit() {
            try {
                this.form._method = "PUT";
                const res = await axios.post(`settings/${this.id}`, this.form);
                if (res.data.isUpdated) {
                    this.form = {};
                    EventBus.$emit("open-modal", false);
                    EventBus.$emit("updated-settings-data", {
                        setting: res.data.setting,
                        index: this.index,
                    });
                }
            } catch (e) {
                console.log(e);
                this.getErrors(e)
            }
        },
    },
};
</script>
