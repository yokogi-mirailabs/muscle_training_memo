<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { useQuasar } from 'quasar';
import { ref } from 'vue';

const q = useQuasar();

const isPassword = ref<boolean>(true);

defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const onHandleLogin = () => {
    form.post(route('login', {
        onError: () => {
            q.notify({
                message: 'ログインに失敗しました',
                color: 'negative',
                position: 'top',
                timeout: 2000,
            });
        },
        onFinish: () => {
            form.reset('password');
        },
    }))
}
</script>

<template>
    <GuestLayout>
        <Head title="ログイン" />

        <div class="row justify-center">
            <div class="col">
                <div class="text-info text-bold text-center q-pt-xs text-h6 q-mb-xl">
                    ログイン
                </div>
                <q-card flat class="card q-mx-auto">
                    <q-card-section class="px-20">
                        <div :class="{ 'q-px-xl': $q.screen.gt.xs }">
                            <q-form @submit.prevent="onHandleLogin">
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
                                <div class="row justify-end">
                                    <Link :href="route('password.request')" class="text-info link-style">パスワードお忘れの方</Link>
                                </div>
                                <div class="q-py-md">
                                    <q-btn
                                        class="full-width text-bold q-pa-sm btn-radius"
                                        label="ログイン"
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
                        <div class="row justify-center">
                            <div class="q-py-xs">
                                <Link :href="route('register')" class="text-info link-style">新規申し込みはこちら</Link>
                            </div>
                        </div>
                    </q-card-section>
                </q-card>
            </div>
        </div>
    </GuestLayout>
</template>
