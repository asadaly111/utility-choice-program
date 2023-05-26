<template>
  <div>
    <!-- <b-row>
      <b-col
        xl="2"
        sm="6"
      >
        <statistic-card-horizontal
          hide-chart
          class="mb-base"
          icon="AlertOctagonIcon"
          icon-right
          :statistic="totalOrders"
          statistic-title="Total Orders"
          color="primary"
        />
      </b-col>
      <b-col
        xl="2"
        sm="6"
        v-if="['admin'].includes(user.role)"
      >
        <statistic-card-horizontal
          hide-chart
          class="mb-base"
          icon="BarChartIcon"
          icon-right
          :statistic="30"
          statistic-title="Total Invoices"
          color="primary"
        />
      </b-col>
      <b-col
        xl="2"
        sm="6"
        v-if="['admin'].includes(user.role)"
      >
        <statistic-card-horizontal
          hide-chart
          class="mb-base"
          icon="DollarSignIcon"
          icon-right
          :statistic="`$300`"
          statistic-title="Invoices Revenue"
          color="primary"
        />
      </b-col>

      <b-col
        xl="2"
        sm="6"
        v-if="['admin'].includes(user.role)"
      >
        <statistic-card-horizontal
          hide-chart
          class="mb-base"
          icon="BarChartIcon"
          icon-right
          :statistic="activeClients"
          statistic-title="Active Clients"
          color="primary"
        />
      </b-col>
      <b-col
        xl="2"
        sm="6"
        v-if="['admin'].includes(user.role)"
      >
        <statistic-card-horizontal
          hide-chart
          class="mb-base"
          icon="BarChartIcon"
          icon-right
          :statistic="activeEmployees"
          statistic-title="Active Employees"
          color="primary"
        />
      </b-col>
    </b-row> -->
  </div>
</template>

<script>
import { BRow, BCol } from 'bootstrap-vue'
import useJwt from '@/auth/jwt/useJwt'
import useDashboard from '@/composables/dashboard'
import { onMounted, ref, watch } from '@vue/composition-api'
import StatisticCardHorizontal from '@core/components/statistics-cards/StatisticCardHorizontal.vue'
import MonthlyOrdersChart from './statistics/MonthlyOrdersChart.vue'

export default {
  components: {
    BRow,
    BCol,
    MonthlyOrdersChart,
    StatisticCardHorizontal,
  },
  setup() {
    const { statistics, isDataFetched, fetchStatistics } = useDashboard()
    const user = JSON.parse(useJwt.getUserData())
    const date = new Date()
    const year = date.getFullYear()
    const isAddLeadActive = ref(false)
    const activeEmployees = ref(0)
    const activeClients = ref(0)
    const totalOrders = ref(0)

    const makeShortcuts = ref([
      { text: 'Today', onClick: () => [new Date(), new Date()] },
      {
        text: 'Yesterday',
        onClick: () => [
          new Date(Date.now() - 3600 * 1000 * 24),
          new Date(),
        ],
      },
      {
        text: 'Last Week',
        onClick: () => [
          new Date(Date.now() - 7 * 24 * 3600 * 1000),
          new Date(),
        ],
      },
      {
        text: 'Monthly',
        onClick: () => [
          new Date(Date.now() - 30 * 24 * 3600 * 1000),
          new Date(),
        ],
      },
      {
        text: 'Yearly',
        onClick: () => [
          new Date(Date.now() - 365 * 24 * 3600 * 1000),
          new Date(),
        ],
      },
    ])

    const dashboardFilters = ref({
      period: [new Date(Date.now() - 30 * 24 * 3600 * 1000), new Date()],
      partner: 'all',
    })
    const monthlySales = ref({
      series: {},
      chartOptions: {
        xaxis: {
          categories: [],
        },
      },
    })
    onMounted(async () => {
      // await fetchStatistics();
      if (['bdm'].includes(user.role)) {
        await fetchUsersByRole('partner')
      }
    })

    watch(statistics, () => {
      if (isDataFetched.value) {
        activeEmployees.value = statistics.value.activeEmployees
        activeClients.value = statistics.value.activeClients
        totalOrders.value = statistics.value.totalOrders
        monthlySales.value.series = [
          {
            name: 'Orders',
            data: statistics.value.monthlyOrders,
          },
        ]
      }
    })

    return {
      year,
      user,
      statistics,
      activeClients,
      totalOrders,
      monthlySales,
      makeShortcuts,
      isDataFetched,
      activeEmployees,
      isAddLeadActive,
      dashboardFilters,
    }
  },
}
</script>
<style lang="scss">
@import "~@core/scss/vue/libs/vue-select.scss";
</style>
