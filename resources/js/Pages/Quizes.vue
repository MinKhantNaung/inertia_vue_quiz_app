<script setup>
import Layout from '../Shared/Layout.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Layout>
        <div class="card text-center col-md-6 offset-md-3">
            <div class="card-header">
                <h1>Welcome from Quiz App.</h1>
            </div>
            <div class="card-body">
                <Link href="/show-quizes" class="btn btn-sm btn-outline-success">Let's start Quiz!</Link>
            </div>
        </div>
    </Layout>
</template>
