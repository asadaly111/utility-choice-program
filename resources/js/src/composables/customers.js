import axios from '@axios'
import {
  ref, watch,
} from '@vue/composition-api'
// Notification
import route from 'ziggy-js'
import toaster from './toaster'

export default function useCustomers() {
  const busy = ref(false)
  const toast = toaster()
  const respResult = ref(null)
  const refListTable = ref(null)
  const customers = ref([])
  const perPage = ref(15)
  const sortBy = ref('id')
  const isSortDirDesc = ref(true)
  const totalRecords = ref(0)
  const currentPage = ref(1)
  const perPageOptions = [25, 50, 100, 150]
  const searchQuery = ref('')
  const customer = ref({})
  const errors = ref({})

  const refetchData = () => {
    refListTable.value.refresh()
  }

  const deleteCustomer = async id => {
    try {
      busy.value = true
      const res = await axios.delete(route('customers.destroy', id))
      respResult.value = res
      toast.success(res.data.message)
      // refetchData()
    } catch (error) {
      toast.error('Error! Deleting user')
    } finally {
      busy.value = false
    }
  }

  const getCustomer = async id => {
    const response = await axios.get(route('customers.show', id))
    customer.value = response.data.data
  }

  const updateCustomer = async customerData => {
    try {
      busy.value = true
      console.log(customerData)
      const response = await axios.put(route('customers.update', customerData.id), customerData)
      respResult.value = response
      toast.success(response.data.message)
    } catch (error) {
      console.log(error)
      if (error.response.status === 422) {
        errors.value = error.response.data.errors
      }
      toast.error(error.response.data.message)
    } finally {
      busy.value = false
    }
  }

  const storeCustomer = async formData => {
    busy.value = true
    await axios
      .post(route('customers.store'), formData)
      .then(resp => {
        respResult.value = resp
        toast.success(resp.data.message)
      })
      .catch(err => {
        respResult.value = err

        if (err.response.status === 422) {
          toast.error(err.response.data.message)
        }
      }).finally(() => {
        busy.value = false
      })
  }

  const fetchCustomers = async () => {
    busy.value = true
    try {
      const response = await axios.get(route('customers.index'), {
        params: {
          perPage: perPage.value,
          page: currentPage.value,
          sortBy: sortBy.value,
          sortDesc: isSortDirDesc.value,
        },
      })
      customers.value = response.data.data
    } catch (e) {
      toast.error(e.response.data.message)
    } finally {
      busy.value = false
    }
  }

  watch([currentPage, perPage, searchQuery], () => {
    fetchCustomers()
  })

  return {
    busy,
    errors,
    sortBy,
    perPage,
    customer,
    customers,
    respResult,
    getCustomer,
    refetchData,
    currentPage,
    searchQuery,
    refListTable,
    totalRecords,
    isSortDirDesc,
    updateCustomer,
    deleteCustomer,
    storeCustomer,
    fetchCustomers,
    perPageOptions,
  }
}
