<template>
  <b-card>
    <validation-observer
      #default="{ handleSubmit }"
      ref="refFormObserver"
    >
      <b-form
        ref="form"
        @submit.prevent="handleSubmit(onSubmit)"
      >
        <b-tabs
          content-class="pt-1"
          fill
        >
          <b-tab
            title="Step 1: Customer Details"
          >
            <template #title>
              <feather-icon icon="UserIcon" />
              <span>Step 1: Customer Details</span>
            </template>

            <b-row>
              <b-col
                md="6"
                lg="2"
              >
                <b-form-group label="Document">
                  <validation-provider
                    #default="{ errors }"
                    name="Document"
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
                md="6"
                lg="2"
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
                md="6"
                lg="2"
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
                md="6"
                lg="2"
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
                md="6"
                lg="2"
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
                md="6"
                lg="2"
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
                md="6"
                lg="2"
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
                md="6"
                lg="2"
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
                md="6"
                lg="2"
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
                md="6"
                lg="2"
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
                md="6"
                lg="2"
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
                md="6"
                lg="2"
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
                    <small class="text-danger">{{ errors[0] }}</small>
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
                md="6"
                lg="2"
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
                md="6"
                lg="2"
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
                md="6"
                lg="2"
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
                md="6"
                lg="2"
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
                md="6"
                lg="2"
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
                md="6"
                lg="2"
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
                md="6"
                lg="2"
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

          </b-tab>
          <b-tab
            title="Step 2: Add Account(s)"
            disabled
          >
            <template #title>
              <feather-icon icon="PlusIcon" />
              <span>Step 2: Add Account(s)</span>
            </template>
            sd
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
        <div class="text-center d-flex justify-content-between">
          <!-- <b-button
        variant="outline-primary"
      >
        Previous
      </b-button> -->
          <div />
          <b-button
            type="submit"
            variant="outline-primary"
          >
            Save &amp; Go to Step 2
          </b-button>

        </div>
      </b-form>
    </validation-observer>
  </b-card>
</template>

<script>
import { ref, onMounted } from '@vue/composition-api'
import {
  BCol,
  BRow,
  BForm,
  BCard,
  BTabs,
  BTab,
  BButton,
  BFormFile,
  BFormGroup,
  BFormInput,
  BFormSelect,
  BInputGroup,
  BFormCheckbox,
  BInputGroupPrepend,
} from 'bootstrap-vue'
import vSelect from 'vue-select'
import { ValidationProvider, ValidationObserver } from 'vee-validate'
// import 'v-select/dist/v-select.css'
import useCustomers from '@/composables/customers'
import statesOptions from '@core/data/states.json'
import citiesOptions from '@core/data/cities.json'
import {
  required, email, integer, min,
} from '@validations'
import 'vue-select/dist/vue-select.css'

export default {
  components: {
    BCol,
    BRow,
    BForm,
    BCard,
    BTabs,
    BTab,
    BButton,
    vSelect,
    BFormFile,
    BFormGroup,
    BFormInput,
    BFormSelect,
    BInputGroup,
    BFormCheckbox,
    ValidationProvider,
    ValidationObserver,
    BInputGroupPrepend,
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
      tax_exempt: false,
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
      busy, respResult, storeCustomer, getCustomer, customer, updateCustomer,
    } = useCustomers()


    const isBillingActive = ref(false)
    const isEdit = ref(false)
    const citiesFilteredObjects = ref([])
    const billingCitiesFilteredObjects = ref([])
    const formData = ref({ ...formInitialState })
    const phone = ref({ ...formPhoneInitialState })

    const showBilling = item => {
      isBillingActive.value = item
    }

    onMounted(async () => {
      if ((root.$route.params.id !== undefined) && (root.$route.params.id !== null)) {
        await getCustomer(root.$route.params.id)
        formData.value = customer.value
        phone.value.phone_number = customer.value.phone
        isEdit.value = true
      }
    })

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

    const resetform = () => {
      formData.value = JSON.parse(JSON.stringify(formInitialState))
      phone.value.phone_number = JSON.parse(
        JSON.stringify(formPhoneInitialState),
      )
    }

    const onSubmit = async () => {
      const data = new FormData()
      if (formData.value.document) {
        data.append('document', formData.value.document)
      }
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
      data.append('state', formData.value.state)
      data.append('city', formData.value.city)
      data.append('zip', formData.value.zip)
      data.append('billing_address_option', formData.value.billing_address_option)
      data.append('billing_address', formData.value.billing_address)
      data.append('billing_state', formData.value.billing_state)
      data.append('billing_city', formData.value.billing_city)
      data.append('billing_zip', formData.value.billing_zip)
      if (formData.value.address2) {
        data.append('address2', formData.value.address2)
      }

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

      if (isEdit.value) {
        data.append('_method', 'PUT')
        await updateCustomer(data, formData.value.id)
      } else {
        await storeCustomer(data)
      }

      if (respResult.value.status === 200) {
        console.log(respResult)
        // push to contract account with id
        root.$router.push({
          name: 'contract-customer-accounts',
          params: { id: respResult.value.data.customer.id },
        })
        // emit('update:is-add-customer-active', false)
        // emit('refetch-data')
        // resetform()
      }
    }

    return {
      busy,
      phone,
      isEdit,
      titles,
      businessTypes,
      industries,
      formData,
      onSubmit,
      showBilling,
      filterCities,
      citiesOptions,
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
