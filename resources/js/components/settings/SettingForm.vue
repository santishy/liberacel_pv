<template>
    <form >
        <div class="w-full" :class="controlsContainerStyle">
            <label :class="[labelStyle]">Precio</label>
            <input
                type="text"
                ref="value"
                v-model="form.value"
                :class="[inputStyle]"
                placeholder="Precio"
            />
        </div>
    </form>
</template>

<script>
export default {
    mounted(){
        EventBus.$on('seletected-setting',setting => {
            this.form.name = setting.name;
            this.form.value = setting.value;
        })
    },
    data(){
        return {
            form:{}
        }
    },
    computed: {
        labelStyle() {
            return " w-3/12 text-center text-gray-700 font-mono font-semibold mr-2 rounded-sm py-3 px-6 bg-gray-300";
        },
        inputStyle() {
            return " placeholder:italic bg-stripes-gray  font-semibold placeholder-gray-600 placeholder-shown:border-gray-500 appearance-none bg-gray-200  rounded w-8/12 py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent";
        },
        controlsContainerStyle() {
            return "flex flex-wrap flex-row  justify-center items-center w-full ";
        },
    },
};
</script>
