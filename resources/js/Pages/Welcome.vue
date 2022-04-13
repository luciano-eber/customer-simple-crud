<script setup>
import { Link, useForm } from '@inertiajs/inertia-vue3';
import AppLogo from '@/Components/AppLogo';
import CustomerRegister from '@/Pages/Partials/CustomerRegister';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    appName: String,
});

const appInfo = {
    currentYear: new Date().getFullYear(),
    repoLink: 'https://github.com/luciano-eber/customer-simple-crud'
};

</script>

<template>
    <div id="wrap">
        <header class="header py-4">
            <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <AppLogo style="width: 2rem;"/>
                    <h1 class="logo-name d-none d-md-flex">{{ appName }}</h1>
                </div>
                <div class="d-flex flex-column flex-md-row text-center text-md-start mt-3 mt-md-0">
                    <Link :href="route('dashboard')" class="me-3">
                        Painel do administrador
                    </Link>
                    <a :href="appInfo.repoLink" target="_blank">Github</a>
                </div>
            </div>
        </header>

        <main class="mt-5">
            <CustomerRegister />
        </main>

        <footer class="py-4 mt-5 bg-white text-center">
            <a :href="appInfo.repoLink">{{ appName }} - {{ appInfo.currentYear }}</a>
        </footer>
    </div>
</template>

<style lang="scss">
body {
    background-color: $light;
}

#app #wrap {
    min-height: 100vh;
    display: flex;
    flex-flow: column nowrap;
    justify-content: space-between;
}
.header {
    background-color: $white;
    box-shadow: $box-shadow-sm;

    .logo-name {
        font-size: 110%;
        margin-bottom: 0;
        margin-left: 1rem;
    }
}
</style>
