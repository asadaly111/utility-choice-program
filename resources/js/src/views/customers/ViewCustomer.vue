<template>
  <div class="row customer-data-row">
    <div class="col-md-4 col-lg-3 col-xl-2 d-flex flex-column">
      <p class="text-center">
        <strong>Customer Info #</strong>
        5455646
      </p>
      <p class="text-center">
        <strong>Agency</strong><br>
        Utility Choice Program
      </p>
      <p class="text-center">
        <strong>Agent</strong><br>
        Corey Harbin
      </p>
      <vue-perfect-scrollbar
        :settings="perfectScrollbarSettings"
        class="bg-white customer-data-scroll col p-2"
      >
        <validation-observer
          #default="{ handleSubmit }"
          ref="refFormObserver"
        >
          <b-overlay

            :show="isLoading"
            rounded="sm"
            opacity="0.5"
          >

            <b-form
              ref="form"
              @submit.prevent="handleSubmit(onSubmit)"
            >
              <b-row>
                <b-col
                  md="12"
                  lg="12"
                >
                  <!-- conditional rules formData.tax_exempt-->
                  <b-form-group label="Document">
                    <validation-provider
                      #default="{ errors }"
                      name="Document"
                      :rules="formData.tax_exempt ? 'required' : '' "
                    >
                      <b-form-file
                        type="file"
                        v-model="formData.document"
                        :state="errors.length > 0 ? false : null"
                      />
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
                  </b-form-group>
                </b-col>

                <b-col
                  cols="12"
                  md="12"
                  lg="12"
                >
                  <b-form-group label="First Name">
                    <validation-provider
                      #default="{ errors }"
                      rules="required"
                      name="First Name"
                    >
                      <b-form-input
                        v-model="formData.first_name"
                        :state="errors.length > 0 ? false : null"
                        placeholder="First Name"
                      />
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
                  </b-form-group>
                </b-col>

                <b-col
                  cols="12"
                  md="12"
                  lg="12"
                >
                  <b-form-group label="Last Name">
                    <validation-provider
                      #default="{ errors }"
                      rules="required"
                      name="Last Name"
                    >
                      <b-form-input
                        v-model="formData.last_name"
                        :state="errors.length > 0 ? false : null"
                        placeholder="Last Name"
                      />
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
                  </b-form-group>
                </b-col>

                <b-col
                  cols="12"
                  md="12"
                  lg="12"
                >
                  <b-form-group label="Title">
                    <validation-provider
                      #default="{ errors }"
                      rules="required"
                      name="Title"
                    >
                      <v-select
                        v-model="formData.title"
                        :options="titles"
                        placeholder="Title"
                      />
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
                  </b-form-group>
                </b-col>

                <b-col
                  cols="12"
                  md="12"
                  lg="12"
                >
                  <b-form-group label="Email">
                    <validation-provider
                      #default="{ errors }"
                      rules="required|email"
                      name="Email"
                    >
                      <b-form-input
                        type="email"
                        v-model="formData.email"
                        :state="errors.length > 0 ? false : null"
                        placeholder="Email"
                      />
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
                  </b-form-group>
                </b-col>

                <b-col
                  md="12"
                  lg="12"
                  v-for="(phoneNum, index) in phone.phone_number"
                  :key="index"
                >
                  <b-form-group label="Phone Number">
                    <b-input-group class="flex-nowrap">
                      <b-input-group-prepend>
                        <b-form-select
                          :options="[
                            {
                              text: 'Mobile',
                              value: 'Mobile',
                            },
                            {
                              text: 'Office',
                              value: 'Office',
                            },
                          ]"
                          v-model="phoneNum.type"
                        />
                      </b-input-group-prepend>
                      <validation-provider
                        #default="{ errors }"
                        rules="required"
                        :name="'Phone Number'"
                        :vid="'Phone-Number-' + index"
                      >
                        <div class="d-flex">
                          <b-form-input
                            type="tel"
                            v-model="phoneNum.value"
                            :state="errors.length > 0 ? false : null"
                            placeholder="Phone Number"
                          />
                          <button
                            v-if="index == 0"
                            type="button"
                            class="btn btn-sm btn-form-action btn-primary"
                            @click.prevent="
                              addPhoneNumber(
                                phone.phone_number[phone.phone_number.length - 1].id +
                                  1
                              )
                            "
                          >
                            <feather-icon
                              icon="PlusIcon"
                              size="16"
                            />
                          </button>
                          <button
                            v-else
                            type="button"
                            class="btn btn-sm btn-form-action btn-primary"
                            @click.prevent="removePhoneNumber(phoneNum.id)"
                          >
                            <feather-icon
                              icon="XIcon"
                              size="16"
                            />
                          </button>
                        </div>
                        <small class="text-danger">{{ errors[0] }}</small>
                      </validation-provider>
                    </b-input-group>

                    <!-- </validation-provider> -->
                  </b-form-group>
                </b-col>

                <b-col
                  cols="12"
                  md="12"
                  lg="12"
                >
                  <b-form-group label="Business Name">
                    <validation-provider
                      #default="{ errors }"
                      rules="required"
                      name="Business Name"
                    >
                      <b-form-input
                        v-model="formData.business_name"
                        :state="errors.length > 0 ? false : null"
                        placeholder="Business Name"
                      />
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
                  </b-form-group>
                </b-col>

                <b-col
                  cols="12"
                  md="12"
                  lg="12"
                >
                  <b-form-group label="Doing Business As">
                    <validation-provider
                      #default="{ errors }"
                      name="Doing Business As"
                    >
                      <b-form-input
                        v-model="formData.doing_business_as"
                        :state="errors.length > 0 ? false : null"
                        placeholder="Doing Business As"
                      />
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
                  </b-form-group>
                </b-col>

                <b-col
                  cols="12"
                  md="12"
                  lg="12"
                >
                  <b-form-group label="Business Type">
                    <validation-provider
                      #default="{ errors }"
                      rules="required"
                      name="Business Type"
                    >
                      <v-select
                        v-model="formData.business_type"
                        :options="businessTypes"
                        placeholder="Business Type"
                      />
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
                  </b-form-group>
                </b-col>

                <b-col
                  cols="12"
                  md="12"
                  lg="12"
                >
                  <b-form-group label="EIN">
                    <validation-provider
                      #default="{ errors }"
                      rules="integer"
                      name="EIN"
                    >
                      <b-form-input
                        v-model="formData.ein"
                        :state="errors.length > 0 ? false : null"
                        placeholder="EIN"
                      />
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
                  </b-form-group>
                </b-col>

                <b-col
                  cols="12"
                  md="12"
                  lg="12"
                >
                  <b-form-group label="Industry">
                    <validation-provider
                      #default="{ errors }"
                      name="Industry"
                    >
                      <v-select
                        v-model="formData.industry"
                        :options="industries"
                        placeholder="Industry"
                      />
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
                  </b-form-group>
                </b-col>

                <b-col
                  cols="12"
                  md="12"
                  lg="12"
                >
                  <b-form-group label="Tax Exempt">
                    <validation-provider
                      #default="{ errors }"
                      name="Tax Exempt"
                    >
                      <b-form-checkbox
                        v-model="formData.tax_exempt"
                        :state="errors.length > 0 ? false : null"
                        placeholder="Tax Exempt"
                        value="1"
                      >
                        <small
                          class="text-danger"
                          v-if="formData.tax_exempt"
                        >
                          You will be required to upload a state Tax Exemption
                          document
                        </small>
                      </b-form-checkbox>
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
                  </b-form-group>
                </b-col>

                <b-col
                  cols="12"
                  md="12"
                  lg="12"
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
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
                  </b-form-group>
                </b-col>

                <b-col
                  cols="12"
                  md="12"
                  lg="12"
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
                  md="12"
                  lg="12"
                >
                  <b-form-group label="State">
                    <validation-provider
                      #default="{ errors }"
                      rules="required"
                      name="State"
                    >
                      <v-select
                        v-model="formData.state"
                        :options="statesOptions"
                        :reduce="(state) => state.name"
                        label="name"
                        placeholder="State"
                        @input="filterCities"
                      />
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
                  </b-form-group>
                </b-col>

                <b-col
                  cols="12"
                  md="12"
                  lg="12"
                >
                  <b-form-group label="City">
                    <validation-provider
                      #default="{ errors }"
                      rules="required"
                      name="City"
                    >
                      <v-select
                        v-model="formData.city"
                        :options="citiesFilteredObjects"
                        :reduce="(city) => city.name"
                        label="name"
                        placeholder="City"
                      />
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
                  </b-form-group>
                </b-col>

                <b-col
                  cols="12"
                  md="12"
                  lg="12"
                >
                  <b-form-group label="Zip">
                    <validation-provider
                      #default="{ errors }"
                      name="Zip"
                      rules="required"
                    >
                      <b-form-input
                        v-model="formData.zip"
                        :state="errors.length > 0 ? false : null"
                        placeholder="Zip"
                      />
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
                  </b-form-group>
                </b-col>

                <b-col
                  cols="12"
                  md="12"
                  lg="12"
                >
                  <b-form-group label="Billing Address">
                    <b-form-checkbox
                      @input="showBilling"
                      v-model="formData.billing_address_option"
                      placeholder="Billing Address"
                      value="1"
                    ><small>
                      Check if billing address different than business address
                    </small></b-form-checkbox>
                  </b-form-group>
                </b-col>

                <b-col
                  v-if="isBillingActive"
                  cols="12"
                  md="12"
                  lg="12"
                >
                  <b-form-group label="Billing Address">
                    <validation-provider
                      #default="{ errors }"
                      rules="required"
                      name="Billing Address"
                    >
                      <b-form-input
                        v-model="formData.billing_address"
                        :state="errors.length > 0 ? false : null"
                        placeholder="Billing Address"
                      />
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
                  </b-form-group>
                </b-col>

                <b-col
                  v-if="isBillingActive"
                  cols="12"
                  md="12"
                  lg="12"
                >
                  <b-form-group label="Billing State">
                    <validation-provider
                      #default="{ errors }"
                      rules="required"
                      name="Billing State"
                    >
                      <v-select
                        v-model="formData.billing_state"
                        :options="statesOptions"
                        :reduce="(state) => state.name"
                        label="name"
                        placeholder="State"
                        @input="filterBillingCities"
                      />
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
                  </b-form-group>
                </b-col>

                <b-col
                  v-if="isBillingActive"
                  cols="12"
                  md="12"
                  lg="12"
                >
                  <b-form-group label="Billing City">
                    <validation-provider
                      #default="{ errors }"
                      rules="required"
                      name="Billing City"
                    >
                      <v-select
                        v-model="formData.billing_city"
                        :options="billingCitiesFilteredObjects"
                        :reduce="(city) => city.name"
                        label="name"
                        placeholder="City"
                      />
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
                  </b-form-group>
                </b-col>

                <b-col
                  v-if="isBillingActive"
                  cols="12"
                  md="12"
                  lg="12"
                >
                  <b-form-group label="Billing Zip">
                    <validation-provider
                      #default="{ errors }"
                      rules="required"
                      name="Billing Zip"
                    >
                      <b-form-input
                        v-model="formData.billing_zip"
                        :state="errors.length > 0 ? false : null"
                        placeholder="Zip"
                      />
                      <small class="text-danger">{{ errors[0] }}</small>
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
                  @click="$emit('update:is-add-customer-active', false)"
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
          </b-overlay>
        </validation-observer>
      </vue-perfect-scrollbar>
    </div>
    <div class="col-md-8 col-lg-9 col-xl-10">
      <b-tabs pills>
        <template #tabs-end>
          <b-button
            variant="primary"
            @click="isAddAccountActive = !isAddAccountActive"
          >
            <feather-icon icon="PlusIcon" />
            Add New Account
          </b-button>
        </template>
        <!-- <b-tab title="Accounts"> -->
        <vue-good-table
          mode="remote"
          @on-page-change="onPageChange"
          @on-per-page-change="onPerPageChange"
          @on-column-filter="onColumnFilter"
          max-height="80vh"
          :columns="tableColumns"
          :total-rows="totalRecords"
          :rows="customersAccounts"
          :select-options="{
            enabled: true,
            selectOnCheckboxOnly: true,
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
        <!-- </b-tab> -->
        <!-- <b-tab title="Quotes" /> -->
        <!-- <b-tab title="Proposals" /> -->
      </b-tabs>
    </div>
    <AddAccount
      v-if="isAddAccountActive"
      :is-add-account-active.sync="isAddAccountActive"
      @refetch-data="fetchAccountRefresh"
      :user-data="userData"
    />
    <EditAccount
      v-if="isEditAccountActive"
      :is-edit-account-active.sync="isEditAccountActive"
      @refetch-data="fetchAccountRefresh"
      :account-data="accountData"
    />
    <AccountFiles
      v-if="isAccountFilesActive"
      :is-account-files-active.sync="isAccountFilesActive"
      @refetch-data="fetchAccountRefresh"
      :file-name="filename"
    />
  </div>
</template>

<script>
import { ref, onMounted, watch } from '@vue/composition-api'
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import { VueGoodTable } from 'vue-good-table'
import 'vue-good-table/dist/vue-good-table.css'
import 'vue-select/dist/vue-select.css'
import vSelect from 'vue-select'
import useCustomers from '@/composables/customers'
import useAccounts from '@/composables/customersAccount'
import statesOptions from '@core/data/states.json'
import citiesOptions from '@core/data/cities.json'
import {
  required, email, integer, min,
} from '@validations'
import VuePerfectScrollbar from 'vue-perfect-scrollbar'
import {
  BRow,
  BCol,
  BForm,
  //   BModal,
  VBModal,
  BButton,
  BTabs,
  BOverlay,
  //   BTab,
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
import EditAccount from './EditAccount.vue'
import AddAccount from './AddAccount.vue'
import AccountFiles from './AccountFiles.vue'


export default {
  components: {
    VuePerfectScrollbar,
    ValidationProvider,
    ValidationObserver,
    BInputGroupPrepend,
    BDropdownItem,
    BFormCheckbox,
    VueGoodTable,
    BInputGroup,
    BFormSelect,
    AddAccount,
    EditAccount,
    AccountFiles,
    BFormInput,
    BFormGroup,
    BDropdown,
    vSelect,
    BOverlay,
    BFormFile,
    BButton,
    // BModal,
    BForm,
    BTabs,
    BCol,
    BRow,
    // BTab,
  },
  data() {
    return {
      required,
      email,
      integer,
      min,
      titles: ['Owner', 'Principal', 'Partner', 'Vice President', 'CEO'],
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
      perfectScrollbarSettings: {
        maxScrollbarLength: 60,
        wheelPropagation: false,
      },
    }
  },
  props: {
    id: {
      type: Number,
      required: true,
    },
  },
  setup(props, context) {
    const fileInitialState = {
      document: [],
    }

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

    const formPhoneInitialState = {
      phone_number: [
        {
          id: 1,
          type: 'Mobile',
          value: '',
        },
      ],
    }

    const {
      busy: isLoading,
      customer,
      getCustomer,
      updateCustomer,
    } = useCustomers()

    const {
      perPage,
      respResult,
      currentPage,
      tableColumns,
      totalRecords,
      fetchAccounts,
      deleteAccount,
      perPageOptions,
      customersAccounts,
    } = useAccounts()

    const filename = ref({})
    const accountData = ref({})
    const isAddAccountActive = ref(false)
    const isEditAccountActive = ref(false)
    const isAccountFilesActive = ref(false)
    const isBillingActive = ref(false)
    const citiesFilteredObjects = ref([])
    const billingCitiesFilteredObjects = ref([])
    const formData = ref({ ...formInitialState })
    const phone = ref({ ...formPhoneInitialState })
    const file = ref({ ...fileInitialState })
    const userData = ref({})

    const editAccountRow = item => {
      accountData.value = item
      isEditAccountActive.value = true
    }

    const accountFile = item => {
      filename.value = item
      isAccountFilesActive.value = true
    }

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

    const serverParams = ref({
      columnFilters: {},
      page: currentPage,
      user_id: props.id,
      perPage,
    })

    const fetchAccountRefresh = () => {
      fetchAccounts(serverParams.value)
    }

    onMounted(async () => {
      await getCustomer(props.id)
    })

    watch(customer, () => {
      formData.value = customer.value
      userData.value = customer.value
      phone.value.phone_number = customer.value.phone
      filterCities(customer.value.state)
      filterBillingCities(customer.value.billing_state)
      if (formData.value.billing_address_option) {
        isBillingActive.value = true
      }
    })

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

    const onSubmit = async () => {
      const data = new FormData()
      Object.keys(formData.value).forEach(key => {
        if (formData.value[key] !== '' && formData.value[key] !== null) {
          data.append(key, formData.value[key])
        }
      })
      data.append('_method', 'PUT')

      for (
        let index = 0;
        index < phone.value.phone_number.length;
        index++
      ) {
        data.append(
          `phone[${index}][id]`,
          phone.value.phone_number[index].id,
        )
        data.append(
          `phone[${index}][type]`,
          phone.value.phone_number[index].type,
        )
        data.append(
          `phone[${index}][value]`,
          phone.value.phone_number[index].value,
        )
      }

      await updateCustomer(data, props.id)
    }

    const deleteAccountConfirmed = async id => {
      await deleteAccount(id)
      if (respResult.value.status === 200) {
        fetchAccounts(serverParams.value)
      }
    }

    const confirmDelete = async id => {
      context.root.$bvModal
        .msgBoxConfirm(
          'Please confirm that you want to delete account.',
          {
            title: 'Please Confirm',
            size: 'sm',
          },
        )
        .then(value => {
          if (value) {
            deleteAccountConfirmed(id)
          }
        })
    }

    return {
        isLoading,
      file,
      phone,
      perPage,
      userData,
      formData,
      filename,
      onSubmit,
      currentPage,
      accountData,
      accountFile,
      onPageChange,
      totalRecords,
      showBilling,
      tableColumns,
      fetchAccounts,
      filterCities,
      citiesOptions,
      confirmDelete,
      statesOptions,
      addPhoneNumber,
      onPerPageChange,
      perPageOptions,
      onColumnFilter,
      editAccountRow,
      isBillingActive,
      customersAccounts,
      fetchAccountRefresh,
      removePhoneNumber,
      isAddAccountActive,
      isEditAccountActive,
      isAccountFilesActive,
      filterBillingCities,
      citiesFilteredObjects,
      billingCitiesFilteredObjects,
    }
  },
  directives: {
    'b-modal': VBModal,
  },

}
</script>
<style lang="scss">
.customer-data-row {
    height: calc(100vh - 120px);
}
.customer-data-scroll {
}

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
