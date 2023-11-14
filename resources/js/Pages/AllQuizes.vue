<script setup>
import Layout from '../Shared/Layout.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    questions: Object,
})

</script>

<template>
    <Layout>
        <div class="card text-center col-md-6 offset-md-3">
            <div class="card-header">
                <h1>Lets' start the Quizes !</h1>
            </div>
            <div class="card-body">
                {{ props.questions }}
            </div>
        </div>
    </Layout>
</template>
