<script setup>
import Layout from '../Shared/Layout.vue';
import { Link, router } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import Swal from 'sweetalert2'
import { Result } from 'postcss';

const props = defineProps({
    questions: Object,
})

const currentIndex = ref(0)
const selectedAnswer = ref(null)
const result = ref(0)

const currentQuestion = computed(() => {
    return props.questions[currentIndex.value]
})

const currentAnswers = computed(() => {
    return props.questions[currentIndex.value].answers
})

const isLastQuestion = computed(() => {
    return currentIndex.value === props.questions.length - 1
})

const selectOption = (index) => {
    selectedAnswer.value = index
}

// for check when selected answer for changing bg color in answers
const isSelected = (index) => {
    return selectedAnswer.value == index
}

const nextQuestion = () => {
    if (selectedAnswer.value == null) {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Please choose an answer !',
        })
    }

    if (props.questions[currentIndex.value].answers[selectedAnswer.value].is_correct === 1) {
        result.value++
    }

    currentIndex.value++
    selectedAnswer.value = null
}

const calculateResult = () => {
    if (props.questions[currentIndex.value].answers[selectedAnswer.value].is_correct === 1) {
        result.value++
    }

    router.post('/results', {
        score: result.value,
        totalQuestions: props.questions.length
    }, {
        preserveState: true
    })
}

</script>

<template>
    <Layout>
        <div class="card text-center col-md-6 offset-md-3">
            <div class="card-header">
                <h1>Lets' start the Quizes !</h1>
            </div>
            <div class="card-body">
                <h4>Question - {{ currentIndex + 1 }} out of {{ props.questions.length }}</h4>
                <ul class="list-group text-start">
                    <li class="list-group-item active">{{ currentQuestion.name }}</li>
                    <li @click="selectOption(index)" v-for="(answer, index) in  currentAnswers " :key="answer.id"
                        :class="{ 'bg-info text-danger': isSelected(index) }" class="list-group-item"
                        style="cursor: pointer;">
                        {{ answer.name }}
                    </li>
                    <li>
                        <button @click.prevent="nextQuestion" v-if="!isLastQuestion"
                            class="btn btn-sm btn-info me-1 text-light">Next</button>
                        <button @click.prevent="calculateResult" v-if="isLastQuestion" class="btn btn-sm btn-primary">Submit</button>
                    </li>
                </ul>
            </div>
        </div>
    </Layout>
</template>
