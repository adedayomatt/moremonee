<template>
    <div class="row">
        <div class="col-4">
            <img :src="product.preview.url" class="w-100" />
        </div>
        <div class="col-8">
            <div class="d-flex justify-content-between">
                <h4>{{ product.name }}</h4>
                <strong>{{ product.price | money(product.currency) }}</strong>
            </div>
            <div class="text-muter">
                <div class="d-flex justify-content-between align-content-center text-muted ">
                    <span class="font-size-sm">Quantity:</span>
                    <span>{{ item.quantity }}</span>
                </div>
                <div class="d-flex justify-content-between align-content-center text-muted">
                    <span class="font-size-sm">Total:</span>
                    <span>{{ (item.quantity * product.price) | money(product.currency) }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "CartItem",
    components: { },
    props: {
        item: Object,
    },
    data() {
        return { }
    },
    computed: {
        product() {
            return this.item.product;
        }
    },
}
</script>
