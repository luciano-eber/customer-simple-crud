<script setup>
import  { computed, ref } from 'vue'
 
const props = defineProps({
    customer: Object
})

const cpfIsVisible = ref(false)

const cpf = computed(() => {
    return cpfIsVisible.value ? props.customer.cpf : ''
})

function toggleCpfVisibility() {
    cpfIsVisible.value = !cpfIsVisible.value
}

</script>

<template>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card w-100">
                    <div class="card-body d-flex flex-column flex-lg-row align-items-lg-center">
                        <div class="col-lg-6 col-xl-4">
                            <h5 class="card-title">{{ customer.nome }}</h5>
                            <h6 class="card-subtitle mb-3 text-muted">
                                <span class="badge bg-dark">Cliente {{ customer.diff_date }}</span>
                            </h6>
                            <h6 class="card-subtitle mb-2 text-muted">Data de registro: {{ customer.created_at }}</h6>
                            <h6 class="card-subtitle text-muted">Última atualização: {{ customer.updated_at }}</h6>
                        </div>
                        <div class="col-lg-6 col-xl-8">
                            <div class="card mt-3 mt-lg-0">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex flex-column">
                                        <small>
                                            Email
                                        </small>
                                        {{ customer.email }}
                                    </li>
                                    <li class="list-group-item d-flex flex-column flex-md-row justify-content-md-between align-items-md-center">
                                        <div class="d-flex flex-column">              
                                            <small>
                                                CPF
                                            </small>

                                            <Transition name="fade" mode="out-in">
                                                <span v-if="!cpfIsVisible" class="cpf-hide">

                                                </span>
                                                <span v-else>
                                                    {{ cpf }}
                                                </span>
                                            </Transition>
                                        </div>
                                        <div class="d-flex justify-content-md-end mt-2 mt-md-0">
                                            <button type="button" class="btn btn-outline-secondary btn-sm" @click.prevent="toggleCpfVisibility">
                                                Mostrar/Esconder
                                            </button>
                                        </div>
                                    </li>
                                </ul>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>