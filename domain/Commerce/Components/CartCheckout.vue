<template>
    <form @submit.prevent class="row justify-content-md-center w-100 align-items-center" >
        <div class="col-12 col-md-3">
            <h4>Total: {{ cartTotal | money($page.props.config.default_currency) }}</h4>
        </div>
        <div class="col-12 col-md-4">
            <app-input
                v-model="form.email"
                type="email"
                name="email"
                placeholder="you@example.com"
            />
        </div>
        <div class="col-12 col-md-5">
            <div class="d-flex mt-2 mt-md-0">
                <app-button
                    :loading="loading"
                    class="btn btn-primary mx-1"
                    :disabled="cart.length == 0"
                    @click="checkout">
                    Checkout
                </app-button>
                <app-button
                    class="btn btn-outline-danger mx-1"
                    :disabled="cart.length == 0"
                    type="button"
                    @click="clearCart">
                    Clear cart
                </app-button>
                <app-button
                    class="btn btn-primary ml-auto"
                    type="button"
                    @click="$inertia.visit(route('orders', [form.email]))"
                >My Orders
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
            form: {}
        };
    },
    computed: {
        ...mapGetters(['cart', 'cartTotal', 'tempUser'])
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
            await this.$inertia.post(this.route('checkout'), this.form)
            this.loading = false;
        }
    },
    watch: {
        tempUser: {
            immediate: true,
            handler(user) {
                if(user) this.form.email = user.email
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
