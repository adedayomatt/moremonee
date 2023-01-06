<template>
    <form class="needs-validation" ref="form" novalidate="" @submit.prevent="submit">
        <p v-if="transaction.message">{{ transaction.message }}</p>
        <app-input
            v-model="form.otp"
            type="text"
            placeholder="XXXXXX"
            name="otp"
            required />
        <app-button
            class="btn btn-primary btn-block"
            :loading="loading"
            type="submit">Complete Payment</app-button>
    </form>
</template>

<script>

export default {
    name: "OtpValidation",
    computed: {
        transaction() {
            return this.$page.props.transaction
        }
    },
    props: {
        loading: Boolean
    },
    data() {
        return {
            form: {}
        }
    },

    methods: {
    submit() {
        const form = this.$refs.form;
        if(!form.checkValidity()) {
            form.classList.add('was-validated');
            return;
        }
        this.$emit("input", this.form);
        }
    },
}
</script>

<style scoped>
    input {
        text-align: center;
        letter-spacing: 5px;
        font-size: 200%;
    }
</style>

