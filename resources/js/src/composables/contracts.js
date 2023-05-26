import axios from '@axios'
import {
  ref, watch, computed,
} from '@vue/composition-api'
import route from 'ziggy-js'
import toaster from './toaster'

export default function useContracts() {
  const busy = ref(false)
  const toast = toaster()
  const respResult = ref(null)
  const refListTable = ref(null)
  const contracts = ref([])
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
        enabled: false,
        filterValue: '',
        placeholder: 'ID',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Agent Name',
      field: 'user.name',
      width: '150px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'Name',
      },
      tdClass: 'align-middle',
    },
    // {
    //   label: 'Last Name',
    //   field: 'last_name',
    //   width: '150px',
    //   filterOptions: {
    //     enabled: true,
    //     filterValue: '',
    //     placeholder: 'Last Name',
    //   },
    //   tdClass: 'align-middle',
    // },
    {
      label: 'Business Name',
      field: 'customer.business_name',
      width: '180px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'Business Name',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'State',
      field: 'state',
      width: '160px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'State',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Utility',
      field: 'utility',
      width: '150px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'Utility',
        // filterDropdownItems: ['Seller', 'Distributor'],
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Account Number',
      field: 'account_number',
      width: '150px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'Account Number',
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
      label: 'E/G',
      field: 'commodity',
      width: '120px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'Commodity',
        filterDropdownItems: ['electricity', 'gas'],

      },
      tdClass: 'align-middle',
    },

    {
      label: 'Supplier',
      field: 'supplier',
      width: '150px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'Supplier',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Product',
      field: 'product',
      width: '200px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'Product',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Volume',
      field: 'volume',
      width: '150px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'Volume',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Start Month',
      field: 'start_month',
      width: '150px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'Start Month',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Sell Price',
      field: 'current_rate',
      width: '150px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'Sell Price',
      },
      tdClass: 'align-middle',
    },
    {
      label: 'Status',
      field: 'status',
      width: '150px',
      filterOptions: {
        enabled: true,
        filterValue: '',
        placeholder: 'Status',
        filterDropdownItems: ['Draft', 'Submitted to Supplier', 'Cancelled by DocuSign', 'Sent To Supplier', 'Accepted by Customer'],
      },
      tdClass: 'align-middle',
    },
    // {
    //   label: 'Flags',
    //   field: 'flags',
    //   width: '150px',
    //   filterOptions: {
    //     enabled: true,
    //     filterValue: '',
    //     placeholder: 'Status',
    //     filterDropdownItems: ['Credit Failed', 'Submitted to Supplier', 'Cancelled by DocuSign', 'Sent To Supplier', 'Accepted by Customer'],
    //   },
    //   tdClass: 'align-middle',
    // },
    // {
    //   label: 'Flags',
    //   field: 'flags',
    //   width: '80px',
    // },
    // {
    //   label: 'Q/C',
    //   field: 'flags',
    //   width: '80px',
    // },
    // {
    //   label: 'Bill',
    //   field: 'flags',
    //   width: '80px',
    // },
    {
      label: 'Actions',
      field: 'actions',
      width: '120px',
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
      const res = await axios.delete(route('contracts.destroy', id))
      respResult.value = res
      toast.success(res.data.message)
      //   refetchData()
    } catch (error) {
      toast.error('Error! Deleting user')
    } finally {
      busy.value = false
    }
  }

  const getContract = async id => {
    const response = await axios.get(route('contracts.show', id))
    return response
  }

  const downloadContractPdf = async id => {
    try {
      const response = await axios.get(route('contracts.download', id), {
        headers: {
          'Content-Type': 'application/pdf',
        },
      })
      const blob = await response.blob()
      const url = window.URL.createObjectURL(new Blob([blob]))
      const link = document.createElement('a')
      link.href = url
      link.setAttribute('download', `${id}-contract.pdf`)
      document.body.appendChild(link)
      link.click()
      link.remove()
    } catch (error) {
      toast.error(error.response.data.message)
    } finally {
      busy.value = false
    }
  }

  const updateCustomer = async (customerData, id) => {
    try {
      busy.value = true
      const response = await axios.post(route('contracts.update', id), customerData)
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

  const sendContractViaDocuSign = async contractId => {
    try {
      busy.value = true
      const response = await axios.post(route('contracts.docusign', contractId))
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

  const storeContract = async formData => {
    busy.value = true
    await axios
      .post(route('contracts.store'), formData)
      .then(resp => {
        respResult.value = resp
        toast.success(resp.data.message)
      })
      .catch(err => {
        console.log(err)
        respResult.value = err
        toast.error(err.response.data.message)
      }).finally(() => {
        busy.value = false
      })
  }

  const fetchContracts = async params => {
    busy.value = true
    try {
      const response = await axios.get(route('contracts.index'), {
        params: {
          perPage: perPage.value,
          page: currentPage.value,
          sortBy: sortBy.value,
          sortDesc: isSortDirDesc.value,
          ...params,
        },
      })
      contracts.value = response.data.data
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

  const fetchContractsList = async () => {
    busy.value = true
    try {
      const response = await axios.get(route('contracts.index'))
      contracts.value = response.data.data
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


  return {
    busy,
    toast,
    errors,
    sortBy,
    perPage,
    dataMeta,
    customer,
    contracts,
    respResult,
    getContract,
    refetchData,
    currentPage,
    refListTable,
    tableColumns,
    totalRecords,
    downloadContractPdf,
    isSortDirDesc,
    updateCustomer,
    deleteCustomer,
    storeContract,
    fetchContracts,
    perPageOptions,
    fetchContractsList,
    sendContractViaDocuSign,
  }
}
