<template>
    <label class="relative inline-flex cursor-pointer">
        <input ref="credit" v-model="is_credit" @change="creditStatusChange" type="checkbox" class="sr-only peer">
        <div
            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
        </div>
        <span class="ml-3 text-sky-800 font-mono text-lg">Venta a crédito: <b class="text-xl">{{ isCredit }}</b></span>
    </label>
</template>
<script>
export default {
    // props: ['form'],
    props: {
        url: { type: String, required: true },
        sale: {
            type: Object,
            default: () => ({}),
        }
    },
    data() {
        return {
            is_credit: false
        }
    },
    mounted() {
        EventBus.$on('associated-user', () => {
            this.is_credit = false;
        })
    },
    methods: {
        async creditStatusChange() {
            if (!this.is_credit) return;
            try {
                const res = await axios.post(this.url, { _method: 'PUT', is_credit: this.is_credit });
            } catch (error) {
                this.$refs.credit.checked = false;
                this.is_credit = false;
                EventBus.$emit('an-error-ocurred', error);
            }
            //EventBus.$emit('credit-status-change', this.form.is_credit)
        }
    },
    watch: {
        'sale.is_credit': {
            handler(newValue) {
                this.is_credit = newValue;
            },
            immediate: true,
        }

    },
    computed: {
        isCredit() {
            return this.is_credit ? 'Si' : 'No';
        }
    }
}
</script>
