<template>
    <div class="exercise__exercise-card color-orange-10">
        <div class="exercise__exercise-img">
            <img :src="imgSrc" alt="" :draggable="false" />
        </div>
        <h4 class="exercise__exercise-title">{{ session.exercise.name }}</h4>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    session: Object
});

const session = ref(props.session);
const imgSrc = `/img/exercises/${session.value.exercise.img}`;

</script>

<style lang="scss" scoped>
@import '../../scss/colors.scss';
@import '../../scss/mixins.scss';

.exercise__exercise-card {
    flex-basis: 30%;
    max-width: 400px;
    border-radius: 30px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: start;
    padding: 10px;
    min-height: 330px;
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
        flex-basis: 95%;
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

