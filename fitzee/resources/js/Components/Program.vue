<template>
    <div class="exercise__exercise-card" :class="colorClass">
        <div class="exercise__exercise-img">
            <img :src="imgSrc" alt="" :draggable="false" />
        </div>
        <h4 class="exercise__exercise-title">{{ program.name }}</h4>
        <p class="exercise__exercise-date">{{ program.scheduled_at_formated }}</p>
        <Switch :modelValue="status === 1" @click.stop="handleCardClick" />
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import Switch from '@/Components/Switch.vue';
import { router, useForm } from '@inertiajs/vue3';

const props = defineProps({
    program: Object,
    status: Number,
});

const colorClass = computed(() => {
    return props.status === 0 ? 'color-blue-10' : props.status === 1 ? 'color-white-10' : '';
});
const program = ref(props.program);
const imgSrc = `/img/exercises/${program.value.img}.png`;

const toggleProgram = async () => {
    const form = useForm({ id: program.value.id });

    await form.post(route('program.toggle', { id: program.value.id }), {
        preserveScroll: true,
        onSuccess: () => router.visit(window.location.href,
            { only: ['programs'] }),
        onError: error => console.log(error)
    });
};

const handleCardClick = event => {
    event.target.tagName !== 'INPUT' && toggleProgram();
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

.exercise__exercise-date {
    @include space('bottom', 1rem);
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

