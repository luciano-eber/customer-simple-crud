<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import Toast from '@/Components/Toast';
import Alert from '@/Components/Alert';
import CustomerForm from '@/Pages/Partials/CustomerForm'

const form = useForm({
    nome: '',
    email: '',
    cpf: '',
    cep: '',
    uf: '',
    localidade: '',
    bairro: '',
    logradouro: '',
    complemento: '',
});

const toastSuccess = ref()

const submit = () => {
    form.clearErrors()
    form.post(route('customers.register'), {
        onSuccess: () => {
            toastSuccess.value.show()
            form.reset()
        }
    })
}
const clearCep = () => {
    form.uf = ''
    form.localidade = ''
    form.bairro = ''
    form.logradouro = ''
}

const fetchCep = (data) => {

    for(const field in data) {
        const fieldVal = data[field]

        if(field == 'uf' || field == 'localidade' || field == 'bairro' || field == 'logradouro')
            form[field] = fieldVal
    }
}

</script>

<template>
    <div>
        <div class="container">
            <h3 class="text-center mb-4">Bem vindo, complete o formulário para cadastrar-se</h3>

            <Alert variant="info">
                Todos os campos <strong>são obrigatórios</strong> para concluir o cadastro
            </Alert>
            
            <CustomerForm 
                :form="form" 
                @save="submit" 
                @fetchCep="fetchCep" 
                @clearCep="clearCep" 
                submitButtonMessage="Concluir cadastro"
            />

        </div>
        <Toast ref="toastSuccess" variant="success">
            Cadastro concluído com sucesso
        </Toast>
    </div>
</template>

<style lang="scss">
@import "bootstrap/scss/alert";
</style>