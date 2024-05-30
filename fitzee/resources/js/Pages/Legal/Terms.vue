<template>
  <Head title="Terms" />

  <AuthenticatedLayout>
    <div>
        <h2>Terms and Conditions of Use for a Web Application</h2>

<p>WARNING</p>

<p>This template of terms and conditions of use ("Terms") is designed for informational purposes only and does not constitute legal advice. You should consult with an attorney to obtain legal advice specific to your situation.
</p>

<h4>1. Definitions</h4>

 <p>Application means the web application you are using, including all of its features, content, and services.
 Company means [Company Name], the company that owns and operates the Application.
 User means you, the person who is using the Application.
 Content means any text, image, audio, video, or other material that can be accessed through the Application.</p>

<h4>2. Acceptance of Terms</h4>

<p>By using the Application, you agree to be bound by these Terms. If you do not agree to these Terms, you may not use the Application.
</p>

<h4>3. Access to the Application</h4>

<p> You must be at least [Minimum Age] years old to use the Application.
 You are responsible for providing internet access and the equipment necessary to use the Application.
 The Company reserves the right to modify, suspend, or terminate access to the Application, in whole or in part, at any time and without notice.
</p>

<h4>4. Use of the Application</h4>

<p> You agree to use the Application in accordance with all applicable laws and regulations.<br>
 You agree not to use the Application for any illegal or harmful purposes.<br>
 You agree not to use the Application in any way that could damage, disable, or overburden the Application or interfere with the use of the Application by other users.<br>
 You agree not to obtain or transmit any illegal, harmful, threatening, abusive, defamatory, vulgar, obscene, hateful, racial, sexist, or otherwise objectionable information via the Application.<br>
 You agree not to impersonate any other person or entity or to provide false or misleading information when using the Application.<br>
 You agree not to use the Application to collect or store personal information about other users without their consent.<br>
 You agree not to use the Application to send spam or unsolicited advertising.<br>
 You agree not to use the Application to upload or distribute malware or other harmful software.<br>
</p>
<h4>5. Intellectual Property</h4>

<p> The Application and all of its Content is protected by copyright, trademark, and other intellectual property laws.
 You are not authorized to use the Content without the prior written consent of the Company or its licensor.
 You are not authorized to copy, modify, create derivative works, publicly display, publicly perform, distribute, or transfer the Content without the prior written consent of the Company or its licensor.
</p>
<h4>6. Termination</h4>

<p> The Company may terminate your account and your access to the Application at any time, in its sole discretion.
 Upon termination, you must cease using the Application and return or destroy all Content that you have downloaded or obtained through the Application.
</p>
<h4>7. Disclaimer of Warranties</h4>

<p> THE APPLICATION IS PROVIDED "AS IS" AND "AS AVAILABLE" WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE WARRANTIES OF ACCURACY, COMPLETENESS, NON-INFRINGEMENT, MERCHANTABILITY, AND FITNESS FOR A PARTICULAR PURPOSE.
 THE COMPANY DOES NOT WARRANT THAT THE APPLICATION WILL BE UNINTERRUPTED OR ERROR-FREE.
 THE COMPANY SHALL NOT IN ANY EVENT BE LIABLE FOR ANY DAMAGES, DIRECT, INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL, OR EXEMPLARY, ARISING OUT OF OR IN CONNECTION WITH THE USE OF THE APPLICATION, EVEN IF THE COMPANY HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES.
</p>
<h4>8. Limitation of Liability</h4>

<p> THE COMPANY'S TOTAL LIABILITY FOR ANY CLAIMS ARISING OUT OF OR IN CONNECTION WITH THE USE OF THE APPLICATION SHALL NOT EXCEED THE AMOUNT YOU PAID FOR ACCESS TO THE APPLICATION.
</p>
<h4>9. Indemnification</h4>

<p> You agree to indemnify, defend, and hold harmless the Company, its officers, directors, employees, agents, and licensors from and against any and all claims, losses, damages, liabilities, costs, and expenses (including reasonable attorneys' fees) arising out of or in connection with your use of the Application, your violation of these Terms, or your violation of any rights of any other person or entity.
</p>
<h4>10. Governing Law</h4>

<p> These Terms shall be governed by and construed in accordance with the laws of the State of [State Name], without regard to its conflict of laws principles.
</p>
<h4>11. Severability</h4>

<p> If any provision of these Terms is held to be invalid or unenforceable, such provision shall be struck from these Terms and the remaining provisions shall remain in full force and effect.
</p>
<h4>12. Waiver</h4>

<p> No waiver of any provision of these Terms shall be effective unless in writing and signed by both you and the Company.
</p>
<h4>13. Entire Agreement
</h4>
<p>These Terms constitute the entire agreement between you and the Company with respect to the use of the Application and supersede all prior or contemporaneous communications and agreements, whether oral or written.
</p>
<h4>14. Updates to the Terms</h4>

<p>The Company may update these Terms at any time by posting a revised version on the Application. You are responsible for checking the Terms periodically for updates. By continuing to use the Application after any changes to the Terms are posted, you agree to be bound by the revised Terms.
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
