<script setup lang="ts">
import { ref } from 'vue';
import { matFitnessCenter } from '@quasar/extras/material-icons';
import { mdiArmFlex  } from '@quasar/extras/mdi-v6';

const tab = ref('trainigs');
</script>

<template>
    <div>
        <q-layout>
            <q-footer bordered elevated class="bg-base-purple text-base-green">
                <q-tabs class="bg-base-purple shadow-2" v-model="tab">
                <q-tab name="trainings" :icon="mdiArmFlex " />
                </q-tabs>
            </q-footer>
        </q-layout>
    </div>
</template>
