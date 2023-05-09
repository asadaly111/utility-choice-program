<template>
  <b-card>
    <b-tabs
      content-class="pt-1"
      fill
    >
      <b-tab
        title="Step 1: Customer Details"
        disabled
      >
        <template #title>
          <feather-icon icon="UserIcon" />
          <span>Step 1: Customer Details</span>
        </template>
      </b-tab>
      <b-tab
        title="Step 2: Add Account(s)"
        disabled
      >
        <template #title>
          <feather-icon icon="PlusIcon" />
          <span>Step 2: Add Account(s)</span>
        </template>

      </b-tab>
      <b-tab
        title="Step 3: Generate Contract"
      >
        <template #title>
          <feather-icon icon="FileIcon" />
          <span>Step 3: Generate Contract</span>
        </template>
        <b-overlay
          :show="busy"
          spinner-variant="primary"
          spinner-type="grow"
          rounded="sm"
          opacity="0.20"
        >

          <div class="d-flex justify-content-center">
            <div>
              <!-- alert wit success message of generate contract -->
              <b-alert
                show
                variant="success"
                class="mt-2 p-2"
              >
                Contract Generated Successfully
              </b-alert>
              <b-button
                variant="primary"
                class="mr-2"
                :to="{ name: 'contracts' }"
              >
                <feather-icon
                  icon="FileIcon"
                  class="d-inline "
                /> View Contracts
              </b-button>
              <b-button
                variant="primary"
                class="mr-2"
                @click="sendViaDocuSign"
              >
                <feather-icon
                  icon="SendIcon"
                  class="d-inline "
                />&nbsp; Send Via DocuSign
              </b-button>
              <!-- <b-button
                variant="primary"
                class="mr-2"
                @click="generateContract"
              >
                <feather-icon
                  icon="PrinterIcon"
                  class="d-inline "
                />&nbsp;Print
              </b-button> -->
              <b-button
                variant="primary"
                class="mr-2"
                @click="downloadContract"
              >
                <feather-icon
                  icon="DownloadIcon"
                  class="d-inline "
                /> &nbsp; Download
              </b-button>
            </div>
          </div>
        </b-overlay>

      </b-tab>
    </b-tabs>
  </b-card>
</template>

<script>
import { ref } from '@vue/composition-api'
import 'vue-select/dist/vue-select.css'

import {
  BCard,
  BTab,
  BTabs,
  BAlert,
  BButton,
  BOverlay,
  BSpinner,
} from 'bootstrap-vue'

import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import 'vue-good-table/dist/vue-good-table.css'
import useContracts from '@/composables/contracts'

export default {
  components: {
    BTab,
    BTabs,
    BCard,
    BAlert,
    BButton,
    BOverlay,
    BSpinner,
  },

  setup(_, { root }) {
    const generateContract = () => {
      console.log('generateContract')
    }

    const {
      busy,
      respResult,
      downloadContractPdf,
      sendContractViaDocuSign,
    } = useContracts()


    const sendViaDocuSign = async () => {
      await sendContractViaDocuSign(root.$route.query.contractId)
    }

    // download contract pdf file from server
    const downloadContract = async () => {
      downloadContractPdf(root.$route.query.contractId)
    }


    return {
      busy,
      downloadContract,
      generateContract,
      sendViaDocuSign,
    }
  },
}
</script>
