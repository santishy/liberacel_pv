<template>
    <layout-component>
        <div class="flex justify-center items-center flex-col  px-4 w-full">
            <raffle-list></raffle-list>
        </div>
    </layout-component>
</template>
<script>
import RaffleList from './RaffleList.vue';


export default {
    name: "RaffleIndex",
    components: { RaffleList },
    data() {
        return {}
    },
    methods: {

    }

}
</script>
