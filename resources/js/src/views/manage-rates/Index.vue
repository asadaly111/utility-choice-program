<template>
  <div>

    <!-- <Export
        :is-export-active.sync="isExportActive"
        :filters="filters"
        export-url="/export/applications"
        v-if="isExportActive &&$can('applications-export', 'all')"
      /> -->
    <AddRate
      :is-add-new-rate-active.sync="isAddNewRateActive"
      @refetch-data="fetchCommercialRates"
      v-if="isAddNewRateActive"
    />


    <!-- <EditRate
      :is-edit-order-active.sync="isEditRateActive"
      @refetch-data="fetchCommercialRates"
      :order-data="orderData"
      v-if="isEditRateActive"
    /> -->
    <b-card
      no-body
      class="mb-0"
    >
      <div class="m-2">
        <b-row>
          <b-col
            cols="12"
            md="6"
            class="d-flex align-items-center justify-content-start mb-1 mb-md-0"
          >
            <label>Show</label>
            <v-select
              v-model="perPage"
              :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
              :options="perPageOptions"
              :clearable="false"
              class="per-page-selector d-inline-block mx-50"
            />
            <label>entries</label>
            <!-- <b-button
              class="d-inline-block ml-1"
              variant="primary"
              @click="isExportActive = true"
            >
              <span class="text-nowrap">Export</span>
            </b-button> -->
            <b-button
              class="d-inline-block ml-1"
              variant="primary"
              @click="isAddNewRateActive = true"
              v-if="$can('new-order', 'all')"
            >
              <span class="text-nowrap">Create New Rate</span>
            </b-button>
          </b-col>
          <b-col
            cols="12"
            md="6"
          >
            <div class="d-flex align-items-center justify-content-end">
              <b-form-input
                v-model="searchQuery"
                class="d-inline-block mr-1"
                placeholder="Search..."
              />
            </div>
          </b-col>
        </b-row>
      </div>
      <b-overlay
        id="overlay-background"
        :show="busy"
        variant="transparent"
        rounded="sm"
      >
        <b-table
          ref="refListTable"
          class="position-relative"
          :items="orders"
          responsive
          :fields="tableColumns"
          primary-key="id"
          :sort-by.sync="sortBy"
          show-empty
          empty-text="No matching records found"
          :sort-desc.sync="isSortDirDesc"
        >
          <template #cell(runSheetFile)="data">
            <b-link
              :to="data.item.runSheetFile"
              class="font-weight-bold"
              target="_blank"
              download
            >
              <feather-icon
                icon="DownloadIcon"
                size="22"
              />
            </b-link>
            <b-link
              :to="data.item.runSheetFile"
              class="font-weight-bold ml-1"
              target="_blank"
              :id="`runSheetFile${data.item.id}`"
            >
              <feather-icon
                icon="EyeIcon"
                size="22"
              />
            </b-link>
          </template>

          <template #cell(actions)="data">
            <div class="text-nowrap">
              <b-dropdown
                variant="link"
                no-caret
              >
                <template #button-content>
                  <feather-icon
                    icon="MoreVerticalIcon"
                    size="16"
                    class="align-middle text-body"
                  />
                </template>

                <b-dropdown-item @click="confirmDelete(data.item.id)">
                  <feather-icon icon="TrashIcon" />
                  <span class="align-middle ml-50">Delete</span>
                </b-dropdown-item>
              </b-dropdown>

            </div>
          </template>
        </b-table>
      </b-overlay>
      <div class="mx-2 mb-2">
        <b-row>
          <b-col
            cols="12"
            sm="6"
            class="d-flex align-items-center justify-content-center justify-content-sm-start"
          >
            <span class="text-muted">Showing {{ dataMeta.from }} to {{ dataMeta.to }} of
              {{ dataMeta.of }} entries</span>
          </b-col>
          <!-- Pagination -->
          <b-col
            cols="12"
            sm="6"
            class="d-flex align-items-center justify-content-center justify-content-sm-end"
          >
            <b-pagination
              v-model="currentPage"
              :total-rows="totalRecords"
              :per-page="perPage"
              first-number
              last-number
              class="mb-0 mt-1 mt-sm-0"
              prev-class="prev-item"
              next-class="next-item"
            >
              <template #prev-text>
                <feather-icon
                  icon="ChevronLeftIcon"
                  size="18"
                />
              </template>
              <template #next-text>
                <feather-icon
                  icon="ChevronRightIcon"
                  size="18"
                />
              </template>
            </b-pagination>
          </b-col>
        </b-row>
      </div>
    </b-card>
  </div>
</template>

<script>
import {
  BLink,
  BCard,
  BRow,
  BCol,
  BTable,
  BButton,
  BOverlay,
  BDropdown,
  BFormInput,
  BPagination,
  BDropdownItem,
} from 'bootstrap-vue'
import { onMounted, ref } from '@vue/composition-api'
import vSelect from 'vue-select'
import useCommercialRates from '@/composables/commercialRates'
import AddRate from './dialoags/AddRate.vue'
import EditRate from './dialoags/EditRate.vue'

export default {
  components: {
    BCol,
    BRow,
    BLink,
    BCard,
    BTable,
    BButton,
    vSelect,
    AddRate,
    EditRate,
    BOverlay,
    BDropdown,
    BFormInput,
    BPagination,
    BDropdownItem,
  },
  setup(_, { root }) {
    const {
      busy,
      sortBy,
      orders,
      filters,
      perPage,
      student,
      dataMeta,
      respResult,
      refetchData,
      searchQuery,
      currentPage,
      totalRecords,
      tableColumns,
      refListTable,
      deleteOrder,
      isSortDirDesc,
      fetchCommercialRates,
      perPageOptions,
    } = useCommercialRates()


    onMounted(() => {
      fetchCommercialRates()
    })


    const isExportActive = ref(false)
    const isAddNewRateActive = ref(false)
    const isEditRateActive = ref(false)
    const isOrderDetailsActive = ref(false)
    const filterKey = ref(0)
    const orderData = ref({})

    const viewOrder = data => {
      isOrderDetailsActive.value = true
      orderData.value = data
    }


    const filterUpdate = filterQuery => {
      Object.assign(filters, filterQuery)
    }

    const resetFilter = () => {
      Object.keys(filters).forEach(index => { filters[index] = null })
      filterKey.value += 1
    }

    const deleteUserConfirmed = async id => {
      await deleteOrder(id)
      if (respResult.value.status === 200) {
        fetchCommercialRates()
      }
    }

    const confirmDelete = async id => {
      root.$bvModal
        .msgBoxConfirm('Please confirm that you want to delete order and all of linked data.', {
          title: 'Please Confirm',
          size: 'sm',
        })
        .then(value => {
          if (value) {
            deleteUserConfirmed(id)
          }
        })
    }

    return {
      busy,
      sortBy,
      filters,
      student,
      perPage,
      orders,
      orderData,
      dataMeta,
      filterKey,
      resetFilter,
      viewOrder,
      fetchCommercialRates,
      refetchData,
      searchQuery,
      currentPage,
      filterUpdate,
      tableColumns,
      totalRecords,
      refListTable,
      isSortDirDesc,
      confirmDelete,
      perPageOptions,
      isExportActive,
      isEditRateActive,
      isAddNewRateActive,
      isOrderDetailsActive,
    }
  },
}
</script>
<style lang="scss" scoped>
.per-page-selector {
    width: 90px;
}
</style>

<style lang="scss">
@import '~@core/scss/vue/libs/vue-select.scss';
</style>
