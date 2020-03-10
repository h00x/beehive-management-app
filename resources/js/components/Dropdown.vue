<template>
    <div class="dropdown relative">
        <div class="dropdown-toggle"
             @click.prevent="isOpen = !isOpen"
        >
            <slot name="trigger"></slot>
        </div>

        <div v-show="isOpen"
             class="dropdown-menu absolute bg-white p-2 rounded shadow whitespace-no-wrap z-20"
             v-bind:class="[align === 'right' ? 'right-0' : 'left-0', generateTopMargin]"
        >
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Dropdown",

        props: {
            align: { default: 'right'},
            margin: { default: '2'}
        },

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
            },
        },

        computed: {
            generateTopMargin() {
                return 'mt-' + this.margin;
            }
        }
    }
</script>

<style scoped>

</style>
