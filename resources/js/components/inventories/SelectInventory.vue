<template>
    <layout-component>
        {{ inventories }}
    </layout-component>
</template>

<script>
export default {
    created() {
        
    },
    props: {
       inventories:{
            type: Array,
            required: true
       }
    },
    components: { },
    data() {
        return {
            
        };
    },
    methods: {
       
    }
};
</script>
