<template>
    <div>
        <div
            v-for="(media, i) in product.media" :key="i"
            class="my-2"
        >
            <img
                v-if="media.type === 'image'"
                :src="media.url"
                class="d-block mx-auto"
                height="500px"
                width="auto"
                :alt="product.name">
            <video
                v-else-if="media.type === 'video'"
                :src="media.url"
                class="d-block w-100 mx-auto"
                controls
            >
            </video>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProductMedia",
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

