<template>
    <div class="p-2 w-full">
        <div>
            <div
                class="flex justify-center items-center m-1 font-medium py-1 px-2 rounded-md text-yellow-700 bg-yellow-100 border border-yellow-300 "
            >
                <div slot="avatar">
                    
                </div>
                <div class="text-xl font-normal  max-w-full flex-initial">
                    <div class="py-2">
                        <i class="fas fa-exclamation-triangle"></i> {{title}}
                        <div class="text-sm font-base mt-3">
                            {{message}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    props: {
        message:{
            type:String,
        },
        title:{
            title:String
        }
    }

}
</script>
