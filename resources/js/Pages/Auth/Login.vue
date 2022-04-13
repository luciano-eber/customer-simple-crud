<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import AppLogo from '@/Components/AppLogo';
import Input from '@/Components/Input';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <div class="d-flex align-items-center justify-content-center flex-column min-vh-100">

        <AppLogo width="5rem"/>

        <h5 class="mt-3">Acessar painel do admin</h5>
        <a href="https://github.com/luciano-eber/customer-simple-crud" target="_blank">Get demo admin credentials</a>

        <form @submit.prevent="submit" class="form-login">
            <div class="card mt-5">
                <div class="card-body">
                    <div class="row row-cols-1 g-3">
                        <div class="col">
                            <Input 
                                type="email"
                                v-model="form.email" 
                                label="Email" 
                                placeholder="master@admin.com"
                                :invalidFeedback="form.errors.email"
                            />
                        </div>
                        <div class="col">
                            <Input 
                                type="password"
                                v-model="form.password" 
                                label="Senha"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-4 w-100">
                Login
            </button>
        </form>
    </div>
</template>

<style lang="scss" scoped>
.form-login {
    width: 90%;
    @media(min-width: map-get($grid-breakpoints, 'md')) {
        width: 25rem;
    }
}
</style>