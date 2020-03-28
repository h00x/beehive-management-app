<template>
    <div @keyup.esc = "closeModal">
        <div @click="openModal">
            <slot name="button">Default button</slot>
        </div>
        <div
            class="modal-bg fixed top-0 bottom-0 left-0 right-0 bg-blackAlpha-75 flex justify-center items-center"
            @click.self = "closeModal"
            v-if="isModalVisible"
            @close="closeModal"
        >
            <div class="modal bg-white shadow p-6 rounded relative max-w-sm whitespace-normal">
                <div class="mb-2">
                    <h3 class="text-2xl"><slot name="header">Default header</slot></h3>
                    <button
                        type="button"
                        class="absolute right-0 top-0 mr-2 mt-2"
                        @click="closeModal"
                    >
                        <i class="fas fa-times text-sm mr-2"></i>
                    </button>
                </div>

                <div class="mb-8">
                    <slot name="body">Default body</slot>
                </div>

                <div class="flex justify-end">
                    <button
                        type="button"
                        @click="closeModal"
                        class="mr-4 text-secondary-500 hover:text-secondary-700"
                    >
                        <slot name="cancel">Cancel</slot>
                    </button>
                    <slot name="footer">Default footer</slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Modal",

        data() {
            return {
                isModalVisible: false,
            }
        },

        methods: {
            closeModal() {
                this.isModalVisible = false;
            },
            openModal() {
                this.isModalVisible = true;
            },
        },
    }
</script>
