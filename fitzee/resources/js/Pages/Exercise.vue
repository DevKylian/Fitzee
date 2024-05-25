<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Input from '@/Components/Input.vue';
import Dropdown from '@/Components/Dropdown.vue';
import Button from '@/Components/Button.vue';
import Success from '@/Components/Success.vue';
import Exercise from '@/Components/Exercise.vue';
import LongCardStats from '@/Components/LongCardStats.vue';
import { Head, useForm, usePage, router } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import { ref, computed } from 'vue';

const profile = usePage().props.profile;
const exercise = usePage().props.exercise;

const colorClass = `color-${exercise.muscle.color}-10`;

const fieldNames = [
  { type: 'number', label: 'Weight', placeholder: '32', name: 'weight' },
  { type: 'number', label: 'Reps', placeholder: '10', name: 'reps' },
  { type: 'date', label: 'Date', placeholder: '23/10/2024', name: 'date' },
];

const form = useForm({
  ...Object.fromEntries(
    fieldNames.map((field) => [field.name, (profile && profile[field.name]) ? profile[field.name].toString() : '']),
  ),
  exercise_id: exercise.id,
  errors: {},
});

const formFields = fieldNames.map((field) => ({
  type: field.type,
  label: field.label,
  placeholder: field.placeholder,
  name: field.name,
}));

const submit = async () => {
  try {
    await form.post(route('exercise', exercise.slug ), {
      preserveScroll: true,
      onSuccess: () => router.visit(window.location.href, {
        only: ['exercise'],
      }),
    });
  } catch (errors) {
    form.errors = errors;
  }
};

</script>

<template>
  <Head title="Exercise" />

  <AuthenticatedLayout>
    <div class="dashboard__section-title">
      <h2 class="dashboard__subtitle">{{ exercise.name }}</h2>
      <p class="dashboard__description">Use the sliders below to choose the exercises you can do in the room you're training in.
        <br>Your program will be created according to these choices.</p>
    </div>
    <div class="exercise__section">
      <div class="exercise__profile">
        <div class="exercise__card" :class="colorClass">
          <div class="exercise__icon">
            <img :src="'/img/icons/' + exercise.muscle.icon + '.png'" alt="">
          </div>
          <div class="exercise__title">
            <h3>{{ exercise.name }}</h3>
          </div>
          <div class="exercise__contents">
            <p class="exercise__desc">Type</p>
            <p class="exercise__content">{{ exercise.type }}</p>
          </div>
          <div class="exercise__contents">
            <p class="exercise__desc">Difficulty</p>
            <p class="exercise__content">{{ exercise.difficulty }}</p>
          </div>
        </div>
      </div>
      <div class="exercise__illustration">
        <img :src="'/img/exercises/' + exercise.tutorial + '.gif'" alt="">
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped lang="scss">
@import '../../scss/colors.scss';
@import '../../scss/mixins.scss';

.exercise__section {
    width: 100%;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    @include space('top', 3rem);
}

.exercise__profile {
    width: 30%;
}

.exercise__illustration {
    width: 65%;
}

.exercise__card {
    width: 100%;
    height: 100%;
    border-radius: 30px;
    padding: 50px;
}

.exercise__icon {
    @include space('bottom', 2rem)
}

.exercise__top {
    @include space('bottom', 1rem);
}

.exercise__contents {
    @include space('top', 1rem);
}

.exercise__desc {
    color: $color-grey;
    font-size: 1.125rem;
}

.exercise__content {
    color: $color-white;
    font-size: 1.25rem;
    font-weight: bold;
    text-transform: capitalize;
}

.exercise__illustration img {
    border-radius: 30px;
}

.exercise__section-title {
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
}

.exercise__section-title h3 {
    font-size: 1.5rem;
    font-weight: bold;
    color: $color-white;
}

.dashboard__description {
    color: $color-grey;
    @include space('top', 1rem);
}

.dashboard__subtitle {
    @include space('bottom', 1rem);
}

.dashboard__section-title {
    @include space('top', 2rem);
    @include space('bottom', 2rem);
}

.weight__history {
    max-width: 50%;
    width: 100%;
    @include space('right', 1rem)
}

.weight__top {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
}

.weight__section {
    display: flex;
    flex-direction: row;
    width: 100%;
    justify-content: space-between;
    @include space('top', 3rem)
}

.weight__container {
    max-width: 35%;
    width: 100%;
}

.weight__form {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    flex-wrap: wrap;
}

.weight__form .input__group {
    display: flex;
    flex-direction: column;
    line-height: normal;
    width: 100%;
}

.weight__form-submit {
    display: flex;
    flex-direction: row;
    justify-content: flex-end;
}

.weight__form-submit button {
    width: 23%;
}

.pagination {
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
}

.pagination-button {
  border-radius: 5px;
  background: $color-bg-grey;
  color: $color-grey;
  padding: 5px 10px;
  margin: 0 5px;
  cursor: pointer;
  transition: background-color 0.3s, color 0.3s;
}

.pagination-button:disabled {
  cursor: not-allowed;
  opacity: 0.5;
}

.pagination-button:hover {
  background-color: #333;
  color: #fff;
}

.page-count {
  margin: 0 10px;
  font-weight: bold;
}


// responsive

@include respond(desktop) {

}

@include respond(tab-land) {

    .exercise__profile {
        width: 40%;
    }

    .exercise__illustration {
        width: 55%;
    }

    .weight__section {
        flex-direction: column;
    }

    .weight__history {
        max-width: 100%;
        width: 100%;
    }

    .weight__container {
        max-width: 100%;
        width: 100%;
    }

}

@include respond(tab-port) {

}

@include respond(phone) {
    .exercise__section {
        flex-direction: column;
    }

    .exercise__profile {
        @include space('top', 2rem);
        width: 100%;
    }

    .exercise__illustration {
        @include space('top', 2rem);
        width: 100%;
    }
}

</style>
