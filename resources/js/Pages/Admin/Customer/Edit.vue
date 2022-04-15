<script setup>
import  { computed, ref } from 'vue';
import { usePage, useForm } from '@inertiajs/inertia-vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from '@/Pages/Admin/Customer/Card';
import CustomerForm from '@/Pages/Partials/CustomerForm'; 
import Modal from '@/Components/Modal';
import Alert from '@/Components/Alert';
import Toast from '@/Components/Toast';

const customer = computed(() => usePage().props.value.data)

const updateCustomerForm = useForm(customer.value);
updateCustomerForm.cpf = ''

const successUpdateToast = ref()
const updateModalConfirm = ref()

const updateConfirm = () => {
    updateModalConfirm.value.show()
}

const updateCustomer = () => {
    updateCustomerForm.clearErrors()
    updateCustomerForm.put(route('customers.update', customer.value.id), {
        onSuccess: () => {
            successUpdateToast.value.show()
            updateModalConfirm.value.hide()
            updateCustomerForm.cpf = ''
        }
    })
}

const clearCep = () => {
    updateCustomerForm.uf = ''
    updateCustomerForm.localidade = ''
    updateCustomerForm.bairro = ''
    updateCustomerForm.logradouro = ''
}

const fetchCep = (data) => {

    for(const field in data) {
        const fieldVal = data[field]

        if(field == 'uf' || field == 'localidade' || field == 'bairro' || field == 'logradouro')
            updateCustomerForm[field] = fieldVal
    }
}

</script>

<template>
    <div>
        <AdminLayout title="Detalhes do cliente">
           <Card :customer="customer"/>
           <div class="row mt-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Atualizar informações do cliente</h6>
                        </div>
                        <div class="card-body">
                            <Alert variant="warning">
                                Cuidado ao lidar com os dados dos clientes, todos os campos <strong>são obrigatórios</strong> para continuar...
                            </Alert>
                            <CustomerForm 
                                :form="updateCustomerForm" 
                                @clearCep="clearCep" 
                                @fetchCep="fetchCep"
                                submitButtonMessage="Continuar"
                                @save="updateConfirm"
                            />
                        </div>
                    </div>
                </div>
           </div>
            <Modal id="#confirm-modal" ref="updateModalConfirm">
                <template #header>
                    <h5 class="modal-title">Tem certeza que quer continuar?</h5>
                </template>

                <template #footer>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não, cancelar</button>
                    <button type="button" class="btn btn-warning" @click="updateCustomer">Sim quero atualizar</button>
                </template>
            </Modal>
            <Toast variant="success" ref="successUpdateToast">
                Dados do cliente atualizados com sucesso
            </Toast>
        </AdminLayout>
    </div>
</template>

<style lang="scss">
@import "bootstrap/scss/list-group";
.cpf-hide {
    background-color: $secondary;
    width: 10rem;
    padding: .8rem 0;
}
</style>