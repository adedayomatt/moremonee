<template>
    <div>
        <h2 class="mb-3">Payment</h2>
        <h6 class="text-muted">{{ order.reference }}</h6>
        <credit-card
            v-if="!transaction || startOver"
            @input="submitCard"
            :loading="ui.submittingCard" />
        <otp-validation
            v-else-if="transaction.action_required == 'otp'"
            @input="validateOtp"
            :loading="ui.validatingOtp"
        />
        <redirect v-else-if="transaction.action_required == 'redirect'" @callback="postCallback"/>
        <div v-else-if="transaction.action_required == 'verify_transaction'"
             class="text-center py-5">
            <h2>Verifying transaction...</h2>
            <p class="text-muted">Please hold on, while your transaction is verified...</p>
        </div>
        <div v-else-if="transaction.action_required == 'retry_verification'"
             class="text-center py-5">
            <h2 class="text-danger">Could not verify transaction</h2>
            <p class="text-muted">{{ transaction.message }}</p>
            <app-button
            class="btn btn-outline-primary btn-block my-2"
            @click="verifyTransaction"
            :loading="ui.verifyingTransaction"
            >Try Again</app-button>
            <app-button
                class="btn btn-primary btn-block my-2"
                @click="startOver = true"
            >Re-Attempt Payment</app-button>
        </div>
    </div>
</template>

<script>
import LayoutApp from "../../Layout";
import Checkout from "./Index";
import { mapMutations } from "vuex";
import CreditCard from "../../Components/Payment/CreditCard";
import OtpValidation from "../../Components/Payment/OtpValidation";
import Redirect from "../../Components/Payment/Redirect";

export default {
    name: 'CheckoutPayment',
    components: {Redirect, OtpValidation, CreditCard},
    layout: (h, page) => h( LayoutApp, [h(Checkout, [page])]),
    data() {
        return {
            startOver: false,
            ui: {
                submittingCard: false,
                validatingOtp: false,
                verifyingTransaction: false,
            },
        }
    },

    props: {
        order: Object,
    },

    computed: {
        errors() {
            return this.$page.props.errors
        },
        transaction() {
            return this.$page.props.transaction
        }
    },
    methods: {
        ...mapMutations([
            'SET_TOAST'
        ]),

        async submitCard(card) {
            this.ui.submittingCard = true;
            await this.$inertia.post(this.route('order.pay', [this.order.reference]), card)
            this.ui.submittingCard = false;
        },

        async validateOtp(data) {
            this.ui.validatingOtp = true;
            await this.$inertia.post(route("otp.validate", [ this.transaction.transaction.reference ]), {
                otp: data.otp,
            },{
                onSuccess: () => {

                },
                onError: e => {

                }
            })
            this.ui.validatingOtp = false;
        },

        async verifyTransaction() {
            this.ui.verifyingTransaction = true;
            await this.$inertia.post(route("transaction.verify", [ this.transaction.transaction.reference ]));
            this.ui.verifyingTransaction = false;
        },

        async postCallback(data) {
            await this.$inertia.post(route('post.flw.callback'), data);
        }
    },

    watch: {
        $page: {
            immediate: true,
            handler(page) {
                if(page.props.transaction) {
                    const actionRequired = page.props.transaction.action_required;
                    switch (actionRequired) {
                        case "verify_transaction":
                            this.verifyTransaction();
                            break;
                        case "terminate":
                            this.$inertia.visit(route("checkout.view"));
                            break;
                    }
                }
            }
        }
    }
}
</script>


