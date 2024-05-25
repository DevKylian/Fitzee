<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    show: Boolean,
});
</script>

<template>
    <Transition name="modal-fade">
        <div v-if="props.show" class="modal-container" @click="$emit('close')">
            <div class="modal-content" @click.stop>
                <div class="modal-header">
                    <h3><slot name="header">default header</slot></h3>
                </div>

                <div class="modal-body">
                    <slot name="body">default body</slot>
                </div>

                <div class="modal-footer">
                    <slot name="footer">
                        <button
                            class="modal-default-button"
                            @click="$emit('close')"
                        >OK</button>
                    </slot>
                </div>
            </div>
        </div>
    </Transition>
</template>

<style scoped lang="scss">
@import '../../scss/mixins.scss';
@import '../../scss/colors.scss';

.modal-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    z-index: 9998;
}

.modal-content {
    max-width: 550px;
    position: relative;
    background: rgba(39, 41, 48, 0.85);
    border-radius: 20px;
    padding: 30px 40px;
    color: $color-white;
}

.modal-header h3 {
    margin-top: 0;
    color: $color-red;
}

.modal-body {
    font-size: 1.125rem;
    margin: 20px 0;
}

.modal-footer {
    color: $color-white;
}

.modal-default-button {
    font-size: 1.125rem;
    float: right;
}

.modal-fade-enter-active, .modal-fade-leave-active {
    transition: opacity 0.2s;
}

.modal-fade-enter, .modal-fade-leave-to {
    opacity: 0;
}

.modal-enter-from {
    opacity: 0;
}

.modal-leave-to {
    opacity: 0;
}

.modal-enter-from .modal-content,
.modal-leave-to .modal-content {
    transform: scale(1.1);
}
</style>
