<script setup>
import { computed, ref, onMounted } from 'vue';
const BootstrapModal= require('bootstrap/js/dist/modal')

const props = defineProps({
    id: String,
})
const modal = ref()
const btsModal = ref()

defineExpose({
    hide,
    show,
})

onMounted(() => {
    btsModal.value = new BootstrapModal(modal.value)
})

function show () {
    btsModal.value.show()
}

function hide() {
    btsModal.value.hide()
}

</script>

<template>
    <teleport to="body">
        <div class="modal fade" :id="id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" ref="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <slot name="header" />
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hide"></button>
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