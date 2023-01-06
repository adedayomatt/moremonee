<template>
        <div>
            <cart-modal ref="cart" />
            <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="topnav">
                <div class="container px-2">
                    <!-- Brand -->
                    <inertia-link class="navbar-brand mr-auto" :href="route('commerce')">
                        <div class="d-flex">
                            <img
                                :src="config.logo_url"
                                :alt="config.business_name"
                                class="navbar-brand-img">
                            <h3 class="text-primary ml-2">{{ config.business_name }}</h3>
                        </div>
                    </inertia-link>

                    <div class="navbar-user position-relative">
                        <inertia-link href="#" class="navbar-user-link" role="button" @click.prevent="$refs.cart.show()">
                    <span
                        class="position-absolute text-center bg-primary text-white d-flex justify-content-center align-items-center"
                        style="height:30px; width: 30px; border-radius: 50%; right: -15px; top: -10px">
                        {{ $store.getters.cartItemsTotal >= 100 ? '99+' : $store.getters.cartItemsTotal }}
                    </span>
                            <i class="fe fe-shopping-cart" style="font-size: 28px"></i>
                        </inertia-link>
                    </div>
                </div>
                <!-- / .container -->
            </nav>
            <main class="main-content pt-6 mx-2" style="min-height: 90vh;">
                <slot />
            </main>
            <div
                v-if="toast.show"
                class="d-flex justify-content-center position-fixed w-100" style="z-index: 99999; bottom: 10px;">
                <div :class="`alert alert-${toast.type} alert-dismissible fade show mx-2`"
                     role="alert">
                    <div v-html="toast.message"></div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

            <footer class="my-5 pt-5 pb-3 text-muted text-center">
                <p class="mb-1">© {{ new Date().getFullYear() }} MoreMonee</p>
                <ul class="mt-4 list-inline font-size-lg">
                    <li v-if="config.facebook_url" class="list-inline-item">
                        <a :href="config.facebook_url" target="_blank"><i class="fe fe-facebook"></i></a>
                    </li>
                    <li v-if="config.instagram_url" class="list-inline-item">
                        <a :href="config.instagram_url" target="_blank"><i class="fe fe-instagram"></i></a>
                    </li>
                    <li v-if="config.whatsapp_url" class="list-inline-item">
                        <a :href="config.whatsapp_url" target="_blank"><i class="fe fe-phone"></i></a>
                    </li>
                </ul>
            </footer>
            <div v-if="route().current('commerce') || route().current('orders')" class="pb-4"></div>
            <nav v-if="route().current('commerce') || route().current('orders')" class="navbar fixed-bottom bg-light">
                <div class="container-fluid">
                    <cart-checkout />
                </div>
            </nav>
        </div>
</template>

<script>

import {mapActions, mapGetters, mapMutations} from 'vuex';
import CartModal from "./Components/Cart";
import CartCheckout from "./Components/CartCheckout";
export default {
    name: 'CommerceApp',
    components: {CartCheckout, CartModal},
    computed: {
        ...mapGetters([
            'cart', 'toast'
        ]),
        config() {
            return this.$page.props.config;
        }
    },
    methods: {
        ...mapActions([
            'clearCartItem'
        ]),
        ...mapMutations([
            'SET_TOAST', 'SET_TEMP_USER'
        ])
    },
    watch: {
        $page: {
            immediate: true,
            handler(page) {
                const toast = page.props.toast;
                const transaction = page.props.transaction;
                if(toast.message) {
                    this.SET_TOAST({
                        show: true,
                        type: !toast.type ? "primary" : (toast.type === "error" ? "danger" :  toast.type),
                        message: toast.message,
                    })
                }
                if(transaction) {
                    switch (transaction.action_required) {
                        case "clear_cart":
                            this.clearCartItem()
                            break;
                    }
                }
                if(page.props.tempUser) {
                    this.SET_TEMP_USER(page.props.tempUser)
                }
            }
        }
    }
}
</script>
