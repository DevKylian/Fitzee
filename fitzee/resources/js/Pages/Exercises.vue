<template>
  <Head title="Exercises" />
  <AuthenticatedLayout>
    <div class="dashboard__section-title">
      <h2 class="dashboard__subtitle">Exercises</h2>
      <p class="dashboard__description">
        Choisis les exercices que tu peux réaliser dans la salle où tu t'entraînes grâce aux sliders ci-dessous.
        <br>Ton programme sera créé en fonction de ces choix.
      </p>
        <p class="dashboard__filters">
            <Checkbox label="Voir mes exercises" :value="filterActive" @update:modelValue="toggleFilter" />
        </p>
    </div>
    <div class="exercises__section">
      <div v-for="muscle in muscles" :key="muscle.id">
        <div v-if="muscle.exercises.length > 0">
          <div class="exercise__section-title">
            <h3>{{ muscle.name }}</h3>
            <img :src="'/img/icons/' + muscle.icon + '.png'" alt="">
          </div>
          <div class="exercise__section-slider">
            <Flicking :options="{ moveType: 'freeScroll', circular: true, bound: true, align: 'prev' }">
                <Redirect
                    v-for="exercise in filterActive ? muscle.exercises.filter(ex => ex.user_exercises.length > 0) : muscle.exercises"
                    :key="exercise.id + '/' + filterActive"
                    :href="`/exercise/${exercise.slug}`"
                >
                    <Exercise :exercise="exercise" :color="muscle.color" :on-update="updateExercises"/>
                </Redirect>
            </Flicking>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Checkbox from '@/Components/Checkbox.vue';
import Redirect from '@/Components/Redirect.vue';
import Exercise from '@/Components/Exercise.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import Flicking from "@egjs/vue3-flicking";
import "@egjs/vue3-flicking/dist/flicking.css";

const profile = usePage().props.profile;
let muscles = usePage().props.muscles;
const filterActive = ref(false);

const updateExercises = () => {
    muscles = usePage().props.muscles;
}

const toggleFilter = (value) => {
    filterActive.value = value;
}
</script>

<style scoped lang="scss">
@import '../../scss/colors.scss';
@import '../../scss/mixins.scss';

.exercises__section {
    width: 100%;
    display: flex;
    flex-direction: column;
}

.exercise__section-title {
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    align-items: center;
}

.exercise__section-title img {
    @include space('left', 1rem);
    width: 32px;
    height: 32px;
}

.exercise__section-title h3 {
    font-size: 1.5rem;
    font-weight: bold;
    color: $color-white;
}

.exercise__section-slider {
    width: 100%;
    display: flex;
    flex-direction: row;
    @include space('top', 2rem);
}

.dashboard__description {
    color: $color-grey;
    @include space('top', 1rem);
}

.dashboard__section-title {
    @include space('top', 2rem);
    @include space('bottom', 2rem);
}

.dashboard__filters {
    @include space('top', 2rem);
    @include space('bottom', 2rem);
}

// responsive

@include respond(desktop) {

}

@include respond(tab-land) {

}

@include respond(tab-port) {
    .profile__form .input__group {
        display: flex;
        flex-direction: column;
        line-height: normal;
        width: 47%;
    }

    .profile__form-submit button {
        width: 47%;
    }
}

@include respond(phone) {
    .profile__form .input__group {
        display: flex;
        flex-direction: column;
        line-height: normal;
        width: 100%;
    }

    .profile__form-submit button {
        width: 100%;
    }
}

</style>














