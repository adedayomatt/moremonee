<template>
    <div>
        <app-input
            v-model="item.quantity"
            placeholder="Quantity"
            min="0"
            :max="product.in_stock"
            type="number"
            :disabled="!inStock"
            append-icon="fe fe-plus"
            prepend-icon="fe fe-minus"
            @input="addToCart"
            :on-append-click="increaseCartQuantity"
            :on-prepend-click="decreaseCartQuantity"
        >
        </app-input>
        <small v-if="inStock && limitReached" class="text-danger mt-n3">Stock limit of {{ product.in_stock }} reached</small>
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
        maxLimit() {
            return this.product.in_stock;
        },
        inStock() {
            return this.product.in_stock > 0;
        },
        quantity() {
            return parseInt(this.item.quantity)
        },
        limitReached() {
            return this.quantity >= this.maxLimit
        }
    },

    methods: {
        addToCart(){
            if(!isNaN(this.quantity) && this.quantity > 0) {
                this.$store.dispatch('addCartItem', {
                    quantity: this.quantity >= this.maxLimit ? this.maxLimit : this.quantity,
                    product: this.product
                }).then(item => {
                    this.item = item;
                })
            } else if (this.item.id) {
                this.$store.dispatch('removeCartItem', this.item)
            }
        },
        increaseCartQuantity() {
            this.item.quantity++;
            if(this.limitReached) {
                this.item.quantity = this.maxLimit;
            }
            this.addToCart()
        },
        decreaseCartQuantity() {
            if(this.quantity > 0) {
                this.item.quantity--;
                this.addToCart()
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
