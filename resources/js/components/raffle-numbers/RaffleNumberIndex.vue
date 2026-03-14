<template>
    <layout-component>
        <div class="flex justify-center items-center flex-col w-full px-4">
            <raffle-number-list></raffle-number-list>
        </div>
    </layout-component>
</template>
<script>
import RaffleNumberList from './RaffleNumberList.vue';
export default {
    components: {
        RaffleNumberList,
    }
}
</script>