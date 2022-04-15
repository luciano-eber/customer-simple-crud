<script setup>
import { computed, ref, onBeforeUpdate } from 'vue';
import { usePage, Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Datatable from '@/Components/Datatable';
import Table from '@/Components/Table';
import ConfirmDestroy from '@/Components/ConfirmDestroy';
import Toast from '@/Components/Toast';

const customers = computed(() => usePage().props.value.data)
const search = computed(() => usePage().props.value.search)

const deletes = ref([])

const successDeleteToast = ref()

onBeforeUpdate(() => {      
    deletes.value = []
})

function destroy(id) {
    Inertia.delete(route('customers.destroy', id), {
        onSuccess: () => successDeleteToast.value.show(),
    })
}
</script>

<template>
<AdminLayout title="Controle de clientes">
    <Datatable :baseRoute="route('dashboard')" :search="search" :pagination="customers">
        <template #table="{ data }">
            <Table>
                <template #thead>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">UF</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">#</th>
                </template>
                <template #tbody>
                    <tr v-for="(item,d) in data" :key="d">
                        <th scope="row">{{item.id}}</th>
                        <td>{{ item.nome }}</td>
                        <td>{{ item.uf }}</td>
                        <td>{{ item.localidade }}</td>
                        <td>
                            <Link :href="route('customers.edit', item.id)" class="btn btn-secondary btn-sm me-2">
                                Detalhes
                            </Link>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" :data-bs-target="`#modal-delete-${d}`">
                                Remover
                            </button>
                        </td>
                    </tr>
                </template>
            </Table>
        </template>

        <template #extras="{ data }">
            <ConfirmDestroy 
                v-for="(item,d) in data" :key="d" 
                :id="`modal-delete-${d}`" 
                :ref="el => { deletes[d] = el }"
                :deleteId="item.id"
                @confirm="destroy"
            />
        </template>
    </Datatable>

    <Toast variant="success" ref="successDeleteToast">
        Cliente Removido
    </Toast>

</AdminLayout>
</template>