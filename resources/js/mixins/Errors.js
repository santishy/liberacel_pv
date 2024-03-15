module.exports = {
    data: () => {
        return {
            errors: null,
        }
    },
    created() {
        EventBus.$on('emptyErrors', () => {
            this.errors = null;
        })
    },
    methods: {
        getErrors(err) {
            console.log({ response: err.response.data })
            if (err?.response?.status === 419) {
                return window.location.href = '/';
            }
            if (err?.response?.status === 403) {
                return window.location.href = '/403';
            }
            this.errors = Object?.values(
                err?.response?.data?.errors
            )?.flat()
        }
    }
}
