<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { mask as vMask } from 'vue-the-mask';
import InputCEP from '@/Components/InputCEP';

const mask = { vMask }

const form = useForm({
    name: '',
    email: '',
    cpf: '',
    cep: '',
    uf: '',
    city: '',
    district: '',
    street: ''
});

const fetchCep = (res) => {
    console.log(res)
}

</script>

<template>
    <div>
        <div class="container">
            <h3 class="text-center">Bem vindo, complete o formulário para cadastrar-se</h3>
            
            <div class="mt-5">
                <h5>Informações pessoais</h5>
                <div class="card">
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-xl-3 g-3">
                            <div class="col">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control" placeholder="Nome completo">
                            </div>
                            <div class="col">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="nome@example.com">
                            </div>
                            <div class="col">
                                <label class="form-label">CPF</label>
                                <input type="text" class="form-control" placeholder="000-000-000-00" v-mask="`###-###-###-##`">
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
                                <InputCEP v-model="form.cep" @fetchCep="fetchCep"/>
                            </div>
                            <div class="col col-lg-6">
                                <label class="form-label">Estado/UF</label>
                                <input type="text" class="form-control" placeholder="Verifique o CEP" disabled>
                            </div>
                            <div class="col col-lg-6">
                                <label class="form-label">Cidade</label>
                                <input type="text" class="form-control" placeholder="Verifique o CEP" disabled>
                            </div>
                            <div class="col col-lg-6">
                                <label class="form-label">Bairro</label>
                                <input type="text" class="form-control" placeholder="Verifique o CEP" disabled>
                            </div>
                            <div class="col col-lg-6">
                                <label class="form-label">Rua</label>
                                <input type="text" class="form-control" placeholder="Verifique o CEP" disabled>
                            </div>
                            <div class="col">
                                <label class="form-label">Complemento</label>
                                
                                <div class="input-group">
                                    <span class="input-group-text">Nº</span>
                                    <input type="text" class="form-control" placeholder="Digite o complemento, ex: número da casa, apt, bloco">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>