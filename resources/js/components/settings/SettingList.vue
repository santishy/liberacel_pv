<template>
    <table class="table-auto bg-white text-center">
        <thead>
            <tr class="bg-purple-200">
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Valor</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <setting-list-item
                v-for="(setting,index) in localSettings"
                :key="setting.id"
                :setting="setting"
                :index="index"
            >
            </setting-list-item>
        </tbody>
    </table>    
</template>

<script>
import SettingListItem from "./SettingListItem.vue";
export default {
    components:{
        SettingListItem
    },
    props:{
        settings:{
            type:Array
        }
    },
    data(){
        return {
            localSettings:[]
        }
    },
    mounted(){

        this.localSettings = this.settings;

        EventBus.$on('updated-settings-data',obj => {
            Vue.set(this.localSettings,obj.index,obj.setting)
            console.log(this.localSettings)
        });
    }
}
</script>