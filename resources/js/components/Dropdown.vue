<template>
    <div class="dropdown relative">
        <div class="dropdown-toggle"
             @click.prevent="isOpen = !isOpen"
        >
            <slot name="trigger"></slot>
        </div>

        <div v-show="isOpen"
             class="dropdown-menu absolute bg-white p-2 rounded shadow mt-2"
        >
            <slot>test</slot>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Dropdown",

        data() {
            return { isOpen: false }
        },

        watch: {
            isOpen(isOpen) {
                if (isOpen) {
                    document.addEventListener('click', this.closeIfClickedOutside);
                }
            }
        },

        methods: {
            closeIfClickedOutside(event) {
                if (! event.target.closest('.dropdown')) {
                    this.isOpen = false;
                    document.removeEventListener('click', this.closeIfClickedOutside);
                }
            }
        },
    }
</script>

<style scoped>

</style>
