<template></template>

<script>
export default {
    created() {
        EventBus.$on('set-parameters', this.getReport)
    },
    methods: {
        getReport(params) {
            console.log({ params })
        }
    }
}
</script>
