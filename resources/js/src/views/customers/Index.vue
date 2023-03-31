<template>
  <div>
    <Add
      v-if="isAddCustomerActive"
      :is-add-customer-active.sync="isAddCustomerActive"
      @refetch-data="fetchCustomers"
    />
    <Edit
      v-if="isEditCustomerActive"
      :is-edit-customer-active.sync="isEditCustomerActive"
      @refetch-data="fetchCustomers"
      :customer-data="customerData"
    />
    <b-row>
      <b-col
        cols="12"
        md
      >
        <app-breadcrumb />
      </b-col>
      <b-col
        cols="6"
        md="auto"
      >
        <button
          class="btn btn-primary"
          @click="isAddCustomerActive = true"
        >
          <feather-icon icon="PlusIcon" />
          <span class="ml-1">Add Customer</span>
        </button>
        <button class="btn btn-primary">
          <feather-icon icon="FolderPlusIcon" />
          <span class="ml-1">Import Customers</span>
        </button>
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
      :rows="customers"
      :select-options="{ enabled: true, selectOnCheckboxOnly: true }"
      :sort-options="{
        enabled: false,
      }"
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
        <span v-if="props.column.field == 'name'">
          <router-link
            :to="{
              name: 'customer',
              params: {
                id: props.row.id
              },
            }"
          >{{ props.row.name }}</router-link>
        </span>

        <span v-else-if="props.column.field === 'phone'">
          <span
            style="display:block"
            v-for="(val, index) in props.row.phone"
            :key="index"
          >{{ val.value }}</span>
        </span>

        <span v-else>
          {{ props.formattedRow[props.column.field] }}
        </span>

        <div v-if="props.column.field === 'actions'">
          <b-dropdown
            toggle-class="p-0"
            variant="link"
            no-caret
            right
          >
            <template #button-content>
              <feather-icon
                icon="MoreVerticalIcon"
                size="16"
                class="align-middle text-body"
              />
            </template>
            <b-dropdown-item @click="editCustomerRow(props.row)">
              <feather-icon icon="EditIcon" />
              <span class="align-middle ml-50">Edit</span>
            </b-dropdown-item>
            <b-dropdown-item @click="confirmDelete(props.row.id)">
              <feather-icon icon="TrashIcon" />
              <span class="align-middle ml-50">Delete</span>
            </b-dropdown-item>
          </b-dropdown>
        </div>

      </template>
    </vue-good-table>
  </div>
</template>

<script>
import { ref } from '@vue/composition-api'
import AppBreadcrumb from '@core/layouts/components/AppBreadcrumb.vue'
import { VueGoodTable } from 'vue-good-table'
import 'vue-select/dist/vue-select.css'
import 'vue-good-table/dist/vue-good-table.css'
import useCustomers from '@/composables/customers'
import statesOptions from '@core/data/states.json'
import citiesOptions from '@core/data/cities.json'
import {
  BRow, BCol, BDropdown, BDropdownItem,
} from 'bootstrap-vue'
import {
  required, email, integer, min,
} from '@validations'
import Add from './Add.vue'
import Edit from './Edit.vue'

export default {
  data() {
    return {
      required,
      email,
      integer,
      min,
    }
  },
  setup(_, context) {
    const {
      busy,
      perPage,
      customers,
      respResult,
      currentPage,
      totalRecords,
      tableColumns,
      deleteCustomer,
      fetchCustomers,
      perPageOptions,
    } = useCustomers()

    const serverParams = ref({
      columnFilters: {},
      page: 1,
      perPage: 10,
    })

    // onMounted(() => {
    //   fetchCustomers(serverParams.value)
    // })

    const customerData = ref({})
    const isAddCustomerActive = ref(false)
    const isEditCustomerActive = ref(false)

    const editCustomerRow = item => {
      customerData.value = item
      isEditCustomerActive.value = true
    }

    const deleteCustomerConfirmed = async id => {
      await deleteCustomer(id)
      if (respResult.value.status === 200) {
        fetchCustomers()
      }
    }

    const updateParams = newProps => {
      serverParams.value = { ...serverParams.value, ...newProps }
    }

    const onPageChange = params => {
      updateParams({ page: params.currentPage })
      fetchCustomers(serverParams.value)
    }

    const onPerPageChange = params => {
      updateParams({ perPage: params.currentPerPage })
      fetchCustomers(serverParams.value)
    }

    const onColumnFilter = params => {
      updateParams(params)
      fetchCustomers(serverParams.value)
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
      customers,
      currentPage,
      totalRecords,
      customerData,
      onPageChange,
      tableColumns,
      citiesOptions,
      statesOptions,
      confirmDelete,
      onColumnFilter,
      fetchCustomers,
      perPageOptions,
      editCustomerRow,
      onPerPageChange,
      isAddCustomerActive,
      isEditCustomerActive,
    }
  },
  components: {
    Add,
    Edit,
    BCol,
    BRow,
    BDropdown,
    VueGoodTable,
    AppBreadcrumb,
    BDropdownItem,
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

#add-customer-modal .modal-dialog,
#edit-customer-modal .modal-dialog {
    max-width: 1000px;
    .form-group {
        .vs__dropdown-toggle {
            padding: 3px 0 7px;
            border: 1px solid #d8d6de;
        }
        .btn-form-action {
            padding: 5px;
        }
        small {
            font-size: 10px;
        }
    }
}
</style>
