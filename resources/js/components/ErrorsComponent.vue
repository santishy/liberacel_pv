<template>
    
    <div
        v-if="show"
        class="w-full mb-3 bg-blue-100 border-t border-b border-red-500 text-red-700 px-4 py-3"
        role="alert"
    >
        <p class="font-bold">Se detecto los siguientes errores:</p>
        <p v-for="error in errorsFound" class="text-sm" :key="error">
            {{ error }}
        </p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            show: false
        };
    },
    props: {
        errorsFound: {
            type: Array
        },
        errorsLength: {
            type: Number
        }
    },
    watch: {
        errorsFound: {
            deep: true,
            async handler() {
                if (this.errorsFound) {
                    this.show = true;
                }

                await setTimeout(() => {
                    this.show = false;
                    EventBus.$emit("emptyErrors")
                }, 3000);
            }
        }
    }
};
</script>
