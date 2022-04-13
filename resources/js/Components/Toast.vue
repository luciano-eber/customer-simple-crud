<script setup>    
import { ref, computed } from 'vue';
import 'bootstrap/js/dist/toast';

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    variant: {
        type: String,
        default: 'primary'
    }
});

const variantClass = computed(() => {
    return `bg-${props.variant} text-white`
})

const showClass = computed(() => {
    return props.show ? 'fade show' : ''
})

</script>

<template>
    <div 
        class="toast align-items-center position-fixed bottom-0 end-0" 
        role="alert" 
        aria-live="assertive" 
        aria-atomic="true"
        :class="[ variantClass, showClass ]"
        data-bs-delay="10000"
    >
        <div class="d-flex">
            <div class="toast-body">
                <slot />
            </div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</template>

<style lang="scss">
@import "bootstrap/scss/toasts";

.toast {
    font-size: 110%;
}
</style>