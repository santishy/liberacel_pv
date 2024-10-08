<template>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <transition enter-active-class="ease-out duration-300" enter-class="opacity-0" enter-to-class="opacity-100"
        leave-active-class="ease-in duration-200" leave-class="opacity-100" leave-to-class="opacity-0">
        <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"
            v-show="modal">
            <div
                class="flex items-center sm:items-end justify-center min-h-screen pt-4 px-6 pb-20 text-center sm:block sm:p-0">
                <!--
                Background overlay, show/hide based on modal state.

                Entering: "ease-out duration-300"
                    From: "opacity-0"
                    To: "opacity-100"
                Leaving: "ease-in duration-200"
                    From: "opacity-100"
                    To: "opacity-0"
            -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <!--
            Modal panel, show/hide based on modal state.

            Entering: "ease-out duration-300"
                From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                To: "opacity-100 translate-y-0 sm:scale-100"
            Leaving: "ease-in duration-200"
                From: "opacity-100 translate-y-0 sm:scale-100"
                To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            -->
                <transition enter-active-class="ease-out duration-300"
                    enter-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    enter-to-class="opacity-100 translate-y-0 sm:scale-100" leave-class="ease-in duration-200"
                    leave-active-class="opacity-100 translate-y-0 sm:scale-100"
                    leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <!-- Se usa v-show aki y arriba para que funcione la transicion -->
                    <div v-show="modal"
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white sm:px-4 px-4 pt-2 pb-4 sm:p-2">
                            <div class="sm:flex sm:items-start">
                                <div class="sm:px-6 pt-4 text-center sm:mt-0 w-full">
                                    <h3 class="w-full text-left text-lg leading-6 font-medium text-slate-800"
                                        id="modal-title">
                                        <slot name="title"></slot>
                                    </h3>
                                    <div class="mt-2">
                                        <slot></slot>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-sky-100 px-4 py-2 sm:pt-2 sm:px-4 sm:flex sm:flex-row-reverse">
                            <slot name="button"></slot>
                            <button type="button" @click="modal = false"
                                class=" w-full inline-flex justify-center items-center rounded-md  border-2 shadow-sm px-4 py-2 mr-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm border-gray-400">
                                Cerrar
                            </button>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
    </transition>
</template>
<script>
export default {
    props: ["id"],
    data() {
        return {
            modal: false
        };
    },
    created() {
        EventBus.$on(this.openModalID, value => {
            this.modal = value;
        });
        EventBus.$on("open-modal", value => {
            this.modal = value;
        });
    },
    computed: {
        openModalID() {
            return `open-modal-${this.id}`;
        }
    },
    watch: {
        id: {
            immediate: true, // Esto permite que el watcher se ejecute inmediatamente cuando el componente se crea
            handler(newVal, oldVal) {
                // Este es el cuerpo del watcher
                // "newVal" es el nuevo valor de la prop "id"
                // "oldVal" es el valor anterior de la prop "id"
                if (newVal !== oldVal) {

                    // Realiza acciones en respuesta al cambio de "id"
                    //this.modal = newVal; // Por ejemplo, actualiza "modal" con el nuevo valor de "id"
                }
            }
        }
    }
};
</script>
