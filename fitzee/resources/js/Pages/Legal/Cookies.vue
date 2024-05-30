<template>
  <Head title="Cookies" />

  <AuthenticatedLayout>
    <div>
<h2>Cookie Policy</h2>
<p>This Cookie Policy ("Policy") explains how [Company Name] ("Company," "we," "us," or "our") uses cookies and similar technologies when you visit our website located at [Website URL] ("Website").
</p>
<h4>1. What are Cookies?</h4>

<p>Cookies are small text files that are stored on your computer or mobile device when you visit a website. They are widely used to remember your actions and preferences on a website (such as login, language, font size, and other display preferences) over a period of time, so you don't have to keep re-entering them whenever you come back to the site or browse from one page to another.
</p>
<h4>2. What Types of Cookies Do We Use?
</h4>
<p>We use the following types of cookies on our Website:

Strictly Necessary Cookies: These cookies are essential for the Website to function properly. They enable you to use the Website's features and services, such as accessing secure areas of the Website or completing online forms.

Performance Cookies: These cookies collect information about how you use the Website, such as which pages you visit and how you interact with the Website. This information helps us to improve the Website's performance and user experience.

Functionality Cookies: These cookies allow the Website to remember your preferences and choices, such as your language preference, font size, and other display preferences. This helps to provide you with a more personalized and convenient experience when you use the Website.

Targeting/Advertising Cookies: These cookies track your browsing habits on the Website and other websites in order to deliver personalized advertising to you.
</p>
<h4>3. How Do We Use Cookies?</h4>

<p>We use cookies for the following purposes:
</p>
<p>To improve your overall experience on our Website;<br>
To remember your preferences and choices;<br>
To track your browsing habits on our Website and other websites;<br>
To deliver personalized advertising to you;<br>
To analyze and improve the performance of our Website;<br>
To secure our Website.</p>

<h4>4. Your Cookie Choices</h4>

<p>You can control the use of cookies by adjusting your browser settings. Most browsers allow you to block or delete all cookies, or block or delete cookies from specific websites. However, if you block all cookies, you may not be able to use some features of our Website.
</p>
<p>You can also opt-out of being tracked by some third-party cookies by visiting the websites of those third parties. For example, you can opt-out of being tracked by Google Analytics by visiting https://support.google.com/analytics/answer/181881?hl=en.
</p>
<h4>5. Changes to Our Cookie Policy</h4>

<p>We may update this Policy from time to time to reflect changes in our practices or as required by law. We will post any changes to this Policy on our Website and notify you by email if the changes are material.
</p>
 </div>

  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<style scoped lang="scss">
@import '../../../scss/colors.scss';
@import '../../../scss/mixins.scss';

p {
    @include space('top', 1rem);
    @include space('bottom', 1rem);
    font-size: 1rem;
    color: $color-grey;
}

h4 {
    font-size: 1.4rem;
    color: $color-white;
}

h2 {
    @include space('top', 4rem);
}

</style>
