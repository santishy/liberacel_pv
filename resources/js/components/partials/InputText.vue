<template>
    <input type="text" :class="inputClass" class="form-text-input" v-bind="$attrs" :value="value"
        @input="updateValue" />
</template>

<script>
export default {
    props: {
        value: {
            type: String,
            default: ''
        },
        inputClass: {
            type: String,
            default: ''
        }
    },
    methods: {
        updateValue(event) {
            this.$emit('input', event.target.value);
        }
    }
};
</script>
