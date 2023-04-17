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
        <div class="d-flex justify-content-between">
          <div>
            <b-button
              variant="primary"
              class="mr-2"
              @click="generateContract"
            >
              Generate Contract
            </b-button>
            <b-button
              variant="primary"
              class="mr-2"
              @click="generateContract"
            >
              Generate Docusign
            </b-button>
            <b-button
              variant="primary"
              class="mr-2"
              @click="generateContract"
            >
              In Person Sign
            </b-button>
          </div>
          <div>
            <b-button
              variant="primary"
              class="mr-2"
              @click="generateContract"
            >
              Print
            </b-button>
            <b-button
              variant="primary"
              class="mr-2"
              @click="generateContract"
            >
              Download
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
} from 'bootstrap-vue'

import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import 'vue-good-table/dist/vue-good-table.css'

export default {
  components: {
    BTab,
    BTabs,
    BCard,
  },

  setup() {
    return {

    }
  }
}
</script>
