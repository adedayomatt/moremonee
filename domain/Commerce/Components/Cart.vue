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
                <hr v-if="i < (cart.length - 1)" class="my-3">
            </template>
        </template>
        <template v-else>
            <div class="text-center text-muted">
                <h3>No item added yet</h3>
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
        ...mapGetters(['cart'])
    },
    methods: {
        hide() {
            this.$refs.modal.hide();
        },
        show() {
            this.$refs.modal.show();
        },
    },
}
</script>
