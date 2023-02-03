<template>
  <b-modal
    cancel-variant="outline-secondary"
    centered
    :hide-footer="true"
    title="Update Group"
    size="lg"
    @close="$emit('update:is-edit-order-active', false)"
    :visible="isEditOrderActive"
    @hide="$emit('update:is-edit-order-active', false)"
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
            name="Group Name"
            rules="required"
          >
            <b-form-group
              label-for="name"
              :state="getValidationState(validationContext)"
            >
              <b-form-input
                placeholder="Group Name"
                id="name"
                v-model="groupFormData.name"
                :state="getValidationState(validationContext)"
                trim
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
            name="Group Size"
            rules="required"
          >
            <b-form-group
              label-for="group_size"
              :state="getValidationState(validationContext)"
            >
              <b-form-spinbutton
                id="group_size"
                placeholder="Group Size"
                v-model="groupFormData.group_size"
                min="1"
                max="100"
                :state="getValidationState(validationContext)"
                trim
              />

              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
              >
                {{ validationContext.errors[0] }}
              </b-form-invalid-feedback>
            </b-form-group>
          </validation-provider>


          <b-form-group
            label-for="description"
          >
            <b-form-textarea
              placeholder="Description"
              id="description"
              v-model="groupFormData.description"
              trim
            />
          </b-form-group>

          <div class="d-flex mt-2">
            <b-button
              v-ripple.400="'rgba(255, 255, 255, 0.15)'"
              variant="primary"
              class="mr-2"
              type="submit"
            >
              Update
            </b-button>
            <b-button
              v-ripple.400="'rgba(186, 191, 199, 0.15)'"
              type="button"
              variant="outline-secondary"
              @click="
                $emit(
                  'update:is-edit-order-active',
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
  BFormGroup,
  BFormInput,
  BFormTextarea,
  BFormSpinbutton,
  BFormInvalidFeedback,
} from 'bootstrap-vue'
import { onMounted, ref } from '@vue/composition-api'
import { required, alphaNum } from '@validations'
import formValidation from '@core/comp-functions/forms/form-validation'
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import Ripple from 'vue-ripple-directive'
import useOrders from '@/composables/orders'

export default {
  components: {
    BButton,
    BModal,
    BForm,
    BOverlay,
    BFormInput,
    BFormGroup,
    BFormTextarea,
    BFormSpinbutton,
    ValidationProvider,
    ValidationObserver,
    BFormInvalidFeedback,
  },
  model: {
    prop: 'isEditOrderActive',
    event: 'update:is-edit-order-active',
  },
  directives: {
    Ripple,
  },
  props: {
    isEditOrderActive: {
      type: Boolean,
      required: true,
    },
    groupData: {
      type: Object,
      required: true,
    },
  },

  setup(props, { emit }) {
    const {
      busy,
      respResult,
      updateOrder,
    } = useOrders()

    const groupFormData = ref({})

    onMounted(() => {
      groupFormData.value = props.groupData
    })


    const {
      refFormObserver, getValidationState, resetForm,
    } = formValidation()

    const onSubmit = async () => {
      await updateOrder(groupFormData.value)
      if (respResult.value.status === 200) {
        emit('refetch-data')
        emit('update:is-edit-order-active', false)
      }
    }

    return {
      busy,
      required,
      alphaNum,
      onSubmit,
      resetForm,
      groupFormData,
      refFormObserver,
      getValidationState,
    }
  },
}
</script>

<style lang="scss" scoped></style>
