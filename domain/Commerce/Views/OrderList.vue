<template>
    <div class="container py-4">
        <h2>Orders - {{ orders.total | numberFormat }}</h2>
        <p class="text-muted">{{ tempUser.email }}</p>
        <div v-if="orders.total">
            <div class="bg-white rounded-lg overflow-auto">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Ref</th>
                            <th scope="col">Email</th>
                            <th scope="col">Total</th>
                            <th scope="col">Billing Name</th>
                            <th scope="col">Shipping Name</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="order in orders.data" :key="order.id">
                            <td>
                                <inertia-link :href="route('order.view', [order.reference])">
                                    {{ order.reference }}
                                </inertia-link>
                                <div class="small text-muted">  {{ order.created_at | datetime }}</div>
                            </td>
                            <td>{{ order.email }}</td>
                            <td>{{ order.totalAmount | money(order.currency) }}</td>
                            <td>{{ [order.billing.first_name, order.billing.last_name].join(" ") }}</td>
                            <td>{{ [order.shipping.first_name, order.shipping.last_name].join(" ") }}</td>
                            <td><span :class="`badge badge-${order.status == 'completed' ? 'success' : 'warning'}`">{{ order.status }}</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-5">
                <pagination :links="orders" />
            </div>
        </div>
        <div v-else class="text-muted text-center py-5">
            <h2>No order found</h2>
            <p>No order has been created for {{ tempUser.email }} yet</p>
        </div>
    </div>
</template>

<script>
import LayoutApp from "../Layout";

import {mapGetters} from "vuex";
export default {
    name: 'Orders',
    components: {  },
    layout: (h, page) => h(LayoutApp, [page]),
    props: {
        orders: Object,
    },
    computed: {
        ...mapGetters(['tempUser'])
    }
}
</script>

