<template>
    <span class="spinner-border spinner-border-sm" role="status" v-if="loading">
        <span class="sr-only">Loading...</span>
    </span>
</template>

<script>
    export default {
        name: "Loading",
        props: ['loading'],
    }
</script>
