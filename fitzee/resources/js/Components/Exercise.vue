<template>
    <div class="exercise__exercise-card" :class="colorClass">
        <div class="exercise__exercise-img">
            <img :src="'/img/exercises/' + exercise.img + '.png'" alt="" draggable="false">
        </div>
        <h4 class="exercise__exercise-title">{{ exercise.name }}</h4>
        <Switch :modelValue="exerciseHasEntry" @click.stop="handleCardClick" />
    </div>
</template>

<script setup>
import { defineProps, ref, computed } from 'vue';
import Switch from '@/Components/Switch.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    exercise: Object,
    color: String,
});

const colorClass = `color-${props.color}-10`;
const exercise = ref(props.exercise);

const exerciseHasEntry = computed(() => exercise.value.user_exercises.length > 0);
const toggleExercise = async () => {
    const formData = new FormData();
    formData.append('slug', exercise.value.slug);
    const form = useForm(formData);

    try {
        await form.post(route('exercise.toggle', { slug: exercise.value.slug }), {
            preserveScroll: true
        });

        if (exerciseHasEntry.value) {
            exercise.value.user_exercises = [];
        } else {
            exercise.value.user_exercises = [{}];
        }

    } catch (error) {
        console.log(error);
    }
};

const handleCardClick = (event) => {
    if (event.target.tagName !== 'INPUT') {
        toggleExercise()
    }
};
</script>

<style lang="scss" scoped>
@import '../../scss/colors.scss';
@import '../../scss/mixins.scss';

.exercise__exercise-card {
    flex-basis: 30%;
    width: 400px;
    border-radius: 30px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: start;
    padding: 10px;
    @include space('right', 1rem);
    @include space('bottom', 2rem);
    transition: transform 0.3s ease;
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

.exercise__exercise-title {
    font-size: 1.5rem;
    font-weight: bold;
    color: $color-white;
    @include space('top', 1rem);
    @include space('bottom', .5rem);
}

// responsive

@include respond(tab-land) {
    .exercise__exercise-card {
        flex-basis: 45%;
        @include space('bottom', 1rem)
    }
}

@include respond(phone) {
    .exercise__exercise-card {
        flex-basis: 95%;
        @include space('bottom', 1rem)
    }
}
</style>
