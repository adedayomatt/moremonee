<template>
    <div class="container">
        <modal-confirmation
            ref="confirmation"
            :title="confirmation.title"
            :on-confirm="confirmation.onConfirm"
        >
            {{ confirmation.body }}
        </modal-confirmation>
        <div class="py-2 text-center">
            <h1 class="text-primary">Checkout</h1>
        </div>
        <div v-if="cartItemsTotal" class="row justify-content-center">
            <div class="col-md-4 order-md-2 mb-4 py-3">
                <div class="bg-white shadow-lg p-3 rounded">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Your cart</span>
                        <span class="badge badge-primary badge-pill">{{ cartItemsTotal }}</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li
                            v-for="item in cart" :key="item.id"
                            class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">{{ item.product.name }}</h6>
                                <small class="text-muted">{{ item.product.short_description }}</small>
                            </div>
                            <span class="text-muted">{{ item.product.price | money(item.product.currency) }} x {{ item.quantity }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total</span>
                            <strong>{{ cartTotal | money($store.getters.currency) }}</strong>
                        </li>
                    </ul>
                    <app-button v-if="!order"
                        class="btn btn-sm btn-outline-danger"
                        @click="clearCart">
                        Clear all items
                    </app-button>
                    <app-button v-else
                        class="btn btn-sm btn-outline-danger mx-2"
                        @click="confirmCancel">
                        Cancel order
                    </app-button>
                </div>
            </div>
            <div class="col-md-6 order-md-1 py-3">
                <slot>
                    <form class="needs-validation" ref="checkoutForm" novalidate="" @submit.prevent="submit">
                    <h2 class="mb-3">Billing address</h2>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <app-input
                                v-model="checkout.billing.first_name"
                                type="text"
                                name="billing.first_name"
                                placeholder="First Name"
                                required />
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <app-input
                                v-model="checkout.billing.last_name"
                                type="text"
                                placeholder="Last Name"
                                name="billing.last_name"
                                required />
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <app-input
                            v-model="checkout.billing.email"
                            type="email"
                            placeholder="you@example.com"
                            name="billing.email"
                            required
                        />
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

<!--                    <div class="mb-3">-->
<!--                        <label for="address">Address</label>-->
<!--                        <app-input-->
<!--                            v-model="checkout.billing_address"-->
<!--                            type="text"-->
<!--                            placeholder="1234 Main St"-->
<!--                            name="billing_address"-->
<!--                            required />-->
<!--                        <div class="invalid-feedback">-->
<!--                            Please enter your shipping address.-->
<!--                        </div>-->
<!--                    </div>-->

<!--                    <div class="mb-3">-->
<!--                        <label for="address2">City</label>-->
<!--                        <app-input-->
<!--                            v-model="checkout.billing_city"-->
<!--                            type="text"-->
<!--                            placeholder="Apartment or suite"-->
<!--                            name="billing_city"-->
<!--                            required-->
<!--                        />-->
<!--                    </div>-->

<!--                    <div class="row">-->
<!--                        <div class="col-md-5 mb-3">-->
<!--                            <label for="country">Country</label>-->
<!--                            <x-select-->
<!--                                v-model="checkout.billing_country"-->
<!--                                :options="['USA']"-->
<!--                                id="country"-->
<!--                                />-->
<!--                            <span v-if="errors && errors.billing_country" class="text-danger">-->
<!--                              {{ errors.billing_country }}-->
<!--                            </span>-->
<!--                        </div>-->
<!--                        <div class="col-md-4 mb-3">-->
<!--                            <label for="state">State</label>-->
<!--                            <x-select-->
<!--                                v-model="checkout.billing_state"-->
<!--                                :options="['California']"-->
<!--                                id="state" />-->
<!--                            <span v-if="errors && errors.billing_state" class="text-danger">-->
<!--                              {{ errors.billing_state }}-->
<!--                            </span>-->
<!--                        </div>-->
<!--                        <div class="col-md-3 mb-3">-->
<!--                            <label for="zip">Zip</label>-->
<!--                            <app-input-->
<!--                                v-model="checkout.billing_zip"-->
<!--                                type="text"-->
<!--                                placeholder="000000"-->
<!--                                name="billing_zip"-->
<!--                                required />-->
<!--                            <div class="invalid-feedback">-->
<!--                                Zip code required.-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->

                    <address-input
                        v-model="checkout.billing.address"
                        name="billing.address"
                        :fill="lastOrder ? lastOrder.billing.address: null"
                    />

                    <div class="custom-control custom-checkbox mb-4">
                        <input v-model="use_billing_for_shipping" type="checkbox" class="custom-control-input" id="same-address">
                        <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
                    </div>

                    <template v-if="!use_billing_for_shipping">
                        <hr class="mb-4">
                        <h2 class="mb-3">Shipping address</h2>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">First name</label>
                                <app-input
                                    v-model="checkout.shipping.first_name"
                                    type="text"
                                    placeholder="First Name"
                                    name="shipping.first_name"
                                    required />
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Last name</label>
                                <app-input
                                    v-model="checkout.shipping.last_name"
                                    type="text"
                                    placeholder="Last name"
                                    name="shipping.last_name"
                                    required />
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email">Email <span class="text-muted">(Optional)</span></label>
                            <app-input
                                v-model="checkout.shipping.email"
                                type="email"
                                placeholder="you@example.com"
                                name="shipping.email"
                            />
                            <div class="invalid-feedback">
                                Please enter a valid email address for shipping updates.
                            </div>
                        </div>

                        <address-input
                            v-model="checkout.shipping.address"
                            name="shipping.address"
                            :fill="lastOrder ? lastOrder.shipping.address: null"
                        />

<!--                        <div class="mb-3">-->
<!--                            <label for="address">Address</label>-->
<!--                            <app-input-->
<!--                                v-model="checkout.shipping_address"-->
<!--                                type="text"-->
<!--                                placeholder="1234 Main St"-->
<!--                                name="shipping_address"-->
<!--                                required />-->
<!--                            <div class="invalid-feedback">-->
<!--                                Please enter your shipping address.-->
<!--                            </div>-->
<!--                        </div>-->

<!--                        <div class="mb-3">-->
<!--                            <label for="address2">City</label>-->
<!--                            <app-input-->
<!--                                v-model="checkout.shipping_city"-->
<!--                                type="text"-->
<!--                                placeholder="Apartment or suite"-->
<!--                                name="shipping_city"-->
<!--                                required-->
<!--                            />-->
<!--                        </div>-->

<!--                        <div class="row">-->
<!--                            <div class="col-md-5 mb-3">-->
<!--                                <label for="country">Country</label>-->
<!--                                <x-select-->
<!--                                    v-model="checkout.shipping_country"-->
<!--                                    :options="['USA']"-->
<!--                                    id="country"-->
<!--                                />-->
<!--                                <span v-if="errors && errors.shipping_country" class="text-danger">-->
<!--                                  {{ errors.shipping_country }}-->
<!--                                </span>-->
<!--                            </div>-->
<!--                            <div class="col-md-4 mb-3">-->
<!--                                <label for="state">State</label>-->
<!--                                <x-select-->
<!--                                    v-model="checkout.shipping_state"-->
<!--                                    :options="['California']"-->
<!--                                    id="state" />-->
<!--                                <span v-if="errors && errors.shipping_state" class="text-danger">-->
<!--                                  {{ errors.shipping_state }}-->
<!--                                </span>-->
<!--                            </div>-->
<!--                            <div class="col-md-3 mb-3">-->
<!--                                <label for="zip">Zip</label>-->
<!--                                <app-input-->
<!--                                    v-model="checkout.shipping_zip"-->
<!--                                    type="text"-->
<!--                                    placeholder="000000"-->
<!--                                    name="shipping_zip"-->
<!--                                    required />-->
<!--                                <div class="invalid-feedback">-->
<!--                                    Zip code required.-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->

                    </template>
                    <app-button class="btn btn-primary btn-lg btn-block" :loading="loading" type="submit">Continue to Payment</app-button>
                </form>
                </slot>
                <div class="text-success text-center mt-5">
                    <small class="text-muted">
                        <i class="fe fe-lock"></i>
                        Your information is transmitted securely
                    </small>
                </div>
            </div>
        </div>
        <div v-else class="d-flex justify-content-center align-content-center text-center">
            <div>
                <h4 class="text-muted mb-5">No item added</h4>
                <app-button class="btn btn-sm btn-primary" @click="$inertia.visit(route('commerce'))">Add items</app-button>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters, mapMutations} from 'vuex';
import LayoutApp from "../../Layout";
import CartItem from "../../Components/CartItem";
import AddressInput from "../../../../resources/js/components/AddressInput";

export default {
    name: 'CheckoutIndex',
    components: {AddressInput, CartItem },
    layout: (h, page) => h( LayoutApp, [page]),
    data() {
        return {
            loading: false,
            modal: {
                title: "",
                content: ""
            },
            use_billing_for_shipping: true,
            checkout:{
                billing: {},
                shipping: {},
            },
            confirmation: {
                body: "",
                onConfirm: () => Promise.resolve(),
            }
        }
    },
    props: {
        lastOrder: Object,
    },
    computed: {
        ...mapGetters(['cart', 'cartTotal', 'cartItemsTotal', 'tempUser']),
        order() {
            return this.$page.props.order;
        },
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
        async submit() {
            const form = this.$refs.checkoutForm;
            if(!form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }
            if(this.use_billing_for_shipping) this.setShippingToBilling();
            this.checkout.items = this.cart.map(item => {
                return {
                    product_id: item.product.id,
                    quantity: item.quantity
                }
            });

            this.loading = true;
            if(this.order) {
                await this.$inertia.put(this.route('order.update', [this.order.reference]), {...this.checkout, status: "pending"})
            } else {
                await this.$inertia.post(this.route('order.create'), this.checkout, {
                    onError: (error) => {
                        this.SET_TOAST({
                            show: true, type: "danger",
                            message: "There was an error creating your order, please check the information provided and try again"
                        })
                    }
                });
            }
            this.loading = false;
        },

        setShippingToBilling() {
            this.checkout.shipping = this.checkout.billing;
        },

        clearCart() {
            this.$store.dispatch('clearCartItem').then(() => {
                this.$inertia.visit(this.route('commerce'));
            })
        },

        confirmCancel() {
            this.confirmation = {
                title: "Cancel order ?",
                body: "Are you sure you want to cancel the order ?",
                onConfirm: this.cancelOrder
            }
            this.$refs.confirmation.show();
        },

        cancelOrder() {
            return new Promise(async (resolve) => {
                await this.$inertia.put(route('order.cancel',[this.order.reference]))
                resolve();
            })
        },

    },
    watch: {
        lastOrder: {
            immediate: true,
            handler(order) {
                if(order && !this.order) {
                    this.checkout = {
                        billing: order.billing,
                        shipping: order.shipping
                    }
                }
            }
        },
        order: {
            immediate: true,
            handler(order) {
                if(order && order.billing && order.shipping) {
                    this.checkout = {
                        billing: order.billing,
                        shipping: order.shipping
                    }
                }
            }
        },
        tempUser: {
            immediate: true,
            handler(user) {
                if (user) {
                    this.checkout.billing.email = this.checkout.billing.email ? this.checkout.billing.email : user.email,
                    this.checkout.shipping.email = this.checkout.shipping.email ? this.checkout.shipping.email : user.email
                }
            }
        }
    }
}
</script>

