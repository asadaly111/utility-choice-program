<template>
  <b-card
    no-body
    class="mb-0"
    style="min-height:350px"
  >
    <div class="m-2">
      <h4>Recent Leads</h4>
    </div>
    <b-table
      ref="refListTable"
      class="position-relative"
      :items="leads"
      :fields="tableColumns"
      primary-key="id"
      show-empty
      responsive
      empty-text="No matching records found"
      :sort-desc.sync="isSortDirDesc"
      @row-clicked="viewDetails"
    />
  </b-card>
</template>

<script>
// import useLeads from '@/composables/leads'
import { onMounted, ref } from '@vue/composition-api'
import {
  BCard, BTable, VBTooltip,
} from 'bootstrap-vue'


export default {
  components: {
    BCard,
    BTable,
  },
  directives: {
    'b-tooltip': VBTooltip,
  },
  setup() {
    const {
      sortBy,
      filters,
      perPage,
      leads,
      dataMeta,
      refetchData,
      fetchLeads,
      searchQuery,
      currentPage,
      totalRecords,
      refListTable,
      isSortDirDesc,
      perPageOptions,
    } = useLeads()
    const isAddLeadActive = ref(false)
    const leadData = ref({})
    onMounted(async () => {
    //   perPage.value = 6
    //   fetchLeads()
    })
    const isLeadViewActive = ref(false)
    const viewDetails = lead => {
      isLeadViewActive.value = true
      leadData.value = lead
    }

    const tableColumns = [
      { key: 'name', sortable: true },
      { key: 'email', sortable: true },
      { key: 'amount_currency', sortable: true, label: 'Amount' },
      { key: 'created_at', sortable: false, label: 'Date added' },
    ]


    return {
      leads,
      sortBy,
      filters,
      perPage,
      dataMeta,
      leadData,
      fetchLeads,
      viewDetails,
      searchQuery,
      currentPage,
      refetchData,
      totalRecords,
      tableColumns,
      refListTable,
      isSortDirDesc,
      perPageOptions,
      isAddLeadActive,
      isLeadViewActive,
    }
  },
}
</script>

