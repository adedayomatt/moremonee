<template>
    <form class="needs-validation" ref="form" novalidate="" @submit.prevent="submit">
        <p>{{ transaction.message }}</p>
        <label for="cc-pin">Card pin</label>
        <app-input
            v-model="form.card_pin"
            type="password"
            id="cc-pin"
            placeholder="XXXX"
            name="card_pin"
            required
            prepend-icon="fe fe-lock"
        />
        <app-button
            class="btn btn-primary btn-block"
            :loading="loading"
            type="submit">Submit</app-button>
    </form>
</template>

<script>

export default {
    name: "CardPin",
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

