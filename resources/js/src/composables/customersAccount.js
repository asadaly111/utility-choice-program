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
  const perPage = ref(10)
  const sortBy = ref('id')
  const isSortDirDesc = ref(true)
  const totalRecords = ref(0)
  const currentPage = ref(1)
  const perPageOptions = [25, 50, 100, 150]
  const account = ref({})
  const errors = ref({})
  const customersAccounts = ref([])
  const tableColumns = [
    {
      label: 'ID',
      field: 'id',
      width: '50px',
      filterOptions: {
        enabled: true,
        filterValue: '',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'E/G',
      field: 'commodity',
      width: '50px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        filterDropdownItems: [
          'Gas',
          'Electricity',
        ],
      },
      tdClass: 'align-middle',
    },
    {
      label: 'State',
      field: 'state',
      width: '120px',
      filterOptions: {
        enabled: true,
        filterValue: '',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Utility',
      field: 'utility',
      width: '120px',
      filterOptions: {
        enabled: true,
        filterValue: '',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Account Number',
      field: 'account_number',
      width: '160px',
      filterOptions: {
        enabled: true,
        filterValue: '',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Service Agreement',
      field: 'service_agreement',
      width: '150px',
      tdClass: 'align-middle',
    },
    {
      label: 'Zone',
      field: 'zone',
      width: '70px',
      filterOptions: {
        enabled: true,
        filterValue: '',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Rate Class',
      field: 'rate_class',
      width: '120px',
      filterOptions: {
        enabled: true,
        filterValue: '',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Sub Type',
      field: 'sub_type',
      width: '100px',
      filterOptions: {
        enabled: true,
        filterValue: '',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Annual Vol.',
      field: 'annual_volume',
      width: '120px',
      filterOptions: {
        enabled: true,
        filterValue: '',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Current Rate',
      field: 'current_rate',
      width: '150px',
      filterOptions: {
        enabled: true,
        filterValue: '',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'End Rate',
      field: 'contract_end_date',
      width: '100px',
      filterOptions: {
        enabled: true,
        filterValue: '',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Status',
      field: 'status',
      width: '100px',
      filterOptions: {
        enabled: true,
        filterValue: '',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Address 1',
      field: 'address1',
      width: '150px',
      filterOptions: {
        enabled: true,
        filterValue: '',
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
      },
      tdClass: 'align-middle',
    },
    {
      label: 'City',
      field: 'city',
      width: '100px',
      filterOptions: {
        enabled: true,
        filterValue: '',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Zip',
      field: 'zip',
      width: '60px',
      filterOptions: {
        enabled: true,
        filterValue: '',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Bill',
      field: 'bill',
      width: '80px',
      tdClass: 'align-middle',
    },
    {
      label: 'LOR',
      field: 'lor',
      width: '80px',
      tdClass: 'align-middle',
    },
    {
      label: 'LOA',
      field: 'loa',
      width: '80px',
      tdClass: 'align-middle',
    },
    {
      label: 'Misc',
      field: 'misc',
      width: '80px',
      tdClass: 'align-middle',
    },
    {
      label: 'Tax Exempt',
      field: 'tax_exempt',
      width: '100px',
    },
    // {
    //   label: 'Notes',
    //   field: 'notes',
    //   width: '80px',
    //   filterOptions: {
    //     enabled: true,
    //     filterValue: '',
    //   },
    // },
    {
      label: 'Actions',
      field: 'actions',
      width: '150px',
      tdClass: 'align-middle',
    },
  ]
  const tableColumns2 = [
    {
      label: 'ID',
      field: 'id',
      width: '50px',
      tdClass: 'align-middle',
    },

    {
      label: 'Account Number',
      field: 'account_number',
      width: '160px',
      tdClass: 'align-middle',
    },
    {
      label: 'Service Agreement',
      field: 'service_agreement',
      width: '150px',
      tdClass: 'align-middle',
    },
    {
      label: 'Zone',
      field: 'zone',
      width: '70px',
      tdClass: 'align-middle',
    },
    {
      label: 'Rate Class',
      field: 'rate_class',
      width: '120px',
      tdClass: 'align-middle',
    },
    {
      label: 'Sub Type',
      field: 'sub_type',
      width: '100px',
      tdClass: 'align-middle',
    },
    {
      label: 'Annual Vol.',
      field: 'annual_volume',
      width: '120px',
      tdClass: 'align-middle',
    },
    {
      label: 'Current Rate',
      field: 'current_rate',
      width: '150px',
      tdClass: 'align-middle',
    },
    {
      label: 'End Rate',
      field: 'contract_end_date',
      width: '100px',
      tdClass: 'align-middle',
    },
    {
      label: 'Status',
      field: 'status',
      width: '100px',
      tdClass: 'align-middle',
    },
    {
      label: 'Address 1',
      field: 'address1',
      width: '150px',
      tdClass: 'align-middle',
    },
    {
      label: 'Address 2',
      field: 'address2',
      width: '150px',
      tdClass: 'align-middle',
    },
    {
      label: 'City',
      field: 'city',
      width: '100px',
      tdClass: 'align-middle',
    },
    {
      label: 'Zip',
      field: 'zip',
      width: '60px',
      tdClass: 'align-middle',
    },
    {
      label: 'Bill',
      field: 'bill',
      width: '80px',
      tdClass: 'align-middle',
    },
    {
      label: 'LOR',
      field: 'lor',
      width: '80px',
      tdClass: 'align-middle',
    },
    {
      label: 'LOA',
      field: 'loa',
      width: '80px',
      tdClass: 'align-middle',
    },
    {
      label: 'Misc',
      field: 'misc',
      width: '80px',
      tdClass: 'align-middle',
    },
    {
      label: 'Tax Exempt',
      field: 'tax_exempt',
      width: '100px',
    },
    // {
    //   label: 'Notes',
    //   field: 'notes',
    //   width: '80px',
    //   filterOptions: {
    //     enabled: true,
    //     filterValue: '',
    //   },
    // },
    {
      label: 'Actions',
      field: 'actions',
      width: '150px',
      tdClass: 'align-middle',
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

  const deleteAccount = async id => {
    try {
      busy.value = true
      const res = await axios.delete(route('customerAccount.destroy', id))
      respResult.value = res
      toast.success(res.data.message)
      //   refetchData()
    } catch (error) {
      toast.error('Error! Deleting Account')
    } finally {
      busy.value = false
    }
  }

  const getAccount = async id => {
    const response = await axios.get(route('customerAccount.show', id))
    account.value = response.data.data
  }

  const updateAccount = async (customerData, id) => {
    try {
      busy.value = true
      const response = await axios.post(route('customerAccount.update', id), customerData)
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

  const storeAccount = async formData => {
    busy.value = true
    await axios
      .post(route('customerAccount.store'), formData)
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

  const fetchAccounts = async params => {
    busy.value = true
    try {
      const response = await axios.get(route('customerAccount.index'), {
        params: {
          perPage: perPage.value,
          page: currentPage.value,
          sortBy: sortBy.value,
          sortDesc: isSortDirDesc.value,
          ...params,
        },
      })
      customersAccounts.value = response.data.data
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

  const AccountFiles = async (customerData, id) => {
    try {
      busy.value = true
      const response = await axios.post(route('customerAccount.files', id), customerData)
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

  watch([currentPage, perPage], () => {
    fetchAccounts()
  })

  return {
    busy,
    errors,
    sortBy,
    perPage,
    dataMeta,
    account,
    respResult,
    getAccount,
    refetchData,
    AccountFiles,
    currentPage,
    refListTable,
    tableColumns,
    tableColumns2,
    totalRecords,
    isSortDirDesc,
    updateAccount,
    deleteAccount,
    storeAccount,
    fetchAccounts,
    perPageOptions,
    customersAccounts,
  }
}
