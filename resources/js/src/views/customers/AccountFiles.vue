<template>
  <b-modal
    centered
    size="sm"
    :hide-footer="true"
    title="Account File"
    :visible="isAccountFilesActive"
    cancel-variant="outline-secondary"
    @close="$emit('update:is-account-files-active', false)"
    @hide="$emit('update:is-account-files-active', false)"
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
            md="12"
            lg="12"
          >
            <b-form-group :label="fileData.name">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Document"
              >
                <b-form-file
                  type="file"
                  v-model="file.document"
                  :state="errors.length > 0 ? false : null"
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
            @click="$emit('update:is-account-files-active', false)"
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
import { ref, onMounted } from '@vue/composition-api'
import useAccounts from '@/composables/customersAccount'
import 'vue-select/dist/vue-select.css'
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
} from 'bootstrap-vue'

export default {
  components: {
    BRow,
    BCol,
    BForm,
    BButton,
    BFormFile,
    BFormGroup,
    ValidationProvider,
    ValidationObserver,
  },
  data() {
    return {
      min,
      email,
      integer,
      required,
    }
  },
  model: {
    prop: 'isAccountFilesActive',
    event: 'update:is-account-files-active',
  },
  props: {
    isAccountFilesActive: {
      type: Boolean,
      required: true,
    },
    fileName: {
      type: Object,
      required: true,
    },
  },
  setup(props, { emit }) {
    const fileInitialState = {
      document: [],
    }

    const fileData = ref({})
    const file = ref({ ...fileInitialState })

    const {
      AccountFiles, respResult,
    } = useAccounts()

    onMounted(() => {
      fileData.value = props.fileName
    })

    const onSubmit = async () => {
      const data = new FormData()
      data.append(fileData.value.type, file.value.document)

      await AccountFiles(data, props.fileName.id)
      if (respResult.value.status === 200) {
        emit('update:is-account-files-active', false)
        emit('refetch-data')
      }
    }

    return {
      file,
      fileData,
      onSubmit,
    }
  },
}
</script>
