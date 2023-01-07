<template>
    <form class="needs-validation" ref="form" novalidate="" @submit.prevent="submit">
        <p>Enter your card details below</p>
        <div class="row">
            <div class="col-12">
                <label for="cc-name">Name on card</label>
                <app-input
                    v-model="form.name_on_card"
                    type="text"
                    id="cc-name"
                    placeholder="John Doe"
                    name="name_on_card"
                    :errors="errors"
                    prepend-icon="fe fe-user"
                    required />
            </div>
            <div class="col-12">
                <label for="cc-number">Card number</label>
                <app-input
                    v-model="form.card_number"
                    type="text"
                    id="cc-number"
                    placeholder="1234567890"
                    name="card_number"
                    :errors="errors"
                    prepend-icon="fe fe-hash"
                    required
                />
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <label for="cc-expiry">Expiry</label>
                <app-input
                    v-model="form.expiry"
                    type="text"
                    id="cc-expiry"
                    placeholder="01/25"
                    name="expiry"
                    :errors="errors"
                    prepend-icon="fe fe-calendar"
                    required />
            </div>
            <div class="col-6">
                <label for="cc-cvv">CVV</label>
                <app-input
                    v-model="form.cvv"
                    type="text"
                    id="cc-cvv"
                    placeholder="123"
                    name="cvv"
                    :errors="errors"
                    prepend-icon="fe fe-lock"
                    required
                />
            </div>
        </div>
        <app-button
            class="btn btn-primary btn-block"
            :loading="loading" type="submit"
        >Make Payment</app-button>
    </form>
</template>

<script>

export default {
    name: "CreditCard",

    computed: {
        errors() {
            return this.$page.props.errors
        }
    },
    props: {
        loading: Boolean
    },
    data() {
        return {
            form: {
                name_on_card: "",
                card_number: "",
                expiry: "",
                cvv: ""
            }
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

