<template>
<GuestLayout>
  <Head title="Log in" />
  <div class="page__container">
    <div class="left">
        <div class="header">
        <Link href="/">
            <img src="img/logo.svg" class="header__logo" alt="">
        </Link>
    </div>
      <form @submit.prevent="submit" class="form">
        <div class="form__head">
            <h1 class="form__title">Log In</h1>
            <p class="form__desc">Welcome back ! Please enter your details.</p>
        </div>

        <div class="form__form">
            <Input type="text" label="Email" placeholder="me@fitzee.app" name="email" :value="form.email" v-model="form.email" required></Input>

            <Input type="password" label="Password" placeholder="**************" name="password" :value="form.password" v-model="form.password" required></Input>

            <div class="form__checkbox">
            <Checkbox label="Remember me" name="remember" :value="form.remember" v-model:checked="form.remember" />
            </div>

            <Button label="Login" color="gradient" />
        </div>
        <p class="form__signup">Don't have an account ?<Link href="/register" class="form__signup-link">Sign up</Link></p>
      </form>
    </div>

    <div class="right">
      <img src="img/auth/dashboard.png" alt="" class="right__img"/>
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
  email: 'admin@localhost',
  password: 'admin',
  remember: false,
  errors: {},
});


const formFields = [
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
];

const submit = async () => {
  try {
    await form.post(route('login'));
    form.reset('password');
  } catch (errors) {
    form.errors = errors;
  }
};

</script>

<style lang="scss">
@import '../../../scss/colors.scss';
@import '../../../scss/mixins.scss';

.page__container {
  display: flex;
  justify-content: center;
  height: 100vh;
  position: relative;
}

.form__title {
    font-size: 32px;
    color: $color-white;
}

.form__head {
    margin-bottom: 20px;
}

.form__desc {
    font-size: 18px;
    color: $color-grey;
}

.form {
  flex: 1;
  padding: 10%;
  justify-content: center;
  display: flex;
  flex-direction: column;
  align-self: center;
}

.form__signup {
  text-align: center;
  @include space(top, 15px);
}

.form__signup-link {
    @include space(left, 6px);
}

.header {
  padding: 3rem 0 0 3rem;
}

.header__logo {
  max-width: 100px;
}

.right {
  flex: 1;
  background: linear-gradient(90deg, #FFB73F 2.47%, #F91768 97.63%);
  background-size: cover;
  background-position: right center;
  position: relative;
  overflow: hidden;
  padding-left: 5%;
}

.left {
    display: flex;
    flex-direction: column;
    flex: 1;
}

.right__img {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  right: 0;
  max-width: 100%;
  padding-left: 30px;
  height: 80%;
}

.form__input {
  max-width: 100%;
  border-radius: 15px;
  box-sizing: border-box;
  background: linear-gradient(180deg, rgba(255, 255, 255, 0.00) 0%, rgba(255, 255, 255, 0.10) 100%), rgba(39, 41, 48, 0.40);
  border: none;
  padding: 12px 10px;
  color: #A0A0A0;
  cursor: pointer;
}

.form__input:hover,
.form__input:active,
.form__input:focus {
  box-shadow: none;
}

@include respond(desktop) {
    .right {
        display: none;
    }
}

@include respond(tab-port) {
    .right {
        display: none;
    }

    .form {
        max-width: 100%;
    }
}
</style>
