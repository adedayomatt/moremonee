<template>
    <modal-vertical
        ref="modal"
        title="Your Cart"
        backdrop="static"
        :keyboard="false"
        direction="right"
        size="sm"
        @close="hide"
        :has-footer="true"
    >
        <template v-if="cart.length">
            <template v-for="(item, i) in cart">
                <cart-item  :item="item" :key="item.id" />
                <hr v-if="i < (cart.length - 1)" class="my-2">
            </template>
        </template>
        <template v-else>
            <div class="text-center text-muted">
                <h3>No item added yet</h3>
            </div>
        </template>
        <template #footer>
            <div>
                <h4>Total: {{ cartTotal | money }}</h4>
            </div>
            <div class="d-flex justify-content-between align-content-center">
                <app-button
                    class="btn btn-sm btn-outline-danger mx-2"
                    :disabled="cart.length == 0"
                    @click="clearCart">
                    Clear cart
                </app-button>
                <app-button
                    class="btn btn-sm btn-primary mx-2"
                    :disabled="cart.length == 0"
                    @click="checkout">
                    Checkout
                </app-button>
            </div>
        </template>
    </modal-vertical>
</template>

<script>
import { mapGetters } from 'vuex';
import CartItem from "./CartItem";
export default {
    name: "Cart",
    components: {
        CartItem
    },
    data() {
        return {};
    },
    computed: {
        ...mapGetters(['cart', 'cartTotal'])
    },
    methods: {
        hide() {
            this.$refs.modal.hide();
        },
        show() {
            this.$refs.modal.show();
        },
        clearCart() {
            this.$store.dispatch('clearCartItem').then(() => {
                this.hide();
            })
        },
        checkout() {
            this.hide();
            this.$inertia.visit(this.route('commerce.checkout'))
        }
    }
}
</script>
