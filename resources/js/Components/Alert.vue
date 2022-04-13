<script setup>
import { computed } from 'vue';

const props = defineProps({
    variant: String,
})

const variantClass = computed(() => {
    return `alert-${props.variant}`
})

</script>
<template>
    <div>
        <div class="alert alert-dismissible" role="alert" :class="[ variantClass ]">
            <slot/>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
</template>