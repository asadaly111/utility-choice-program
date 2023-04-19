<template>
  <b-modal
    centered
    size="lg"
    id="add-customer-modal"
    ref="add-customer-popup"
    title="Create New Customer"
    :hide-footer="true"
    cancel-variant="outline-secondary"
    :visible="isAddCustomerActive"
    @close="$emit('update:is-add-customer-active', false)"
    @hide="$emit('update:is-add-customer-active', false)"
  >
    <validation-observer
      #default="{ handleSubmit }"
      ref="refFormObserver"
    >
      <!-- overlay -->
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
              md="6"
              lg="4"
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
              lg="4"
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
                    :state="errors.length > 0 ? false : null"
                    placeholder="Email"
                  />
                  <small class="text-danger">{{ errors[0] }}</small>
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
              lg="4"
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
              lg="4"
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
              lg="4"
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
              lg="4"
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
              lg="4"
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
              lg="4"
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
              lg="4"
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
              lg="4"
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
              lg="4"
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
              lg="4"
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
              lg="4"
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
  </b-modal>
</template>

<script>
import { ref } from '@vue/composition-api'
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import 'vue-select/dist/vue-select.css'
import vSelect from 'vue-select'

import 'vue-good-table/dist/vue-good-table.css'
import useCustomers from '@/composables/customers'
import statesOptions from '@core/data/states.json'
import citiesOptions from '@core/data/cities.json'
import {
  required, email, integer, min,
} from '@validations'
import {
  BRow,
  BCol,
  BForm,
  BModal,
  BButton,
  BFormFile,
  BOverlay,
  BFormGroup,
  BFormInput,
  BFormSelect,
  BInputGroup,
  BFormCheckbox,
  BInputGroupPrepend,
} from 'bootstrap-vue'

export default {
  components: {
    ValidationProvider,
    ValidationObserver,
    BInputGroupPrepend,
    BFormCheckbox,
    BInputGroup,
    BFormSelect,
    BOverlay,
    BFormInput,
    BFormGroup,
    vSelect,
    BFormFile,
    BButton,
    BModal,
    BForm,
    BCol,
    BRow,
  },
  data() {
    return {
      titles: [
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

    const { busy: isLoading, respResult, storeCustomer } = useCustomers()

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

    const resetform = () => {
      formData.value = JSON.parse(JSON.stringify(formInitialState))
      phone.value.phone_number = JSON.parse(
        JSON.stringify(formPhoneInitialState),
      )
    }

    const onSubmit = async () => {
      const data = new FormData()

      //   append each form key value pair to data if not empty
      Object.keys(formData.value).forEach(key => {
        if (formData.value[key] !== '' && formData.value[key] !== null) {
          data.append(key, formData.value[key])
        }
      })

      //   data.append('document', formData.value.document)
      //   data.append('first_name', formData.value.first_name)
      //   data.append('last_name', formData.value.last_name)
      //   data.append('title', formData.value.title)
      //   data.append('email', formData.value.email)
      //   data.append('business_name', formData.value.business_name)
      //   data.append('doing_business_as', formData.value.doing_business_as)
      //   data.append('business_type', formData.value.business_type)
      //   data.append('ein', formData.value.ein)
      //   data.append('industry', formData.value.industry)
      //   data.append('tax_exempt', formData.value.tax_exempt)
      //   data.append('address1', formData.value.address1)
      //   data.append('state', formData.value.state)
      //   data.append('city', formData.value.city)
      //   data.append('zip', formData.value.zip)
      //   data.append('billing_address_option', formData.value.billing_address_option)
      //   data.append('billing_address', formData.value.billing_address)
      //   data.append('billing_state', formData.value.billing_state)
      //   data.append('billing_city', formData.value.billing_city)
      //   data.append('billing_zip', formData.value.billing_zip)
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

      await storeCustomer(data)
      if (respResult.value.status === 200) {
        emit('update:is-add-customer-active', false)
        emit('refetch-data')
        resetform()
      }
    }

    return {
      isLoading,
      required,
      email,
      integer,
      min,
      phone,
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

  model: {
    prop: 'isAddCustomerActive',
    event: 'update:is-add-customer-active',
  },
  props: {
    isAddCustomerActive: {
      type: Boolean,
      required: true,
    },
  },
}
</script>
