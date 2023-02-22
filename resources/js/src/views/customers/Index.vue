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
          v-b-modal.add-customer-modal
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
      :rows="rows"
      max-height="80vh"
      :pagination-options="{
        enabled: true,
        mode: 'records',
        perPage: 50,
        position: 'top',
        perPageDropdown: [20, 30, 40, 50],
        dropdownAllowAll: false,
        setCurrentPage: 2,
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
        <!-- Column: Name -->

        <!-- Column: Action -->
        <div v-if="props.column.field === 'actions'" />
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
      @show="resetModal"
      @hidden="resetModal"
      centered
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
                  v-model="formData.billing_address_option"
                  placeholder="Billing Address"
                ><p>
                  Check if billing address different
                  than business address
                </p></b-form-checkbox>
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
import { ref, watch } from '@vue/composition-api'
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
  BFormCheckbox,
  BInputGroup,
  BFormFile,
  BFormSelect,
  BInputGroupPrepend,
  BButton,
  BForm,
} from 'bootstrap-vue'
import {
  required, email, integer, min,
} from '@validations'

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
          label: 'Name',
          field: 'name',
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
          field: 'businessname',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'Select',
            filterDropdownItems: ['Business 1', 'Business 2'],
          },
        },
        {
          label: 'Doing Business As',
          field: 'doingbusinessas',
          width: '220px',
          filterOptions: {
            enabled: true,
            placeholder: 'Select',
            filterDropdownItems: ['Seller', 'Distributor'],
          },
        },
        {
          label: 'Business Type',
          field: 'businesstype',
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
              'Corporation',
              'Limited Liability Company',
              'Partnership',
              'Individual',
            ],
          },
        },
        {
          label: 'Tax Excempt',
          field: 'taxexempt',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'Tax Excempt',
            filterDropdownItems: ['Yes', 'No'],
          },
        },
        {
          label: 'Address',
          field: 'address',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'Address',
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
          label: 'State',
          field: 'state',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'State',
            filterDropdownItems: [
              'Ohio',
              'Missouri',
              'Pennsylvania',
            ],
          },
        },
        {
          label: 'Billing Address',
          field: 'billingaddress',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'Billing Address',
          },
        },
        {
          label: 'Billing City',
          field: 'billingcity',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'Billing City',
          },
        },
        {
          label: 'Billing State',
          field: 'billingstate',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'Billing State',
            filterDropdownItems: [
              'South Carolina',
              'Texas',
              'New York',
            ],
          },
        },
        {
          label: 'B.Zip',
          field: 'bzip',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'B.Zip',
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
        {
          label: 'Flags',
          field: 'flags',
          width: '100px',
        },
        {
          label: 'E/G/Q/C',
          field: 'egqc',
          type: 'date',
          dateInputFormat: 'yyyy-MM-dd',
          dateOutputFormat: 'MMM do yy',
          width: '150px',
        },
        {
          label: 'Actions',
          field: 'actions',
          width: '250px',
        },
      ],
      rows: [
        { id: 0 },
        { id: 1 },
        { id: 2 },
        { id: 3 },
        { id: 4 },
        { id: 5 },
        { id: 6 },
        { id: 7 },
        { id: 8 },
        { id: 9 },
        { id: 10 },
        { id: 11 },
        { id: 12 },
        { id: 13 },
        { id: 14 },
        { id: 15 },
        { id: 16 },
        { id: 17 },
        { id: 18 },
        { id: 19 },
        { id: 20 },
        { id: 21 },
        { id: 22 },
        { id: 23 },
        { id: 24 },
        { id: 25 },
        { id: 26 },
        { id: 27 },
        { id: 28 },
        { id: 29 },
        { id: 30 },
        { id: 31 },
        { id: 32 },
        { id: 33 },
        { id: 34 },
        { id: 35 },
        { id: 36 },
        { id: 37 },
        { id: 38 },
        { id: 39 },
        { id: 40 },
        { id: 41 },
        { id: 42 },
        { id: 43 },
        { id: 44 },
        { id: 45 },
        { id: 46 },
        { id: 47 },
        { id: 48 },
        { id: 49 },
        { id: 50 },
        { id: 51 },
        { id: 52 },
        { id: 53 },
        { id: 54 },
        { id: 55 },
        { id: 56 },
        { id: 57 },
        { id: 58 },
        { id: 59 },
        { id: 60 },
        { id: 61 },
        { id: 62 },
        { id: 63 },
        { id: 64 },
        { id: 65 },
        { id: 66 },
        { id: 67 },
        { id: 68 },
        { id: 69 },
        { id: 70 },
        { id: 71 },
        { id: 72 },
        { id: 73 },
        { id: 74 },
        { id: 75 },
        { id: 76 },
        { id: 77 },
        { id: 78 },
        { id: 79 },
        { id: 80 },
        { id: 81 },
        { id: 82 },
        { id: 83 },
        { id: 84 },
        { id: 85 },
        { id: 86 },
        { id: 87 },
        { id: 88 },
        { id: 89 },
        { id: 90 },
        { id: 91 },
        { id: 92 },
      ],
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
  setup(props, { emit }) {
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
      respResult,
      storeCustomer,
    } = useCustomers()

    const citiesFilteredObjects = ref([])
    const formData = ref({ ...formInitialState })
    const phone = ref({ ...formPhoneInitialState })

    const addPhoneNumber = id => {
      phone.value.phone_number.push({ id, type: 'Mobile', value: '' })
    }
    const removePhoneNumber = id => {
      phone.value.phone_number = phone.value.phone_number.filter(obj => obj.id !== id)
    }

    const filterCities = state => {
      citiesFilteredObjects.value = citiesOptions.filter(obj => obj.state_name === state)
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

      for (let index = 0; index < phone.value.phone_number.length; index++) {
        data.append(`phone[${index}][id]`, phone.value.phone_number[index].id)
        data.append(`phone[${index}][type]`, phone.value.phone_number[index].type)
        data.append(`phone[${index}][value]`, phone.value.phone_number[index].value)
      }

      await storeCustomer(data)
      if (respResult.value.status === 200) {
        emit('refetch-data')
      }
    }

    return {
      busy,
      phone,
      formData,
      onSubmit,
      filterCities,
      citiesOptions,
      statesOptions,
      addPhoneNumber,
      removePhoneNumber,
      citiesFilteredObjects,
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
    BButton,
    BForm,
  },
  methods: {
    resetModal() {
      this.name = ''
      this.nameState = null
    },
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
