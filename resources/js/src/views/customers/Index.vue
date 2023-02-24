<template>
  <div>
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
          v-ripple.400="'rgba(113, 102, 240, 0.15)'"
          @click="isModalActive = true"
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
            <b-dropdown-item
              @click="isModalActive = true"
              v-if="$can('users-edit', 'all')"
            >
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
    <!-- modal -->
    <b-modal
      size="lg"
      id="add-customer-modal"
      ref="add-customer-popup"
      title="Create New Customer"
      :hide-footer="true"
      cancel-variant="outline-secondary"
      centered
      :visible="isModalActive"
      @close="isModalActive = false"
      @hide="isModalActive = false"
    >
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
              lg="4"
            >
              <b-form-group label="Document">
                <validation-provider
                  #default="{ errors }"
                  rules="required"
                  name="Document"
                >
                  <b-form-file
                    type="file"
                    v-model="formData.document"
                    :state="
                      errors.length > 0 ? false : null
                    "
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
              lg="4"
            >
              <b-form-group label="First Name">
                <validation-provider
                  #default="{ errors }"
                  rules="required"
                  name="First Name"
                >
                  <b-form-input
                    v-model="formData.first_name"
                    :state="
                      errors.length > 0 ? false : null
                    "
                    placeholder="First Name"
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
              lg="4"
            >
              <b-form-group label="Last Name">
                <validation-provider
                  #default="{ errors }"
                  rules="required"
                  name="Last Name"
                >
                  <b-form-input
                    v-model="formData.last_name"
                    :state="
                      errors.length > 0 ? false : null
                    "
                    placeholder="Last Name"
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
              lg="4"
            >
              <b-form-group label="Title">
                <validation-provider
                  #default="{ errors }"
                  rules="required"
                  name="Title"
                >
                  <vue-select
                    v-model="formData.title"
                    :options="titles"
                    placeholder="Title"
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
              lg="4"
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
                    :state="
                      errors.length > 0 ? false : null
                    "
                    placeholder="Email"
                  />
                  <small class="text-danger">{{
                    errors[0]
                  }}</small>
                </validation-provider>
              </b-form-group>
            </b-col>

            <b-col
              md="6"
              lg="4"
              v-for="(phoneNum, index) in phone.phone_number"
              :key="index"
            >
              <b-form-group label="Phone Number">
                <!-- <validation-provider
                  #default="{ errors }"
                  rules="required"
                  :name="'Phone Number' + index"
                  :vid="'Phone-Number-' + index"
                > -->
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
                        :state="
                          errors.length > 0 ? false : null
                        "
                        placeholder="Phone Number"
                      />
                      <button
                        v-if="index == 0"
                        type="button"
                        class="btn btn-sm btn-form-action btn-primary"
                        @click.prevent="
                          addPhoneNumber(
                            phone.phone_number[
                              phone.phone_number
                                .length - 1
                            ].id + 1
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
                        @click.prevent="
                          removePhoneNumber(phoneNum.id)
                        "
                      >
                        <feather-icon
                          icon="XIcon"
                          size="16"
                        />
                      </button>
                    </div>
                    <small class="text-danger">{{
                      errors[0]
                    }}</small>
                  </validation-provider>
                </b-input-group>

                <!-- </validation-provider> -->
              </b-form-group>
            </b-col>

            <b-col
              cols="12"
              md="6"
              lg="4"
            >
              <b-form-group label="Business Name">
                <validation-provider
                  #default="{ errors }"
                  rules="required"
                  name="Business Name"
                >
                  <b-form-input
                    v-model="formData.business_name"
                    :state="
                      errors.length > 0 ? false : null
                    "
                    placeholder="Business Name"
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
              lg="4"
            >
              <b-form-group label="Doing Business As">
                <validation-provider
                  #default="{ errors }"
                  rules="required"
                  name="Doing Business As"
                >
                  <b-form-input
                    v-model="formData.doing_business_as"
                    :state="
                      errors.length > 0 ? false : null
                    "
                    placeholder="Doing Business As"
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
              lg="4"
            >
              <b-form-group label="Business Type">
                <validation-provider
                  #default="{ errors }"
                  rules="required"
                  name="Business Type"
                >
                  <vue-select
                    v-model="formData.business_type"
                    :options="businessTypes"
                    placeholder="Business Type"
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
              lg="4"
            >
              <b-form-group label="EIN">
                <validation-provider
                  #default="{ errors }"
                  rules="required"
                  name="EIN"
                >
                  <b-form-input
                    v-model="formData.ein"
                    :state="
                      errors.length > 0 ? false : null
                    "
                    placeholder="EIN"
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
              lg="4"
            >
              <b-form-group label="Industry">
                <validation-provider
                  #default="{ errors }"
                  rules="required"
                  name="Industry"
                >
                  <vue-select
                    v-model="formData.industry"
                    :options="industries"
                    placeholder="Industry"
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
              lg="4"
            >
              <b-form-group label="Tax Exempt">
                <validation-provider
                  #default="{ errors }"
                  rules="required"
                  name="Tax Exempt"
                >
                  <b-form-checkbox
                    v-model="formData.tax_exempt"
                    :state="
                      errors.length > 0 ? false : null
                    "
                    placeholder="Tax Exempt"
                    value="1"
                  ><p>
                    You will be required to upload a
                    state Tax Exemption document
                  </p></b-form-checkbox>
                  <small class="text-danger">{{
                    errors[0]
                  }}</small>
                </validation-provider>
              </b-form-group>
            </b-col>

            <b-col
              cols="12"
              md="6"
              lg="4"
            >
              <b-form-group label="Address 1">
                <validation-provider
                  #default="{ errors }"
                  rules="required"
                  name="Address 1"
                >
                  <b-form-input
                    v-model="formData.address1"
                    :state="
                      errors.length > 0 ? false : null
                    "
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
              lg="4"
            >
              <b-form-group label="Address 2">
                <validation-provider
                  #default="{ errors }"
                  rules="required"
                  name="Address 2"
                >
                  <b-form-input
                    v-model="formData.address2"
                    :state="
                      errors.length > 0 ? false : null
                    "
                    placeholder="Address 2"
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
              lg="4"
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
                    :reduce="state => state.name"
                    label="name"
                    placeholder="State"
                    @input="filterCities"
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
              lg="4"
            >
              <b-form-group label="City">
                <validation-provider
                  #default="{ errors }"
                  rules="required"
                  name="City"
                >
                  <vue-select
                    v-model="formData.city"
                    :options="citiesFilteredObjects"
                    :reduce="city => city.name"
                    label="name"
                    placeholder="City"
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
              lg="4"
            >
              <b-form-group label="Zip">
                <validation-provider
                  #default="{ errors }"
                  name="Zip"
                  rules="required"
                >
                  <b-form-input
                    v-model="formData.zip"
                    :state="
                      errors.length > 0 ? false : null
                    "
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
              lg="4"
            >
              <b-form-group label="Billing Address">
                <b-form-checkbox
                  @input="showBilling"
                  v-model="formData.billing_address_option"
                  placeholder="Billing Address"
                  value="1"
                ><p>
                  Check if billing address different
                  than business address
                </p></b-form-checkbox>
              </b-form-group>
            </b-col>

            <b-col
              v-if="isBillingActive"
              cols="12"
              md="6"
              lg="4"
            >
              <b-form-group label="Billing Address">
                <validation-provider
                  #default="{ errors }"
                  rules="required"
                  name="Billing Address"
                >
                  <b-form-input
                    v-model="formData.billing_address"
                    :state="
                      errors.length > 0 ? false : null
                    "
                    placeholder="Billing Address"
                  />
                  <small class="text-danger">{{
                    errors[0]
                  }}</small>
                </validation-provider>
              </b-form-group>
            </b-col>

            <b-col
              v-if="isBillingActive"
              cols="12"
              md="6"
              lg="4"
            >
              <b-form-group label="Billing State">
                <validation-provider
                  #default="{ errors }"
                  rules="required"
                  name="Billing State"
                >
                  <vue-select
                    v-model="formData.billing_state"
                    :options="statesOptions"
                    :reduce="state => state.name"
                    label="name"
                    placeholder="State"
                    @input="filterBillingCities"
                  />
                  <small class="text-danger">{{
                    errors[0]
                  }}</small>
                </validation-provider>
              </b-form-group>
            </b-col>

            <b-col
              v-if="isBillingActive"
              cols="12"
              md="6"
              lg="4"
            >
              <b-form-group label="Billing City">
                <validation-provider
                  #default="{ errors }"
                  rules="required"
                  name="Billing City"
                >
                  <vue-select
                    v-model="formData.billing_city"
                    :options="billingCitiesFilteredObjects"
                    :reduce="city => city.name"
                    label="name"
                    placeholder="City"
                  />
                  <small class="text-danger">{{
                    errors[0]
                  }}</small>
                </validation-provider>
              </b-form-group>
            </b-col>

            <b-col
              v-if="isBillingActive"
              cols="12"
              md="6"
              lg="4"
            >
              <b-form-group label="Billing Zip">
                <validation-provider
                  #default="{ errors }"
                  rules="required"
                  name="Billing Zip"
                >
                  <b-form-input
                    v-model="formData.billing_zip"
                    :state="
                      errors.length > 0 ? false : null
                    "
                    placeholder="Zip"
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
              variant="primary"
              type="submit"
            >
              Save
            </b-button>
          </div>

        </b-form>
      </validation-observer>
    </b-modal>
  </div>
</template>

<script>
import { ref, onMounted } from '@vue/composition-api'
import AppBreadcrumb from '@core/layouts/components/AppBreadcrumb.vue'
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import { VueGoodTable } from 'vue-good-table'
import 'vue-select/dist/vue-select.css'
import { VueSelect } from 'vue-select'
import Ripple from 'vue-ripple-directive'
import 'vue-good-table/dist/vue-good-table.css'
import useCustomers from '@/composables/customers'
import statesOptions from '@core/data/states.json'
import citiesOptions from '@core/data/cities.json'
import {
  BRow,
  BCol,
  BModal,
  VBModal,
  BFormGroup,
  BFormInput,
  BInputGroup,
  BFormFile,
  BFormSelect,
  BButton,
  BForm,
  BDropdown,
  BFormCheckbox,
  BDropdownItem,
  BInputGroupPrepend,
} from 'bootstrap-vue'
import {
  required, email, integer, min,
} from '@validations'
import { emit } from 'process'

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
      busy,
      perPage,
      customers,
      respResult,
      currentPage,
      storeCustomer,
      deleteCustomer,
      fetchCustomers,
      perPageOptions,
    } = useCustomers()

    onMounted(() => {
      fetchCustomers()
    })

    const isBillingActive = ref(false)
    const isModalActive = ref(false)
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
      phone.value.phone_number = phone.value.phone_number.filter(obj => obj.id !== id)
    }

    const filterCities = state => {
      citiesFilteredObjects.value = citiesOptions.filter(obj => obj.state_name === state)
    }

    const filterBillingCities = state => {
      billingCitiesFilteredObjects.value = citiesOptions.filter(obj => obj.state_name === state)
    }

    const resetform = () => {
      formData.value = JSON.parse(JSON.stringify(formInitialState))
      phone.value.phone_number = JSON.parse(JSON.stringify(formPhoneInitialState))
    }

    const onSubmit = async () => {
      const data = new FormData()
      data.append('document', formData.value.document)
      data.append('first_name', formData.value.first_name)
      data.append('last_name', formData.value.last_name)
      data.append('title', formData.value.title)
      data.append('email', formData.value.email)
      data.append('business_name', formData.value.business_name)
      data.append('doing_business_as', formData.value.doing_business_as)
      data.append('business_type', formData.value.business_type)
      data.append('ein', formData.value.ein)
      data.append('industry', formData.value.industry)
      data.append('tax_exempt', formData.value.tax_exempt)
      data.append('address1', formData.value.address1)
      data.append('address2', formData.value.address2)
      data.append('state', formData.value.state)
      data.append('city', formData.value.city)
      data.append('zip', formData.value.zip)
      data.append('billing_address_option', formData.value.billing_address_option)
      data.append('billing_address', formData.value.billing_address)
      data.append('billing_state', formData.value.billing_state)
      data.append('billing_city', formData.value.billing_city)
      data.append('billing_zip', formData.value.billing_zip)

      for (let index = 0; index < phone.value.phone_number.length; index++) {
        data.append(`phone[${index}][id]`, phone.value.phone_number[index].id)
        data.append(`phone[${index}][type]`, phone.value.phone_number[index].type)
        data.append(`phone[${index}][value]`, phone.value.phone_number[index].value)
      }

      await storeCustomer(data)
      if (respResult.value.status === 200) {
        isModalActive.value = false
        resetform()
      }
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
      phone,
      perPage,
      formData,
      onSubmit,
      customers,
      currentPage,
      showBilling,
      filterCities,
      citiesOptions,
      isModalActive,
      statesOptions,
      confirmDelete,
      addPhoneNumber,
      perPageOptions,
      isBillingActive,
      removePhoneNumber,
      filterBillingCities,
      citiesFilteredObjects,
      billingCitiesFilteredObjects,
    }
  },
  directives: {
    'b-modal': VBModal,
    Ripple,
  },
  components: {
    ValidationProvider,
    ValidationObserver,
    AppBreadcrumb,
    BFormFile,
    VueGoodTable,
    BRow,
    BCol,
    BFormCheckbox,
    BInputGroup,
    BFormSelect,
    BInputGroupPrepend,
    VueSelect,
    BModal,
    BFormGroup,
    BFormInput,
    BDropdown,
    BDropdownItem,
    BButton,
    BForm,
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

#add-customer-modal .modal-dialog {
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
