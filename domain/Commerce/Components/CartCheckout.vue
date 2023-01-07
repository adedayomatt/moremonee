<template>
    <form @submit.prevent class="row justify-content-md-center w-100 align-items-center" >
        <div class="col-12 col-md-3">
            <h4>Total: {{ cartTotal | money(currency) }}</h4>
        </div>
        <div class="col-12 col-md-4">
            <app-input
                v-model="email"
                type="email"
                name="email"
                placeholder="you@example.com"
            />
        </div>
        <div class="col-12 col-md-5">
            <div class="d-flex mt-2 mt-md-0">
                <app-button
                    :loading="loading"
                    class="btn btn-sm btn-primary mx-1"
                    :disabled="cart.length == 0"
                    @click="checkout">
                    <i class="fe fe-log-out"></i>
                    Checkout
                </app-button>
                <app-button
                    class="btn btn-sm btn-outline-danger mx-1"
                    :disabled="cart.length == 0"
                    type="button"
                    @click="clearCart">
                    <i class="fe fe-x"></i>
                    Clear cart
                </app-button>
                <app-button
                    class="btn btn-sm btn-primary ml-auto"
                    type="button"
                    :disabled="!email"
                    @click="$inertia.visit(route('orders', [email]))"
                ><i class="fe fe-box"></i> My Orders
                </app-button>
            </div>
        </div>
    </form>
</template>

<script>
import {mapGetters, mapMutations} from "vuex";
export default {
    name: "CartCheckout",
    data() {
        return {
            loading: false,
            email: null
        };
    },
    computed: {
        ...mapGetters(['cart', 'cartTotal', 'tempUser', 'currency'])
    },
    methods: {
        ...mapMutations([
            'SET_TOAST'
        ]),
        clearCart() {
            this.$store.dispatch('clearCartItem').then(() => {
                this.SET_TOAST({
                    show: true,
                    message: "Cart cleared"
                })
                this.$emit("cart-cleared");
            })
        },
        async checkout() {
            this.loading = true;
            await this.$inertia.post(this.route('checkout'), { email: this.email })
            this.loading = false;
        },
    },
    watch: {
        $page: {
            immediate: true,
            handler() {
                this.email = this.$store.getters.tempUser.email;
            }
        }
    }
}
</script>

<style scoped>
    .form-group {
        margin-bottom: 0 !important;
    }
</style>
