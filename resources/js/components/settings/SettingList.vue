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
                v-for="setting in settings"
                :key="setting.id"
                :setting="setting"
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
    }
}
</script>