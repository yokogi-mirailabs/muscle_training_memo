<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { TrainingPart } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { QForm, useQuasar } from 'quasar';
import { ref } from 'vue';

const $q = useQuasar();

interface Props {
    trainingPart?: TrainingPart
}

const props = withDefaults(defineProps<Props>(), {
    trainingPart: undefined,
});

const storeTrainingForm = useForm({
    part_name: props.trainingPart?.name ?? '',
    name: '',
});

const onHandleStore = () => {
    if (!(storeTrainingFormRef.value as QForm).validate()) return;

    storeTrainingForm.post(route('trainings.store', {
        onStart: () => $q.loading.show(),
        onSuccess: () => {
            $q.notify({
                color: 'positive',
                position: 'top',
                message: 'トレーニング種目を作成しました',
                timeout: 1500,
            });
        },
        onError: (err: any) => console.log(err),
        onFinish: () => $q.loading.hide(),
    }));
};

const storeTrainingFormRef = ref<QForm | null>(null);

</script>
<template>
    <AuthenticatedLayout>
        <Head title="トレーニング種目作成" />
        <div class="col">
            <div class="text-base-green text-bold text-center q-pt-xs text-h6 q-mb-xl">
                トレーニング種目作成
            </div>
            <q-card flat class="card q-mx-auto">
                <q-card-section class="px-20">
                    <div :class="{ 'q-px-xl': $q.screen.gt.xs }">
                        <q-form ref="storeTrainingFormRef" @submit.prevent="onHandleStore">
                            <div>
                                <div class="q-mb-sm">部位名</div>
                                <q-input
                                    v-model="storeTrainingForm.part_name"
                                    bg-color="white"
                                    outlined
                                    dense
                                    autofocus
                                    :rules="[val => !!val || '部位名を入力してください']"
                                    :error="!!storeTrainingForm.errors.part_name"
                                    :error-message="storeTrainingForm.errors.part_name"
                                ></q-input>
                            </div>
                            <div class="q-mt-xs">
                                <div class="q-mb-sm">トレーニング名</div>
                                <q-input
                                    v-model="storeTrainingForm.name"
                                    bg-color="white"
                                    outlined
                                    dense
                                    :rules="[val => !!val || 'トレーニング名を入力してください']"
                                    :error="!!storeTrainingForm.errors.name"
                                    :error-message="storeTrainingForm.errors.name"
                                >
                                </q-input>
                            </div>
                            <div class="q-py-md">
                                <q-btn
                                    class="full-width text-bold q-pa-sm"
                                    style="background-color: #4D869C;"
                                    label="作成する"
                                    text-color="white"
                                    no-caps
                                    unelevated
                                    type="submit"
                                    :disabled="storeTrainingForm.processing"
                                ></q-btn>
                            </div>
                        </q-form>
                    </div>
                </q-card-section>
            </q-card>
        </div>
    </AuthenticatedLayout>
</template>