<script setup>
import Layout from '../Shared/Layout.vue';
import { Link } from '@inertiajs/vue3';
// pinia
import { useCounterStore } from '../Stores/counter';

const store = useCounterStore();

</script>

<template>
    <Layout>
        <div class="card text-center col-md-6 offset-md-3">
            <div class="card-header">
                <h1>Welcome from Quiz App.</h1>
            </div>
            <div class="card-body">

                <!-- pinia -->
                <h1>Count is {{ store.count }}</h1>

                <h2>Double is {{ store.doubleCount }}</h2>

                <h3>Double + 1 is {{ store.doublePlusOne }}</h3>

                <h4>Divide by total is {{ store.divideByTotal }}</h4>

                <button @click="store.increment()">Increment</button>
                <!-- pinia -->

                <Link href="/show-quizes" class="btn btn-sm btn-outline-success">Let's start Quiz!</Link>
            </div>
        </div>
    </Layout>
</template>
