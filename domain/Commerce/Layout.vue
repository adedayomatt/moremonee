<template>
        <div>
            <cart-modal ref="cart" />
            <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="topnav">
                <div class="container px-2 align-items-center">
                    <!-- Brand -->
                    <inertia-link class="navbar-brand mr-auto" :href="route('commerce', [$store.getters.currency])">
                        <div class="d-flex align-items-center">
                            <img
                                :src="config.logo_url"
                                :alt="config.business_name"
                                class="navbar-brand-img">
                            <h3 class="text-primary ml-2">{{ config.business_name }}</h3>
                        </div>
                    </inertia-link>
                    <div v-if="config.enable_multiple_currency" class="mx-2" style="width: 180px">
                        <x-select
                            :options="config.currencies || []"
                            :value="$store.getters.currency"
                            @input="currencyChange"
                            class="mr-2 w-100"
                        />
                    </div>
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
            <div v-if="route().current('commerce') || route().current('orders')" class="pb-5"></div>
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
    data() {
        return {}
    },
    computed: {
        ...mapGetters([
            'cart', 'toast'
        ]),
        config() {
            return this.$page.props.config;
        },
    },
    methods: {
        ...mapActions([
            'clearCartItem'
        ]),
        ...mapMutations([
            'SET_TOAST', 'SET_TEMP_USER', 'SET_CURRENCY'
        ]),
        currencyChange(currency) {
            if(!currency){
                this.SET_TOAST({
                    show: true,
                    type: "danger",
                    message: "You need to select a currency"
                })
                return;
            }
            this.SET_CURRENCY(currency);
            this.$inertia.visit(route('commerce', { currency }), {
                onSuccess: () => {
                    this.clearCartItem();
                }
            })
        }
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
                        stick: toast.stick
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
                    this.SET_TEMP_USER(page.props.tempUser);
                }
                this.SET_CURRENCY(page.props.tempUser?.currency || page.props.config.default_currency);
                if(this.cart.length && !this.cart.every(item => item.product.currency === this.$store.getters.currency)) {
                    this.clearCartItem();
                }
            }
        },
    }
}
</script>
