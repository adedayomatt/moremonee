<template>
    <form class="needs-validation" ref="form" novalidate="" @submit.prevent="submit">
        <p>{{ transaction.message }}</p>
        <address-input
            v-model="form"
            name="address"
            :fill="order.billing.address"
        />
        <app-button
            class="btn btn-primary btn-block"
            :loading="loading"
            type="submit">Submit</app-button>
    </form>
</template>

<script>
import AddressInput from "../../../../resources/js/components/AddressInput";
export default {
    name: "VerifyAddress",
    components: {AddressInput},
    computed: {
        transaction() {
            return this.$page.props.transaction
        }
    },
    props: {
        loading: Boolean,
        order: Object,
    },
    data() {
        return {
            form: {}
        }
    },

    methods: {
    submit() {
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

