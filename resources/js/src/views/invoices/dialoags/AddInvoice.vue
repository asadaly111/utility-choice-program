<template>
  <b-modal
    cancel-variant="outline-secondary"
    centered
    :hide-footer="true"
    title="Create New Order"
    size="lg"
    id="add-new-order"
    @close="$emit('update:is-add-new-order-active', false)"
    :visible="isAddNewOrderActive"
    @hide="$emit('update:is-add-new-order-active', false)"
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
          class="p-2"
          @submit.prevent="handleSubmit(onSubmit)"
          @reset.prevent="resetForm"
        >

          <validation-provider
            #default="validationContext"
            name="Uplaod PO File"
            rules="required"
          >
            <b-form-group
              label="Upload PO file here"
              label-for="poFile"
              :state="getValidationState(validationContext)"
            >
              <b-form-file
                v-model="orderData.poFile"
                placeholder="Choose a file or drop it here..."
                drop-placeholder="Drop PO file here..."
                :state="getValidationState(validationContext)"
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
            name="Uplaod DST File"
            rules="required"
          >
            <b-form-group
              label="Upload Run Sheet file here"
              label-for="dstFile"
              :state="getValidationState(validationContext)"
            >
              <b-form-file
                v-model="orderData.dstFile"
                placeholder="Choose a file or drop it here..."
                drop-placeholder="Drop file here..."
                :state="getValidationState(validationContext)"
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
            name="Run Sheet"
            rules="required"
          >
            <b-form-group
              label="Upload Run Sheet file here"
              label-for="runSheetFile"
              :state="getValidationState(validationContext)"
            >
              <b-form-file
                v-model="orderData.runSheetFile"
                placeholder="Choose a file or drop it here..."
                drop-placeholder="Drop file here..."
                :state="getValidationState(validationContext)"
              />

              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
              >
                {{ validationContext.errors[0] }}
              </b-form-invalid-feedback>
            </b-form-group>
          </validation-provider>


          <b-form-group
            label-for="comments"
          >
            <b-form-textarea
              placeholder="Comments"
              id="comments"
              v-model="orderData.comments"
              rows="6"
              trim
            />
          </b-form-group>

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
              @click="
                $emit(
                  'update:is-add-new-order-active',
                  false
                )
              "
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
  BFormFile,
  BFormGroup,
  BFormTextarea,
  BFormInvalidFeedback,
} from 'bootstrap-vue'
import { ref } from '@vue/composition-api'
import { required, alphaNum } from '@validations'
import formValidation from '@core/comp-functions/forms/form-validation'
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import useOrders from '@/composables/orders'

export default {
  components: {
    BButton,
    BModal,
    BForm,
    BOverlay,
    BFormFile,
    BFormGroup,
    BFormTextarea,
    ValidationProvider,
    ValidationObserver,
    BFormInvalidFeedback,
  },
  model: {
    prop: 'isAddNewOrderActive',
    event: 'update:is-add-new-order-active',
  },
  props: {
    isAddNewOrderActive: {
      type: Boolean,
      required: true,
    },
  },

  setup(props, { emit }) {
    const {
      busy,
      respResult,
      storeOrder,
    } = useOrders()

    const orderData = ref({
      poFile: null,
      dstFile: null,
      runSheetFile: null,
      comments: '',
    })

    const {
      refFormObserver, getValidationState, resetForm,
    } = formValidation()

    const onSubmit = async () => {
      const formData = new FormData()
      formData.append('poFile', orderData.value.poFile)
      formData.append('dstFile', orderData.value.dstFile)
      formData.append('runSheetFile', orderData.value.runSheetFile)
      formData.append('comments', orderData.value.comments)

      await storeOrder(formData)
      if (respResult.value.status === 200) {
        emit('refetch-data')
        emit('update:is-add-new-order-active', false)
      }
    }

    return {
      busy,
      required,
      alphaNum,
      onSubmit,
      resetForm,
      orderData,
      refFormObserver,
      getValidationState,
    }
  },
}
</script>

  <style lang="scss" scoped></style>
