<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { useQuasar } from 'quasar';
import { ref } from 'vue';

const q = useQuasar();

const isPassword = ref<boolean>(true);
const isPasswordConfirmation = ref<boolean>(true);

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const onHandleRegister = () => {
    form.post(route('register'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <div class="row justify-center">
            <div class="col">
                <div class="text-info text-bold text-center q-pt-xs text-h6 q-mb-xl">
                    会員登録
                </div>
                <q-card flat class="card q-mx-auto">
                    <q-card-section class="px-20">
                        <div :class="{ 'q-px-xl': $q.screen.gt.xs }">
                            <q-form @submit.prevent="onHandleRegister">
                                <div>
                                    <div class="q-mb-sm">名前</div>
                                    <q-input
                                        id="input-name"
                                        v-model="form.name"
                                        bg-color="white"
                                        outlined
                                        dense
                                        autofocus
                                        :error="!!form.errors.name"
                                        :error-message="form.errors.name"
                                    ></q-input>
                                </div>
                                <div>
                                    <div class="q-mb-sm">メールアドレス</div>
                                    <q-input
                                        id="input-email"
                                        v-model="form.email"
                                        bg-color="white"
                                        outlined
                                        dense
                                        autofocus
                                        :error="!!form.errors.email"
                                        :error-message="form.errors.email"
                                    ></q-input>
                                </div>
                                <div class="q-mt-xs">
                                    <div class="q-mb-sm">パスワード</div>
                                    <q-input
                                        id="input-password"
                                        v-model="form.password"
                                        bg-color="white"
                                        outlined
                                        dense
                                        :type="isPassword ? 'password' : 'text'"
                                        :error="!!form.errors.password"
                                        :error-message="form.errors.password"
                                    >
                                        <template v-slot:append>
                                            <q-icon
                                                :name="isPassword ? 'visibility_off' : 'visibility'"
                                                class="cursor-pointer"
                                                @click="isPassword = !isPassword"
                                            />
                                        </template>
                                    </q-input>
                                </div>
                                <div class="q-mt-xs">
                                    <div class="q-mb-sm">パスワード確認用</div>
                                    <q-input
                                        id="input-password_confirmation"
                                        v-model="form.password_confirmation"
                                        bg-color="white"
                                        outlined
                                        dense
                                        :class="{ 'q-mb-md': !!form.errors.password_confirmation}"
                                        :type="isPasswordConfirmation ? 'password' : 'text'"
                                        :error="!!form.errors.password_confirmation"
                                        :error-message="form.errors.password_confirmation"
                                    >
                                        <template v-slot:append>
                                            <q-icon
                                                :name="isPasswordConfirmation ? 'visibility_off' : 'visibility'"
                                                class="cursor-pointer"
                                                @click="isPasswordConfirmation = !isPasswordConfirmation"
                                            />
                                        </template>
                                    </q-input>
                                </div>
                                <div class="row justify-end">
                                    <Link :href="route('password.request')" class="text-info link-style">パスワードお忘れの方</Link>
                                </div>
                                <div class="q-py-md">
                                    <q-btn
                                        class="full-width text-bold q-pa-sm btn-radius"
                                        label="会員登録"
                                        color="info"
                                        no-caps
                                        unelevated
                                        max-width="100%"
                                        type="submit"
                                        :disabled="form.processing"
                                    ></q-btn>
                                </div>
                            </q-form>
                        </div>
                        <q-separator class="q-my-md guest-separator-color"></q-separator>
                        <div class="row justify-center text-info">
                            <div class="q-py-xs">
                                <Link :href="route('login')" class="text-info link-style">すでにアカウントをお持ちの方はこちらからログイン</Link>
                            </div>
                        </div>
                    </q-card-section>
                </q-card>
            </div>
        </div>
    </GuestLayout>
</template>
