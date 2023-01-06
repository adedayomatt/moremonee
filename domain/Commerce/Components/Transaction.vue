<template>
    <ul class="list-group mb-3">
        <li
            v-for="item in items"
            class="list-group-item">
            <small class="text-muted">{{ item.label }}</small>
            <div><strong>{{ item.value }}</strong></div>
        </li>
    </ul>
</template>

<script>
export default {
    name: "Transaction",
    components: { },
    props: {
        transaction: Object,
    },
    data() {
        return { }
    },
    computed: {
        items() {
            return [
                { label: "Reference", value: this.transaction.reference },
                { label: "Amount", value: this.$options.filters.money(this.transaction.amount, this.transaction.currency)  },
                { label: "Status", value: this.transaction.status },
                { label: "Time", value: this.$options.filters.datetime(this.transaction.created_at) }
            ]
        }
    },
}
</script>
