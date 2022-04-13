<script setup>
import { computed } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { mask as vMask } from 'vue-the-mask';
import InputCEP from '@/Components/InputCEP';
import Input from '@/Components/Input';
import Toast from '@/Components/Toast';
import Alert from '@/Components/Alert';
import 'bootstrap/js/dist/alert'

const mask = { vMask }

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

const clientSideValidationIsOk = computed(() => {

    function hasLength(field) {
        return field.length ? true : false
    }

    // all rules should be return boolean value
    const rules = [ 
        hasLength(form.nome),
        hasLength(form.email),
        hasLength(form.cpf),
        /\S+@\S+\.\S+/.test(form.email),
        /^\d{3}\.\d{3}\.\d{3}\-\d{2}$/.test(form.cpf),
        /\d{5}\-\d{3}/.test(form.cep),
        hasLength(form.cep),
        hasLength(form.uf),
        hasLength(form.localidade),
        hasLength(form.bairro),
        hasLength(form.logradouro),
        hasLength(form.complemento),
    ]

    return rules.every(el => el)
})  

const submit = () => {
    form.clearErrors()
    form.post(route('customers.register'), {
        onSuccess: () => form.reset(),
    })
    
}

</script>

<template>
    <div>
        <div class="container">
            <h3 class="text-center mb-4">Bem vindo, complete o formulário para cadastrar-se</h3>

            <Alert variant="info">
                Todos os campos <strong>são obrigatórios</strong> para concluir o cadastro
            </Alert>
            
            <form @submit.prevent="submit">
                <div class="mt-4">
                    <h5>Informações pessoais</h5>
                    <div class="card">
                        <div class="card-body">
                            <div class="row row-cols-1 row-cols-xl-3 g-3">
                                <div class="col">
                                   <Input 
                                        v-model="form.nome" 
                                        label="Nome" 
                                        placeholder="Nome Completo"
                                        :invalidFeedback="form.errors.nome"
                                    />
                                </div>
                                <div class="col">
                                    <Input 
                                        v-model="form.email" 
                                        label="Email" 
                                        placeholder="nome@example.com"
                                        :invalidFeedback="form.errors.email"
                                        type="email"
                                    />
                                </div>
                                <div class="col">
                                    <Input
                                        v-model="form.cpf" 
                                        label="CPF" 
                                        placeholder="000.000.000-00"
                                        :invalidFeedback="form.errors.cpf"
                                        v-mask="`###.###.###-##`"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <h5>Informações de endereço</h5>
                    <div class="card">
                        <div class="card-body">
                            <div class="row row-cols-1 g-3">
                                <div class="col">
                                    <InputCEP 
                                        v-model="form.cep" 
                                        @fetchCep="fetchCep" 
                                        @clearCep="clearCep" 
                                        :invalidFeedback="form.errors.cep"
                                    />
                                </div>
                                <div class="col col-lg-6">
                                    <Input 
                                        v-model="form.uf" 
                                        label="Estado/UF" 
                                        placeholder="Verifique o CEP"
                                        :invalidFeedback="form.errors.uf"
                                        disabled
                                    />
                                </div>
                                <div class="col col-lg-6">
                                    <Input 
                                        v-model="form.localidade" 
                                        label="Cidade" 
                                        placeholder="Verifique o CEP"
                                        :invalidFeedback="form.errors.localidade"
                                        disabled
                                    />
                                </div>
                                <div class="col col-lg-6">
                                    <Input
                                        v-model="form.bairro" 
                                        label="Bairro" 
                                        placeholder="Verifique o CEP"
                                        :invalidFeedback="form.errors.bairro"
                                        disabled
                                    />
                                </div>
                                <div class="col col-lg-6">
                                    <Input
                                        v-model="form.logradouro" 
                                        label="Rua" 
                                        placeholder="Verifique o CEP"
                                        :invalidFeedback="form.errors.logradouro"
                                        disabled
                                    />
                                </div>
                                <div class="col">
                                    <Input
                                        label="Complemento"
                                        v-model="form.complemento"
                                        placeholder="Digite o complemento, ex: número da casa, apt, bloco"
                                        :invalidFeedback="form.errors.complemento"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-success btn-lg" :disabled="!clientSideValidationIsOk || form.processing">
                        Concluir cadastro
                    </button>
                </div>
            </form>

        </div>
        <Toast :show="form.wasSuccessful" variant="success">
            Cadastro concluído com sucesso
        </Toast>
    </div>
</template>

<style lang="scss">
@import "bootstrap/scss/alert";
</style>