<script setup>
import Layout from '../Shared/Layout.vue';
import NewQuestionModal from '@/Shared/NewQuestionModal.vue'
import { ref } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import Swal from 'sweetalert2'
import { useToastr } from '../toastr.js'

const showNewQuestionModal = ref(false)
let answerId = 1;
const selectedAnswer = ref(null)
const toastr = useToastr();

const props = defineProps({
    questions: Object,
})

const form = useForm({
    questionName: '',
    answers: [],
})

const addNewAnswer = () => {
    const newAnswer = {
        id: answerId++,
        answer: '',
        is_correct: 0,
    };

    form.answers.push(newAnswer)
}

const handleRadioToggle = (answerId) => {
    selectedAnswer.value = answerId;
    form.answers.forEach(answer => {
        if (answer.id === answerId) {
            answer.is_correct = 1;
        } else {
            answer.is_correct = 0;
        }
    })
}

const submitQuestion = () => {
    if (form.answers.length < 4) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Four answers require to submit !',
        })
        return false;
    }

    for (const answer of form.answers) {
        if (answer.answer === '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Answers must not be empty !',
            })
            return false;
        }
    }

    if (form.answers.every(item => item.is_correct === 0)) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Choose one answer to be true !',
        })
        return false;
    }

    form.post('/questions', {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            closeModal();
            toastr['success']('Question and answers created successfully !')
        }
    });
}

const showViewQuestionModal = ref(false)
const selectedQuestion = ref(null)
const selectedEditAnswers = ref(null)

const viewQuestionModal = (index) => {
    showViewQuestionModal.value = true;
    selectedQuestion.value = props.questions[index];
    selectedEditAnswers.value = props.questions[index].answers;
}

const handleRadioEdit = (answerId) => {
    selectedEditAnswers.value.forEach((answer) => {
        if(answer.id === answerId) {
            answer.is_correct = 1
        } else {
            answer.is_correct = 0
        }
    })
}

const closeModal = () => {
    showNewQuestionModal.value = false;
    answerId = 1;
    form.reset();
    form.clearErrors();
}

const closeViewModal = () => {
    showViewQuestionModal.value = false;
}
</script>

<template>
    <Layout>
        <div class="card">
            <div class="card-header">
                <h1 class="display-6">Questions
                    <button type="button" @click.prevent="showNewQuestionModal = true"
                        class="btn btn-sm btn-success float-end">+ Create</button>
                </h1>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover table-info">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(question, index) in props.questions" :key="question.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ question.name }}</td>
                            <td>
                                <button type="button" @click.prevent="viewQuestionModal(index)"
                                    class="btn btn-outline-primary ms-1 fw-bolder">View</button>
                                <button type="button" class="btn btn-outline-secondary ms-1 fw-bolder">Edit</button>
                                <button type="button" class="btn btn-outline-danger ms-1 fw-bolder">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <Teleport to="body">
            <NewQuestionModal :show="showNewQuestionModal" @close="showNewQuestionModal = false">
                <template #header>
                    <h3>Add New Question</h3>
                </template>
                <template #body>
                    <form class="bg-light py-2 px-1">
                        <div class="mb-4">
                            <label for="question" class="text-muted">Question</label>
                            <input type="text" v-model="form.questionName" id="question" placeholder="Enter question"
                                :class="{ 'is-invalid': form.errors.questionName }" class="form-control mt-1">
                            <span :class="{ 'invalid-feedback': form.errors.questionName }">{{ form.errors.questionName
                            }}</span>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h6># Answers</h6>
                                </div>
                                <div class="col-sm-4">
                                    <h6>Correct?</h6>
                                </div>
                                <div v-for="(answer, index) in form.answers" :key="index" class="row">
                                    <div class="col-sm-8 mb-1">
                                        <div class="row">
                                            <span class="col-1">{{ answer.id }}</span>
                                            <input type="text" v-model="answer.answer" class="form-control col">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 d-flex align-items-center mb-1">
                                        <input type="radio" :checked="answer.is_correct === 1" :value="answer.id"
                                            @change="handleRadioToggle(answer.id)" class="ms-2 form-check-input">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </template>
                <template #footer>
                    <span @click.prevent="addNewAnswer" v-if="form.answers.length < 4"
                        class="me-2 bg-black text-white px-2 py-0" style="cursor: pointer;">
                        <h3>+</h3>
                    </span>
                    <button type="button" @click.prevent="closeModal" class="btn btn-sm btn-danger">Cancel</button>
                    <button type="button" @click.prevent="submitQuestion" v-if="form.answers.length"
                        class="btn btn-sm btn-success ms-1">Submit</button>
                </template>
            </NewQuestionModal>

            <NewQuestionModal :show="showViewQuestionModal" @close="showViewQuestionModal = false">
                <template #header>
                    <h5 class="text-info">View Question/Answers</h5>
                </template>
                <template #body>
                    <h6 class="fw-bold">Q. {{ selectedQuestion.name }}</h6>
                    <div class="row">
                        <div class="col-sm-8">
                            <h6># Answers</h6>
                        </div>
                        <div class="col-sm-4">
                            <h6>Correct?</h6>
                        </div>
                        <div v-for="(answer, index) in selectedEditAnswers" :key="index" class="row">
                            <div class="col-sm-8 mb-1">
                                <div class="row">
                                    <span class="col-1">{{ index + 1 }}</span>
                                    <input type="text" v-model="answer.name" class="form-control col">
                                </div>
                            </div>
                            <div class="col-sm-4 d-flex align-items-center mb-1">
                                <input type="radio" :checked="answer.is_correct === 1" :value="answer.id" @change="handleRadioEdit(answer.id)" class="ms-2 form-check-input">
                            </div>
                        </div>
                    </div>
                </template>
                <template #footer>
                    <button type="button" @click.prevent="closeViewModal" class="btn btn-sm btn-danger">Cancel</button>
                    <button type="button" class="btn btn-sm btn-success ms-1">Submit</button>
                </template>
            </NewQuestionModal>
        </Teleport>
    </Layout>
</template>
