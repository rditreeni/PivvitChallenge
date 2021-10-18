<template>
  <div class="row d-flex justify-content-center">
    <div class="col-xs-6 col-sm-4 col-md-8r">
      <div
        v-if="errors.length"
        class="alert alert-danger alert-dismissible fade show"
      >
        <ul id="errors">
          <li v-for="item in errors" :key="item.id">
            {{ item }}
          </li>
        </ul>
      </div>

      <div class="form-group">
        <label for="customerName">Customer Name</label>
        <input
          type="text"
          class="form-control"
          id="customerName"
          v-model="customerName"
          placeholder="Customer Name"
        />
      </div>
      <div class="form-group">
        <label for="customerName">Offering</label>
        <select class="form-control" v-model="offeringId" id="offeringId">
          <option
            v-for="offering in offerings"
            :key="offering.id"
            :value="offering.id"
            >{{ offering.title }} - {{ offering.price }}</option
          >
        </select>
      </div>
      <div class="form-group">
        <label for="customerName">Quantity</label>
        <input
          type="number"
          class="form-control"
          id="quantity"
          v-model="quantity"
          placeholder="Quantity"
          min="1"
        />
      </div>
      <div class="from-group">Total : {{ total }}</div>
      <br />
      <button type="button" class="btn btn-primary" @click="savePurchase">
        Submit
      </button>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      customerName: "",
      quantity: "",
      offeringId: "",
      offerings: [],
      errors: [],
    };
  },
  computed: {
    total() {
      if (this.quantity > 0 && this.offeringId > 0) {
        var element = this;
        var valObj = this.offerings.filter(function(elem) {
          if (elem.id == element.offeringId) return elem;
        });
        return "$" + (this.quantity * valObj[0].price).toFixed(2);
      }
      return "$" + 0;
    },
  },
  methods: {
    savePurchase() {
      this.errors = [];
      const purchase = {
        customerName: this.customerName,
        offeringID: this.offeringId,
        quantity: this.quantity,
      };

      if (
        this.customerName == "" ||
        this.offeringId == "" ||
        this.quantity == ""
      ) {
        if (this.customerName == "") {
          this.errors.push("Customer Name is required.");
        }
        if (this.offeringId == "") {
          this.errors.push("Please select offering.");
        }
        if (this.quantity == "") {
          this.errors.push("Quantity is required.");
        }
        return false;
      }

      axios
        .post("/api/purchases", purchase)
        .then((res) => {
          this.errors = [];
          if (res.status == 201) {
            this.$router.push("/");
          }
        })
        .catch((error) => {
          if (error.response.data.errors) {
            if (error.response.data.errors.customerName) {
              this.errors.push("Customer Name is required.");
            }
            if (error.response.data.errors.offeringID) {
              this.errors.push("Please select offering.");
            }
            if (error.response.data.errors.quantity) {
              this.errors.push("Quantity is required.");
            }
          }
        });
    },
    getOfferings() {
      axios.get("/api/offerings").then((response) => {
        if (response.data.offerings.length) {
          this.offerings = response.data.offerings;
        }
      });
    },
  },
  created() {
    this.errors = [];
    this.getOfferings();
  },
};
</script>
