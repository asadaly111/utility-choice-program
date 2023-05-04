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

        <!-- 4 buttons inline for generate docusign, inperson sign, print and download -->
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
              @click="generateContract"
            >
              <feather-icon
                icon="SendIcon"
                class="d-inline "
              />&nbsp; Send Via DocuSign
            </b-button>
            <b-button
              variant="primary"
              class="mr-2"
              @click="generateContract"
            >
              <feather-icon
                icon="PenToolIcon"
                class="d-inline "
              />&nbsp; In Person Sign
            </b-button>
            <b-button
              variant="primary"
              class="mr-2"
              @click="generateContract"
            >
              <feather-icon
                icon="PrinterIcon"
                class="d-inline "
              />&nbsp;Print
            </b-button>
            <b-button
              variant="primary"
              class="mr-2"
              @click="generateContract"
            >
              <feather-icon
                icon="DownloadIcon"
                class="d-inline "
              /> &nbsp; Download
            </b-button>
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

          </div>
        </div>

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
} from 'bootstrap-vue'

import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import 'vue-good-table/dist/vue-good-table.css'

export default {
  components: {
    BTab,
    BTabs,
    BCard,
    BAlert,
    BButton,
  },

  setup() {
    const generateContract = () => {
      console.log('generateContract')
    }

    return {
      generateContract,
    }
  },
}
</script>
