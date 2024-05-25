<template>
  <div class="card-stats" :class="colorClass">
    <div class="card-stats__content">
      <p class="card-stats__title">{{ title }}</p>
      <p class="card-stats__desc">{{ desc }}</p>
    </div>
    <div class="card-stats__img">
      <img :src="getIcon(icone)" alt="Icon">
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
      target: "img/icons/target.png",
      zoom: "img/icons/zoom.png",
      up: "img/icons/up.png",
      graph: "img/icons/graph.png",
    };

    const getIcon = (icone) => {
      return icons[icone] || "";
    };

    const colorClass = computed(() => {
      if (props.color === "gradient") {
        return "color-gradient";
      } else if (props.color === "red") {
        return "color-red";
      } else if (props.color === "green") {
        return "color-green";
      } else if (props.color === "blue") {
        return "color-blue";
      } else if (props.color === "white") {
        return "color-white";
      } else if (props.color === "yellow") {
        return "color-yellow";
      } else if (props.color === "grey") {
        return "color-grey";
      } else if (props.color === "orange") {
        return "color-orange";
      }
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
  flex-basis: 23%;
  margin-right: 1rem;
  width: 100%;
  height: 100px;
  border-radius: 30px;
  display: flex;
  flex-direction: row;
  align-items: center;
  padding: 30px;
  transition: transform 0.3s ease;
}

.card-stats:hover {
  transform: scale(1.025);
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
  flex-direction: row;
  align-items: center;
  justify-content: flex-end;
}

// responsive

@include respond(tab-land) {
    .card-stats {
        flex-basis: 45%;
        padding: 15px 25px;
        @include space('bottom', 1rem)
    }
}

// colors

.color-red {
  background: linear-gradient(90deg, rgba(0, 0, 0, 0.00) 0%, $color-red-10 100%), rgba(39, 41, 48, 0.40);
}

.color-orange {
  background: linear-gradient(90deg, rgba(0, 0, 0, 0.00) 0%, $color-orange-10 100%), rgba(39, 41, 48, 0.40);
}

.color-blue {
  background: linear-gradient(90deg, rgba(0, 0, 0, 0.00) 0%, $color-blue-10 100%), rgba(39, 41, 48, 0.40);
}

.color-green {
  background: linear-gradient(90deg, rgba(0, 0, 0, 0.00) 0%, $color-green-10 100%), rgba(39, 41, 48, 0.40);
}

.color-white {
  background: linear-gradient(90deg, rgba(0, 0, 0, 0.00) 0%, $color-white-10 100%), rgba(39, 41, 48, 0.40);
}

.color-grey {
  background: linear-gradient(90deg, rgba(0, 0, 0, 0.00) 0%, $color-grey-10 100%), rgba(39, 41, 48, 0.40);
}

.color-yellow {
  background: linear-gradient(90deg, rgba(0, 0, 0, 0.00) 0%, $color-yellow-10 100%), rgba(39, 41, 48, 0.40);
}

</style>
