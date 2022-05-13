<template>
    <form>
        <div>
            <input type="text" :class="inputStyle">
        </div>
        <div slot="bonos-button">
            
        </div>
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