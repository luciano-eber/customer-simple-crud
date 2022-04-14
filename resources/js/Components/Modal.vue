<script setup>
import { computed, ref } from 'vue';
import 'bootstrap/js/dist/modal';

const props = defineProps({
    id: String,
})

const close = ref()

defineExpose({
    close
})

</script>

<template>
    <teleport to="body">
        <div class="modal fade" :id="id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <slot name="header" />
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ref="close"></button>
                    </div>
                    <div class="modal-body">
                        <slot name="body" />
                    </div>
                    <div class="modal-footer">
                        <slot name="footer" />
                    </div>
                </div>
            </div>
        </div>
    </teleport>
</template>

<style lang="scss">
@import "bootstrap/scss/modal";
</style>