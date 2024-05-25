<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Input from '@/Components/Input.vue';
import Dropdown from '@/Components/Dropdown.vue';
import Button from '@/Components/Button.vue';
import Success from '@/Components/Success.vue';
import Info from '@/Components/Info.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const profile = usePage().props.profile;
const info = usePage().props.info;
const programOptions = usePage().props.programOptions;
const gymFrequentationOptions = usePage().props.gymFrequentationOptions;
const genderOptions = usePage().props.genderOptions;
const goalOptions = usePage().props.goalOptions;
const program_type = ref(profile.program_type);
const gender = ref(profile.gender);
const gym_frequentation = ref(profile.gym_frequentation);
const goal = ref(profile.goal);
const programSpecifics = usePage().props.programSpecifics;

const fieldNames = [
  { type: 'number', label: 'Age', placeholder: '23', name: 'age' },
  { type: 'number', label: 'Weight', placeholder: '23', name: 'weight' },
  { type: 'number', label: 'Weight goal', placeholder: '23', name: 'weight_goal' },
  { type: 'date', label: 'Goal date', placeholder: '01/01/2024', name: 'goal_date' },
  { type: 'number', label: 'Size', placeholder: '23', name: 'size' },
  { type: 'number', label: 'Gym experience', placeholder: '23', name: 'gym_experience' },
];

const form = useForm({
    ...Object.fromEntries(
        fieldNames.map((field) => [field.name, (profile && profile[field.name]) ? profile[field.name].toString() : '']),
    ),
    gym_frequentation: gym_frequentation.value ? gym_frequentation.value.toString() : '',
    program_type: program_type.value ? program_type.value.toString() : '',
    gender: gender.value ? gender.value.toString() : '',
    goal: goal.value ? goal.value.toString() : '',
    errors: {},
});

const filteredProgramOptions = computed(() => {
    if (!gym_frequentation.value) return programOptions;

    let gymFrequency = parseInt(gym_frequentation.value);

    return programOptions.filter(option => {
        const programRules = programSpecifics[option.value];
        if (programRules.values) {
            return programRules.values.includes(gymFrequency);
        }
        else {
            return gymFrequency >= programRules.min && gymFrequency <= programRules.max;
        }
    });
});

const formFields = fieldNames.map((field) => ({
  type: field.type,
  label: field.label,
  placeholder: field.placeholder,
  name: field.name,
}));

const updateProgramType = (value) => {
    program_type.value = value.toString();
    form.program_type = value.toString();
};

const updateGender = (value) => {
  gender.value = value.toString();
  form.gender = value.toString();
};

const updateGymFrequentation = (value) => {
  gym_frequentation.value = value.toString();
  form.gym_frequentation = value.toString();
};

const updateGoal = (value) => {
  goal.value = value.toString();
  form.goal = value.toString();
};

const submit = async () => {
  try {
    await form.post(route('my-profile'), {
        preserveScroll: true
    });
  } catch (errors) {
    form.errors = errors;
  }
};

</script>

<template>
    <Head title="My profile" />

    <AuthenticatedLayout>
        <div class="dashboard__section-title">
            <h2 class="dashboard__subtitle">Your profile</h2>
        </div>
        <Success :message="$page.props.success" />
        <Info :message="$page.props.flash.info" />
        <form @submit.prevent="submit" class="form">
            <div class="profile__form">
                <Dropdown
                label="Gender"
                name="gender"
                v-model="gender"
                :value="gender"
                :options="genderOptions"
                :errors="form.errors"
                @updateEvent="updateGender"
                />
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
                <Dropdown
                    label="Gym frequentation"
                    name="gym_frequentation"
                    v-model="gym_frequentation"
                    :value="gym_frequentation"
                    :options="gymFrequentationOptions"
                    :errors="form.errors"
                    @updateEvent="updateGymFrequentation"
                />
                <Dropdown
                label="Goal"
                name="goal"
                v-model="goal"
                :value="goal"
                :options="goalOptions"
                :errors="form.errors"
                @updateEvent="updateGoal"
                />
                <Dropdown
                    label="Program type"
                    name="program_type"
                    v-model="program_type"
                    :value="program_type"
                    :options="filteredProgramOptions"
                    :errors="form.errors"
                    @updateEvent="updateProgramType"
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
    width: 23%;
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
input[type="date"]::-webkit-calendar-picker-indicator {
  cursor: pointer;
  border-radius: 4px;
  margin-right: 2px;
  opacity: 0.6;
  filter: invert(0.8);
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
