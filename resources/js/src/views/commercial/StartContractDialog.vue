<template>
  <b-modal
    centered
    size="sm"
    :hide-footer="true"
    title="Start Contract"
    :visible="isStartContractVisible"
    cancel-variant="outline-secondary"
    @close="$emit('update:is-start-contract-visible', false)"
    @hide="$emit('update:is-start-contract-visible', false)"
  >
    <div class="d-flex justify-content-between">
      <div class="info-text-container">
        <div class="info-text">
          Term:
        </div>
        <div>{{ term }}</div>
        <div class="info-text">
          Start Month:
        </div>
        <div>05/2023</div>
      </div>
      <div>
        <div class="product-type">
          {{ rate.name }}
        </div>
        <div class="text-center rate ">
          <span>{{ rate.price }}</span>
        </div>
      </div>
    </div>
    <hr>
    <div class="price-info">
      <span>ABM:</span>  0.002
    </div> <div class="information">
      <feather-icon
        icon="AlertCircleIcon"
        size="18"
      /> Swing - 100%
    </div> <!----> <!----> <!---->
    <div class="information">
      <feather-icon
        icon="AlertCircleIcon"
        size="18"
      /> Min Load Factor - 30%
    </div>
    <div class="information"><feather-icon
      icon="AlertCircleIcon"
      size="18"
    /> <span>For Matrix Contracts, 1 month bill copy required (Must be within the past 90 dayss)
      No Golf Courses, Churches or any other Seasonal Customers</span>
    </div>
    <div class="d-flex mt-2">
      <b-button
        variant="primary"
        class="mr-2"
        :to="{ name: 'contract-customer'}"
      >
        Start Contract
      </b-button>
      <b-button
        type="button"
        variant="outline-secondary"
        @click="$emit('update:is-start-contract-visible', false)"
      >
        Cancel
      </b-button>
    </div>
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
    prop: 'isStartContractVisible',
    event: 'update:is-start-contract-visible',
  },
  props: {
    isStartContractVisible: {
      type: Boolean,
      required: true,
    },
    rate: {
      type: Object,
      required: true,
    },
    term: {
      type: String,
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
        emit('update:is-start-contract-visible', false)
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

<style scoped>
.info-text-container {
    display: flex;
    flex-wrap: wrap;
}
.information {
    margin-top: 0.5rem;
}
.price-info {
    background-color: #f2f3f8;
    padding: 1rem;
    position: relative;
}
.product-type {
    font-size: 1rem;
    font-weight: 500;
}
.rate {
    font-size: 1.5rem;
    font-weight: 500;
}
.info-text-container div {
    flex-basis: 40%;
}
</style>
