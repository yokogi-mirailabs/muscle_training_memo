<script setup lang="ts">
import { useDialogPluginComponent } from 'quasar';

interface Props {
    title?: string;
    message?: string;
};

const props = withDefaults(defineProps<Props>(), {
    title: '削除確認',
    message: '削除します。よろしいですか？',
});

defineEmits([
    ...useDialogPluginComponent.emits
])

const { dialogRef, onDialogHide, onDialogOK, onDialogCancel } = useDialogPluginComponent()

</script>

<template>
    <q-dialog ref="dialogRef" @hide="onDialogHide">
        <q-card class="q-dialog-plugin card-radius q-py-md">
            <q-card-section class="text-center">
                <div class="text-h6 text-info text-weight-bold">{{ title }}</div>
                <div class="q-mt-lg">
                    {{ message }}
                </div>
            </q-card-section>
            <q-card-actions class="row justify-center">
                <q-btn
                    class="btn-radius dialog-cancel-btn text-weight-bold q-mr-md"
                    unelevated
                    full-width
                    text-color="info"
                    label="キャンセル"
                    @click="onDialogCancel"
                />
                <q-btn
                    class="btn-radius text-weight-bold"
                    unelevated
                    full-width
                    color="secondary"
                    label="OK"
                    @click="onDialogOK"
                />
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>
