<template>
    <div v-if="errorString" class="text-danger">
        {{ errorString }}
    </div>
</template>

<script>
export default {
    name: "AppError",
    props: { message: String, label: String },
    computed: {
        errors() { return this.$page.props.errors },
        errorString() {
            if (this.message) return this.message;
            if (!(this.errors && this.errors[this.label])) return null;
            const error = this.errors[this.label];
            return error.constructor === Array ? error[0] : error;
        },
    },
}
</script>

<style scoped>

</style>
