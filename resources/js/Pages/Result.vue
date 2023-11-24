<script setup>
import Layout from '../Shared/Layout.vue';
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { useToastr } from '../toastr.js'

const props = defineProps({
    correctPercentage: String,
    comment: String,
})

</script>

<template>
    <Layout>
        <div class="card text-center">
            <div class="card-header">
                <h1 class="display-6 text-success">Result</h1>
            </div>
            <div class="card-body table-responsive text-info">
                <h2>{{ props.comment }}</h2>
                <h3>Your score is {{ props.correctPercentage }}%</h3>
            </div>
        </div>
    </Layout>
</template>
