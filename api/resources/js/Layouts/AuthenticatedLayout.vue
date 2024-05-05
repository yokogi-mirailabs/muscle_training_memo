<script setup lang="ts">
import { ref } from 'vue';
import { matFitnessCenter } from '@quasar/extras/material-icons';
import { mdiArmFlex  } from '@quasar/extras/mdi-v6';

const tab = ref('trainigs');
</script>

<template>
    <div>
        <q-layout>
            <q-page-container>
                <main class="q-pa-lg">
                    <header class="" v-if="$slots.header">
                        <h1 class="text-h5 text-light-green text-bold">
                            <slot name="header" />
                        </h1>
                    </header>
                    <slot />
                </main>
            </q-page-container>
            <q-footer bordered elevated class="bg-base-green text-base-lignt-green">
                <q-tabs class="bg-base-green shadow-2" v-model="tab">
                <q-tab name="trainings" :icon="mdiArmFlex " />
                </q-tabs>
            </q-footer>
        </q-layout>
    </div>
</template>
