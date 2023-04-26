<template>
  <b-modal
    cancel-variant="outline-secondary"
    centered
    :hide-footer="true"
    title="Create New Rate"
    size="lg"
    id="add-new-order"
    @close="$emit('update:is-add-new-rate-active', false)"
    :visible="isAddNewRateActive"
    @hide="$emit('update:is-add-new-rate-active', false)"
  >
    <validation-observer
      #default="{ handleSubmit }"
      ref="refFormObserver"
    >
      <b-overlay
        :show="busy"
        spinner-variant="primary"
        spinner-type="grow"
        rounded="sm"
        opacity="0.20"
      >
        <!-- Form -->
        <b-form
          @submit.prevent="handleSubmit(onSubmit)"
          @reset.prevent="resetForm"
        >
          <b-row>
            <b-col lg="6">
              <validation-provider
                #default="validationContext"
                name="Supplier"
                rules="required"
              >
                <b-form-group
                  label="Supplier"
                  :state="getValidationState(validationContext)"
                >
                  <v-select
                    v-model="formData.supplier"
                    :options="suppliers"
                    :reduce="(supplier) => supplier.title"
                    label="title"
                    placeholder="Select Supplier"
                  />
                  <b-form-invalid-feedback
                    :state="getValidationState(validationContext)"
                  >
                    {{ validationContext.errors[0] }}
                  </b-form-invalid-feedback>
                </b-form-group>
              </validation-provider>

            </b-col>
            <b-col lg="6">
              <validation-provider
                #default="validationContext"
                name="State"
                rules="required"
              >
                <b-form-group
                  label="State"
                  :state="getValidationState(validationContext)"
                >
                  <v-select
                    v-model="formData.state"
                    :options="statesOptions"
                    :reduce="(state) => state.name"
                    label="name"
                    placeholder="State"
                  />
                  <b-form-invalid-feedback
                    :state="getValidationState(validationContext)"
                  >
                    {{ validationContext.errors[0] }}
                  </b-form-invalid-feedback>
                </b-form-group>
              </validation-provider>
            </b-col>
            <b-col lg="6">
              <validation-provider
                #default="validationContext"
                name="State"
                rules="required"
              >
                <b-form-group
                  label-for="commodity"
                  label="Commodity"
                >
                  <v-select
                    :options="[{ text: 'Electricity', value: 'electricity' }, { text: 'Gas', value: 'gas'}]"
                    label="text"
                    value="value"
                    @input="onCommodityChange"
                    :reduce="(dropdown) => dropdown.value"
                    v-model="formData.commodity"
                  />
                  <b-form-invalid-feedback
                    :state="getValidationState(validationContext)"
                  >
                    {{ validationContext.errors[0] }}
                  </b-form-invalid-feedback>
                </b-form-group>
              </validation-provider>
            </b-col>
            <b-col lg="6">
              <validation-provider
                #default="validationContext"
                name="Utility"
                rules="required"
              >
                <b-form-group
                  label="Utility"
                  :state="getValidationState(validationContext)"
                >
                  <v-select
                    :options="utilitiesList"
                    label="text"
                    :reduce="(dropdown) => dropdown.text"
                    v-model="formData.utility"
                  />
                  <b-form-invalid-feedback
                    :state="getValidationState(validationContext)"
                  >
                    {{ validationContext.errors[0] }}
                  </b-form-invalid-feedback>
                </b-form-group>
              </validation-provider>

            </b-col>
            <b-col lg="6">
              <validation-provider
                #default="validationContext"
                name="Product"
                rules="required"
              >
                <b-form-group
                  label-for="Product"
                  label="Product"
                >
                  <b-form-select
                    :options="products"
                    v-model="formData.product"
                  />
                  <b-form-invalid-feedback
                    :state="getValidationState(validationContext)"
                  >
                    {{ validationContext.errors[0] }}
                  </b-form-invalid-feedback>
                </b-form-group>
              </validation-provider>
            </b-col>
            <b-col lg="6">
              <validation-provider
                #default="validationContext"
                name="Demand Size"
                rules="required"
              >
                <b-form-group
                  label-for="demand_size"
                  label="Demand Size"
                >
                  <b-form-select
                    :options="demandSizeOptions"
                    v-model="formData.demand_size"
                  />
                  <b-form-invalid-feedback
                    :state="getValidationState(validationContext)"
                  >
                    {{ validationContext.errors[0] }}
                  </b-form-invalid-feedback>
                </b-form-group>
              </validation-provider>
            </b-col>
            <b-col lg="12">
              <validation-provider
                #default="validationContext"
                name="Rate Class"
                rules="required"
              >
                <b-form-group
                  label="Rate Class"
                  :state="getValidationState(validationContext)"
                >
                  <v-select
                    v-model="formData.rate_class"
                    :options="rateClassesList"
                    label="text"
                    placeholder="Rate Class"
                  />
                  <b-form-invalid-feedback
                    :state="getValidationState(validationContext)"
                  >
                    {{ validationContext.errors[0] }}
                  </b-form-invalid-feedback>
                </b-form-group>
              </validation-provider>
            </b-col>
            <b-col lg="6">
              <validation-provider
                #default="validationContext"
                name="Current Rate"
                rules="required"
              >
                <b-form-group label="Current Rate">
                  <b-form-input
                    v-model="formData.current_rate"
                    placeholder="Current Rate"
                  />
                  <b-form-invalid-feedback
                    :state="getValidationState(validationContext)"
                  >
                    {{ validationContext.errors[0] }}
                  </b-form-invalid-feedback>
                </b-form-group>
              </validation-provider>
            </b-col>
          </b-row>
          <div class="d-flex mt-2">
            <b-button
              variant="primary"
              class="mr-2"
              type="submit"
            >
              Submit
            </b-button>
            <b-button
              type="button"
              variant="outline-secondary"
              @click="$emit('update:is-add-new-rate-active',false)"
            >
              Cancel
            </b-button>
          </div>
        </b-form>
      </b-overlay>
    </validation-observer>
  </b-modal>
</template>

<script>
import {
  BRow,
  BCol,
  BForm,
  BModal,
  BButton,
  BOverlay,
  BFormInput,
  BFormSelect,
  BFormGroup,
  BFormInvalidFeedback,
} from 'bootstrap-vue'
import { ref } from '@vue/composition-api'
import { required, alphaNum } from '@validations'
import formValidation from '@core/comp-functions/forms/form-validation'
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import useCommercialRates from '@/composables/commercialRates'
import 'vue-select/dist/vue-select.css'
import statesOptions from '@core/data/states.json'
import rateClasses from '@core/data/rateClasses'
import suppliers from '@core/data/suppliers'
import utility from '@core/data/utility'
import vSelect from 'vue-select'

export default {
  components: {
    BButton,
    BModal,
    BRow,
    BCol,
    BForm,
    BOverlay,
    vSelect,
    BFormGroup,
    BFormInput,
    BFormSelect,
    ValidationProvider,
    ValidationObserver,
    BFormInvalidFeedback,
  },
  model: {
    prop: 'isAddNewRateActive',
    event: 'update:is-add-new-rate-active',
  },
  props: {
    isAddNewRateActive: {
      type: Boolean,
      required: true,
    },
  },

  setup(props, { emit }) {
    const {
      busy,
      respResult,
      storeCommercialRate,
    } = useCommercialRates()

    const initialState = {
      supplier: '',
      state: '',
      commodity: '',
      utility: '',
      product: '',
      start_month: '',
      current_rate: '',
      demand_size: '',
      rate_class: '',
    }
    const formData = ref({ ...initialState })
    const rateClassesList = ref([])
    const utilitiesList = ref([])

    const onCommodityChange = value => {
      console.log(value)
      //   utilitiesList.value = []
      formData.value.commodity = value
      rateClassesList.value = rateClasses.filter(rateClass => rateClass.commodity === value)
      utilitiesList.value = utility.filter(
        util => util.state === formData.value.state && util.commodity === value,
      )
    }

    const onStateChange = value => {
      console.log(value)
      //   formData.value.state = value
      utilitiesList.value = utility.filter(
        util => util.state === value && util.commodity === formData.value.commodity,
      )
    }

    // change formData commodity filter rateClasses

    const products = ref(['Fixed Price'])

    const demandSizeOptions = ref(['25kW - 35kW', '35kW - 50kW', '<100kW', '<25kW', '50kW', '100kW', '>25kW', '50kW', 'Flat Load', 'Heat Load'])

    const {
      refFormObserver, getValidationState, resetForm,
    } = formValidation()

    const onSubmit = async () => {
      await storeCommercialRate(formData)
      if (respResult.value.status === 200) {
        emit('refetch-data')
        emit('update:is-add-new-rate-active', false)
      }
    }

    return {
      busy,
      required,
      products,
      alphaNum,
      onSubmit,
      resetForm,
      onStateChange,
      formData,
      utilitiesList,
      suppliers,
      rateClasses,
      statesOptions,
      refFormObserver,
      rateClassesList,
      demandSizeOptions,
      onCommodityChange,
      getValidationState,
    }
  },
}
</script>

<style lang="scss" scoped></style>
