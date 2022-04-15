<script setup>
import { computed } from 'vue';
import { mask as vMask } from 'vue-the-mask';
import InputCEP from '@/Components/InputCEP';
import Input from '@/Components/Input';

const mask = { vMask }

const props = defineProps({
    form: Object,
    submitButtonMessage: String
})

const emit = defineEmits([
    'clearCep',
    'fetchCep',
    'save',
])

const clearCep = () => {
    emit('clearCep')
}

const fetchCep = (data) => {
    emit('fetchCep', data)
}

const save = () => {
    emit('save');
}


const clientSideValidationIsOk = computed(() => {

    function hasLength(field) {
        return field.length ? true : false
    }

    // all rules should be return boolean value
    const rules = [ 
        hasLength(props.form.nome),
        hasLength(props.form.email),
        hasLength(props.form.cpf),
        /\S+@\S+\.\S+/.test(props.form.email),
        /^\d{3}\.\d{3}\.\d{3}\-\d{2}$/.test(props.form.cpf),
        /\d{5}\-\d{3}/.test(props.form.cep),
        hasLength(props.form.cep),
        hasLength(props.form.uf),
        hasLength(props.form.localidade),
        hasLength(props.form.bairro),
        hasLength(props.form.logradouro),
        hasLength(props.form.complemento),
    ]

    return rules.every(el => el)
})  

</script>

<template>
    <div>
        <form @submit.prevent="save">
            <div class="mt-4">
                <h6>Informações pessoais</h6>
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
                <h6>Informações de endereço</h6>
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
                    {{ submitButtonMessage }}
                </button>
            </div>
        </form>
    </div>
</template>