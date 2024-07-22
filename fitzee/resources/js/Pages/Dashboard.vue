<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage, router, Link } from '@inertiajs/vue3';
import CardStats from '@/Components/CardStats.vue';
import Modal from '@/Components/Modal.vue';
import Redirect from '@/Components/Redirect.vue';
import CardStatsVertical from '@/Components/CardStatsVertical.vue';
import LongCardStats from '@/Components/LongCardStats.vue';
import Flicking from "@egjs/vue3-flicking";
import "@egjs/vue3-flicking/dist/flicking.css";
import { computed, ref, onBeforeMount } from "vue";

const profile = usePage().props.profile;
const series = usePage().props.series;
const daysRemainingText = usePage().props.daysRemainingText;
const showModal = ref(false);
let programs = usePage().props.programs;
let upcomingPrograms = computed(() => programs.filter(program => program.status === 0));

// Pagination setup
const itemsPerPage = 3;
const currentPage = ref(1);

const paginatedSeries = computed(() => {
    const startIndex = (currentPage.value - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    return series.slice(startIndex, endIndex);
});

const pageCount = computed(() => {
    return Math.ceil(series.length / itemsPerPage);
});

const goToPage = (page) => {
    if (page >= 1 && page <= pageCount.value) {
        currentPage.value = page;
    }
};

const getProgramDetails = (title) => {
    if (title.includes('Pectoraux') || title.includes('Epaules') || title.includes('Triceps')) {
        return { color: 'red', icon: 'pectorals', name: 'Push' };
    } else if (title.includes('Dos') || title.includes('Biceps')) {
        return { color: 'blue', icon: 'back', name: 'Pull' };
    } else if (title.includes('Jambes')) {
        return { color: 'yellow', icon: 'legs', name: 'Legs' };
    } else {
        return { color: 'grey', icon: 'question', name: title };
    }
};

const getExerciseDetails = (muscleId) => {
    switch (muscleId) {
        case 100:
        case 101:
        case 102:
        case 103:
            return { color: 'red', icon: 'pectorals' };
        case 200:
        case 201:
        case 202:
            return { color: 'orange', icon: 'shoulders' };
        case 300:
        case 301:
        case 302:
            return { color: 'white', icon: 'triceps' };
        case 400:
        case 401:
            return { color: 'blue', icon: 'biceps' };
        case 500:
        case 501:
        case 502:
        case 503:
        case 504:
            return { color: 'green', icon: 'back' };
        case 600:
        case 601:
        case 602:
        case 603:
        case 604:
            return { color: 'yellow', icon: 'legs' };
        default:
            return { color: 'grey', icon: 'question' };
    }
};
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <button id="show-modal" @click="showModal = true">Show Modal</button>
        <Modal :show="showModal" @close="showModal = false">
            <template #header>
                ⚡️ Bienvenue sur Fitzee
            </template>
            <template #body>
                Pour créer ton programme il faut que tu renseignes tes informations sur ton <Link :href="route('my-profile')" method="get" as="button" type="button" class="link">profil</Link> !
            </template>
        </Modal>
        <div class="grid-four">
            <CardStats color="red" :title="daysRemainingText || 0" desc="To reach your goal" icone="target"></CardStats>
            <CardStats color="yellow" title="2" desc="Sessions this week" icone="graph"></CardStats>
            <CardStats color="white" :title="profile.program_type_text || 0" desc="Program type" icone="zoom"></CardStats>
            <CardStats color="blue" :title="profile.weight_goal ? profile.weight_goal + ' kg' : '0 kg'" desc="Weight" icone="up"></CardStats>
        </div>
        <div class="dashboard__contents">
            <div class="dashboard__content">
                <div class="dashboard__section-title">
                    <h2 class="dashboard__subtitle">Last series</h2>
                    <div v-if="series.length > 0" class="pagination">
                        <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1" class="pagination-button prev-button">&lt;</button>
                        <span class="page-count">{{ currentPage }} / {{ pageCount }}</span>
                        <button @click="goToPage(currentPage + 1)" :disabled="currentPage === pageCount" class="pagination-button next-button">&gt;</button>
                    </div>
                </div>
                <div class="last-series">
                    <p v-if="series.length <= 0" class="no-series-message">Aucune série d'exercices disponible.</p>
                    <LongCardStats
                        v-for="(serie, index) in paginatedSeries"
                        :key="serie.id"
                        :weight="serie.reps[index].weight"
                        :reps="serie.reps[index].reps"
                        :date="serie.formatted_created_at"
                        :icone="serie.exercise.muscle.icon"
                        :uniqueKey="serie.id"
                    ></LongCardStats>
                </div>
            </div>
            <div class="dashboard__content">
                <div class="dashboard__section-title">
                    <h2 class="dashboard__subtitle">Your next exercises</h2>
                </div>
                <div class="next-exercises">
                    <Flicking :options="{ moveType: 'freeScroll', circular: true, bound: true, align: 'prev' }">
                        <Redirect
                            v-for="serie in series"
                            :key="serie.id"
                            :href="`/session/${serie.id}`"
                            style="margin-right: 1rem;"
                        >
                            <CardStatsVertical
                                :color="getExerciseDetails(serie.exercise.muscle_part).color"
                                :title="serie.exercise.name"
                                desc="3 series of 12 reps"
                                :icone="getExerciseDetails(serie.exercise.muscle_part).icon"
                                :key="1"
                            ></CardStatsVertical>
                        </Redirect>
                    </Flicking>
                </div>
                <div class="dashboard__section-title">
                    <h2 class="dashboard__subtitle">Your next sessions</h2>
                </div>
                <div class="next-sessions">
                    <Flicking :options="{ moveType: 'freeScroll', circular: true, bound: true, align: 'prev' }">
                        <Redirect
                            v-for="program in upcomingPrograms"
                            :key="program.id"
                            :href="`/session/${program.id}`"
                            style="margin-right: 1rem;"
                        >
                            <CardStatsVertical
                                :color="getProgramDetails(program.name).color"
                                :title="getProgramDetails(program.name).name"
                                :desc="program.scheduled_at_formated"
                                :icone="getProgramDetails(program.name).icon"
                                :key="1"
                            ></CardStatsVertical>
                        </Redirect>
                    </Flicking>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
@import '../../scss/mixins.scss';
@import '../../scss/colors.scss';

.dashboard__contents {
    display: flex;
    flex-direction: row;
    width: 100%;
}

.dashboard__content {
  min-width: 45%;
  width: 100%;
  @include space('right', 2rem)
}

.next-exercises {
  display: flex;
  flex-direction: column;
  @include space('bottom', 2rem)
}

.next-sessions {
  display: flex;
  flex-direction: column;
  @include space('top', 2rem)
}

.dashboard__section-title {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    @include space('bottom', 2rem);
}

.grid-four {
    display: flex;
    flex-wrap: wrap;
    margin: 3rem 0;
}

.last-series {
    min-width: 100%;
    width: 100%;
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
    .grid-four {
        flex-direction: row;
        flex-wrap: wrap;
    }

    .last-series {
        width: 97%;
    }
}

@include respond(tab-land) {
    .grid-four {
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .last-series {
        width: 92%;
    }
}

@include respond(tab-port) {
    .last-series {
        width: 100%;
    }

    .dashboard__contents {
        flex-direction: column;
    }
}

@include respond(phone) {
    .grid-four {
        flex-direction: column;
        flex-wrap: nowrap;
    }
}

</style>
