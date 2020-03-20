<template>
    <transition name="fade">
        <div
            class="alert alert-block"
            v-if="isOpen"
            v-bind:class="'alert-' + message.type"
        >
            <button
                type="button"
                class="close"
                data-dismiss="alert"
                @click.prevent="isOpen = !isOpen"
            >
                <i class="far fa-times-circle"></i>
            </button>
            <strong>{{ message.description }}</strong>
        </div>
    </transition>
</template>

<script>
    export default {
        name: "FlashMessage",
        props: {
            message: {
                default: 'Default message'
            }
        },

        data() {
            return {
                isOpen: true
            }
        },

        beforeMount() {
            Object.keys(this.message).length ? this.isOpen = true : this.isOpen = false;
        }
    }
</script>
