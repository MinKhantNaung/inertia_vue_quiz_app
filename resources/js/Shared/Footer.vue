<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-body-secondary">&copy; 2023 Company, Inc</p>

            <Link href="/"
                class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <svg class="bi me-2" width="40" height="32">
                <use xlink:href="#bootstrap" />
            </svg>
            </Link>

            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item">
                    <Link href="#" class="nav-link px-2 text-body-secondary">Home</Link>
                </li>
                <li class="nav-item">
                    <Link href="#" class="nav-link px-2 text-body-secondary">Quiz</Link>
                </li>
                <li class="nav-item">
                    <Link href="#" class="nav-link px-2 text-body-secondary">Questions</Link>
                </li>
            </ul>
        </footer>
    </div>
</template>
