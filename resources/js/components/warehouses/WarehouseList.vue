<template>
    <nav-component>
        <div class="w-9/12 mx-auto flex justify-center ">
            <div
                class="bg-white shadow rounded max-w-full sm:overflow-x-hidden overflow-x-auto"
            >
                <table
                    v-if="inventories.length"
                    v-can="'view warehouses'"
                    class="table-auto"
                >
                    <thead>
                        <tr class="bg-danger">
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Dirección</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <warehouse-list-item
                            v-for="(inventory, index) in localInventories"
                            :key="inventory.id"
                            :inventory="inventory"
                            :index="index"
                        />
                    </tbody>
                </table>
            </div>
        </div>
        <information-component>
            <template slot="title">
                Almacenes
            </template>

            <message
                :title="modalDataConfirm.title"
                :message="modalDataConfirm.message"
            ></message>
            <template slot="button">
                <agree
                    v-if="modalDataConfirm.actionEnabled"
                    :method="modalDataConfirm.action"
                    @deleteWarehouse="deleteWarehouse"
                    @emptyWarehouse="emptyWarehouse"
                ></agree>
            </template>
        </information-component>
    </nav-component>
</template>

<script>
import { mapState, mapMutations } from "vuex";
import Agree from "../alerts/Agree.vue";
import Message from "../alerts/Message.vue";
import NavComponent from "../NavComponent.vue";
import WarehouseListItem from "./WarehouseListItem.vue";
import InformationComponent from "../modals/InformationComponent.vue";

export default {
    components: {
        NavComponent,
        Agree,
        WarehouseListItem,
        InformationComponent,
        Message
    },
    props: {
        inventories: {
            type: Array
        }
    },
    data() {
        return {
            localInventories: [],
            show:true
        };
    },
    created() {
        if (this.inventories) this.localInventories = this.inventories;
    },
    methods: {
        ...mapMutations(["setModalDataConfirm"]),
        deleteWarehouse() {
            EventBus.$emit("open-modal", false);
            if (this.modalDataConfirm?.inventory)
                axios
                    .delete("/warehouses/" + this.modalDataConfirm.inventory.id)
                    .then(res => {
                        if (res.data.deleted) {
                            console.log(this.modalDataConfirm.index);
                            this.localInventories.splice(
                                this.modalDataConfirm.index,
                                1
                            );
                            this.setModalDataConfirm({});
                        } else {
                            this.setModalDataConfirm({
                                title: "No se pudo eliminar",
                                message: res.data.message,
                                actionEnabled:false
                            });
                            EventBus.$emit("open-modal", true);
                        }
                    })
                    .catch(err => {
                        this.getErrors(
                            err
                        );
                    });
        },
        emptyWarehouse() {
            EventBus.$emit('open-modal',false);
            axios
                .delete("/inventories/" + this.modalDataConfirm.inventory.id, {
                    id: this.modalDataConfirm.inventory.id
                })
                .then(res => {
                    if(res.data.empty){
                        this.notify({title:'Almacenes',message:'El almacén se vacio correctamente.'});
                    }
                })
                .catch(err =>{
                    this.getErrors(err);
                });
        }
    },
    computed: {
        ...mapState(["modalDataConfirm"])
    }
};
</script>
