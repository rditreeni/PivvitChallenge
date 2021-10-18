<template>
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Purchase ID</th>
        <th>Customer Name</th>
        <th>Offering Title</th>
        <th>Quantity</th>
        <th>Unit Price</th>
        <th>Total Price</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(purchase, index) in purchases" :key="index">
        <td>{{ purchase.id }}</td>
        <td>{{ purchase.customerName }}</td>
        <td>{{ purchase.offering.title }}</td>
        <td>{{ purchase.quantity }}</td>
        <td>${{ purchase.offering.price }}</td>
        <td>${{ (purchase.offering.price * purchase.quantity).toFixed(2) }}</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      purchases: "",
    };
  },
  methods: {
    getPurchases() {
      axios.get("/api/purchases").then((response) => {
        if (response.data.purchases.length) {
          this.purchases = response.data.purchases;
        }
      });
    },
  },
  created() {
    this.getPurchases();
  },
};
</script>
