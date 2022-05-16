<template>
    <form>
        <div>
            <input type="text" :class="inputStyle" placeholder="Ejemplo: 3531002244">
        </div>
        <slot name="bonus-button">
            
        </slot>
    </form>
</template>
<script>
export default{
    props:{ 
        inputStyle:{
            type:String,
            default:''
        }
    },
}
</script>