<template>
    <div :class="`avatar ${size ? ' avatar-'+size : ''}`">
        <img v-lazy="src" v-if="src" :alt="text" class="avatar-img rounded-circle">
        <span class="avatar-title rounded-circle" v-else-if="text">{{ text }}</span>
        <span class="avatar-title rounded-circle" v-else><i :class="icon || 'fe fe-user h4 mb-0'"></i></span>
    </div>
</template>

<script>
    export default {
        name: "Avatar",
        props: {
            text: String,
            src: String,
            icon: String,
            size: String,
        },
    }
</script>

<style scoped>

</style>
