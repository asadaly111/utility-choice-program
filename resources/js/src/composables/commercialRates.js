import axios from '@axios'
import {
  computed, ref, watch, reactive,
} from '@vue/composition-api'
import route from 'ziggy-js'
import toaster from './toaster'

export default function useCommercialRates() {
  const busy = ref(false)
  const respResult = ref(null)
  const commercialRates = ref([])
  const rateData = ref(null)
  const errors = ref({})
  const toast = toaster()
  const perPage = ref(10)
  const totalRecords = ref(0)
  const currentPage = ref(1)
  const perPageOptions = [10, 25, 50, 100]
  const searchQuery = ref('')
  const sortBy = ref('id')
  const isSortDirDesc = ref(true)
  const refListTable = ref(null)

  const filters = reactive({

  })

  const tableColumns = [
    { key: 'state', sortable: false },
    { key: 'commodity', sortable: true },
    { key: 'utility', sortable: true },
    { key: 'product', sortable: true },
    { key: 'start_month', sortable: false },
    { key: 'rate_class', sortable: false },
    { key: 'demand_size', sortable: false },
    { key: 'current_rate', sortable: false },
    { key: 'actions' },
  ]


  const dataMeta = computed(() => {
    const localItemsCount = refListTable.value ? refListTable.value.localItems.length : 0
    return {
      from: perPage.value * (currentPage.value - 1) + (localItemsCount ? 1 : 0),
      to: perPage.value * (currentPage.value - 1) + localItemsCount,
      of: totalRecords.value,
    }
  })

  const fetchCommercialRates = async () => {
    try {
      busy.value = true
      const response = await axios.get(route('commercial-rates.index'), {
        params: {
          q: searchQuery.value,
          perPage: perPage.value,
          page: currentPage.value,
          sortBy: sortBy.value,
          sortDesc: isSortDirDesc.value,
          ...filters,
        },
      })
      commercialRates.value = response.data.data
      if (response.data.meta) {
        const { total } = response.data.meta
        totalRecords.value = total
      }
    } catch (error) {
      console.log(error)
      if (error.message === 'Network Error') {
        toast.error(error.message)
      } else {
        respResult.value = error
        toast.error(error.response.data.message)
      }
    } finally {
      busy.value = false
    }
  }

  const getCommercialRate = async id => {
    try {
      const response = await axios.get(route('commercial-rates.show', { id }))
      rateData.value = response.data.data
    } catch (error) {
      if (error.message === 'Network Error') {
        toast.error(error.message)
      } else {
        if (error.response.status === 422) {
          errors.value = error.response.data.errors
        }
        respResult.value = error
        toast.error(error.response.data.message)
      }
    }
  }


  const storeCommercialRate = async data => {
    errors.value = ''
    try {
      busy.value = true
      const response = await axios.post(route('commercial-rates.store'), data)
      respResult.value = response
      toast.success(response.data.message)
    } catch (error) {
      if (error.message === 'Network Error') {
        toast.error(error.message)
      } else {
        if (error.response.status === 422) {
          errors.value = error.response.data.errors
        }
        respResult.value = error
        toast.error(error.response.data.message)
      }
    } finally {
      busy.value = false
    }
  }


  const updateCommercialRateStatus = async orderData => {
    try {
      busy.value = true
      const response = await axios.post(route('commercial-rates.status', orderData.id), orderData)
      respResult.value = response
      toast.success(response.data.message)
    } catch (e) {
      console.log(e)
      if (e.response.status === 422) {
        toast.error(e.response.data.message)
      }
    } finally {
      busy.value = false
    }
  }


  const updateCommercialRate = async data => {
    errors.value = ''
    try {
      busy.value = true
      const response = await axios.put(route('commercial-rates.update', data.id), data)
      respResult.value = response
      toast.success(response.data.message)
    } catch (error) {
      if (error.message === 'Network Error') {
        toast.error(error.message)
      } else {
        if (error.response.status === 422) {
          errors.value = error.response.data.errors
        }
        respResult.value = error
        toast.error(error.response.data.message)
      }
    } finally {
      busy.value = false
    }
  }


  const deleteCommercialRate = async id => {
    try {
      busy.value = true
      const response = await axios.delete(route('commercial-rates.destroy', id))
      toast.success(response.data.message)
      respResult.value = response
    } catch (error) {
      if (error.message === 'Network Error') {
        toast.error(error.message)
      } else {
        respResult.value = error
        toast.error(error.response.data.message)
      }
    } finally {
      busy.value = false
    }
  }

  const fetchCommercialRatesList = async () => {
    busy.value = true
    try {
      const response = await axios.get(route('commercial-rates.index'), {
        params: {
          ...filters,
        },
      })
      commercialRates.value = response.data.data
    } catch (e) {
      toast.error(e.response.data.message)
    } finally {
      busy.value = false
    }
  }

  watch([currentPage, searchQuery], () => {
    fetchCommercialRates()
  })

  return {
    busy,
    sortBy,
    errors,
    perPage,
    rateData,
    filters,
    dataMeta,
    respResult,
    updateCommercialRate,
    currentPage,
    searchQuery,
    totalRecords,
    tableColumns,
    isSortDirDesc,
    perPageOptions,
    commercialRates,
    getCommercialRate,
    storeCommercialRate,
    fetchCommercialRates,
    deleteCommercialRate,
    fetchCommercialRatesList,
    updateCommercialRateStatus,
  }
}
