<template>
  <GuestLayout>
    <Head title="Sign Up" />
    <div class="page__container">
      <div class="left">
        <div class="header">
          <Link href="/">
            <img src="img/logo.svg" class="header__logo" alt="" />
          </Link>
        </div>
        <form @submit.prevent="submit" class="form">
          <div class="form__head">
            <h1 class="form__title">Sign Up</h1>
            <p class="form__desc">Welcome! Please enter your details.</p>
          </div>

          <div class="form__form">
            <Input
              v-for="field in formFields"
              :key="field.name"
              :label="field.label"
              :name="field.name"
              :type="field.type"
              :placeholder="field.placeholder"
              :value="form[field.name]"
              v-model="form[field.name]"
              :errors="form.errors"
            />

            <div class="form__checkbox">
                <Checkbox label="I accept the term of use" name="terms" v-model:checked="form.terms" />
                <span v-if="form.errors.terms" class="error__label">{{ form.errors.terms }}</span>
            </div>

            <Button label="Register" color="gradient" />
          </div>
          <p class="form__signup">Already have an account ?<Link href="/login" class="form__signup-link">Log in</Link></p>
        </form>
      </div>

      <div class="right">
        <img src="img/auth/dashboard.png" alt="" class="right__img" />
      </div>
    </div>
  </GuestLayout>
</template>

<script setup>
import { ref } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Input from '@/Components/Input.vue';
import Checkbox from '@/Components/Checkbox.vue';
import Button from '@/Components/Button.vue';

const form = useForm({
  username: '',
  email: '',
  password: '',
  password_confirmation: '',
  terms: false,
  errors: {},
});

const formFields = [
  {
    type: 'text',
    label: 'Username',
    placeholder: 'johndoe',
    name: 'username',
  },
  {
    type: 'email',
    label: 'Email',
    placeholder: 'john.doe@fitzee.app',
    name: 'email',
  },
  {
    type: 'password',
    label: 'Password',
    placeholder: '**************',
    name: 'password',
  },
  {
    type: 'password',
    label: 'Password confirmation',
    placeholder: '**************',
    name: 'password_confirmation',
  },
];

const submit = async () => {
  try {
    await form.post(route('register'), {
        preserveScroll: true
    });
    form.reset('password', 'password_confirmation');
  } catch (errors) {
    form.errors = errors;
  }
};

</script>


<style lang="scss" scoped>
@import '../../../scss/colors.scss';
@import '../../../scss/mixins.scss';
@import '../../../scss/form.scss';
@import '../../../scss/error.scss';

// page

.form {
  flex: 1;
  width: 70%;
  padding: 10%;
  justify-content: center;
  display: flex;
  flex-direction: column;
  align-self: center;
}

.page__container {
    display: flex;
    justify-content: center;
    position: relative;
    min-height: 100vh;
  }

// header

.header {
padding: 3rem 0 0 3rem;
}

.header__logo {
max-width: 100px;
}

// side

.right {
    flex: 1;
    background: linear-gradient(90deg, #FFB73F 2.47%, #F91768 97.63%);
    background-size: cover;
    background-position: right center;
    position: relative;
    overflow: hidden;
    padding-left: 5%;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    justify-content: center;
}

.right__img {
    max-width: 90%;
}

.left {
    display: flex;
    flex-direction: column;
    flex: 1;
}

// responsive

@include respond(desktop) {
      .right {
          display: none;
      }
  }

@include respond(tab-port) {
    .right {
        display: none;
    }
}

</style>
