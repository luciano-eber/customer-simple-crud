<script setup>
import { ref } from 'vue';
import Modal from '@/Components/Modal';
import Alert from '@/Components/Alert';

const props = defineProps({
    id: String,
    deleteId: Number
})

const emit = defineEmits([
    'confirm'
])

 const modal = ref()

const confirm = (id) => {
    modal.value.hide()
    emit('confirm', props.deleteId)
}

</script>

<template>
    <div>
        <Modal :id="id" ref="modal">
            <template #header>
                <h5 class="modal-title">Tem certeza que quer continuar?</h5>
            </template>

            <template #body>
                <Alert variant="warning">
                    Esta ação é irreversível
                </Alert>
            </template>

            <template #footer>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não, cancelar</button>
                <button type="button" class="btn btn-danger" @click="confirm">Sim quero remover</button>
            </template>
        </Modal>
    </div>
</template>