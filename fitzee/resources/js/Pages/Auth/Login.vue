<<<<<<< Updated upstream
=======
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

>>>>>>> Stashed changes
<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

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

<<<<<<< Updated upstream
<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Forgot your password?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
=======
<style lang="scss" scoped>
@import '../../../scss/colors.scss';
@import '../../../scss/mixins.scss';
@import '../../../scss/form.scss';

// page

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
>>>>>>> Stashed changes
