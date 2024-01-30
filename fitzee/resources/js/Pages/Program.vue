<template>
    <Head title="Program" />
    <AuthenticatedLayout>
        <div class="dashboard__section-title">
            <div class="dashboard__actions-left">
                <h2 class="dashboard__subtitle">Program</h2>
                <p class="dashboard__description">
                    Choisis les exercices que tu peux réaliser dans la salle où tu t'entraînes grâce aux sliders ci-dessous.
                    <br>Ton programme sera créé en fonction de ces choix.
                </p>
            </div>
            <div class="dashboard__actions-right" v-if="hasPrograms">
                <Button @click="deleteProgram" label="Supprimer mon programme" color="gradient" />
            </div>
        </div>
        <Info :message="info" />
        <div v-if="allowGenerateProgram" class="exercises__generate">
            <Button @click="generateProgram" label="Générer mon programme" color="gradient" />
        </div>
        <div class="exercises__section" v-if="hasPrograms">
            <div class="exercise__section-title">
                <h3>A venir</h3>
            </div>
            <div class="exercise__section-slider">
                <Flicking :options="{ moveType: 'freeScroll', circular: true, bound: true, align: 'prev' }">
                    <Redirect
                        v-for="program in upcomingPrograms"
                        :key="program.id"
                        :href="`/session/${program.id}`"
                    >
                        <Program :program="program" :status="program.status" :on-update="updatePrograms" :href="`/program/${program.id}`"/>
                    </Redirect>
                </Flicking>
            </div>
            <div class="exercise__section-title">
                <h3>Terminé</h3>
            </div>
            <div class="exercise__section-slider">
                <Flicking :options="{ moveType: 'freeScroll', circular: true, bound: true, align: 'prev' }">
                    <Redirect
                        v-for="program in finishedPrograms"
                        :key="program.id"
                        :href="`/session/${program.id}`"
                    >
                        <Program :program="program" :status="program.status" :on-update="updatePrograms"/>
                    </Redirect>
                </Flicking>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Redirect from '@/Components/Redirect.vue';
import Program from '@/Components/Program.vue';
import Button from '@/Components/Button.vue';
import Success from '@/Components/Success.vue';
import {Head, router, usePage} from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import Flicking from "@egjs/vue3-flicking";
import "@egjs/vue3-flicking/dist/flicking.css";
import Info from "@/Components/Info.vue";

let programs = usePage().props.programs;
let info = ref(usePage().props.info);
let success = ref(usePage().props.success);
let everyProgramStatusOne = computed(() => programs.every(program => program.status === 1));
let upcomingPrograms = computed(() => programs.filter(program => program.status === 0));
let finishedPrograms = computed(() => programs.filter(program => program.status === 1));
let hasPrograms = computed(() => programs.length > 0);
let noFuturePrograms = computed(() => {
    const currentDate = new Date();
    currentDate.setHours(0, 0, 0, 0);

    const latestProgramDate = programs.reduce((latestDate, program) => {
        const programDate = new Date(program.scheduled_at);
        return programDate > latestDate ? programDate : latestDate;
    }, new Date(0))

    return latestProgramDate <= currentDate;
});

let allowGenerateProgram = computed(() => everyProgramStatusOne.value && noFuturePrograms.value);

const updatePrograms = () => {
    programs = usePage().props.programs;
    upcomingPrograms = computed(() => programs.filter(program => program.status === 0));
    finishedPrograms = computed(() => programs.filter(program => program.status === 1));
}

const generateProgram = async () => {
    try {
        const response = await fetch('/program/generate');

        if(response.ok){
            router.visit(window.location.href, {
                only: ['programs'],
            })
        } else {
            let error = await response.json();
            info.value = error.info;
        }
    } catch (error) {
        console.log(error);
    }
}

const deleteProgram = async () => {
    try {
        const response = await fetch(`/program/delete`, {
            method: 'GET',
        });

        if (response.ok) {router.visit(window.location.href, {
                only: ['programs'],
            })
        } else {
            console.error('Failed to delete program');
        }
    } catch (error) {
        console.error('Failed to delete program', error);
    }
};
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

.exercises__generate {
    width: 300px;
    @include space('bottom', 2rem);
}

.dashboard__description {
    color: $color-grey;
    @include space('top', 1rem);
}

.dashboard__section-title {
    @include space('top', 2rem);
    @include space('bottom', 2rem);
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
}

.dashboard__actions-left {
    display: flex;
    flex-direction: column;
}

.dashboard__actions-right {
    display: flex;
    align-items: center;
    justify-content: center;
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

    .dashboard__section-title {
        flex-direction: column;
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
