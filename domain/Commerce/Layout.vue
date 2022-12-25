<template>
        <div>
            <cart-modal ref="cart" />
            <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="topnav">
                <div class="container px-2">
                    <!-- Brand -->
                    <inertia-link class="navbar-brand mr-auto" :href="route('commerce')">
                        <div class="d-flex">
                            <img
                                src="./assets/moremonee_logo.png"
                                alt="MoreMonee Logo"
                                class="navbar-brand-img">
                            <h3 class="text-primary ml-2">MoreMonee POS</h3>
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
            <footer class="my-5 pt-5 pb-3 text-muted text-center">
                <p class="mb-1">© {{ new Date().getFullYear() }} MoreMonee</p>
                <ul class="mt-4 list-inline font-size-lg">
                    <li class="list-inline-item">
                        <a href="https://www.facebook.com/profile.php?id=100086742019184" target="_blank"><i class="fe fe-facebook"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://www.instagram.com/more.monee/" target="_blank"><i class="fe fe-instagram"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://api.whatsapp.com/send?phone=2347033688463" target="_blank"><i class="fe fe-phone"></i></a>
                    </li>
                </ul>
            </footer>
        </div>
</template>

<script>

import { mapGetters } from 'vuex';
import CartModal from "./Components/Cart";
export default {
    name: 'CommerceApp',
    components: {CartModal},
    computed: {
        ...mapGetters([
            'cart'
        ])
    }
}
</script>
