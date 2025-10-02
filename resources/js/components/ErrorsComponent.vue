<template>
    <div v-if="show"
        class="w-full px-4 z-10 text-xl py-2 mb-3 shadow-sm text-red-700  border rounded bg-red-100 border-red-500 transition-all duration-150"
        role="alert">
        <p class="font-bold">Se detecto los siguientes errores:</p>
        <p v-for="error in errors" class="text-sm mt-2 ml-4" :key="error">
            * {{ error }}
        </p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            show: false,
            errors: null,
        };
    },
    props: {
        id: {
            type: Number,
            default: 0
        }
    },
    mounted() {
      //tratar de eliminar este evento sino se necesita
        EventBus.$on(`an-error-ocurred-${this.id}`, this.getErrors)
        EventBus.$on(`an-error-ocurred`, this.getErrors)
    },
    methods: {
        getErrors(err) {
            console.log("entro aki");
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
    },
    watch: {
        errors: {
            deep: true,
            async handler() {
                if (this.errors) {
                    this.show = true;
                }

                await setTimeout(() => {
                    this.show = false;
                    this.errors = null;
                }, 3000);
            }
        }
    }
};
</script>
