<template>
  <div class="card-stats">
    <div class="card-stats__img">
      <img :src="getIcon(icone)" alt="Icon">
    </div>
    <div class="card-stats__all">
        <div class="card-stats__content">
            <p class="card-stats__title">{{ weight }}</p>
            <p class="card-stats__desc">Weight</p>
        </div>
        <div class="card-stats__content">
            <p class="card-stats__title">{{ reps }}</p>
            <p class="card-stats__desc">Reps</p>
        </div>
        <div class="card-stats__content">
            <p class="card-stats__title">{{ date }}</p>
            <p class="card-stats__desc">Date</p>
        </div>
    </div>
  </div>
</template>

<script>
import { ref, computed, watch } from "vue";

export default {
  props: {
    weight: String,
    reps: String,
    date: String,
    icone: String,
  },
  setup(props) {
    const icons = {
      target: "/img/icons/target.png",
      zoom: "/img/icons/zoom.png",
      up: "/img/icons/up.png",
      graph: "/img/icons/graph.png",
      pectorals: "/img/icons/pectorals.png",
      shoulders: "/img/icons/shoulders.png",
      back: "/img/icons/back.png",
      glutes: "/img/icons/glutes.png",
      legs: "/img/icons/legs.png",
      triceps: "/img/icons/triceps.png",
      arms: "/img/icons/arms.png",
    };

    const getIcon = (icone) => {
      return icons[icone] || "";
    };

    console.log(props.weight)

    return {
      getIcon,
    };
  },
};
</script>

<style scoped lang="scss">
@import '../../scss/mixins.scss';
@import '../../scss/colors.scss';

.card-stats {
  width: 100%;
  border-radius: 30px;
  display: flex;
  flex-direction: row;
  align-items: center;
  padding: 25px;
  @include space('bottom', 2rem);
  background: linear-gradient(180deg, rgba(255, 255, 255, 0.00) 0%, rgba(255, 255, 255, 0.10) 100%), rgba(39, 41, 48, 0.40);
}

.card-stats__all {
    width: 100%;
    display: flex;
    flex-direction: row;
    justify-content: space-around;
}

.card-stats__content {
  display: flex;
  flex-direction: column;
  flex: 1;
}

.card-stats__title {
  color: $color-white;
  font-weight: bold;
  font-size: 1.5rem;
}

.card-stats__desc {
  color: $color-grey;
  font-size: 1.125rem;
}

.card-stats__img {
  display: flex;
  width: 46px;
  height: 46px;
  flex-direction: row;
  align-items: center;
  justify-content: flex-start;
  @include space('right', 2rem);
  @include space('left', 1rem);
}

// responsive

@include respond(tab-land) {
    .card-stats {
        flex-basis: 100%;
        padding: 15px 25px;
        @include space('bottom', 1rem)
    }

    .card-stats__all {
        flex-wrap: wrap;
    }
}

@include respond(phone) {
    .card-stats {
        flex-basis: 100%;
        padding: 15px 10px;
        @include space('bottom', 1rem)
    }

    .card-stats__all {
        width: 55%;
        flex-wrap: wrap;
    }
}

@include respond(tab-port) {
    .card-stats__all {
        width: 65%;
        flex-wrap: wrap;
    }
}

</style>
