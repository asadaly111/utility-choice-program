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
          <validation-provider
            #default="validationContext"
            name="State"
            rules="required"
          >
            <b-form-group
              label-for="commodity"
              label="Commodity"
            >
              <b-form-select
                :options="['Electricity', 'Gas']"
                v-model="formData.commodity"
              />
              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
              >
                {{ validationContext.errors[0] }}
              </b-form-invalid-feedback>
            </b-form-group>
          </validation-provider>

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
                v-model="formData.utility"
                :options="[]"
                label="name"
                placeholder="Utility"
              />
              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
              >
                {{ validationContext.errors[0] }}
              </b-form-invalid-feedback>
            </b-form-group>
          </validation-provider>


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
                :options="[]"
                label="name"
                placeholder="Rate Class"
              />
              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
              >
                {{ validationContext.errors[0] }}
              </b-form-invalid-feedback>
            </b-form-group>
          </validation-provider>

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
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'
import statesOptions from '@core/data/states.json'


export default {
  components: {
    BButton,
    BModal,
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
      state: '',
      commodity: '',
      utility: '',
      product: '',
      start_month: '',
      current_rate: '',
    }

    const formData = ref({ ...initialState })

    const products = ref(['Fixed Price', 'Fixed Adder', 'Fixed Green', 'Pass Through', 'Energy Only', 'Fixed Energy Congestion Passthrough', 'Fixed Energy Cap PT', 'Fixed Adder Pass Through', 'Fixed Hub Price', 'Pass Through Hub Price'])


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
      formData,
      statesOptions,
      refFormObserver,
      getValidationState,
    }
  },
}
</script>

<style lang="scss" scoped></style>
