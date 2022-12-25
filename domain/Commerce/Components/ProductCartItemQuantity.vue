<template>
    <div>
        <app-input
            v-model="item.quantity"
            placeholder="Quantity"
            min="0"
            :max="product.in_stock"
            type="number"
            :disabled="!inStock"
            @input="addToCart">
        </app-input>
        <div class="text-right">
            <small class="text-muted">Total: {{ (item.quantity * product.price) | money(product.currency) }}</small>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    name: "ProductCartItemQuantity",
    props: {
        product: Object,
    },
    data() {
        return {
            item: {}
        }
    },

    computed: {
        ...mapGetters([
            'cart'
        ]),
        inStock() {
            return this.product.in_stock > 0;
        },
        quantity() {
            return parseInt(this.item.quantity)
        }
    },

    methods: {
        addToCart(){
            if((!this.quantity || this.quantity <= 0) && this.item.id){
                this.$store.dispatch('removeCartItem', this.item)
            } else {
                this.$store.dispatch('addCartItem', {
                    quantity: this.quantity,
                    product: this.product
                }).then(item => {
                        this.item = item;
                    })
            }
        }
    },

    watch: {
        cart: {
            immediate: true,
            handler(cart = []) {
                const item = cart.find(item => item.product.id === this.product.id)
                if(item){
                    this.item = item;
                    return;
                }
                this.item = {
                    quantity: 0
                }
            }
        }
    }
}
</script>
