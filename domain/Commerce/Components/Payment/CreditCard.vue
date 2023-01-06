<template>
    <form class="needs-validation" ref="form" novalidate="" @submit.prevent="submit">
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
                    required />
                <div class="invalid-feedback">
                    Name on card is required
                </div>
            </div>
            <div class="col-12">
                <label for="cc-number">Credit card number</label>
                <app-input
                    v-model="form.card_number"
                    type="text"
                    placeholder="1234567890"
                    name="card_number"
                    :errors="errors"
                    required
                />
                <div class="invalid-feedback">
                    Credit card number is required
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <label for="cc-expiration">Expiration</label>
                <app-input
                    v-model="form.expiry"
                    type="text"
                    placeholder="01/25"
                    name="expiry"
                    :errors="errors"
                    required />
                <div class="invalid-feedback">
                    Expiration date required
                </div>
            </div>
            <div class="col-6">
                <label for="cc-expiration">CVV</label>
                <app-input
                    v-model="form.cvv"
                    type="text"
                    placeholder="123"
                    name="cvv"
                    :errors="errors"
                    required
                />
                <div class="invalid-feedback">
                    Security code required
                </div>
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
                name_on_card: "Adedayo Matthews",
                card_number: "5531886652142950",
                expiry: "09/32",
                cvv: "564"
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

