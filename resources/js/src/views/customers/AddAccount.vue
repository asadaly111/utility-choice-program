<template>
  <b-modal
    id="addNewCustomerAccount"
    cancel-variant="outline-secondary"
    size="lg"
    centered
    :hide-footer="true"
    title="Add New Account"
    :visible="isAddAccountActive"
    @close="$emit('update:is-add-account-active', false)"
    @hide="$emit('update:is-add-account-active', false)"
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
              <b-form-file
                type="file"
                v-model="file.document"
              />
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
            lg="4"
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
            lg="4"
          >
            <b-form-group label="Commodity">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Commodity"
              >
                <vue-select
                  :options="[{ text: 'Electricity', value: 'electricity' }, { text: 'Gas', value: 'gas'}]"
                  label="text"
                  value="value"
                  @input="onCommodityChange"
                  :reduce="(dropdown) => dropdown.value"
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
              <b-form-input
                v-model="formData.address2"
                placeholder="Address 2"
              />
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="8"
          >
            <b-form-group label="Rate Class">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Rate Class"
              >
                <vue-select
                  :options="rateClassesList"

                  label="text"
                  :reduce="(dropdown) => dropdown.text"
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
            lg="4"
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
            lg="4"
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
            lg="4"
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
            lg="4"
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
            lg="4"
          >
            <b-form-group label="Utility">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Utility"
              >
                <vue-select
                  :options="utilitiesList"
                  label="text"
                  :reduce="(dropdown) => dropdown.text"
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
            lg="4"
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
            lg="4"
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
            lg="4"
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
            lg="4"
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
  </b-modal>
</template>

<script>
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import { ref, onMounted, watch } from '@vue/composition-api'
import useAccounts from '@/composables/customersAccount'
import 'vue-select/dist/vue-select.css'
import { VueSelect } from 'vue-select'
import statesOptions from '@core/data/states.json'
import citiesOptions from '@core/data/cities.json'
import utility from '@core/data/utility'
import rateClasses from '@core/data/rateClasses'
import {
  required, email, integer, min,
} from '@validations'
import {
  BRow,
  BCol,
  BForm,
  BButton,
  BFormFile,
  BFormGroup,
  BFormInput,
} from 'bootstrap-vue'

export default {
  components: {
    BRow,
    BCol,
    BForm,
    BButton,
    BFormFile,
    BFormGroup,
    BFormInput,
    VueSelect,
    ValidationProvider,
    ValidationObserver,
  },
  data() {
    return {
      min,
      email,
      integer,
      required,
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
  model: {
    prop: 'isAddAccountActive',
    event: 'update:is-add-account-active',
  },
  props: {
    isAddAccountActive: {
      type: Boolean,
      required: true,
    },
    userData: {
      type: Object,
      required: true,
    },
  },
  setup(props, { emit }) {
    const formInitialState = {
      zip: '',
      zone: '',
      city: '',
      notes: '',
      state: 'Delaware',
      utility: '',
      address1: '',
      address2: '',
      sub_type: '',
      commodity: '',
      rate_class: '',
      current_rate: '',
      annual_volume: '',
      account_number: '',
      account_status: '',
      contract_end_date: '',
    }

    const fileInitialState = {
      document: [],
    }

    const citiesFilteredObjects = ref([])
    const file = ref({ ...fileInitialState })
    const formData = ref({ ...formInitialState })
    const rateClassesList = ref([])
    const utilitiesList = ref([])

    // filter utilities by state and commodity
    const onStateChange = value => {
      console.log(value)
      //   formData.value.state = value
      utilitiesList.value = utility.filter(
        util => util.state === value && util.commodity === formData.value.commodity,
      )
    }


    // change formData commodity filter rateClasses
    const onCommodityChange = value => {
      //   utilitiesList.value = []
      formData.value.commodity = value
      rateClassesList.value = rateClasses.filter(rateClass => rateClass.commodity === value)
      utilitiesList.value = utility.filter(
        util => util.state === formData.value.state && util.commodity === value,
      )
    }

    const {
      storeAccount, respResult,
    } = useAccounts()

    onMounted(() => {
      formData.value = { ...props.userData }
    })

    const filterCities = state => {
      onStateChange(state)
      formData.value.utility = ''
      citiesFilteredObjects.value = citiesOptions.filter(
        obj => obj.state_name === state,
      )
    }

    // watch(formData, () => {
    //   filterCities(formData.value.state)
    // })

    const resetplanData = () => {
      formData.value = JSON.parse(JSON.stringify(formInitialState))
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
      data.append('user_id', props.userData.id)

      if (formData.value.address2) {
        data.append('address2', formData.value.address2)
      }

      await storeAccount(data)
      if (respResult.value.status === 200) {
        emit('update:is-add-account-active', false)
        emit('refetch-data')
        resetplanData()
      }
    }

    return {
      file,
      utility,
      onSubmit,
      formData,
      onStateChange,
      utilitiesList,
      onCommodityChange,
      rateClassesList,
      filterCities,
      statesOptions,
      citiesFilteredObjects,
    }
  },
}
</script>

<style lang="scss">
#addNewCustomerAccount .modal-dialog {
    max-width: 1000px;
}
</style>
