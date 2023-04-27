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
                    @input="onStateChange"
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
                name="Start Month"
                rules="required"
              >
                <b-form-group
                  label-for="start_month"
                  label="Start Month"
                >
                  <flat-pickr
                    :config="pickerConfig"
                    class="form-control"
                    placeholder="Start Month"
                    v-model="formData.start_month"
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
                name="Commodity"
                rules="required"
              >
                <b-form-group
                  label-for="commodity"
                  label="Commodity"
                >
                  <!-- <v-select
                    :options="[{ text: 'Electricity', value: 'electricity' }, { text: 'Gas', value: 'gas'}]"
                    label="text"
                    value="value"
                    @input="onCommodityChange"
                    :reduce="(dropdown) => dropdown.value"
                    v-model="formData.commodity"
                  /> -->

                  <b-form-radio-group
                    v-model="formData.commodity"
                    :options="commodityOptions"
                    name="commodity"
                    @change="onCommodityChange"
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
            <b-col lg="6">
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
                    :reduce="(dropdown) => dropdown.text"
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

            <!-- description -->
            <b-col lg="12">
              <validation-provider
                #default="validationContext"
                name="Description"
              >
                <b-form-group
                  label-for="description"
                  label="Description"
                >
                  <b-form-textarea
                    v-model="formData.description"
                    placeholder="Description"
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
  BFormTextarea,
  BFormRadioGroup,
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
import flatPickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import monthSelectPlugin from 'flatpickr/dist/plugins/monthSelect/index.js'
import 'flatpickr/dist/plugins/monthSelect/style.css'

export default {
  components: {
    BButton,
    BModal,
    flatPickr,
    BRow,
    BCol,
    BForm,
    BOverlay,
    vSelect,
    BFormTextarea,
    BFormGroup,
    BFormRadioGroup,
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
      product: 'Fixed Price',
      start_month: '',
      current_rate: '',
      demand_size: '',
      rate_class: '',
      description: '',
    }
    const formData = ref({ ...initialState })
    const rateClassesList = ref([])
    const utilitiesList = ref([])

    const pickerConfig = {
      plugins: [
        new monthSelectPlugin({
          shorthand: true,
          dateFormat: 'm/Y',
        }),
      ],
    }

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

    const commodityOptions = ref([
      { text: 'Electricity', value: 'electricity' },
      { text: 'Gas', value: 'gas' },
    ])

    const demandSizeOptions = ref([
      { text: '0 - 100,000', value: '100000' },
      { text: '100,000 - 200,000', value: '200000' },
      { text: '200,000 - 300,000', value: '300000' },
      { text: '300,000 - 400,000', value: '400000' },
      { text: '400,000 - 500,000', value: '500000' },
      { text: '500,000 - 600,000', value: '600000' },
      { text: '600,000 - 700,000', value: '700000' },
      { text: '700,000 - 800,000', value: '800000' },
      { text: '800,000 - 900,000', value: '900000' },
      { text: '900,000 - 1,000,000+', value: '1000000' },
    ])


    const {
      refFormObserver, getValidationState, resetForm,
    } = formValidation()

    const onSubmit = async () => {
      await storeCommercialRate(formData.value)
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
      commodityOptions,
      utilitiesList,
      suppliers,
      pickerConfig,
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

<style lang="scss" >
.form-control[readonly]{
    background-color: #fff;
    opacity: 1;
}
.vs__selected{
    text-overflow: ellipsis;
    max-width: 280px;
    white-space: nowrap;
    overflow: hidden;
    display: inline-block;
}
</style>
