<template>
  <b-card no-body>
    <b-card-header class="align-items-baseline">
      <div>
        <b-card-title class="mb-25">
          This Week Leads
        </b-card-title>
        <b-card-text class="mb-0">
          Total Leads: {{ totalLeads }}
        </b-card-text>
      </div>
    </b-card-header>

    <b-card-body class="pb-0">
      <vue-apex-charts
        type="line"
        height="250"
        v-if="isDataFetched"
        :options="chartOptions"
        :series="chartOptions.series"
      />
    </b-card-body>
  </b-card>
</template>
<script>
import VueApexCharts from 'vue-apexcharts'
import {
  BCard, BCardHeader, BCardTitle, BCardText, BCardBody,
} from 'bootstrap-vue'
import { ref, watch } from '@vue/composition-api'

export default {
  components: {
    VueApexCharts,
    BCard,
    BCardHeader,
    BCardTitle,
    BCardText,
    BCardBody,
  },
  props: {
    isDataFetched: {
      type: Boolean,
    },
    weeklyLeads: {
      type: Object,
      required: true,
    },
  },
  setup(props) {
    const totalLeads = ref(0)
    const chartOptions = ref({
      series: {},
      chart: {
        toolbar: { show: false },
        zoom: { enabled: false },
      },
      plotOptions: {
        bar: {
          borderRadius: 4,
          horizontal: true,
        },
      },
      dataLabels: {
        enabled: true,
      },
      xaxis: {
        categories: [],
      },
      yaxis: {
        tickAmount: 5,
        labels: {
          style: {
            cssClass: 'text-grey fill-current',
          },
          formatter(val) {
            return val > 999 ? `${(val / 1000).toFixed(1)}k` : val
          },
        },
      },
    })

    watch(props.weeklyLeads, weeklyLeads => {
      totalLeads.value = Object.values(weeklyLeads.series).reduce((a, b) => Number(a) + Number(b))

      chartOptions.value.series = [
        {
          name: 'Leads',
          data: weeklyLeads.series,
        },
      ]
      chartOptions.value.xaxis.categories = weeklyLeads.labels
    })
    return {
      totalLeads,
      chartOptions,
    }
  },

}
</script>
