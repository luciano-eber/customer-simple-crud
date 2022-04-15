<script setup>    
import { ref, computed, onMounted } from 'vue';
const BootstrapToast = require('bootstrap/js/dist/toast') // dont try es6 import

const props = defineProps({
    delay: {
        type: Number,
        default: 4000,
    },
    variant: {
        type: String,
        default: 'primary'
    }
});

defineExpose({
    show,
    hide
})

const variantClass = computed(() => {
    return `bg-${props.variant} text-white`
}) 

const toastEl = ref()

const btsToast = ref()

onMounted(() => {
    btsToast.value = new BootstrapToast(toastEl.value, {
        delay: props.delay
    })
})

function show () {
    btsToast.value.show()
}

function hide() {
    btsToast.value.hide()
}

</script>

<template>
    <teleport to="body">
        <div 
            class="toast align-items-center position-fixed top-0 w-100" 
            role="alert" 
            aria-live="assertive" 
            aria-atomic="true"
            :class="[ variantClass ]"
            ref="toastEl"
        >
            <div class="d-flex">
                <div class="toast-body text-center w-100">
                    <slot />
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </teleport>
</template>

<style lang="scss">
@import "bootstrap/scss/toasts";

.toast {
    font-size: 110%;
}
</style>