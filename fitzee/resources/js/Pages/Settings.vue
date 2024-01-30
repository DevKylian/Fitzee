<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Input from '@/Components/Input.vue';
import Button from '@/Components/Button.vue';
import Success from '@/Components/Success.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const user = usePage().props.auth.user

const detailsFieldNames = [
  { type: 'text', label: 'First name', placeholder: 'John', name: 'first_name' },
  { type: 'text', label: 'Last name', placeholder: 'Doe', name: 'last_name' },
  { type: 'text', label: 'Email', placeholder: 'john.doe@fitzee.app', name: 'email' },
  { type: 'text', label: 'Username', placeholder: 'john.doe', name: 'username' },
];

const securityFieldNames = [
  { type: 'password', label: 'Actual password', placeholder: '**************', name: 'actual_password' },
  { type: 'password', label: 'New password', placeholder: '**************', name: 'new_password' },
];

const detailsForm = useForm({
  ...Object.fromEntries(
    detailsFieldNames.map((field) => [field.name, (user && user[field.name]) ? user[field.name].toString() : '']),
  ),
  errors: {},
});

const securityForm = useForm({
  ...Object.fromEntries(
    securityFieldNames.map((field) => [field.name, (user && user[field.name]) ? user[field.name].toString() : '']),
  ),
  errors: {},
});

const detailsFormFields = detailsFieldNames.map((field) => ({
  type: field.type,
  label: field.label,
  placeholder: field.placeholder,
  name: field.name,
}));

const securityFormFields = securityFieldNames.map((field) => ({
  type: field.type,
  label: field.label,
  placeholder: field.placeholder,
  name: field.name,
}));

const detailsSubmit = async () => {
  try {
    await detailsForm.post(route('settings.updateDetails'), {
        preserveScroll: true
    });
  } catch (errors) {
    detailsForm.errors = errors;
  }
};

const securitySubmit = async () => {
  try {
    await securityForm.post(route('settings.updatePassword'), {
        preserveScroll: true
    });
  } catch (errors) {
    securityForm.errors = errors;
  }
};

</script>

<template>
    <Head title="Settings" />

    <AuthenticatedLayout>
        <div class="dashboard__section-title">
            <h2 class="dashboard__subtitle">Personnal details</h2>
        </div>
        <Success v-if="$page.props.success" :message="$page.props.success.details" />
        <form @submit.prevent="detailsSubmit" class="form">
            <div class="profile__form">
                <Input
                v-for="field in detailsFormFields"
                :key="field.name"
                :label="field.label"
                :name="field.name"
                :type="field.type"
                :placeholder="field.placeholder"
                :value="detailsForm[field.name]"
                v-model="detailsForm[field.name]"
                :errors="detailsForm.errors"
                />
            </div>
            <div class="profile__form-submit">
                <Button label="Edit" color="gradient" />
            </div>
        </form>

        <div class="dashboard__section-title">
            <h2 class="dashboard__subtitle">Security</h2>
        </div>
        <Success v-if="$page.props.success" :message="$page.props.success.password" />
        <form @submit.prevent="securitySubmit" class="form">
            <div class="profile__form">
                <Input
                v-for="field in securityFormFields"
                :key="field.name"
                :label="field.label"
                :name="field.name"
                :type="field.type"
                :placeholder="field.placeholder"
                :value="securityForm[field.name]"
                v-model="securityForm[field.name]"
                :errors="securityForm.errors"
                />
            </div>
            <div class="profile__form-submit">
                <Button label="Edit" color="gradient" />
            </div>
        </form>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
@import '../../scss/mixins.scss';

.dashboard__section-title {
    @include space('top', 2rem);
    @include space('bottom', 2rem);
}

.profile__form {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    flex-wrap: wrap;
}

.profile__form .input__group {
    display: flex;
    flex-direction: column;
    line-height: normal;
    width: 48%;
}

.profile__form-submit {
    display: flex;
    flex-direction: row;
    justify-content: flex-end;
}

.profile__form-submit button {
    width: 23%;
}

// responsive

@include respond(desktop) {

}

@include respond(tab-land) {

}

@include respond(tab-port) {
    .profile__form .input__group {
        display: flex;
        flex-direction: column;
        line-height: normal;
        width: 47%;
    }

    .profile__form-submit button {
        width: 47%;
    }
}

@include respond(phone) {
    .profile__form .input__group {
        display: flex;
        flex-direction: column;
        line-height: normal;
        width: 100%;
    }

    .profile__form-submit button {
        width: 100%;
    }
}

</style>
