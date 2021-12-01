<template>
    <nav-component>
        <div class="md:w-9/12 mx-auto flex flex-wrap items-baseline" >
            <registration-form
                class="mr-4"
                :inventories="inventories"
                :method="method"
                :editable-user="editableUser"
                :uri="uri"
            >
            </registration-form>
            <assign-role
                :roles="roles"
                class="self-start"
                :has-roles="hasRoles"
                v-can="definePermission"
            ></assign-role>
        </div>
    </nav-component>
</template>
<script>
import NavComponent from "../NavComponent.vue";

export default {
    components: { NavComponent },
    props: {
        roles: {
            type: Array
        },
        inventories: {
            type: Array
        },
        editableUser: {
            type: Object
        },
        hasRoles: {
            type: Array
        },
        method: {
            type: String
        },
        uri: {
            type: String
        }
    },
    computed:{
        definePermission(){
            if(this.method.toUpperCase() === 'POST' )
                return 'create user';
            return 'edit user';
        }
    }
};
</script>
