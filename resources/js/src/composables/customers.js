import axios from '@axios'
import {
  ref, watch, computed,
} from '@vue/composition-api'
import route from 'ziggy-js'
import toaster from './toaster'

export default function useCustomers() {
  const busy = ref(false)
  const toast = toaster()
  const respResult = ref(null)
  const refListTable = ref(null)
  const customers = ref([])
  const perPage = ref(10)
  const sortBy = ref('id')
  const isSortDirDesc = ref(true)
  const totalRecords = ref(0)
  const currentPage = ref(1)
  const perPageOptions = [25, 50, 100, 150]
  const customer = ref({})
  const errors = ref({})
  const tableColumns = [
    {
      label: 'ID',
      field: 'id',
      width: '50px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'ID',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'First Name',
      field: 'first_name',
      width: '150px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'Name',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Last Name',
      field: 'last_name',
      width: '150px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'Name',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Email',
      field: 'email',
      width: '180px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'Email',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Phone',
      field: 'phone',
      width: '160px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'Phone',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Business Name',
      field: 'business_name',
      width: '150px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'Business Name',
        // filterDropdownItems: ['Business 1', 'Business 2'],
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Doing Business As',
      field: 'doing_business_as',
      width: '150px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'Doing Business As',
        // filterDropdownItems: ['Seller', 'Distributor'],
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Business Type',
      field: 'business_type',
      width: '150px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'Business Type',
        filterDropdownItems: [
          'Corporation',
          'Limited Liability Company',
          'Partnership',
          'Individual',
        ],
      },
      tdClass: 'align-middle',
    },
    {
      label: 'EIN',
      field: 'ein',
      width: '120px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'EIN',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Industry',
      field: 'industry',
      width: '150px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'Industry',
        filterDropdownItems: [
          'Real Estate',
          'Information',
          'Arts',
          'Entertainment',
          'Construction',
          'Corporate Management',
          'Education Services',
          'Agriculture',
          'Other',
          'Government',
          'Finance',
          'Energy',
          'Healthcare',
          'Hospitality',
          'Manufacturing',
          'Retail Trade',
          'Wholesale Trade',
        ],
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Tax Excempt',
      field: 'tax_exempt',
      width: '150px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'Tax Excempt',
        filterDropdownItems: ['Yes', 'No'],
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Address 1',
      field: 'address1',
      width: '200px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'Address',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Address 2',
      field: 'address2',
      width: '150px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'Address',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'State',
      field: 'state',
      width: '150px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'State',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'City',
      field: 'city',
      width: '150px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'City',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Billing Address',
      field: 'billing_address',
      width: '150px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'Billing Address',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Billing State',
      field: 'billing_state',
      width: '150px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'Billing State',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Billing City',
      field: 'billing_city',
      width: '150px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'Billing City',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Billing Zip',
      field: 'billing_zip',
      width: '150px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'Billing Zip',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Agency',
      field: 'agency',
      width: '150px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'Agency',
        filterDropdownItems: [
          'Corporation',
          'Limited Liability Company',
          'Partnership',
          'Individual',
        ],
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Agent',
      field: 'agent',
      width: '150px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'Agent',
        filterDropdownItems: [
          'Robert Zane',
          'Harvey Dentt',
          'Sean Azfarani',
        ],
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Flags',
      field: 'flags',
      width: '80px',
    },
    {
      label: 'E/G/Q/C',
      field: 'egqc',
      type: 'date',
      dateInputFormat: 'yyyy-MM-dd',
      dateOutputFormat: 'MMM do yy',
      width: '120px',
    },
    {
      label: 'Actions',
      field: 'actions',
      width: '80px',
      tdClass: 'align-middle text-center',
    },
  ]

  const refetchData = () => {
    refListTable.value.refresh()
  }

  const dataMeta = computed(() => {
    const localItemsCount = refListTable.value ? refListTable.value.localItems.length : 0
    return {
      from: perPage.value * (currentPage.value - 1) + (localItemsCount ? 1 : 0),
      to: perPage.value * (currentPage.value - 1) + localItemsCount,
      of: totalRecords.value,
    }
  })

  const deleteCustomer = async id => {
    try {
      busy.value = true
      const res = await axios.delete(route('customers.destroy', id))
      respResult.value = res
      toast.success(res.data.message)
      //   refetchData()
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

  const updateCustomer = async (customerData, id) => {
    try {
      busy.value = true
      const response = await axios.post(route('customers.update', id), customerData)
      respResult.value = response
      toast.success(response.data.message)
    } catch (error) {
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

  const fetchCustomers = async params => {
    busy.value = true
    try {
      const response = await axios.get(route('customers.index'), {
        params: {
          perPage: perPage.value,
          page: currentPage.value,
          sortBy: sortBy.value,
          sortDesc: isSortDirDesc.value,
          ...params,
        },
      })
      customers.value = response.data.data
      if (response.data.meta) {
        const { total } = response.data.meta
        totalRecords.value = total
      }
    } catch (e) {
      toast.error(e.response.data.message)
    } finally {
      busy.value = false
    }
  }

  watch([currentPage, perPage], () => {
    fetchCustomers()
  })

  return {
    busy,
    errors,
    sortBy,
    perPage,
    dataMeta,
    customer,
    customers,
    respResult,
    getCustomer,
    refetchData,
    currentPage,
    refListTable,
    tableColumns,
    totalRecords,
    isSortDirDesc,
    updateCustomer,
    deleteCustomer,
    storeCustomer,
    fetchCustomers,
    perPageOptions,
  }
}
