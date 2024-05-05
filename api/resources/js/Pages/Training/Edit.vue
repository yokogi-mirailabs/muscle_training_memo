<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Training } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { QForm, useQuasar  } from 'quasar';
import { ref } from 'vue';

const $q = useQuasar();

interface Props {
    training: Training
}

const props = defineProps<Props>();

const updateTrainingForm = useForm({
    part_name: props.training.training_part.name ?? '',
    name: props.training.name ?? '',
});

const onHandleUpdate = () => {
    if (!(updateTrainingFormRef.value as QForm).validate()) return;

    updateTrainingForm.put(route('trainings.update', {
        training: props.training.id
    }), {
        onStart: () => $q.loading.show(),
        onSuccess: () => {
            $q.notify({
                color: 'positive',
                position: 'top',
                message: 'トレーニング種目を更新しました',
                timeout: 1500,
            });
        },
        onError: (err: any) => console.log(err),
        onFinish: () => $q.loading.hide(),
    });
};

const updateTrainingFormRef = ref<QForm | null>(null);

</script>
<template>
    <AuthenticatedLayout>
        <Head title="トレーニング種目更新" />
        <div class="col">
            <div class="text-base-green text-bold text-center q-pt-xs text-h6 q-mb-xl">
                トレーニング種目更新
            </div>
            <q-card flat class="card q-mx-auto">
                <q-card-section class="px-20">
                    <div :class="{ 'q-px-xl': $q.screen.gt.xs }">
                        <q-form ref="updateTrainingFormRef" @submit.prevent="onHandleUpdate">
                            <div>
                                <div class="q-mb-sm">部位名</div>
                                <q-input
                                    v-model="updateTrainingForm.part_name"
                                    bg-color="white"
                                    outlined
                                    dense
                                    autofocus
                                    :rules="[val => !!val || '部位名を入力してください']"
                                    :error="!!updateTrainingForm.errors.part_name"
                                    :error-message="updateTrainingForm.errors.part_name"
                                ></q-input>
                            </div>
                            <div class="q-mt-xs">
                                <div class="q-mb-sm">トレーニング名</div>
                                <q-input
                                    v-model="updateTrainingForm.name"
                                    bg-color="white"
                                    outlined
                                    dense
                                    :rules="[val => !!val || 'トレーニング名を入力してください']"
                                    :error="!!updateTrainingForm.errors.name"
                                    :error-message="updateTrainingForm.errors.name"
                                >
                                </q-input>
                            </div>
                            <div class="q-py-md">
                                <q-btn
                                    class="full-width text-bold q-pa-sm"
                                    style="background-color: #4D869C;"
                                    label="更新する"
                                    text-color="white"
                                    no-caps
                                    unelevated
                                    type="submit"
                                    :disabled="updateTrainingForm.processing"
                                ></q-btn>
                            </div>
                        </q-form>
                    </div>
                </q-card-section>
            </q-card>
        </div>
    </AuthenticatedLayout>
</template>