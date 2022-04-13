<script setup>
import { ref, computed } from 'vue';
import { mask as vMask } from 'vue-the-mask';

const props = defineProps({
    modelValue: String,
    invalidFeedback: String,
});

const emit = defineEmits([
    'update:modelValue',
    'clearCep',
    'fetchCep'
]);

const mask = { vMask }

const errorMessage = ref('');

const checking = ref(false);

const hasError = computed(() => {
    return errorMessage.value.length ? true : false
})

const api = computed(() => {
    const cep = props.modelValue.replace(/\D/g, '');
    return `https://viacep.com.br/ws/${cep}/json`;
})

const cepIsValid = computed(() => {
    const rule = /\d{5}\-\d{3}/
    return rule.test(props.modelValue)
})

const updateValue = (val) => {
    clearCep();
    emit('update:modelValue', val);
}

const clearCep = () => {
    emit('clearCep')
}

const fetchCep = () => {
    
    if(!checking.value) {
        clearCep()
        checking.value = true
        errorMessage.value = '';

        const goFetch = () => {
            fetch(api.value)
            .then((res) => {
                checking.value = false

                res.json()
                .then(data => {
                    if(data.hasOwnProperty('erro'))
                        errorMessage.value = 'CEP não encontrado';
                    else
                        emit('fetchCep', data)
                })
            })
            .catch(() => {
                checking.value = false
                errorMessage.value = 'Não foi possível completar a busca'
            })
        }

        setTimeout(goFetch, 2000);
    }
}

</script>

<template>
    <div>
        <label class="form-label">CEP</label>
        <div class="row">
            
            <div class="col-lg-6 mb-2 mb-lg-0">

                <input type="text" class="form-control" :class="{ 'is-invalid': hasError || invalidFeedback }" placeholder="00000-000" v-mask="`#####-###`" :value="modelValue" @input="updateValue($event.target.value)" />

                <div v-show="hasError" class="invalid-feedback">
                    {{ errorMessage }}
                </div>

                <div v-show="invalidFeedback" class="invalid-feedback">
                    {{ invalidFeedback }}
                </div>

            </div>

            <div class="col-lg-6">
                <button type="button" class="btn btn-primary w-100" :disabled="!cepIsValid" @click="fetchCep">
                    <span v-if="checking">Verificando...</span>
                    <span v-else>Verificar CEP</span>
                </button>
            </div>
        </div>
    </div>
</template>