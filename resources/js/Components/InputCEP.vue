<script setup>
import { ref, computed } from 'vue';
import { mask as vMask } from 'vue-the-mask';

const props = defineProps({
    modelValue: String
});

const emit = defineEmits([
    'update:modelValue',
    'fetchCep'
]);

const mask = { vMask }

const errorMessage = ref('')

const api = computed(() => {
    const cep = props.modelValue.replace(/\D/g, '');
    return `https://viacep.com.br/ws/${cep}/json`;
})

const cepIsValid = computed(() => {
    const rule = /\d{5}\-\d{3}/
    return rule.test(props.modelValue)
})

const updateValue = (val) => {
    emit('update:modelValue', val);
}

const fetchCep = () => {
    console.log('fetching cep on via cep')
    fetch(api._value)
    .then((res) => {
        emit('fetchCep', res)
    })
    .catch((err) => {
        errorMessage.value = err
    })
}

</script>

<template>
    <div>
        <label class="form-label">CEP</label>
        <div class="row">
            <div class="col-lg-6">
                <input type="text" class="form-control" placeholder="00000-000" v-mask="`#####-###`" :value="modelValue" @input="updateValue($event.target.value)" />
            </div>
            <div class="col-lg-6">
                <button type="button" class="btn btn-primary w-100" :disabled="!cepIsValid" @click="fetchCep">
                    Verificar CEP
                </button>
            </div>
        </div>
    </div>
</template>