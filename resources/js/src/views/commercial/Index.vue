<template>
  <div>
    <StartContractDialog
      v-if="isStartContractVisible"
      :is-start-contract-visible.sync="isStartContractVisible"
      :rate="selectRate"
    />
    <b-form-row
      class="commercial-rates-filters align-items-end justify-content-between"
    >
      <b-col cols="12">
        <app-breadcrumb />
      </b-col>
      <b-col
        cols="6"
        sm="4"
        md="3"
        lg="2"
        xl
      >
        <b-form-group>
          <label
            class="d-block"
            for="commodity"
          >
            Commodity
          </label>
          <b-form-select
            v-model="filters.commodity"
            placeholder="Select Commodity"
            :options="commodityOptions"
            id="commodity"
            @change="onCommodityChange"
          />
        </b-form-group>
      </b-col>

      <b-col
        cols="6"
        sm="4"
        md="3"
        lg="2"
        xl
      >
        <b-form-group>
          <label
            class="d-block"
            for="state"
          >
            State
          </label>
          <v-select
            v-model="filters.state"
            :options="statesOptions"
            :reduce="(state) => state.name"
            label="name"
            placeholder="State"
            @input="onStateChange"
          />
        </b-form-group>
      </b-col>
      <b-col
        cols="6"
        sm="4"
        md="3"
        lg="2"
        xl
      >
        <b-form-group>
          <label
            class="d-block"
            for="supplier"
          >
            Supplier
          </label>
          <v-select
            v-model="filters.supplier"
            :options="suppliers"
            :reduce="(supplier) => supplier.title"
            label="title"
            id="supplier"
            placeholder="Select Supplier"
          />
        </b-form-group>
      </b-col>

      <b-col
        cols="6"
        sm="4"
        md="3"
        lg="2"
        xl
      >
        <b-form-group>
          <label
            class="d-block"
            for="utility"
          >
            Utility
          </label>
          <v-select
            :options="utilitiesList"
            label="text"
            placeholder="Select Utility"
            :reduce="(dropdown) => dropdown.text"
            v-model="filters.utility"
          />
        </b-form-group>
      </b-col>
      <b-col
        cols="6"
        sm="4"
        md="3"
        lg="2"
        xl
      >
        <b-form-group>
          <label
            class="d-block"
            for="start_month"
          >
            Start Month
          </label>
          <flat-pickr
            :config="pickerConfig"
            class="form-control"
            placeholder="Start Month"
            v-model="filters.start_month"
          />
        </b-form-group>
      </b-col>
      <b-col
        cols="6"
        sm="4"
        md="3"
        lg="2"
        xl
      >
        <b-form-group>
          <label
            class="d-block"
            for="start_month"
          >
            Rate Classes
          </label>
          <v-select
            v-model="filters.rate_class"
            :options="rateClassesList"
            label="text"
            :reduce="(dropdown) => dropdown.text"
            placeholder="Rate Class"
          />
        </b-form-group>
      </b-col>
      <b-col
        cols="6"
        sm="4"
        md="3"
        lg="2"
        xl
      >
        <b-form-group>
          <label
            class="d-block"
            for="start_month"
          >
            Demand Size
          </label>
          <b-form-select
            :options="demandSizeOptions"
            v-model="filters.demand_size"
            placeholder="Demand Size"
          />
        </b-form-group>
      </b-col>
      <b-col
        cols="6"
        sm="4"
        md="3"
        lg="2"
        xl
      >
        <b-form-group>
          <div class="d-flex justify-content-between">
            <button
              type="button"
              @click="onSearch"
              class="btn btn-primary w-50 ml-1"
            >
              <feather-icon icon="SearchIcon" /><span>Search</span>
            </button>
            <button
              type="button"
              @click="resetSearch"
              class="btn btn-warning w-50 ml-1"
            >
              <span>Reset</span>
            </button>
          </div>
        </b-form-group>
      </b-col>
    </b-form-row>

    <!-- table -->
    <div class="table-responsive mt-3">
      <p class="text-center">Last Update Was:
        {{ lastUpdatedAt }}
      </p>
      <b-overlay
        rounded
        opacity="0.6"
        :show="ratesLoading"
      >
        <table class="table ">
          <thead>
            <tr>
              <th scope="col">
                Commodity
              </th>
              <th scope="col">
                Supplier
              </th>
              <th scope="col">
                State
              </th>
              <th scope="col">
                Utility
              </th>
              <th scope="col">
                Start Month
              </th>
              <th scope="col">
                Rate
              </th>
              <th scope="col">
                Rate Class
              </th>
              <th scope="col">
                Demand Size
              </th>

              <th scope="col">
                Updated At
              </th>
              <th scope="col">
                Actions
              </th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(rate, index) in commercialRates"
              :key="index"
            >
              <td>
                <span>
                  <img
                    :src="require('@/assets/images/icons/gas.svg')"
                    v-if="rate.commodity == 'gas'"
                    width="20"
                  >
                  <img
                    :src="require('@/assets/images/icons/electricity.svg')"
                    v-if="rate.commodity == 'electricity'"
                    width="20"
                  >
                </span>
              </td>
              <td>
                {{ rate.supplier }}
              </td>
              <td>{{ rate.state }}</td>
              <td>{{ rate.utility }}</td>
              <td>{{ rate.start_month }}</td>
              <td><a
                href="javascript:;"
                class="text-primary text-underline"
                @click="startContract(rate)"
              >{{ rate.current_rate }}</a></td>
              <td>{{ rate.rate_class }}</td>
              <!-- demand_size  comma separated -->
              <td>{{ rate.demand_size.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') }}</td>
              <td>{{ rate.updated_at }}</td>
              <td><a
                href="javascript:;"
                class="text-primary text-underline"
                @click="startContract(rate)"
              >Start Contract
              </a>
              </td>
            </tr>
          </tbody>
        </table>
      </b-overlay>
    </div>
  </div>

</template>

<script>
import AppBreadcrumb from '@core/layouts/components/AppBreadcrumb.vue'
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'
import flatPickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import monthSelectPlugin from 'flatpickr/dist/plugins/monthSelect/index.js'
import 'flatpickr/dist/plugins/monthSelect/style.css'
import statesOptions from '@core/data/states.json'
import rateClasses from '@core/data/rateClasses'
import suppliers from '@core/data/suppliers'
import utility from '@core/data/utility'
import useCommercialRates from '@/composables/commercialRates'
import {
  BCol,
  BOverlay,
  BFormRow,
  BFormSelect,
  BFormGroup,
} from 'bootstrap-vue'
import { ref } from '@vue/composition-api'
import StartContractDialog from './StartContractDialog.vue'

export default {
  data() {
    return {}
  },
  components: {
    BCol,
    BOverlay,
    vSelect,
    flatPickr,
    BFormRow,
    BFormGroup,
    BFormSelect,
    AppBreadcrumb,
    StartContractDialog,
  },
  setup() {
    // const filters = ref({
    //   supplier: '',
    //   commodities: '',
    //   state: '',
    //   commodity: '',
    //   utility: '',
    //   start_month: '',
    //   current_rate: '',
    //   demand_size: '',
    //   rate_class: '',
    // })

    const {
      busy: ratesLoading,
      filters,
      commercialRates,
      fetchCommercialRates,
    } = useCommercialRates()


    const commodityOptions = ref([
      { text: 'Electricity', value: 'electricity' },
      { text: 'Gas', value: 'gas' },
    ])

    const selectRate = ref({})
    const isStartContractVisible = ref(false)
    const selectTerm = ref('')
    const startContract = rate => {
      selectRate.value = rate
      isStartContractVisible.value = true
    }

    const resetSearch = () => {
      // reset filters key value
      Object.keys(filters).forEach(key => {
        filters[key] = ''
      })

      fetchCommercialRates()
    }


    const rateClassesList = ref([])
    const utilitiesList = ref([])

    const pickerConfig = {
      plugins: [
        new monthSelectPlugin({
          shorthand: true,
          dateFormat: 'm/Y',
        }),
      ],
    }

    // get last updated_at from commercialRates array
    const lastUpdatedAt = ref('')
    const lastUpdated = async () => {
      if (commercialRates.value.length > 0) {
        lastUpdatedAt.value = commercialRates.value[0].updated_at
      }
    }

    // rate.current_rate comma separated string


    const onCommodityChange = value => {
      //   utilitiesList.value = []
      filters.commodity = value
      rateClassesList.value = rateClasses.filter(rateClass => rateClass.commodity === value)
      utilitiesList.value = utility.filter(
        util => util.state === filters.state && util.commodity === value,
      )
    }

    const onStateChange = value => {
      console.log(value)
      //   filters.state = value
      utilitiesList.value = utility.filter(
        util => util.state === value && util.commodity === filters.commodity,
      )
    }

    // onSearch
    const onSearch = async () => {
      await fetchCommercialRates()
      await lastUpdated()
    }


    const demandSizeOptions = ref([
      { text: '0 - 100,000', value: '100000' },
      { text: '100,000 - 200,000', value: '200000' },
      { text: '200,000 - 300,000', value: '300000' },
      { text: '300,000 - 400,000', value: '400000' },
      { text: '400,000 - 500,000', value: '500000' },
      { text: '500,000 - 600,000', value: '600000' },
      { text: '600,000 - 700,000', value: '700000' },
      { text: '700,000 - 800,000', value: '800000' },
      { text: '800,000 - 900,000', value: '900000' },
      { text: '900,000 - 1,000,000+', value: '1000000' },
    ])

    return {
      filters,
      rateClasses,
      suppliers,
      statesOptions,
      pickerConfig,
      selectTerm,
      resetSearch,
      startContract,
      onCommodityChange,
      selectRate,
      lastUpdatedAt,
      onSearch,
      ratesLoading,
      commercialRates,
      rateClassesList,
      onStateChange,
      utilitiesList,
      commodityOptions,
      demandSizeOptions,
      isStartContractVisible,
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
.form-control[readonly]{
    background-color: #fff;
    opacity: 1;
}
.vs__selected{
    text-overflow: ellipsis;
    max-width: 250px;
    white-space: nowrap;
    overflow: hidden;
    display: inline-block;
}
.text-underline{
    text-decoration: underline;
}
.text-primary{
    color: #5A8DEE;
}

</style>

