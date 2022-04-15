<script setup>
import { computed, ref, onMounted } from 'vue';
import { Link } from '@inertiajs/inertia-vue3'
import Pagination from '@/Components/Pagination';
import Alert from '@/Components/Alert';

const props = defineProps({
    search: String,
    baseRoute: String,
    pagination: Object
})

const searchString = ref('')

const searchRoute = computed(() => {
    return `${props.baseRoute}?search=${searchString.value}`
})

onMounted(() => {
    searchString.value = props.search ?? ''
})
</script>

<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row d-flex align-items-center mb-3">
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Pesquisar nesta tabela" aria-label="Username" aria-describedby="basic-addon1" v-model="searchString">
                                <span class="input-group-text">
                                    <Link :href="searchRoute" class="btn btn-primary">
                                        Filtrar
                                    </Link>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-2 mt-2 mt-lg-0">
                            <Link :href="baseRoute" class="btn btn-outline-secondary w-100" :class="{ disabled: !search }">
                                Resetar Filtro
                            </Link>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-lg-row">
                        <span v-if="search" class="me-lg-5">
                            Filtrando por: <strong>{{ search }}</strong>
                        </span> 
                        <span v-if="pagination.total" class="me-lg-5">
                            Total de resultados: <strong>{{ pagination.total }}</strong>
                        </span>
                        <span>
                            Ordem de exibição: <strong>Mais recente</strong>
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div v-if="pagination.data.length">
                        <slot name="table" :data="pagination.data" />
                    </div>

                    <Alert v-else variant="warning">
                        Not found
                    </Alert>
                </div>
                
                <div class="card-footer">
                    <Pagination :data="pagination"/>
                </div>
            </div>
        </div>

        <slot name="extras" :data="pagination.data" />
    </div>
</template>