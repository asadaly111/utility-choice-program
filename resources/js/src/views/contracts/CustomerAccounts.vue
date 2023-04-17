<template>
  <b-card>
    <!-- tabs -->
    <b-tabs
      content-class="pt-1"
      fill
    >
      <b-tab
        title="Step 1: Customer Details"
        disabled
      >
        <template #title>
          <feather-icon icon="UserIcon" />
          <span>Step 1: Customer Details</span>
        </template>
      </b-tab>
      <b-tab
        title="Step 2: Add Account(s)"
        active
      >
        <template #title>
          <feather-icon icon="PlusIcon" />
          <span>Step 2: Add Account(s)</span>
        </template>

        <b-card no-body>
          <b-card-body>
            <!-- <b-row>
              <b-col>
                <b-button
                  class="mb-1"
                  variant="primary"
                  @click="isAddAccountActive = true"
                >
                  Add Account
                </b-button>
              </b-col>
            </b-row> -->
            <b-row>
              <b-col>
                <vue-good-table
                  mode="remote"
                  @on-page-change="onPageChange"
                  @on-per-page-change="onPerPageChange"
                  @on-column-filter="onColumnFilter"
                  max-height="80vh"
                  :columns="tableColumns2"
                  :total-rows="totalRecords"
                  :rows="customersAccounts"
                  :select-options="{
                    enabled: true,
                    selectOnCheckboxOnly: false,
                  }"
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
                    <div v-if="props.column.field == 'eg'">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        width="24"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"
                        />
                      </svg>
                    </div>
                    <div v-else-if="props.column.field == 'bill'">
                      <feather-icon
                        icon="FolderPlusIcon"
                        size="18"
                        class="align-middle text-body"
                        @click="accountFile({id:props.row.id, name:'Bill', type:'bill'})"
                      />
                    </div>
                    <div v-else-if="props.column.field == 'loa'">
                      <feather-icon
                        icon="FolderPlusIcon"
                        size="18"
                        class="align-middle text-body"
                        @click="accountFile({id:props.row.id, name:'Loa', type:'loa'})"
                      />
                    </div>
                    <div v-else-if="props.column.field == 'lor'">
                      <feather-icon
                        icon="FolderPlusIcon"
                        size="18"
                        class="align-middle text-body"
                        @click="accountFile({id:props.row.id, name:'Lor', type:'lor'})"
                      />
                    </div>
                    <div v-else-if="props.column.field == 'misc'">
                      <feather-icon
                        icon="FolderPlusIcon"
                        size="18"
                        class="align-middle text-body"
                        @click="accountFile({id:props.row.id,name:'Misc', type:'misc'})"
                      />
                    </div>
                    <div v-else-if="props.column.field == 'tax_exempt'">
                      <feather-icon
                        icon="FolderPlusIcon"
                        size="18"
                        class="align-middle text-body"
                        @click="accountFile({id:props.row.id,name:'Tax Exempt', type:'tax_exempt'})"
                      />
                    </div>
                    <div v-else-if="props.column.field == 'notes'">
                      <feather-icon
                        icon="FolderIcon"
                        size="18"
                        class="align-middle text-body"
                      />
                    </div>
                    <div v-else-if="props.column.field === 'actions'">
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
                        <b-dropdown-item>
                          <feather-icon
                            icon="RotateCcwIcon"
                          />
                          <span
                            class="align-middle ml-50"
                          >History</span>
                        </b-dropdown-item>
                        <b-dropdown-item
                          @click="editAccountRow(props.row)"
                        >
                          <feather-icon icon="EditIcon" />
                          <span
                            class="align-middle ml-50"
                          >Edit</span>
                        </b-dropdown-item>
                        <b-dropdown-item
                          @click="confirmDelete(props.row.id)"
                        >
                          <feather-icon icon="TrashIcon" />
                          <span
                            class="align-middle ml-50"
                          >Delete</span>
                        </b-dropdown-item>
                      </b-dropdown>
                    </div>
                    <span v-else>
                      {{ props.formattedRow[props.column.field] }}
                    </span>
                  </template>
                </vue-good-table>
              </b-col>
            </b-row>
          </b-card-body>

          <b-card-body>
            <div class="d-flex justify-content-between">
              <b-button
                class="mb-1"
                variant="primary"
                :to="{
                  name: 'contract-customer',
                  params: {
                    id: $route.params.id,
                  },
                }"
              >
                Back to Step 1
              </b-button>
              <div class="d-flex d-flex-middle flex-flow-row align-items-center">
                <div class="p-10 xs-p-5">
                  Total Volume:
                </div>
                <div
                  class="p-10  xs-p-5"
                  id="total-volume"
                  data-val="10000"
                >
                  {{ totalVolume }}
                </div>
                <div class="p-10 xs-p-5 ml-3">
                  Used Volume:
                </div>
                <div
                  id="used-volume"
                  class="p-10 xs-p-5"
                  data-val="0"
                  style="transition: .6s all ease-in-out"
                >
                  {{ formData.annual_volume }}
                </div>
                <div class="inline-block ml-5 sm-p-10 xs-p-5">
                  <b-alert
                    class="mb-0"
                    show
                    variant="primary"
                    v-if="formData.annual_volume >= totalVolume"
                  >
                    <div class="alert-body">
                      <span>You may generate contract. Just save account first.</span>
                    </div>
                  </b-alert>
                  <b-alert
                    class="mb-0"
                    variant="danger"
                    v-else
                    show
                  >
                    <div class="alert-body">
                      <span> Used volume is less than total ({{ totalVolume }} needed)</span>
                    </div>
                  </b-alert>

                </div>
              </div>
              <b-button
                class="mb-1"
                variant="primary"
                :disabled="customersAccounts.length > 0 ? false : true"
                :to="{name: 'contract-generate'}"
              >
                Generate Contract
              </b-button>
            </div>
          </b-card-body>

          <b-card-body>
            <validation-observer
              #default="{ handleSubmit }"
              ref="refFormObserver"
            >

              <b-form
                ref="form"
                @submit.prevent="handleSubmit(onSubmit)"
              >
                <b-row>
                  <b-col
                    md="6"
                    lg="2"
                  >
                    <b-form-group label="Document">
                      <b-form-file
                        type="file"
                        v-model="file.document"
                      />
                    </b-form-group>
                  </b-col>

                  <b-col
                    cols="12"
                    md="6"
                    lg="2"
                  >
                    <b-form-group label="Zip">
                      <validation-provider
                        #default="{ errors }"
                        rules="required"
                        name="Zip"
                      >
                        <b-form-input
                          v-model="formData.zip"
                          :state="errors.length > 0 ? false : null"
                          placeholder="Zip"
                        />
                        <small class="text-danger">{{
                          errors[0]
                        }}</small>
                      </validation-provider>
                    </b-form-group>
                  </b-col>

                  <b-col
                    cols="12"
                    md="6"
                    lg="2"
                  >
                    <b-form-group label="Sub Type">
                      <validation-provider
                        #default="{ errors }"
                        rules="required"
                        name="Sub Type"
                      >
                        <b-form-input
                          v-model="formData.sub_type"
                          :state="errors.length > 0 ? false : null"
                          placeholder="Sub Type"
                        />
                        <small class="text-danger">{{
                          errors[0]
                        }}</small>
                      </validation-provider>
                    </b-form-group>
                  </b-col>

                  <b-col
                    cols="12"
                    md="6"
                    lg="2"
                  >
                    <b-form-group label="Commodity">
                      <validation-provider
                        #default="{ errors }"
                        rules="required"
                        name="Commodity"
                      >
                        <vue-select
                          :options="[
                            {
                              value: 'electricity',
                              name: 'Electricity',
                            },
                            {
                              value: 'gas',
                              name: 'Gas',
                            },
                          ]"
                          label="name"
                          :reduce="(dropdown) => dropdown.name"
                          v-model="formData.commodity"
                          :state="errors.length > 0 ? false : null"
                        />
                        <small class="text-danger">{{
                          errors[0]
                        }}</small>
                      </validation-provider>
                    </b-form-group>
                  </b-col>

                  <b-col
                    cols="12"
                    md="6"
                    lg="2"
                  >
                    <b-form-group label="Address 1">
                      <validation-provider
                        #default="{ errors }"
                        rules="required"
                        name="Address 1"
                      >
                        <b-form-input
                          v-model="formData.address1"
                          :state="errors.length > 0 ? false : null"
                          placeholder="Address 1"
                        />
                        <small class="text-danger">{{
                          errors[0]
                        }}</small>
                      </validation-provider>
                    </b-form-group>
                  </b-col>

                  <b-col
                    cols="12"
                    md="6"
                    lg="2"
                  >
                    <b-form-group label="Address 2">
                      <b-form-input
                        v-model="formData.address2"
                        placeholder="Address 2"
                      />
                    </b-form-group>
                  </b-col>

                  <b-col
                    cols="12"
                    md="6"
                    lg="2"
                  >
                    <b-form-group label="Rate Class">
                      <validation-provider
                        #default="{ errors }"
                        rules="required"
                        name="Rate Class"
                      >
                        <vue-select
                          :options="[
                            {
                              value: 'none',
                              name: 'None',
                            }
                          ]"
                          label="name"
                          :reduce="(dropdown) => dropdown.name"
                          v-model="formData.rate_class"
                          :state="errors.length > 0 ? false : null"
                        />
                        <small class="text-danger">{{
                          errors[0]
                        }}</small>
                      </validation-provider>
                    </b-form-group>
                  </b-col>

                  <b-col
                    cols="12"
                    md="6"
                    lg="2"
                  >
                    <b-form-group label="Status">
                      <validation-provider
                        #default="{ errors }"
                        rules="required"
                        name="Status"
                      >
                        <vue-select
                          :options="[
                            {
                              value: 'Under Contact',
                              name: 'Under Contact',
                            },
                            {
                              value: 'Not Under Contract',
                              name: 'Not Under Contract',
                            },
                          ]"
                          label="name"
                          :reduce="(dropdown) => dropdown.name"
                          v-model="formData.account_status"
                          :state="errors.length > 0 ? false : null"
                        />
                        <small class="text-danger">{{
                          errors[0]
                        }}</small>
                      </validation-provider>
                    </b-form-group>
                  </b-col>

                  <b-col
                    cols="12"
                    md="6"
                    lg="2"
                  >
                    <b-form-group label="Contract End Date">
                      <validation-provider
                        #default="{ errors }"
                        rules="required"
                        name="Contract End Date"
                      >
                        <b-form-input
                          type="date"
                          v-model="formData.contract_end_date"
                          :state="errors.length > 0 ? false : null"
                          placeholder="Contract End Date"
                        />
                        <small class="text-danger">{{
                          errors[0]
                        }}</small>
                      </validation-provider>
                    </b-form-group>
                  </b-col>

                  <b-col
                    cols="12"
                    md="6"
                    lg="2"
                  >
                    <b-form-group label="State">
                      <validation-provider
                        #default="{ errors }"
                        rules="required"
                        name="State"
                      >
                        <vue-select
                          v-model="formData.state"
                          :options="statesOptions"
                          :reduce="(state) => state.name"
                          label="name"
                          @input="filterCities"
                          :state="errors.length > 0 ? false : null"
                        />
                        <small class="text-danger">{{
                          errors[0]
                        }}</small>
                      </validation-provider>
                    </b-form-group>
                  </b-col>

                  <b-col
                    cols="12"
                    md="6"
                    lg="2"
                  >
                    <b-form-group label="City">
                      <validation-provider
                        #default="{ errors }"
                        rules="required"
                        name="City"
                      >
                        <vue-select
                          :options="citiesFilteredObjects"
                          :reduce="(city) => city.name"
                          v-model="formData.city"
                          label="name"
                          :state="errors.length > 0 ? false : null"
                        />
                        <small class="text-danger">{{
                          errors[0]
                        }}</small>
                      </validation-provider>
                    </b-form-group>
                  </b-col>

                  <b-col
                    cols="12"
                    md="6"
                    lg="2"
                  >
                    <b-form-group label="Zone">
                      <validation-provider
                        #default="{ errors }"
                        rules="required"
                        name="Zone"
                      >
                        <vue-select
                          :options="[
                            {
                              value: 'none',
                              name: 'None',
                            }
                          ]"
                          label="name"
                          :reduce="(dropdown) => dropdown.name"
                          v-model="formData.zone"
                          :state="errors.length > 0 ? false : null"
                        />
                        <small class="text-danger">{{
                          errors[0]
                        }}</small>
                      </validation-provider>
                    </b-form-group>
                  </b-col>

                  <b-col
                    cols="12"
                    md="6"
                    lg="2"
                  >
                    <b-form-group label="Utility">
                      <validation-provider
                        #default="{ errors }"
                        rules="required"
                        name="Utility"
                      >
                        <vue-select
                          :options="utility"
                          label="name"
                          :reduce="(dropdown) => dropdown.name"
                          v-model="formData.utility"
                          :state="errors.length > 0 ? false : null"
                        />
                        <small class="text-danger">{{
                          errors[0]
                        }}</small>
                      </validation-provider>
                    </b-form-group>
                  </b-col>

                  <b-col
                    cols="12"
                    md="6"
                    lg="2"
                  >
                    <b-form-group label="Current Rate">
                      <validation-provider
                        #default="{ errors }"
                        rules="required"
                        name="Current Rate"
                      >
                        <b-form-input
                          v-model="formData.current_rate"
                          :state="errors.length > 0 ? false : null"
                          placeholder="Current Rate"
                        />
                        <small class="text-danger">{{
                          errors[0]
                        }}</small>
                      </validation-provider>
                    </b-form-group>
                  </b-col>

                  <b-col
                    cols="12"
                    md="6"
                    lg="2"
                  >
                    <b-form-group label="Notes">
                      <b-form-input
                        v-model="formData.notes"
                        placeholder="Notes"
                      />
                    </b-form-group>
                  </b-col>

                  <b-col
                    cols="12"
                    md="6"
                    lg="2"
                  >
                    <b-form-group label="Account Number">
                      <validation-provider
                        #default="{ errors }"
                        rules="required"
                        name="Account Number"
                      >
                        <b-form-input
                          v-model="formData.account_number"
                          :state="errors.length > 0 ? false : null"
                          placeholder="Account Number"
                        />
                        <small class="text-danger">{{
                          errors[0]
                        }}</small>
                      </validation-provider>
                    </b-form-group>
                  </b-col>

                  <b-col
                    cols="12"
                    md="6"
                    lg="2"
                  >
                    <b-form-group label="Annual Volume">
                      <validation-provider
                        #default="{ errors }"
                        rules="required"
                        name="Annual Volume"
                      >
                        <b-form-input
                          v-model="formData.annual_volume"
                          :state="errors.length > 0 ? false : null"
                          placeholder="Annual Volume"
                        />
                        <small class="text-danger">{{
                          errors[0]
                        }}</small>
                      </validation-provider>
                    </b-form-group>
                  </b-col>
                </b-row>

                <!-- Form Actions -->
                <div class="d-flex mt-2 m-2 justify-content-end">
                  <b-button
                    type="button"
                    size="sm"
                    class="mr-2"
                    variant="outline-secondary"
                    @click="$emit('update:is-add-account-active', false)"
                  >
                    Cancel
                  </b-button>
                  <b-button
                    variant="primary"
                    type="submit"
                  >
                    Save
                  </b-button>
                </div>
              </b-form>
            </validation-observer>
          </b-card-body>
        </b-card>
      </b-tab>
      <b-tab
        title="Step 3: Generate Contract"
        disabled
      >
        <template #title>
          <feather-icon icon="FileIcon" />
          <span>Step 3: Generate Contract</span>
        </template>
        sd
      </b-tab>
    </b-tabs>
    <!-- end tabs -->
    <AddAccount
      v-if="isAddAccountActive"
      :is-add-account-active.sync="isAddAccountActive"
      @refetch-data="fetchAccountRefresh"
      :user-data="userData"
    />
  </b-card>
</template>

<script>
import { ref, onMounted } from '@vue/composition-api'

import {
  BRow,
  BCol,
  BCard,
  BCardBody,
  BTabs,
  BTab,
  BForm,
  BAlert,
  BButton,
  BFormFile,
  BFormGroup,
  BFormInput,
  BDropdown,
  BDropdownItem,
  BFormSelect,
  BInputGroup,
  BFormCheckbox,
  BInputGroupPrepend,
} from 'bootstrap-vue'
import useCustomers from '@/composables/customers'
import statesOptions from '@core/data/states.json'
import citiesOptions from '@core/data/cities.json'
import {
  required, email, integer, min,
} from '@validations'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import useAccounts from '@/composables/customersAccount'
import { VueGoodTable } from 'vue-good-table'
import 'vue-good-table/dist/vue-good-table.css'
import utility from '@core/data/utility.json'
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import { VueSelect } from 'vue-select'
import AddAccount from '../customers/AddAccount.vue'

export default {
  components: {
    BTabs,
    BTab,
    BRow,
    BCol,
    BCard,
    BForm,
    BAlert,
    BCardBody,
    AddAccount,
    BButton,
    VueGoodTable,
    BFormFile,
    BFormGroup,
    BFormInput,
    BDropdown,
    VueSelect,
    BDropdownItem,
    BFormSelect,
    BInputGroup,
    BFormCheckbox,
    BInputGroupPrepend,
    ValidationProvider,
    ValidationObserver,
  },
  methods: {
    formSubmitted() {},
  },

  setup(props, { root }) {
    const titles = ref([
      'Owner',
      'Principal',
      'Partner',
      'Vice President',
      'CEO',
      'COO',
      'CFO',
      'Controller',
      'Treasurer',
      'Director of Operations',
      'Director of Finance',
      'Business Manager',
      'Finance Manager',
      'Property Manager',
      'Trustee',
      'Board Member',
      'Power of Attorney',
      'Business Administrator',
      'Pastor',
      'Reverend',
      'Rabbi',
      'Accounts Payable Manager',
    ])
    const businessTypes = ref([
      'Corporation',
      'Limited Liability Company',
      'Partnership',
      'Individual',
    ])
    const industries = ([
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
    ])

    const isAddAccountActive = ref(false)
    const userData = ref({})
    const totalVolume = ref(10000)

    // get customer data
    const {
      getCustomer,
      customer,
    } = useCustomers()



    onMounted(async () => {
      await getCustomer(root.$route.params.id)
      userData.value = customer.value
    })


    const formInitialState = {
      document: null,
      first_name: '',
      last_name: '',
      title: '',
      email: '',
      business_name: '',
      doing_business_as: '',
      business_type: '',
      ein: '',
      industry: '',
      tax_exempt: '',
      address1: '',
      address2: '',
      state: '',
      city: '',
      zip: '',
      billing_address_option: '',
      billing_address: '',
      billing_state: '',
      billing_city: '',
      billing_zip: '',
    }

    const fileInitialState = {
      document: [],
    }

    const file = ref({ ...fileInitialState })

    const {
      perPage,
      respResult,
      currentPage,
      tableColumns2,
      storeAccount,
      totalRecords,
      fetchAccounts,
      deleteAccount,
      perPageOptions,
      customersAccounts,
    } = useAccounts()

    const formPhoneInitialState = {
      phone_number: [
        {
          id: 1,
          type: 'Mobile',
          value: '',
        },
      ],
    }


    const serverParams = ref({
      columnFilters: {},
      page: currentPage,
      user_id: root.$route.params.id,
      perPage,
    })


    fetchAccounts(serverParams.value)


    const fetchAccountRefresh = () => {
      fetchAccounts(serverParams.value)
    }

    const updateParams = newProps => {
      serverParams.value = { ...serverParams.value, ...newProps }
    }

    const onPageChange = params => {
      updateParams({ page: params.currentPage })
      fetchAccounts(serverParams.value)
    }

    const onPerPageChange = params => {
      updateParams({ perPage: params.currentPerPage })
      fetchAccounts(serverParams.value)
    }

    const onColumnFilter = params => {
      updateParams(params)
      fetchAccounts(serverParams.value)
    }

    const isBillingActive = ref(false)
    const citiesFilteredObjects = ref([])
    const billingCitiesFilteredObjects = ref([])
    const formData = ref({ ...formInitialState })
    const phone = ref({ ...formPhoneInitialState })

    const showBilling = item => {
      isBillingActive.value = item
    }

    const addPhoneNumber = id => {
      phone.value.phone_number.push({ id, type: 'Mobile', value: '' })
    }
    const removePhoneNumber = id => {
      phone.value.phone_number = phone.value.phone_number.filter(
        obj => obj.id !== id,
      )
    }

    const filterCities = state => {
      citiesFilteredObjects.value = citiesOptions.filter(
        obj => obj.state_name === state,
      )
    }

    const filterBillingCities = state => {
      billingCitiesFilteredObjects.value = citiesOptions.filter(
        obj => obj.state_name === state,
      )
    }

    const onSubmit = async () => {
      const data = new FormData()
      data.append('document', file.value.document)
      data.append('zip', formData.value.zip)
      data.append('sub_type', formData.value.sub_type)
      data.append('commodity', formData.value.commodity)
      data.append('address1', formData.value.address1)
      data.append('rate_class', formData.value.rate_class)
      data.append('status', formData.value.account_status)
      data.append('contract_end_date', formData.value.contract_end_date)
      data.append('state', formData.value.state)
      data.append('city', formData.value.city)
      data.append('zone', formData.value.zone)
      data.append('utility', formData.value.utility)
      data.append('current_rate', formData.value.current_rate)
      data.append('notes', formData.value.notes)
      data.append('account_number', formData.value.account_number)
      data.append('annual_volume', formData.value.annual_volume)
      data.append('user_id', customer.value.id)

      if (formData.value.address2) {
        data.append('address2', formData.value.address2)
      }

      await storeAccount(data)
      if (respResult.value.status === 200) {
        fetchAccountRefresh()
        // emit('update:is-add-account-active', false)
        // emit('refetch-data')
        // resetplanData()
      }
    }

    return {
      required,
      email,
      integer,
      min,
      phone,
      onSubmit,
      formData,
      utility,
      file,
      titles,
      totalVolume,
      userData,
      industries,
      businessTypes,
      showBilling,
      filterCities,
      onColumnFilter,
      citiesOptions,
      perPage,
      isAddAccountActive,
      onPageChange,
      onPerPageChange,
      respResult,
      currentPage,
      tableColumns2,
      totalRecords,
      fetchAccounts,
      deleteAccount,
      fetchAccountRefresh,
      perPageOptions,
      customersAccounts,
      statesOptions,
      addPhoneNumber,
      isBillingActive,
      removePhoneNumber,
      filterBillingCities,
      citiesFilteredObjects,
      billingCitiesFilteredObjects,
    }
  },
}
</script>
<style lang="scss">
@import '@core/scss/vue/libs/vue-wizard.scss';
.vgt-table th{
  font-size: 11px !important;
}
</style>

<style lang="scss" scoped>
.checkout-form-wizard ::v-deep {
  .wizard-tab-content {
    box-shadow: none !important;
    background: transparent !important;
    padding: 0;
  }
}

</style>
