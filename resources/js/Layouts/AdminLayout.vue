<script setup>
import { ref, computed } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { usePage } from '@inertiajs/inertia-vue3'

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    Inertia.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    Inertia.post(route('logout'));
};

const user = computed(() => usePage().props.value.user)
</script>

<template>
    <div>
        <header class="bg-white py-3">
            <div class="container">
                <div class="w-100 d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between">
                    <div>
                        Olá {{ user.name }}
                    </div>
                    <div>
                        <a href="" @click.prevent="logout">
                            Sair
                        </a>
                    </div>
                </div>
            </div>
        </header>
        <!-- Page Content -->
        <main class="mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3>{{ title }}</h3>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <slot />
                    </div>
                </div>
            </div>
        </main>

        <footer class="mt-5 py-5 text-center">
            {{ $page.props.appname }}
        </footer>
    </div>
</template>
