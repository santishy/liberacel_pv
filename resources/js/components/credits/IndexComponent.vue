<template>
    <nav-component>
        <credit-list></credit-list>
    </nav-component>
</template>
<script>
import NavComponent from '../NavComponent.vue';
import CreditList from './CreditList.vue';
export default {
    components: {
        NavComponent,
        CreditList,
    }
}
</script>