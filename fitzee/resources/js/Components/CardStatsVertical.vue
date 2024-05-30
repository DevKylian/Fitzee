<template>
  <div class="card-stats" :class="colorClass">
    <div class="card-stats__img">
      <img :src="getIcon(icone)" draggable="false" alt="Icon">
    </div>
    <div class="card-stats__content">
      <p class="card-stats__title">{{ title }}</p>
      <p class="card-stats__desc">{{ desc }}</p>
    </div>
  </div>
</template>

<script>
import { ref, computed, watch } from "vue";

export default {
  props: {
    title: String,
    desc: String,
    color: String,
    icone: String,
  },
  setup(props) {
    const icons = {
      glute: "img/icons/glute.png",
      legs: "img/icons/legs.png",
      squat: "img/icons/squat.png",
      pectorals: "img/icons/pectorals.png",
      biceps: "img/icons/arms.png",
      triceps: "img/icons/arms.png",
      back: "img/icons/back.png",
      shoulders: "img/icons/shoulders.png",
    };

    const getIcon = (icone) => {
      return icons[icone] || "";
    };

    const colorClass = computed(() => {
      const colorMap = {
          gradient: "color-gradient",
          red: "color-red",
          green: "color-green",
          blue: "color-blue",
          white: "color-white",
          yellow: "color-yellow",
          grey: "color-grey",
          orange: "color-orange",
      };

      return colorMap[props.color] || "";
    });


    return {
      getIcon,
      colorClass,
    };
  },
};
</script>

<style scoped lang="scss">
@import '../../scss/mixins.scss';
@import '../../scss/colors.scss';

.card-stats {
  flex-basis: 30%;
  width: 100%;
  min-width: 160px;
  border-radius: 30px;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 30px 0;
  @include space('right', 1rem);
  transition: transform 0.3s ease;
}

.card-stats:hover {
  transform: scale(1.025);
}

.card-stats__content {
  display: flex;
  flex-direction: column;
  flex: 1;
  align-items: center;
}

.card-stats__title {
  color: $color-white;
  font-weight: bold;
  font-size: 1.5rem;
  @include space('top', 1.8rem);
}

.card-stats__desc {
  color: $color-grey;
  font-size: 1.125rem;
}

.card-stats__img {
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: flex-end;
  width: 36px;
}

// responsive

@include respond(tab-land) {
    .card-stats {
        flex-basis: 50%;
        padding: 15px 25px;
        @include space('bottom', 1rem)
    }
}

@include respond(tab-port) {
    .card-stats {
        flex-basis: 40%;
        padding: 15px 25px;
        @include space('bottom', 1rem)
    }
}

@include respond(phone) {
    .card-stats {
        flex-basis: 50%;
        padding: 15px 25px;
        @include space('bottom', 1rem)
    }
}

// colors

.color-red {
  background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 0%, $color-red-10 100%), rgba(39, 41, 48, 0.40);
}

.color-orange {
  background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 0%, $color-orange-10 100%), rgba(39, 41, 48, 0.40);
}

.color-blue {
  background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 0%, $color-blue-10 100%), rgba(39, 41, 48, 0.40);
}

.color-green {
  background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 0%, $color-green-10 100%), rgba(39, 41, 48, 0.40);
}

.color-white {
  background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 0%, $color-white-10 100%), rgba(39, 41, 48, 0.40);
}

.color-grey {
  background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 0%, $color-grey-10 100%), rgba(39, 41, 48, 0.40);
}

.color-yellow {
  background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 0%, $color-yellow-10 100%), rgba(39, 41, 48, 0.40);
}

</style>
