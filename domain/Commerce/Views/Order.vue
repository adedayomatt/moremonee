<template>
    <div class="container py-4">
        <div class="shadow-lg rounded-lg p-1 p-md-3">
            <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Order {{ order.reference }}</h1>
                <h4>status: <span :class="`badge badge-${order.status == 'completed' ? 'success' : 'warning'}`">{{ order.status }}</span></h4>
                <small class="text-muted">Created {{ order.created_at | datetime }}</small>
                <h2>Items</h2>
                <ul class="list-group mb-3">
                    <li
                        v-for="item in order.order_items" :key="item.id"
                        class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h4 class="my-0">{{ item.product.name }}</h4>
                            <small class="text-muted">{{ item.product.short_description }}</small>
                        </div>
                        <span class="text-muted">{{ item.amount | money(item.currency) }} x {{ item.quantity }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total</span>
                        <strong>{{ order.totalAmount | money(order.currency) }}</strong>
                    </li>
                </ul>
                <h2>Billing</h2>
                <ul class="list-group mb-3">
                    <li
                        v-for="item in billing"
                        class="list-group-item d-flex justify-content-between">
                        <span class="text-muted">{{ item.label }}</span>
                        <strong>{{ item.value }}</strong>
                    </li>
                </ul>
                <h2>Shipping</h2>
                <ul class="list-group mb-3">
                    <li
                        v-for="item in shipping"
                        class="list-group-item d-flex justify-content-between">
                        <span class="text-muted">{{ item.label }}</span>
                        <strong>{{ item.value }}</strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <h2>Payment(s)</h2>
                <div v-if="order.transactions.length">
                    <transaction
                        v-for="transaction in order.transactions" :key="transaction.id"
                        :transaction="transaction" class="my-2" />
                </div>
                <div v-else class="py-5 text-muted text-center">
                    <small>No payment attempt for this order</small>
                </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
import LayoutApp from "../Layout";
import Transaction from "../Components/Transaction";
export default {
    name: 'Order',
    components: {Transaction},
    layout: (h, page) => h(LayoutApp, [page]),
    props: {
        order: Object,
    },
    computed: {

        billing() {
            return [
                { label: "First Name", value: this.order.billing.first_name },
                { label: "Last Name", value: this.order.billing.last_name },
                { label: "Email", value: this.order.billing.email },
                { label: "Address", value: this.order.billing?.address?.address },
                { label: "City", value: this.order.billing?.address?.city?.name },
                { label: "State", value: this.order.billing?.address?.state?.name },
                { label: "Country", value: this.order.billing?.address?.country.name },
                { label: "Zipcode", value: this.order.billing?.address?.zipcode }
            ]
        },
        shipping() {
            return [
                { label: "First Name", value: this.order.shipping.first_name },
                { label: "Last Name", value: this.order.shipping.last_name },
                { label: "Email", value: this.order.shipping.email },
                { label: "Address", value: this.order.shipping?.address?.address },
                { label: "City", value: this.order.shipping?.address?.city?.name },
                { label: "State", value: this.order.shipping?.address?.state?.name },
                { label: "Country", value: this.order.shipping?.address?.country?.name },
                { label: "Zipcode", value: this.order.shipping?.address?.zipcode }
            ]
        }
    }
}
</script>

