<template>
    <div>
        <div class="exercise__exercise-card color-white-10" v-if="showFirstCard">
            <img class="exercise__exercise-order" :src="'/img/icons/numbers/' + order + '.png'" :alt="'Number ' + order" title="Number {{ order }}">
            <div class="exercise__exercise-content">
                <h4 class="exercise__exercise-title" v-if="!isEditMode">{{ rep.weight }} kg</h4>
                <input v-else v-model="rep.weight" type="number" />
                <h4 class="exercise__exercise-subtitle">Poids</h4>
                <h4 class="exercise__exercise-title" v-if="!isEditMode">{{ rep.reps }}</h4>
                <input v-else v-model="rep.reps" type="number" />
                <h4 class="exercise__exercise-subtitle">Reps</h4>
            </div>
            <div class="exercise__exercise-actions">
                <button class="exercise__exercise-btn" @click="isEditMode ? validateEditAndSubmit(rep.id) : toggleEdit()">
                    <img :src="isEditMode ? '/img/icons/check.png' : '/img/icons/pen.png'" alt="">
                </button>
                <button class="exercise__exercise-btn" @click="deleteRep(rep.id)">
                    <img src="/img/icons/cross.png" alt="">
                </button>
            </div>
        </div>
        <button class="exercise__exercise-card color-white-10" @click="addRep" v-else>
            <img src="/img/icons/plus.png" class="exercise__exercise-card-icon" alt="">
        </button>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { Head, useForm, usePage, router } from '@inertiajs/vue3';

const props = defineProps({
    rep: Object,
    order: Number,
    showFirstCard: Boolean,
    serieId: String,
});

const rep = ref(props.rep);

const isEditMode = ref(false);
const emit = defineEmits(['update-success', 'delete-success'])

const toggleEdit = () => {
    isEditMode.value = !isEditMode.value;
};

const validateEditAndSubmit = async (id) => {
    toggleEdit();

    const form = {
        weight: rep.value.weight,
        reps: rep.value.reps,
    };

    try {
        await useForm(form).put(route('rep.edit', rep.value.id), {
            preserveScroll: true,
        });
        emit('update-success', 'Modifié avec succès !');
    } catch (errors) {
        console.error(errors);
    }
};

const addRep = async () => {
    const form = {
        serie_id: props.serieId,
        reps: 0,
        weight: 0,
    };

    try {
        await useForm(form).post(route('rep.add'), {
            preserveScroll: true,
            onSuccess: () => router.visit(window.location.href, {
                only: ['rep'],
            })
        });
        emit('add-success', 'Ajouté avec succès !');
    } catch (errors) {
        console.error(errors);
    }
};

const deleteRep = async (id) => {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette répétition ?')) {
        await useForm({}).delete(route('rep.destroy', id), {
            preserveScroll: true,
            onSuccess: () => router.visit(window.location.href, {
                only: ['rep'],
            })
        });
        emit('delete-success', 'Supprimé avec succès !');
    }
};
</script>

<style lang="scss" scoped>
@import '../../scss/colors.scss';
@import '../../scss/mixins.scss';

.exercise__exercise-card {
    flex-basis: 30%;
    min-width: 230px;
    max-width: 230px;
    border-radius: 30px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-around;
    padding: 10px;
    min-height: 330px;
    @include space('right', 1rem);
    @include space('bottom', 2rem);
    transition: transform 0.3s ease;
}

.exercise__exercise-card-icon {
    width: 54px;
    height: 54px;
}

.exercise__exercise-content {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.exercise__exercise-order {
    width: 32px;
    height: 32px;
}

.exercise__exercise-actions {
    display: flex;
    flex-direction: row;
}

.exercise__exercise-btn {
    width: 18px;
    height: 18px;
    margin: 0 1rem;
}

.exercise__exercise-card:hover {
    transform: scale(1.025);
}

.exercise__exercise-img {
    padding: 0;
}

.exercise__exercise-img img {
    border-radius: 30px;
    object-fit: cover;
    width: 100%;
    height: 100%;
}

.exercise__exercise-date {
    @include space('bottom', 1rem);
}

.exercise__exercise-title {
    font-size: 1.5rem;
    font-weight: bold;
    color: $color-white;
    @include space('top', 1rem);
}

.exercise__exercise-subtitle {
    font-size: 1rem;
    color: $color-grey;
}

// responsive

@include respond(tab-land) {
    .exercise__exercise-card {
        max-width: 230px;
        flex-basis: 95%;
        @include space('bottom', 1rem)
    }
}

@include respond(phone) {
    .exercise__exercise-card {
        max-width: 95%;
        flex-basis: 95%;
        @include space('bottom', 1rem)
    }
}
</style>

