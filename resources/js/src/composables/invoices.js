import axios from '@axios'
import {
  computed, ref, watch, reactive,
} from '@vue/composition-api'
import route from 'ziggy-js'
import toaster from './toaster'

export default function useInvoices() {
  const busy = ref(false)
  const respResult = ref(null)
  const invoices = ref([])
  const invoiceData = ref(null)
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
    userId: null,
    brokerId: null,
  })


  const tableColumns = [
    { key: 'order', sortable: true },
    { key: 'amount', sortable: false, label: 'amount' },
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

  const fetchInvoices = async () => {
    try {
      busy.value = true
      const response = await axios.get(route('invoices.index'), {
        params: {
          q: searchQuery.value,
          perPage: perPage.value,
          page: currentPage.value,
          sortBy: sortBy.value,
          sortDesc: isSortDirDesc.value,
          ...filters,
        },
      })
      invoices.value = response.data.data
      if (response.data.meta) {
        const { total } = response.data.meta
        totalRecords.value = total
      }
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

  const fetchKanBanInvoices = async () => {
    try {
      busy.value = true
      const response = await axios.get(route('invoices.kanban'), {
        params: {
          ...filters,
        },
      })
      invoices.value = response.data.data
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

  const getInvoice = async id => {
    try {
      const response = await axios.get(route('invoices.show', { id }))
      invoiceData.value = response.data.data
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


  const storeInvoice = async data => {
    errors.value = ''
    try {
      busy.value = true
      const response = await axios.post(route('invoices.store'), data)
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

  const updateInvoice = async data => {
    errors.value = ''
    try {
      busy.value = true
      const response = await axios.put(route('invoices.update', data.id), data)
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

  const updateKanban = async (invoiceId, status) => {
    errors.value = ''
    try {
      busy.value = true
      const response = await axios.post(route('invoices.kanban.update', invoiceId), { status })
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


  const deleteInvoice = async id => {
    try {
      busy.value = true
      const response = await axios.delete(route('invoices.destroy', id))
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
  const resolvePayDayStatus = invoicestatus => {
    if (invoicestatus === 'invoice') { return '- 4 days' }
    if (invoicestatus === 'application_taken') { return '- 3 days' }
    if (invoicestatus === 'submitted') { return '- 2 days' }
    if (invoicestatus === 'approved') { return '- tomorrow' }
    if (invoicestatus === 'settled') { return '- today' }
    return ''
  }

  const resolveInvoicestatus = invoicestatus => {
    if (invoicestatus === 'invoice') { return 'danger' }
    if (invoicestatus === 'application_taken') { return 'warning' }
    if (invoicestatus === 'submitted') { return 'info' }
    if (invoicestatus === 'approved') { return 'primary' }
    if (invoicestatus === 'settled') { return 'success' }
    return ''
  }

  watch([currentPage, searchQuery], () => {
    fetchInvoices()
  })

  return {
    busy,
    invoices,
    sortBy,
    errors,
    filters,
    perPage,
    getInvoice,
    invoiceData,
    dataMeta,
    storeInvoice,
    respResult,
    updateInvoice,
    fetchInvoices,
    deleteInvoice,
    currentPage,
    searchQuery,
    updateKanban,
    totalRecords,
    tableColumns,
    isSortDirDesc,
    perPageOptions,
    fetchKanBanInvoices,
    resolveInvoicestatus,
    resolvePayDayStatus,
  }
}
