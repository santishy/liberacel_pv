<template>
    <nav-component>
        <transaction-report :uri='uri' :name="name">
        </transaction-report>
        <transaction-list :uri="uri" :name="name"> </transaction-list>
    </nav-component>
</template>
<script>
import NavComponent from "../NavComponent.vue";

export default {
    components: { NavComponent },
    props: {
        uri: String,
        name: String
    }
};
</script>
