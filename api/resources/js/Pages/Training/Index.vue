<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { Training } from '@/types/index';
import { ref, computed } from 'vue';
import { QTableProps, useQuasar } from 'quasar';
import ConfirmDeleteDialog from '@/Components/ConfirmDeleteDialog.vue';

const $q = useQuasar();

interface Props {
    trainings: Training[];
};

const props = withDefaults(defineProps<Props>(), {
    trainings: () => [],
});

const groupedTrainings = computed(() => {
    return Object.groupBy(props.trainings, training => training.training_part_id);
});
// const pagination: QTableProps['pagination'] = {
//     page: 1,
//     rowsPerPage: 50,
//     rowsNumber: props.trainings.length,
// }
const columns: QTableProps['columns'] = [
    {
        name: 'name',
        required: true,
        label: 'name',
        align: 'left',
        field: 'name',
    },
    {
        name: 'delete',
        required: true,
        label: 'delete',
        align: 'right',
        field: 'delete',
    }
];

const onHandleDelete = (id: number) => {

    $q.dialog({
        component: ConfirmDeleteDialog,
    }).onOk(() => {

        router.visit(route('trainings.destroy', { training: id }), {
            method: 'delete',
            onStart: () => $q.loading.show(),
            onSuccess: () => {
                $q.notify({
                    color: 'positive',
                    position: 'top',
                    message: 'トレーニング種目を削除しました',
                    timeout: 1500,
                });
            },
            onFinish: () => $q.loading.hide(),
        });

    });

};

</script>

<template>
    <AuthenticatedLayout>
        <Head title="トレーニング種目一覧" />
        <div class="container">
            <q-btn
                class="q-mb-md"
                unelevated
                style="width: 100%; background-color: #4D869C; color: white; border-radius: 10px;"
                label="今日のトレーニング内容を記録する"
            />
            <div v-for="(rows, index) in groupedTrainings">
                <q-table
                    class="q-mb-md mx-auto trainings-table"
                    flat
                    bordered
                    :hide-header="true"
                    dense
                    card-class="table-card"
                    title-class="text-subtitle2 "
                    :title="rows ? rows[0].training_part.name : ''"
                    :rows="rows ?? []"
                    :rows-per-page-options="[3, 5]"
                    :columns="columns"
                    row-key="name"
                    >
                    <template #body-cell-name="props">
                        <q-td :props="props">
                            <Link :href="route('trainings.edit', { training: props.row.id })"  style="text-decoration: none;">{{ props.row.name }}</Link>
                        </q-td>
                    </template>
                    <template #body-cell-delete="props">
                        <q-td :props="props">
                            <q-btn
                                flat
                                dense
                                icon="delete"
                                style="color: #4D869C;"
                                @click="onHandleDelete(props.row.id)"
                            />
                        </q-td>
                    </template>
                    <template #bottom>
                        <q-tr>
                            <q-td colspan="3">
                                <Link
                                    :href="route('trainings.create', { training_part_id: index })"
                                >種目を追加する</Link>
                            </q-td>
                        </q-tr>
                    </template>
                </q-table>
            </div>
            <q-page-sticky position="bottom-right" :offset="[18, 18]">
                <q-btn
                    fab
                    icon="add"
                    style="background-color: #7AB2B2; color: white;"
                    :href="route('trainings.create')"
                    />
            </q-page-sticky>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.table-card {
    border-radius: 10px;
}

.table-width {
    width: 600px;
}
</style>