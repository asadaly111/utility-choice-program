<template>
  <div>
    <b-row class="justify-content-md-end">
      <b-col
        cols="12"
        md
      >
        <app-breadcrumb />
      </b-col>
      <b-col cols="auto">
        <b-form-group>
          <b-form-checkbox switch>
            Show Expired
          </b-form-checkbox>
        </b-form-group>
      </b-col>
      <b-col cols="auto">
        <b-form-group>
          <b-form-checkbox switch>
            Compact View
          </b-form-checkbox>
        </b-form-group>
      </b-col>
    </b-row>
    <vue-good-table
      mode="remote"
      @on-page-change="onPageChange"
      @on-per-page-change="onPerPageChange"
      @on-column-filter="onColumnFilter"
      max-height="80vh"
      :columns="tableColumns"
      :total-rows="totalRecords"
      :rows="contracts"
      :select-options="{ enabled: false, selectOnCheckboxOnly: false }"
      :pagination-options="{
        enabled: true,
        mode: 'records',
        perPage: perPage,
        position: 'top',
        perPageDropdown: perPageOptions,
        dropdownAllowAll: false,
        setCurrentPage: currentPage,
        nextLabel: 'Next',
        prevLabel: 'Prev',
        rowsPerPageLabel: 'Rows per page',
        ofLabel: 'of',
        pageLabel: 'page', // for 'pages' mode
        allLabel: 'All',
      }"
    >
      <template
        slot="table-row"
        slot-scope="props"
      >
        <span v-if="props.column.field == 'customer.business_name'">
          <router-link
            :to="{
              name: 'customer',
              params: {
                id: props.row.customer.id
              },
            }"
          >{{ props.row.customer.business_name }}
          </router-link>
        </span>
        <span v-else-if="props.column.field == 'commodity'">
          <img
            :src="require('@/assets/images/icons/gas.svg')"
            v-if="props.row.commodity == 'gas'"
            width="25"
          >
          <img
            :src="require('@/assets/images/icons/electricity.svg')"
            v-if="props.row.commodity == 'electricity'"
            width="25"
          >
        </span>

        <div
          class="action-buttons"
          v-else-if="props.column.field === 'con'"
        >
          <button class="btn action-btn">
            <feather-icon
              icon="FileIcon"
              size="16"
            />
          </button>
        </div>

        <div
          class="action-buttons"
          v-else-if="props.column.field === 'bill'"
        >
          <button class="btn action-btn">
            <feather-icon
              icon="PaperclipIcon"
              size="16"
            />
          </button>
        </div>

        <div
          class="action-buttons"
          v-else-if="props.column.field === 'qc'"
        >
          <button class="btn action-btn">
            <feather-icon
              icon="FilePlusIcon"
              size="16"
            />
          </button>
        </div>

        <div
          class="action-buttons"
          v-else-if="props.column.field === 'notes'"
        >
          <button class="btn action-btn">
            <feather-icon
              icon="FileIcon"
              size="16"
            />
          </button>
        </div>

        <div
          class="action-buttons"
          v-else-if="props.column.field === 'actions'"
        >
          <button class="btn action-btn">
            <feather-icon
              icon="DownloadIcon"
              size="16"
            />
          </button>
          <!-- <button class="btn action-btn">
            <feather-icon
              icon="SendIcon"
              size="16"
            />
          </button>
          <button class="btn action-btn">
            <feather-icon
              icon="ClockIcon"
              size="16"
            />
          </button>
          <button class="btn action-btn">
            <feather-icon
              icon="RefreshCwIcon"
              size="16"
            />
          </button>
          <button class="btn action-btn">
            <feather-icon
              icon="EditIcon"
              size="16"
            />
          </button> -->
          <button class="btn action-btn">
            <feather-icon
              icon="TrashIcon"
              size="16"
            />
          </button>
        </div>
        <span v-else>
          {{ props.formattedRow[props.column.field] }}
        </span>
      </template>
    </vue-good-table>
  </div>
</template>

<script>
import AppBreadcrumb from '@core/layouts/components/AppBreadcrumb.vue'
import { ref } from '@vue/composition-api'
import {
  BRow, BCol, BFormGroup, BFormRow, BFormCheckbox,
} from 'bootstrap-vue'
import 'vue-good-table/dist/vue-good-table.css'
import { VueGoodTable } from 'vue-good-table'
import useContracts from '@/composables/contracts'

export default {
  data() {
    return {
    }
  },
  components: {
    BRow,
    BCol,
    BFormGroup,
    BFormRow,
    BFormCheckbox,
    VueGoodTable,
    AppBreadcrumb,
  },

  setup(_, context) {
    const {
      busy,
      perPage,
      contracts,
      respResult,
      currentPage,
      totalRecords,
      tableColumns,
      deleteCustomer,
      fetchContracts,
      perPageOptions,
    } = useContracts()

    const serverParams = ref({
      columnFilters: {},
      page: 1,
      perPage: 10,
    })

    // onMounted(() => {
    //   fetchContracts(serverParams.value)
    // })

    const customerData = ref({})
    const isAddCustomerActive = ref(false)
    const isEditCustomerActive = ref(false)
    const isImportCustomerActive = ref(false)

    const editCustomerRow = item => {
      customerData.value = item
      isEditCustomerActive.value = true
    }

    const deleteCustomerConfirmed = async id => {
      await deleteCustomer(id)
      if (respResult.value.status === 200) {
        fetchContracts()
      }
    }

    const updateParams = newProps => {
      serverParams.value = { ...serverParams.value, ...newProps }
    }

    const onPageChange = params => {
      updateParams({ page: params.currentPage })
      fetchContracts(serverParams.value)
    }

    const onPerPageChange = params => {
      updateParams({ perPage: params.currentPerPage })
      fetchContracts(serverParams.value)
    }

    const onColumnFilter = params => {
      updateParams(params)
      fetchContracts(serverParams.value)
    }

    const confirmDelete = async id => {
      context.root.$bvModal
        .msgBoxConfirm(
          'Please confirm that you want to delete customer.',
          {
            title: 'Please Confirm',
            size: 'sm',
          },
        )
        .then(value => {
          if (value) {
            deleteCustomerConfirmed(id)
          }
        })
    }

    return {
      busy,
      perPage,
      contracts,
      currentPage,
      totalRecords,
      customerData,
      onPageChange,
      tableColumns,
      confirmDelete,
      onColumnFilter,
      fetchContracts,
      perPageOptions,
      editCustomerRow,
      onPerPageChange,
      isAddCustomerActive,
      isEditCustomerActive,
      isImportCustomerActive,
    }
  },
}
</script>
<style lang="scss">
.vgt-wrap {
    .vgt-table {
        thead {
            position: sticky;
            top: 0;
        }
        th {
            font-size: 12px;
            input {
                font-size: 12px;
            }
            select {
                font-size: 12px;
            }
        }
        td {
            font-size: 12px;
            img {
                max-width: 150px;
                max-height: 50px;
            }
            .action-buttons {
                .action-btn {
                    font-size: 20px;
                    padding: 5px;
                }
            }
        }
    }
    .vgt-wrap__footer {
        padding: 10px;
        .footer__row-count {
            form {
                display: inline-flex;
                align-items: center;
            }
            .footer__row-count__label {
                font-size: 13px;
            }
            .footer__row-count__select {
                font-size: 12px;
            }
            &::after {
                border-width: 4px;
            }
        }
        .footer__navigation__page-info {
            font-size: 12px;
        }
        .footer__navigation__page-btn span {
            font-size: 12px;
        }
    }
}
</style>
