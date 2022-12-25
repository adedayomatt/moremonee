<template>
    <div>
        <modal
            ref="modal"
            :title="product.name"
            size="lg"
        >
            <p>{{ product.description }}</p>
            <product-media :product="product" />
        </modal>
        <div class="row bg-white rounded-lg shadow-lg">
            <div class="col-md-4 px-0 mx-0 text-center">
                <div class="p-2">
                    <img
                        :src="preview"
                        class="w-100 rounded-start rounded-lg cursor-pointer"
                        @click="$refs.modal.show()"
                    />
                    <span
                        :class="`my-1 translate-middle badge rounded-pill text-white ${inStock ? 'bg-success' : 'bg-danger'}`">
                    {{ inStock ? 'In stock' : 'Out of stock' }}
                    </span>
                </div>

            </div>
            <div class="col-md-8">
                <div class="p-3 mt-4">
                    <div class="d-flex justify-content-between">
                        <a href="#" @click.prevent="$refs.modal.show()">
                            <h2 class="text-primary">{{ product.name }}</h2>
                        </a>
                        <h4 class="strong">{{ product.price | money(product.currency) }}</h4>
                    </div>
                    <p class="text-truncate">{{ product.short_description }}</p>
                    <small class="text-muted">Enter quantity to purchase</small>
                    <product-cart-item-quantity :product="product" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ProductCartItemQuantity from "./ProductCartItemQuantity";
import ProductMedia from "./ProductMedia";

export default {
    name: "Product",
    components: { ProductMedia, ProductCartItemQuantity },
    props: {
        product: Object,
    },
    computed: {
        inStock() {
            return this.product.in_stock > 0;
        },
        preview() {
            return this.product.preview && this.product.preview.url
                ? this.product.preview.url : null;
        }
    },
    data() {
        return {}
    },
    methods: {},
}
</script>

