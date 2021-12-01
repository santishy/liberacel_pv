module.exports = {
    data: () => {
        return {
            errors: null,
            ola: 'hola'
        }
    },
    created(){
        EventBus.$on('emptyErrors',()=>{
            this.errors = null;
        })
    },
    methods: {
        getErrors(err) {
            console.log(err)
            if (err?.response?.status === 403) {
                return window.location.href = '/403';
            }
            this.errors = Object.values(
                err?.response?.data?.errors
            ).flat()
        }
    }
}