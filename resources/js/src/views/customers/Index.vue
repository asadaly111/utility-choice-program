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
      :columns="columns"
      :select-options="{ enabled: true, selectOnCheckboxOnly: true }"
      :rows="customers"
      max-height="80vh"
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
        <div v-if="props.column.field === 'actions'">
          <b-dropdown
            variant="link"
            no-caret
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
            <b-dropdown-item
              @click="confirmDelete(props.row.id)"
            >
              <feather-icon
                icon="TrashIcon"
              />
              <span class="align-middle ml-50">Delete</span>
            </b-dropdown-item>

          </b-dropdown>
        </div>

        <span v-if="props.column.field === 'phone'">
          <span
            style="display:block"
            v-for="(val, index) in props.row.phone"
            :key="index"
          >{{ val.value }}</span>
        </span>
        <span v-else>
          {{ props.formattedRow[props.column.field] }}
        </span>

      </template>
    </vue-good-table>
  </div>
</template>

<script>
import { ref, onMounted } from '@vue/composition-api'
import AppBreadcrumb from '@core/layouts/components/AppBreadcrumb.vue'
import { VueGoodTable } from 'vue-good-table'
import 'vue-select/dist/vue-select.css'
import 'vue-good-table/dist/vue-good-table.css'
import useCustomers from '@/composables/customers'
import statesOptions from '@core/data/states.json'
import citiesOptions from '@core/data/cities.json'
import {
  BRow,
  BCol,
  BDropdown,
  BDropdownItem,
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
      columns: [
        {
          label: 'ID',
          field: 'id',
          width: '100px',
          filterOptions: {
            enabled: true,
            placeholder: 'ID',
          },
        },
        {
          label: 'First Name',
          field: 'first_name',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'Name',
          },
        },
        {
          label: 'Last Name',
          field: 'last_name',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'Name',
          },
        },
        {
          label: 'Email',
          field: 'email',
          width: '180px',
          filterOptions: {
            enabled: true,
            placeholder: 'Email',
          },
        },
        {
          label: 'Phone',
          field: 'phone',
          width: '180px',
          filterOptions: {
            enabled: true,
            placeholder: 'Phone',
          },
        },
        {
          label: 'Business Name',
          field: 'business_name',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'Business Name',
            // filterDropdownItems: ['Business 1', 'Business 2'],
          },
        },
        {
          label: 'Doing Business As',
          field: 'doing_business_as',
          width: '220px',
          filterOptions: {
            enabled: true,
            placeholder: 'Doing Business As',
            // filterDropdownItems: ['Seller', 'Distributor'],
          },
        },
        {
          label: 'Business Type',
          field: 'business_type',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'Business Type',
            filterDropdownItems: [
              'Corporation',
              'Limited Liability Company',
              'Partnership',
              'Individual',
            ],
          },
        },
        {
          label: 'EIN',
          field: 'ein',
          width: '150px',
          filterOptions: {
            enabled: true,
            placeholder: 'EIN',
          },
        },
        {
          label: 'Industry',
          field: 'industry',
          width: '200px',
          filterOptions: {
            enabled: true,
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
        },
        {
          label: 'Tax Excempt',
          field: 'tax_exempt',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'Tax Excempt',
            filterDropdownItems: ['Yes', 'No'],
          },
        },
        {
          label: 'Address',
          field: 'address1',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'Address',
          },
        },
        {
          label: 'Address',
          field: 'address2',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'Address',
          },
        },
        {
          label: 'State',
          field: 'state',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'State',
          },
        },
        {
          label: 'City',
          field: 'city',
          width: '150px',
          filterOptions: {
            enabled: true,
            placeholder: 'City',
          },
        },
        {
          label: 'Billing Address',
          field: 'billing_address',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'Billing Address',
          },
        },
        {
          label: 'Billing State',
          field: 'billing_state',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'Billing State',
          },
        },
        {
          label: 'Billing City',
          field: 'billing_city',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'Billing City',
          },
        },
        {
          label: 'Billing Zip',
          field: 'billing_zip',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'Billing Zip',
          },
        },
        {
          label: 'Agency',
          field: 'agency',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'Agency',
            filterDropdownItems: [
              'Corporation',
              'Limited Liability Company',
              'Partnership',
              'Individual',
            ],
          },
        },
        {
          label: 'Agent',
          field: 'agent',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'Agent',
            filterDropdownItems: [
              'Robert Zane',
              'Harvey Dentt',
              'Sean Azfarani',
            ],
          },
        },
        // {
        //   label: 'Flags',
        //   field: 'flags',
        //   width: '100px',
        // },
        // {
        //   label: 'E/G/Q/C',
        //   field: 'egqc',
        //   type: 'date',
        //   dateInputFormat: 'yyyy-MM-dd',
        //   dateOutputFormat: 'MMM do yy',
        //   width: '150px',
        // },
        {
          label: 'Actions',
          field: 'actions',
          width: '250px',
        },
      ],
      //   rows: [{ id: 1, name: 'taha' }],
      titles: [
        'Owner',
        'Principal',
        'Partner',
        'Vice President',
        'CEO',
      ],
      businessTypes: [
        'Corporation',
        'Limited Liability Company',
        'Partnership',
        'Individual',
      ],
      industries: [
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
    }
  },
  setup(_, context) {
    const {
      busy,
      perPage,
      customers,
      respResult,
      currentPage,
      deleteCustomer,
      fetchCustomers,
      perPageOptions,
    } = useCustomers()

    onMounted(() => {
      fetchCustomers()
    })

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

    const confirmDelete = async id => {
      context.root.$bvModal
        .msgBoxConfirm('Please confirm that you want to delete customer.', {
          title: 'Please Confirm',
          size: 'sm',
        })
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
      customerData,
      citiesOptions,
      statesOptions,
      confirmDelete,
      fetchCustomers,
      perPageOptions,
      editCustomerRow,
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

#add-customer-modal .modal-dialog, #edit-customer-modal .modal-dialog  {
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
