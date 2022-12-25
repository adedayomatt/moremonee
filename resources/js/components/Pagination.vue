<template>
        <div class="pagination" v-if="links.next_page_url && links.prev_page_url">
            <inertia-link class="page-item page-link" :href="links.first_page_url" v-if="links.first_page_url"
                          :class="{'disabled': links.current_page === 1 || !links.first_page_url}">First</inertia-link>
            <button class="page-item page-link" v-else disabled>First</button>

            <inertia-link class="page-item page-link" :href="links.prev_page_url" v-if="links.prev_page_url"
                          :class="{ 'disabled': !links.prev_page_url }">Previous</inertia-link>
            <button class="page-item page-link" v-else disabled>Previous</button>

            <inertia-link class="page-item page-link" :href="links.next_page_url" v-if="links.next_page_url"
                          :class="{ 'disabled': !links.next_page_url }">Next</inertia-link>
            <button class="page-item page-link" v-else disabled>Next</button>

            <inertia-link class="page-item page-link" :href="links.last_page_url" v-if="links.last_page_url"
                    :class="{ 'disabled': links.current_page === links.last_page || !links.last_page_url }"
            >Last</inertia-link>
            <button class="page-item page-link" v-else disabled>Last</button>
        </div>
</template>

<script>
    export default {
        name: "Pagination",
        props: {
            links: { type: Object, required: true },
            size: String,
        },
        computed: {

        },
    }
</script>

<style scoped>

</style>
