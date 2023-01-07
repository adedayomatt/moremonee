<template>
    <div class="container py-4">
        <div class="text-center">
            <h1 class="text-primary strong">Establish and build your business with MoreMonee.</h1>
            <p>Moremonee provides banking solutions that give you the freedom to make quick and easy payments, access loans, make more Profits and help you grow faster financially.</p>
            <a
                href="https://moremoneegroup.com/"
                target="_blank"
                class="btn btn-primary"
            >Get to know more</a>
        </div>
        <hr class="my-5" />
        <h2 class="text-center">Available POS</h2>
        <div v-if="products.total">
            <div  class="row justify-content-center">
               <div v-for="product in products.data" class="col-lg-4 col-md-6">
                   <product
                       :product="product"
                       :key="product.id"
                       class="m-2"
                   />
               </div>
            </div>
            <div class="d-flex justify-content-center mt-5">
                <pagination :links="products" />
            </div>
        </div>
        <div v-else class="text-muted text-center">
            <h2>No POS available for purchase at the moment</h2>
            <p>You can check back later</p>
        </div>
    </div>
</template>

<script>
import LayoutApp from "../Layout";
import Product from "../Components/Product";
import {mapGetters} from "vuex";
export default {
    name: 'Products',
    components: { Product },
    layout: (h, page) => h(LayoutApp, [page]),
    props: {
        products: Object,
    },
    computed: {
        ...mapGetters(['cart', 'cartItemsTotal'])
    }
}
</script>

