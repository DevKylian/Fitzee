<template>
  <Head title="Notice" />

  <AuthenticatedLayout>
    <div>
        <h2>Legal Notice</h2>
<p>This Legal Notice ("Notice") applies to your use of the website located at fitzee.app ("Website") operated by Kylian DEV ("Company," "we," "us," or "our").
</p>
<h4>1. Acceptance of Legal Notice</h4>

<p>By accessing and using the Website, you agree to be bound by the terms and conditions set forth in this Notice. If you disagree with any of the terms and conditions set forth in this Notice, you may not access or use the Website.
</p>
<h4>2. Information on the Website
</h4>
<p>The information on the Website is provided for general informational purposes only and does not constitute professional advice. We endeavor to keep the information on the Website accurate and up-to-date, but we make no representations or warranties of any kind, express or implied, about the completeness, accuracy, reliability, suitability, or availability with respect to the Website or the information, products, services, or related graphics contained on the Website for any purpose.
</p>
<h4>3. Intellectual Property
</h4>
<p>The content of the Website, including but not limited to the text, graphics, logos, images, and software, is the property of the Company or its licensors and is protected by copyright, trademark, and other intellectual property laws. You may not modify, copy, distribute, transmit, display, publish, create derivative works from, or sell any content without the prior written consent of the Company.
</p>
<h4>4. Links to Third-Party Websites
</h4>
<p>The Website may contain links to third-party websites. These links are provided for your convenience only and do not constitute an endorsement by the Company of the content on such third-party websites. The Company is not responsible for the content of any linked websites and makes no representations or warranties regarding the accuracy or completeness of any information contained on such websites.
</p>
<h4>5. Limitation of Liability
</h4>
<p>The Company shall not be liable for any damages arising out of or in connection with your use of the Website. This includes, but is not limited to, direct, indirect, incidental, consequential, special, punitive, or exemplary damages, including but not limited to, damages for loss of profits, data, or goodwill.
</p>
<h4>6. Governing Law
</h4>
<p>This Notice shall be governed by and construed in accordance with the laws of the State of [State Name], without regard to its conflict of laws principles.
</p>
<h4>7. Entire Agreement
</h4>
<p>This Notice constitutes the entire agreement between you and the Company with respect to your use of the Website and supersedes all prior or contemporaneous communications and agreements, whether oral or written.
</p>
<h4>8. Severability
</h4>
<p>If any provision of this Notice is held to be invalid or unenforceable, such provision shall be struck from this Notice and the remaining provisions shall remain in full force and effect.
</p>
<h4>9. Waiver
</h4>
<p>No waiver of any provision of this Notice shall be effective unless in writing and signed by both you and the Company.
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
