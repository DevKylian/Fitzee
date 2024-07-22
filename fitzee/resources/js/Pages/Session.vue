<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Button from '@/Components/Button.vue';
import SessionSerie from '@/Components/SessionSerie.vue';
import SessionRep from '@/Components/SessionRep.vue';
import { Head, useForm, usePage, router } from '@inertiajs/vue3';
import Success from "@/Components/Success.vue";

let successMessage = ref(null);
if (usePage().props.success) {
    successMessage.value = usePage().props.success;
}

const handleSuccess = message => {
    successMessage.value = { details: message };
};

const handleButtonClick = () => {
    console.log('Le bouton a été cliqué!');
};

let sessions = usePage().props.sessions;
console.log(sessions)
</script>

<template>
  <Head title="Session" />

  <AuthenticatedLayout>
    <div class="dashboard__section-title">
      <h2 class="dashboard__subtitle">Session</h2>
      <p class="dashboard__description">Use the sliders below to choose the exercises you can do in the room you're training in.
        <br>Your program will be created according to these choices.
      </p>
        <div style="margin-top:2rem;">
<!--            <Success v-if="successMessage && successMessage.details" :message="successMessage.details" />-->
        </div>
        <div v-for="session in sessions" class="dashboard__sessions">
            <SessionSerie :session="session"/>
            <div v-if="session.exercise.series.length > 0" class="dashboard__series">
                <div v-for="(rep, repIndex) in session.exercise.series[0].reps">
                    <SessionRep
                        :serieId="session.exercise.series[0].id"
                        :rep="rep"
                        :order="repIndex + 1"
                        :showFirstCard="true"
                        @update-success="handleSuccess"
                        @update-error="handleError"
                        @delete-success="handleSuccess"
                        @delete-error="handleError"
                    />
                </div>
                <div>
                    <SessionRep
                        :serieId="session.exercise.series[0].id"
                        v-if="session.exercise.series[0].reps.length < 3"
                        :showFirstCard="false"
                        :order="session.exercise.series[0].reps.length + 1"
                        @update-success="handleSuccess"
                        @update-error="handleError"
                        @delete-success="handleSuccess"
                        @delete-error="handleError"
                    />
                </div>
            </div>
        </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped lang="scss">
@import '../../scss/colors.scss';
@import '../../scss/mixins.scss';

.dashboard__sessions {
    display: flex;
    flex-direction: row;
    @include space('top', 3rem);
}

.dashboard__series {
    display: flex;
    flex-direction: row;
}

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

    .dashboard__sessions {
        flex-direction: row;
    }

    .dashboard__series {
        flex-direction: row;
    }

}

@include respond(tab-port) {

    .dashboard__sessions {
        flex-direction: column;
    }

    .dashboard__series {
        flex-direction: column;
    }
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
