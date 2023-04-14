<template>
  <div>
    <b-row class="justify-content-md-end">
      <b-col
        cols="12"
        md
      >
        <app-breadcrumb />
      </b-col>
      <b-col cols="auto">
        <b-form-group>
          <b-form-checkbox switch>
            Show Expired
          </b-form-checkbox>
        </b-form-group>
      </b-col>
      <b-col cols="auto">
        <b-form-group>
          <b-form-checkbox switch>
            Compact View
          </b-form-checkbox>
        </b-form-group>
      </b-col>
    </b-row>
    <vue-good-table
      :columns="columns"
      :select-options="{ enabled: true, selectOnCheckboxOnly: true }"
      :rows="rows"
      max-height="80vh"
      :pagination-options="{
        enabled: true,
        mode: 'records',
        perPage: 50,
        position: 'top',
        perPageDropdown: [20, 30, 40, 50],
        dropdownAllowAll: false,
        setCurrentPage: 2,
        nextLabel: 'Next',
        prevLabel: 'Prev',
        rowsPerPageLabel: 'Rows per page',
        ofLabel: 'of',
        pageLabel: 'page', // for 'pages' mode
        allLabel: 'All',
      }"
    >
      <template
        slot="table-row"
        slot-scope="props"
      >
        <div
          class="action-buttons"
          v-if="props.column.field === 'con'"
        >
          <button class="btn action-btn">
            <feather-icon
              icon="FileIcon"
              size="16"
            />
          </button>
        </div>

        <div
          class="action-buttons"
          v-if="props.column.field === 'bill'"
        >
          <button class="btn action-btn">
            <feather-icon
              icon="PaperclipIcon"
              size="16"
            />
          </button>
        </div>

        <div
          class="action-buttons"
          v-if="props.column.field === 'qc'"
        >
          <button class="btn action-btn">
            <feather-icon
              icon="FilePlusIcon"
              size="16"
            />
          </button>
        </div>

        <div
          class="action-buttons"
          v-if="props.column.field === 'notes'"
        >
          <button class="btn action-btn">
            <feather-icon
              icon="FileIcon"
              size="16"
            />
          </button>
        </div>

        <div
          class="action-buttons"
          v-if="props.column.field === 'actions'"
        >
          <button class="btn action-btn">
            <feather-icon
              icon="DownloadIcon"
              size="16"
            />
          </button>
          <button class="btn action-btn">
            <feather-icon
              icon="SendIcon"
              size="16"
            />
          </button>
          <button class="btn action-btn">
            <feather-icon
              icon="ClockIcon"
              size="16"
            />
          </button>
          <button class="btn action-btn">
            <feather-icon
              icon="RefreshCwIcon"
              size="16"
            />
          </button>
          <button class="btn action-btn">
            <feather-icon
              icon="EditIcon"
              size="16"
            />
          </button>
          <button class="btn action-btn">
            <feather-icon
              icon="DeleteIcon"
              size="16"
            />
          </button>
        </div>
      </template>
    </vue-good-table>
  </div>
</template>

<script>
import AppBreadcrumb from '@core/layouts/components/AppBreadcrumb.vue'
import {
  BRow, BCol, BFormGroup, BFormRow, BFormCheckbox,
} from 'bootstrap-vue'
import 'vue-good-table/dist/vue-good-table.css'
import { VueGoodTable } from 'vue-good-table'

export default {
  data() {
    return {
      columns: [
        {
          label: 'ID',
          field: 'id',
          width: '100px',
          filterOptions: {
            enabled: true,
            placeholder: 'ID',
          },
        },
        {
          label: 'Agency',
          field: 'agency',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'Name',
            filterDropdownItems: ['', ''],
          },
        },
        {
          label: 'Agent',
          field: 'agent',
          width: '180px',
          filterOptions: {
            enabled: true,
            placeholder: 'Email',
            filterDropdownItems: ['', ''],
          },
        },
        {
          label: 'Business Name',
          field: 'businessname',
          width: '180px',
          filterOptions: {
            enabled: true,
            placeholder: 'Business Name',
            filterDropdownItems: ['', ''],
          },
        },
        {
          label: 'State',
          field: 'state',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'Select',
            filterDropdownItems: ['', ''],
          },
        },
        {
          label: 'Utility',
          field: 'doingbusinessas',
          width: '220px',
          filterOptions: {
            enabled: true,
            placeholder: 'Select',
            filterDropdownItems: ['', ''],
          },
        },
        {
          label: 'Account Numbers',
          field: 'businesstype',
          width: '250px',
          filterOptions: {
            enabled: true,
            placeholder: 'Business Type',
            filterDropdownItems: ['', ''],
          },
        },
        {
          label: 'EIN',
          field: 'ein',
          width: '150px',
          filterOptions: {
            enabled: true,
            placeholder: 'EIN',
          },
        },
        {
          label: 'E/G',
          field: 'eg',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'E/G',
            filterDropdownItems: ['', ''],
          },
        },
        {
          label: 'Supplier',
          field: 'supplier',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'Supplier',
            filterDropdownItems: ['', ''],
          },
        },
        {
          label: 'Product',
          field: 'product',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'Product',
            filterDropdownItems: ['', ''],
          },
        },
        {
          label: 'A.Volumne',
          field: 'volume',
          width: '150px',
          filterOptions: {
            enabled: true,
            placeholder: 'Volume',
          },
        },
        {
          label: 'Term',
          field: 'term',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'Term',
            filterDropdownItems: ['', ''],
          },
        },
        {
          label: 'Start Date',
          field: 'startdate',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'Start Date',
          },
        },
        {
          label: 'End Date',
          field: 'enddate',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'End Date',
          },
        },
        {
          label: 'Type',
          field: 'type',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'Type',
            filterDropdownItems: ['', ''],
          },
        },
        {
          label: 'Parent',
          field: 'parent',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'Parent',
          },
        },
        {
          label: 'Child',
          field: 'child',
          width: '200px',
          filterOptions: {
            enabled: true,
            placeholder: 'Agency',
            filterDropdownItems: ['', ''],
          },
        },
        {
          label: 'ABM',
          field: 'abm',
          width: '200px',
        },
        {
          label: 'BF',
          field: 'bf',
          width: '100px',
        },
        {
          label: 'Sell. Price',
          field: 'sellprice',
          width: '150px',
        },
        {
          label: 'Agency DV',
          field: 'agencydv',
          width: '150px',
        },
        {
          label: 'Last Update',
          field: 'lastupdate',
          width: '150px',
          type: 'date',
          dateInputFormat: 'yyyy-MM-dd',
          dateOutputFormat: 'MMM do yy',
          filterOptions: {
            enabled: true,
            placeholder: 'Last Update',
          },
        },
        {
          label: 'Create Date',
          field: 'createdate',
          width: '150px',
          type: 'date',
          dateInputFormat: 'yyyy-MM-dd',
          dateOutputFormat: 'MMM do yy',
          filterOptions: {
            enabled: true,
            placeholder: 'Create Update',
          },
        },
        {
          label: 'Status',
          field: 'status',
          width: '150px',
          filterOptions: {
            enabled: true,
            placeholder: 'Status',
            filterDropdownItems: ['', ''],
          },
        },
        {
          label: 'TPV ID',
          field: 'tpvid',
          width: '250px',
        },
        {
          label: 'Flags',
          field: 'flags',
          width: '250px',
          filterOptions: {
            enabled: true,
            placeholder: 'Flags',
            filterDropdownItems: ['', ''],
          },
        },
        {
          label: 'Con.',
          field: 'con',
          width: '60px',
          tdClass: 'align-middle text-center p-0',
        },
        {
          label: 'Bill',
          field: 'bill',
          width: '60px',
          tdClass: 'align-middle text-center p-0',
        },
        {
          label: 'QC',
          field: 'qc',
          width: '60px',
          tdClass: 'align-middle text-center p-0',
        },
        {
          label: 'Notes',
          field: 'notes',
          width: '80px',
          tdClass: 'align-middle text-center p-0',
        },
        {
          label: '',
          field: 'actions',
          width: '220px',
          sortable: false,
          tdClass: 'align-middle text-center p-0',
        },
      ],
      rows: [
        { id: 0 },
        { id: 1 },
        { id: 2 },
        { id: 3 },
        { id: 4 },
        { id: 5 },
        { id: 6 },
        { id: 7 },
        { id: 8 },
        { id: 9 },
        { id: 10 },
        { id: 11 },
        { id: 12 },
        { id: 13 },
        { id: 14 },
        { id: 15 },
        { id: 16 },
        { id: 17 },
        { id: 18 },
        { id: 19 },
        { id: 20 },
        { id: 21 },
        { id: 22 },
        { id: 23 },
        { id: 24 },
        { id: 25 },
        { id: 26 },
        { id: 27 },
        { id: 28 },
        { id: 29 },
        { id: 30 },
        { id: 31 },
        { id: 32 },
        { id: 33 },
        { id: 34 },
        { id: 35 },
        { id: 36 },
        { id: 37 },
        { id: 38 },
        { id: 39 },
        { id: 40 },
        { id: 41 },
        { id: 42 },
        { id: 43 },
        { id: 44 },
        { id: 45 },
        { id: 46 },
        { id: 47 },
        { id: 48 },
        { id: 49 },
        { id: 50 },
        { id: 51 },
        { id: 52 },
        { id: 53 },
        { id: 54 },
        { id: 55 },
        { id: 56 },
        { id: 57 },
        { id: 58 },
        { id: 59 },
        { id: 60 },
        { id: 61 },
        { id: 62 },
        { id: 63 },
        { id: 64 },
        { id: 65 },
        { id: 66 },
        { id: 67 },
        { id: 68 },
        { id: 69 },
        { id: 70 },
        { id: 71 },
        { id: 72 },
        { id: 73 },
        { id: 74 },
        { id: 75 },
        { id: 76 },
        { id: 77 },
        { id: 78 },
        { id: 79 },
        { id: 80 },
        { id: 81 },
        { id: 82 },
        { id: 83 },
        { id: 84 },
        { id: 85 },
        { id: 86 },
        { id: 87 },
        { id: 88 },
        { id: 89 },
        { id: 90 },
        { id: 91 },
        { id: 92 },
      ],
    }
  },
  components: {
    BRow,
    BCol,
    BFormGroup,
    BFormRow,
    BFormCheckbox,
    VueGoodTable,
    AppBreadcrumb,
  },
}
</script>
<style lang="scss">
.vgt-wrap {
    .vgt-table {
        thead {
            position: sticky;
            top: 0;
        }
        th {
            font-size: 12px;
            input {
                font-size: 12px;
            }
            select {
                font-size: 12px;
            }
        }
        td {
            font-size: 12px;
            img {
                max-width: 150px;
                max-height: 50px;
            }
            .action-buttons {
                .action-btn {
                    font-size: 20px;
                    padding: 5px;
                }
            }
        }
    }
    .vgt-wrap__footer {
        padding: 10px;
        .footer__row-count {
            form {
                display: inline-flex;
                align-items: center;
            }
            .footer__row-count__label {
                font-size: 13px;
            }
            .footer__row-count__select {
                font-size: 12px;
            }
            &::after {
                border-width: 4px;
            }
        }
        .footer__navigation__page-info {
            font-size: 12px;
        }
        .footer__navigation__page-btn span {
            font-size: 12px;
        }
    }
}
</style>
