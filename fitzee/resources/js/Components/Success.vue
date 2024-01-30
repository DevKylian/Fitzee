<template>
    <Transition>
        <div v-if="message" class="alert alert-success">
            <img src="/img/icons/success.png" class="alert-img" alt="Icon">
            <p>{{ message }}</p>
        </div>
    </Transition>
</template>

<script>
export default {
  props: {
    message: String,
  },
};
</script>

<style scoped lang="scss">
@import '../../scss/mixins.scss';
@import '../../scss/colors.scss';

.alert {
    color: $color-white;
    font-weight: bold;
    width: fit-content;
    height: 100px;
    border-radius: 15px;
    display: flex;
    flex-direction: row;
    align-items: center;
    padding: 10px 30px;
    @include space('bottom', 2.5rem);
    background: linear-gradient(90deg, rgba(0, 0, 0, 0.00) 0%, $color-green-10 100%), rgba(39, 41, 48, 0.40);
}

.alert-img {
    @include space('right', 1.5rem);
    width: 32px;
}

.alert p {
    color: $color-white;
}


// responsive

@include respond(desktop) {

}

@include respond(tab-land) {

}

@include respond(tab-port) {
    .alert {
        width: 100%;
    }
}

@include respond(phone) {

}

.v-enter-active,
.v-leave-active {
  transition: opacity 0.3s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
</style>
