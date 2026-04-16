<template>
    <input type="text" :placeholder="placeholder" :class="classes" @input="$emit('input', $event.target.value)"
        :value="value" @keyup.enter="$emit('search', value)" class="form-text-input " />
</template>
<script>
export default {
    props: {
        value: {
            type: String,
            default: ''
        },
        classes: {
            type: String,
            default: '',
        },
        placeholder: {
            type: String,
            default: '',
        }
    }
};
</script>