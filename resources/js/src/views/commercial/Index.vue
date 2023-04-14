<template>
  <div>
    <StartContractDialog
      v-if="isStartContractVisible"
      :is-start-contract-visible.sync="isStartContractVisible"
      :rate="selectRate"
      :term="selectTerm"
    />
    <b-form-row
      class="commercial-rates-filters align-items-center justify-content-end"
    >
      <b-col cols="12">
        <app-breadcrumb />
      </b-col>
      <b-col
        cols="6"
        sm="4"
        md="3"
        lg="2"
      >
        <b-form-group>
          <vue-select
            :options="zipcodes"
            v-model="filter.zipcode"
            placeholder="Zip Code"
          />
        </b-form-group>
      </b-col>
      <b-col
        cols="6"
        sm="4"
        md="3"
        lg="2"
      >
        <b-form-group>
          <vue-select
            :options="commodities"
            v-model="filter.commodities"
            placeholder="Commodity"
          />
        </b-form-group>
      </b-col>
      <b-col
        cols="6"
        sm="4"
        md="3"
        lg="2"
      >
        <b-form-group>
          <vue-select
            :options="states"
            v-model="filter.states"
            placeholder="States"
          />
        </b-form-group>
      </b-col>
      <b-col
        cols="6"
        sm="4"
        md="3"
        lg="2"
      >
        <b-form-group>
          <vue-select
            :options="utilities"
            v-model="filter.utilities"
            placeholder="Utilities"
          />
        </b-form-group>
      </b-col>
      <b-col
        cols="6"
        sm="4"
        md="3"
        lg="2"
      >
        <b-form-group>
          <vue-select
            :options="zones"
            v-model="filter.zones"
            placeholder="Zones"
          />
        </b-form-group>
      </b-col>
      <b-col
        cols="6"
        sm="4"
        md="3"
        lg="2"
      >
        <b-form-group>
          <vue-select
            :options="rateClasses"
            v-model="filter.rateClasses"
            placeholder="Rate Classes"
          />
        </b-form-group>
      </b-col>
      <b-col
        cols="6"
        sm="4"
        md="3"
        lg="2"
      >
        <b-form-group>
          <vue-select
            :options="dSizeRCode"
            v-model="filter.dSizeRCode"
            placeholder="D. Size / R. Code"
          />
        </b-form-group>
      </b-col>
      <b-col
        cols="6"
        sm="4"
        md="3"
        lg="2"
      >
        <b-form-group>
          <b-form-input
            type="text"
            v-model="filter.startMonth"
            placeholder="Start Month"
          />
        </b-form-group>
      </b-col>
      <b-col
        cols="6"
        sm="4"
        md="3"
        lg="2"
      >
        <b-form-group>
          <b-form-input
            type="text"
            v-model="filter.annualVolume"
            placeholder="Annual Volumne"
          />
        </b-form-group>
      </b-col>
      <b-col
        cols="6"
        sm="4"
        md="3"
        lg="2"
      >
        <b-form-group>
          <vue-select
            :options="prices"
            v-model="filter.fixedPrice"
            placeholder="Fixed Price"
          />
        </b-form-group>
      </b-col>
      <b-col
        cols="6"
        sm="4"
        md="3"
        lg="2"
      >
        <b-form-group>
          <b-form-input
            type="text"
            v-model="filter.brokerFee"
            placeholder="Broker Fee"
          />
        </b-form-group>
      </b-col>
      <b-col
        cols="6"
        sm="4"
        md="3"
        lg="2"
      >
        <b-form-group>
          <b-form-input
            type="text"
            v-model="filter.currentRate"
            placeholder="Current Rate"
          />
        </b-form-group>
      </b-col>
      <b-col
        cols="6"
        sm="4"
        md="3"
        lg="2"
      >
        <button
          type="submit"
          class="btn btn-primary w-100"
        >
          <feather-icon icon="SearchIcon" />
          <span class="ml-1">Start Search</span>
        </button>
      </b-col>
    </b-form-row>

    <!-- table -->
    <div class="table-responsive mt-3">
      <p class="text-center">Last Update Was:
        04/13/2023 10:35</p>
      <table class="table ">
        <thead>
          <tr>
            <th scope="col">
              Supplier
            </th>
            <th scope="col">
              Product
            </th>
            <th scope="col">
              12 Month
            </th>
            <th scope="col">
              18 Month
            </th>
            <th scope="col">
              24 Month
            </th>
            <th scope="col">
              36 Month
            </th>
            <th scope="col">
              48 Month
            </th>
            <th scope="col">
              60 Month
            </th>
            <th scope="col">
              Information
            </th>
            <th>
              Swing
            </th>
            <th>
              Min Load Factor
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            class=""
            v-for="(rate, index) in rates"
            :key="index"
          >
            <td>
              <img
                :src="rate.supplier_logo"
                alt="avatar"
                style="width:auto;max-width:120px;height:35px;object-fit:contain"
              >
            </td>
            <td>{{ rate.name }}</td>
            <td><a
                class="text-decoration-underline"
              href="#"
              @click="startContract(rate, '12 month')"
            >{{ rate.price_12 }}</a></td>
            <td><a
                class="text-decoration-underline"
              href="#"
              @click="startContract(rate, '18 month')"
            >{{ rate.price_18 }}</a></td>
            <td><a
              href="#"
              class="text-decoration-underline"
              @click="startContract(rate, '24 month')"
            >{{ rate.price_24 }}</a></td>
            <td><a
              href="#"
              class="text-decoration-underline"
              @click="startContract(rate, '36 month')"
            >{{ rate.price_36 }}</a></td>
            <td><a
              href="#"
              class="text-decoration-underline"
              @click="startContract(rate, '48 month')"
            >{{ rate.price_48 }}</a></td>
            <td><a
              href="#"
              class="text-decoration-underline"
              @click="startContract(rate, '60 months')"
            >{{ rate.price_60 }}</a></td>
            <td><div style="width: 200px;height: 50px;overflow: auto;">
              {{ rate.description }}
            </div></td>
            <td>{{ rate.swing }}</td>
            <td>{{ rate.load_factor }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</template>

<script>
import AppBreadcrumb from '@core/layouts/components/AppBreadcrumb.vue'
import { VueSelect } from 'vue-select'
import 'vue-select/dist/vue-select.css'
// import VueApexCharts from 'vue-apexcharts'
import {
  BRow,
  BCol,
  BForm,
  BFormRow,
  BFormGroup,
  BFormInput,
} from 'bootstrap-vue'
import { ref } from '@vue/composition-api'
import StartContractDialog from './StartContractDialog.vue'

export default {
  data() {
    return {}
  },
  components: {
    BRow,
    BCol,
    BForm,
    BFormRow,
    BFormGroup,
    BFormInput,
    VueSelect,
    AppBreadcrumb,
    StartContractDialog,
  },
  setup() {
    const filter = ref({
      zipcode: '',
      commodities: '',
      states: '',
      utilities: '',
      zones: '',
      rateClasses: '',
      dSizeRCode: '',
      startMonth: '',
      annualVolume: '',
      fixedPrice: '',
      brokerFee: '',
      currentRate: '',
    })
    const zipcodes = ['834798', '645331', '567323', '478563']
    const commodities = ['Option A', 'Option B', 'Option C', 'Option D']
    const states = ['Option A', 'Option B', 'Option C', 'Option D']
    const utilities = ['Option A', 'Option B', 'Option C', 'Option D']
    const zones = ['Option A', 'Option B', 'Option C', 'Option D']
    const rateClasses = ['Option A', 'Option B', 'Option C', 'Option D']
    const dSizeRCode = ['Option A', 'Option B', 'Option C', 'Option D']
    const prices = ['Option A', 'Option B', 'Option C', 'Option D']

    const selectRate = ref({})
    const isStartContractVisible = ref(false)
    const selectTerm = ref('')
    const startContract = (rate, term) => {
      selectRate.value = rate
      selectTerm.value = term

      isStartContractVisible.value = true
    }

    const rates = [
      {
        id: 1,
        supplier_logo: 'https://myservicecloud.net/uploads/supplier_logo/Dynegy-removebg-preview.png',
        name: 'Fixed Price Single Bill',
        price_12: '0.06580',
        price_18: '0.06580',
        price_24: '0.06580',
        price_36: '0.06580',
        price_48: '0.06580',
        price_60: '0.06580',
        description: 'All-In Fixed prices, no passthroughs, includes Tax and POR where applicable',
        swing: '100%',
        load_factor: '30%',
      },
      {
        id: 2,
        supplier_logo: 'https://myservicecloud.net/uploads/supplier_logo/hudson.png',
        name: 'Fixed Price Single Bill',
        price_12: '0.06580',
        price_18: '0.06580',
        price_24: '0.06580',
        price_36: '0.06580',
        price_48: '0.06580',
        price_60: '0.06580',
        description: 'All-In Fixed prices, no passthroughs, includes Tax and POR where applicable',
        swing: '100%',
        load_factor: '30%',
      },
      {
        id: 3,
        supplier_logo: 'https://myservicecloud.net/uploads/supplier_logo/santanna.png',
        name: 'Fixed Price Single Bill',
        price_12: '0.06580',
        price_18: '0.06580',
        price_24: '0.06580',
        price_36: '0.06580',
        price_48: '0.06580',
        price_60: '0.06580',
        description: 'All-In Fixed prices, no passthroughs, includes Tax and POR where applicable',
        swing: '100%',
        load_factor: '30%',
      },
      {
        id: 4,
        supplier_logo: 'https://myservicecloud.net/uploads/supplier_logo/natil.png',
        name: 'Fixed Price Single Bill',
        price_12: '0.06580',
        price_18: '0.06580',
        price_24: '0.06580',
        price_36: '0.06580',
        price_48: '0.06580',
        price_60: '0.06580',
        description: 'All-In Fixed prices, no passthroughs, includes Tax and POR where applicable',
        swing: '100%',
        load_factor: '30%',
      },
    ]

    return {
      filter,
      zipcodes,
      commodities,
      states,
      utilities,
      zones,
      rateClasses,
      dSizeRCode,
      prices,
      rates,
      selectTerm,
      isStartContractVisible,
      startContract,
      selectRate,
    }
  },
}
</script>
<style lang="scss">
.commercial-rates-filters {
    .form-group {
        .vs__dropdown-toggle {
            padding: 3px 0 7px;
            border: 1px solid #d8d6de;
        }
    }
}
.text-decoration-underline {
    text-decoration: underline;
}
</style>
