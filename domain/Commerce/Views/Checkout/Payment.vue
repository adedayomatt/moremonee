<template>
    <div>
        <h2 class="mb-3">Payment</h2>
        <h6 class="text-muted">{{ order.reference }}</h6>
        <credit-card v-if="!transaction || startOver"
            @input="submitCard"
            :loading="ui.submittingCard" />
        <card-pin v-else-if="transaction.action_required === 'provide_pin'"
          @input="submitPin"
          :loading="ui.submittingPin"/>
        <otp v-else-if="transaction.action_required === 'provide_otp'"
            @input="submitOtp"
            :loading="ui.submittingOtp"
        />
        <verify-address v-else-if="transaction.action_required === 'provide_address'"
         :order="order"
        :loading="ui.submittingAddress"
        @input="submitAddress"
        />
        <redirect v-else-if="transaction.action_required === 'redirect'"
                  @callback="postCallback"
                  @close="postCallback"/>
        <div v-else-if="transaction.action_required === 'verify_transaction'"
             class="text-center py-5">
            <h2>Verifying transaction...</h2>
            <p class="text-muted">Please hold on, while your transaction is verified...</p>
        </div>
        <div v-else-if="transaction.action_required === 'requery_transaction'"
             class="text-center py-5">
            <h2 class="text-danger">Transaction Failed</h2>
            <p class="text-muted">{{ transaction.message }}</p>
            <div>
                <app-button
                    class="btn btn-primary my-2"
                    @click="verifyTransaction"
                    :loading="ui.verifyingTransaction"
                >Requery Transaction</app-button>
            </div>
            <app-button
                v-if="transaction"
                class="btn btn-outline-primary btn-sm my-2"
                @click="startOver = true"
            > <i class="fe fe-refresh-cw"></i> Use another card</app-button>
        </div>
    </div>
</template>

<script>
import LayoutApp from "../../Layout";
import Checkout from "./Index";
import { mapMutations } from "vuex";
import CreditCard from "../../Components/Payment/CreditCard";
import Otp from "../../Components/Payment/Otp";
import CardPin from "../../Components/Payment/CardPin";
import Redirect from "../../Components/Payment/Redirect";
import VerifyAddress from "../../Components/Payment/VerifyAddress";

export default {
    name: 'CheckoutPayment',
    components: {VerifyAddress, Redirect, Otp, CreditCard, CardPin},
    layout: (h, page) => h( LayoutApp, [h(Checkout, [page])]),
    data() {
        return {
            startOver: false,
            ui: {
                submittingCard: false,
                submittingOtp: false,
                submittingPin: false,
                submittingAddress: false,
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

        async submitOtp(data) {
            this.ui.submittingOtp = true;
            await this.$inertia.post(route("otp.validate", [ this.transaction.transaction.reference ]), {
                otp: data.otp,
            })
            this.ui.submittingOtp = false;
        },

        async submitPin(data) {
            this.ui.submittingPin = true;
            await this.$inertia.post(this.route('order.pay', [this.order.reference]), {
                ...this.transaction.card,
                auth_mode: this.transaction.auth_mode,
                transaction_reference: this.transaction.transaction_reference,
                card_pin: data.card_pin,
            })
            this.ui.submittingPin = false;
        },

        async submitAddress(data) {
            this.ui.submittingAddress = true;
            await this.$inertia.post(this.route('order.pay', [this.order.reference]), {
                ...this.transaction.card,
                auth_mode: this.transaction.auth_mode,
                transaction_reference: this.transaction.transaction_reference,
                address: data,
            })
            this.ui.submittingAddress = false;
        },

        async verifyTransaction() {
            if(this.transaction.transaction.reference) {
                this.ui.verifyingTransaction = true;
                await this.$inertia.post(route("transaction.verify", [ this.transaction.transaction.reference ]));
                this.ui.verifyingTransaction = false;
            }
        },

        async postCallback(data) {
            await this.$inertia.post(route('post.flw.callback', [this.transaction.transaction.reference]), data);
        }
    },

    watch: {
        $page: {
            immediate: true,
            handler(page) {
                this.startOver = false;
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


