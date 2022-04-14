<script setup>
import { computed, ref, onBeforeUpdate, watch, onMounted } from 'vue';
import { usePage, Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Table from '@/Components/Table';
import Pagination from '@/Components/Pagination';
import Alert from '@/Components/Alert';
import Modal from '@/Components/Modal';

const customers = computed(() => usePage().props.value.data)
const search = computed(() => usePage().props.value.search)
const searchString = ref('')

const searchRoute = computed(() => {
    return `${route('dashboard')}?search=${searchString.value}`
})

const deletes = ref([])

onBeforeUpdate(() => {      
    deletes.value = []
})

onMounted(() => {
    searchString.value = search.value ?? ''
})

function destroy(id) {
    Inertia.delete(route('customers.destroy', id))
}

function confirmDestroy(id, ref) {
    deletes.value[ref].close.click()
    destroy(id)
}


</script>

<template>
<AdminLayout title="Clientes cadastrados">
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
                            <Link :href="route('dashboard')" class="btn btn-outline-secondary w-100" :class="{ disabled: !search }">
                                Resetar Filtro
                            </Link>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-lg-row">
                        <span v-if="search" class="me-lg-5">
                            Filtrando por: <strong>{{ search }}</strong>
                        </span> 
                        <span v-if="customers.total" class="me-lg-5">
                            Total de resultados: <strong>{{ customers.total }}</strong>
                        </span>
                        <span>
                            Ordem de exibição: <strong>Mais recente</strong>
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <Table v-if="customers.data.length">
                        <template #thead>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">UF</th>
                            <th scope="col">Cidade</th>
                            <th scope="col">#</th>
                        </template>
                        <template #tbody>
                            <tr v-for="(data,d) in customers.data" :key="d">
                                <th scope="row">{{data.id}}</th>
                                <td>{{ data.nome }}</td>
                                <td>{{ data.uf }}</td>
                                <td>{{ data.localidade }}</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" :data-bs-target="`#modal-delete-${d}`">
                                        Remover
                                    </button>
                                </td>
                            </tr>
                        </template>
                    </Table>
                    <Alert v-else variant="warning">
                        Not found
                    </Alert>
                </div>
                <div class="card-footer">
                    <Pagination :data="customers"/>
                </div>
            </div>
        </div>

        <Modal v-for="(data,d) in customers.data" :key="d" :id="`modal-delete-${d}`" :ref="el => { deletes[d] = el } ">
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
                <button type="button" class="btn btn-danger" @click="confirmDestroy(data.id, d)">Sim quero remover</button>
            </template>
        </Modal>
    </div>
</AdminLayout>
</template>

<style lang="scss">

</style>