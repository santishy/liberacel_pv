<template>
    <layout-component>
        <div
            class="relative overflow-x-auto bg-white rounded scroll-smooth scrollbar-track-transparent  scrollbar-thumb-sky-500 scrollbar-thin">
            <table v-if="inventories.length" v-can="'view warehouses'"
                class="w-full sm:text-sm text-left  text-slate-500">
                <thead class="sm:text-xs text-slate-700 uppercase bg-gray-100 ">
                    <tr class="bg-danger">
                        <th scope="col" class="px-6 py-3">Nombre</th>
                        <th scope="col" class="px-6 py-3">Dirección</th>
                        <th scope="col" class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <warehouse-list-item v-for="(inventory, index) in localInventories" :key="inventory.id"
                        :inventory="inventory" :index="index" />
                </tbody>
            </table>
        </div>

        <information-component>
            <template slot="title">
                Almacenes
            </template>

            <message :title="modalDataConfirm.title" :message="modalDataConfirm.message"></message>
            <template slot="button">
                <agree v-if="modalDataConfirm.actionEnabled" :method="modalDataConfirm.action"
                    @deleteWarehouse="deleteWarehouse" @emptyWarehouse="emptyWarehouse"></agree>
            </template>
        </information-component>
    </layout-component>
</template>

<script>
import { mapState, mapMutations } from "vuex";
import Agree from "../alerts/Agree.vue";
import Message from "../alerts/Message.vue";
//import NavComponent from "../NavComponent.vue";
import WarehouseListItem from "./WarehouseListItem.vue";
import InformationComponent from "../modals/InformationComponent.vue";

export default {
    components: {
        //  NavComponent,
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
            show: true
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
                                actionEnabled: false
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
            EventBus.$emit('open-modal', false);
            axios
                .delete("/inventories/" + this.modalDataConfirm.inventory.id, {
                    id: this.modalDataConfirm.inventory.id
                })
                .then(res => {
                    if (res.data.empty) {
                        this.notify({ title: 'Almacenes', message: 'El almacén se vacio correctamente.' });
                    }
                })
                .catch(err => {
                    this.getErrors(err);
                });
        }
    },
    computed: {
        ...mapState(["modalDataConfirm"])
    }
};
</script>
