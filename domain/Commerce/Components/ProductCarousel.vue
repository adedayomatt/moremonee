<template>
    <div :id="`product-${product.id}-carousel`" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button
                v-for="(media, i) in product.media" :key="i"
                type="button"
                :data-bs-target="`#product-${product.id}-carousel`"
                :data-bs-slide-to="i" :class="{'active': i === 0}" :aria-current="i === 0"
                :aria-label="`Slide ${i + 1}`"></button>
        </div>
        <div class="carousel-inner">
            <div
                v-for="(media, i) in product.media"
                class="carousel-item"
                :class="{'active':  i == 0}"
            >
                <img
                    v-if="media.type === 'image'"
                    :src="media.url"
                    class="d-block w-100"
                    :alt="product.name">
                <video
                    v-else-if="media.type === 'video'"
                    :src="media.url"
                    class="d-block w-100"
                    controls
                    :alt="product.name">
                </video>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" :data-bs-target="`#product-${product.id}-carousel`" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" :data-bs-target="`#product-${product.id}-carousel`" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</template>

<script>
export default {
    name: "ProductCarousel",
    components: {},
    props: {
        product: Object,
    },
    computed: {},
    data() {
        return {}
    },
    methods: {},
}
</script>

