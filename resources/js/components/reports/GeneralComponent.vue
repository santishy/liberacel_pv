<template></template>

<script>
export default {
    data() {
        return {
            URIs: [
                '/payments/',
                '/expenses/',
                '/sales/',
                '/fast-sales/'
            ]
        }
    },
    created() {
        EventBus.$on('set-parameters', this.getReports)
    },
    methods: {
        async getReports(params) {
            const reports = this.URIs.map(
                uri => {
                    if (uri === '/expenses/') {
                        delete params['filter[status]']
                    }
                    return axios.get(uri, { params })
                }
            );
            const data = await Promise.all(reports);
            console.log({ data })
        }
    }
}
</script>
