<template>
  <b-card>
    <form-wizard
      color="#7367F0"
      :title="null"
      :subtitle="null"
      finish-button-text="Submit"
      back-button-text="Previous"
      class="mb-3"
      @on-complete="formSubmitted"
    >
      <!-- account detail tab -->
      <tab-content
        title="Customer Details"
      >
        <b-row>
          <b-col
            md="6"
            lg="4"
          >
            <b-form-group label="Document">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Document"
              >
                <b-form-file
                  type="file"
                  v-model="formData.document"
                  :state="errors.length > 0 ? false : null"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="First Name">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="First Name"
              >
                <b-form-input
                  v-model="formData.first_name"
                  :state="errors.length > 0 ? false : null"
                  placeholder="First Name"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Last Name">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Last Name"
              >
                <b-form-input
                  v-model="formData.last_name"
                  :state="errors.length > 0 ? false : null"
                  placeholder="Last Name"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Title">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Title"
              >
                <vue-select
                  v-model="formData.title"
                  :options="titles"
                  placeholder="Title"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Email">
              <validation-provider
                #default="{ errors }"
                rules="required|email"
                name="Email"
              >
                <b-form-input
                  type="email"
                  v-model="formData.email"
                  :state="errors.length > 0 ? false : null"
                  placeholder="Email"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            md="6"
            lg="4"
            v-for="(phoneNum, index) in phone.phone_number"
            :key="index"
          >
            <b-form-group label="Phone Number">
              <b-input-group class="flex-nowrap">
                <b-input-group-prepend>
                  <b-form-select
                    :options="[
                      {
                        text: 'Mobile',
                        value: 'Mobile',
                      },
                      {
                        text: 'Office',
                        value: 'Office',
                      },
                    ]"
                    v-model="phoneNum.type"
                  />
                </b-input-group-prepend>
                <validation-provider
                  #default="{ errors }"
                  rules="required"
                  :name="'Phone Number'"
                  :vid="'Phone-Number-' + index"
                >
                  <div class="d-flex">
                    <b-form-input
                      type="tel"
                      v-model="phoneNum.value"
                      :state="errors.length > 0 ? false : null"
                      placeholder="Phone Number"
                    />
                    <button
                      v-if="index == 0"
                      type="button"
                      class="btn btn-sm btn-form-action btn-primary"
                      @click.prevent="
                        addPhoneNumber(
                          phone.phone_number[phone.phone_number.length - 1].id +
                            1
                        )
                      "
                    >
                      <feather-icon
                        icon="PlusIcon"
                        size="16"
                      />
                    </button>
                    <button
                      v-else
                      type="button"
                      class="btn btn-sm btn-form-action btn-primary"
                      @click.prevent="removePhoneNumber(phoneNum.id)"
                    >
                      <feather-icon
                        icon="XIcon"
                        size="16"
                      />
                    </button>
                  </div>
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-input-group>

              <!-- </validation-provider> -->
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Business Name">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Business Name"
              >
                <b-form-input
                  v-model="formData.business_name"
                  :state="errors.length > 0 ? false : null"
                  placeholder="Business Name"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Doing Business As">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Doing Business As"
              >
                <b-form-input
                  v-model="formData.doing_business_as"
                  :state="errors.length > 0 ? false : null"
                  placeholder="Doing Business As"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Business Type">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Business Type"
              >
                <vue-select
                  v-model="formData.business_type"
                  :options="businessTypes"
                  placeholder="Business Type"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="EIN">
              <validation-provider
                #default="{ errors }"
                rules="required|integer"
                name="EIN"
              >
                <b-form-input
                  v-model="formData.ein"
                  :state="errors.length > 0 ? false : null"
                  placeholder="EIN"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Industry">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Industry"
              >
                <vue-select
                  v-model="formData.industry"
                  :options="industries"
                  placeholder="Industry"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Tax Exempt">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Tax Exempt"
              >
                <b-form-checkbox
                  v-model="formData.tax_exempt"
                  :state="errors.length > 0 ? false : null"
                  placeholder="Tax Exempt"
                  value="1"
                ><p>
                  You will be required to upload a state Tax Exemption
                  document
                </p></b-form-checkbox>
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Address 1">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Address 1"
              >
                <b-form-input
                  v-model="formData.address1"
                  :state="errors.length > 0 ? false : null"
                  placeholder="Address 1"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Address 2">
              <b-form-input
                v-model="formData.address2"
                placeholder="Address 2"
              />
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="State">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="State"
              >
                <vue-select
                  v-model="formData.state"
                  :options="statesOptions"
                  :reduce="(state) => state.name"
                  label="name"
                  placeholder="State"
                  @input="filterCities"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="City">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="City"
              >
                <vue-select
                  v-model="formData.city"
                  :options="citiesFilteredObjects"
                  :reduce="(city) => city.name"
                  label="name"
                  placeholder="City"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Zip">
              <validation-provider
                #default="{ errors }"
                name="Zip"
                rules="required"
              >
                <b-form-input
                  v-model="formData.zip"
                  :state="errors.length > 0 ? false : null"
                  placeholder="Zip"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Billing Address">
              <b-form-checkbox
                @input="showBilling"
                v-model="formData.billing_address_option"
                placeholder="Billing Address"
                value="1"
              ><p>
                Check if billing address different than business address
              </p></b-form-checkbox>
            </b-form-group>
          </b-col>

          <b-col
            v-if="isBillingActive"
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Billing Address">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Billing Address"
              >
                <b-form-input
                  v-model="formData.billing_address"
                  :state="errors.length > 0 ? false : null"
                  placeholder="Billing Address"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            v-if="isBillingActive"
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Billing State">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Billing State"
              >
                <vue-select
                  v-model="formData.billing_state"
                  :options="statesOptions"
                  :reduce="(state) => state.name"
                  label="name"
                  placeholder="State"
                  @input="filterBillingCities"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            v-if="isBillingActive"
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Billing City">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Billing City"
              >
                <vue-select
                  v-model="formData.billing_city"
                  :options="billingCitiesFilteredObjects"
                  :reduce="(city) => city.name"
                  label="name"
                  placeholder="City"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            v-if="isBillingActive"
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Billing Zip">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Billing Zip"
              >
                <b-form-input
                  v-model="formData.billing_zip"
                  :state="errors.length > 0 ? false : null"
                  placeholder="Zip"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>
        </b-row>
      </tab-content>

      <!-- personal details -->
      <tab-content
        title="Add Accounts"
      >
      <vue-good-table
          mode="remote"
          @on-page-change="onPageChange"
          @on-per-page-change="onPerPageChange"
          @on-column-filter="onColumnFilter"
          max-height="80vh"
          :columns="tableColumns2"
          :total-rows="totalRecords"
          :rows="customersAccounts"
          :select-options="{
            enabled: true,
            selectOnCheckboxOnly: true,
          }"
          :sort-options="{
            enabled: false,
          }"
          :pagination-options="{
            enabled: true,
            mode: 'records',
            perPage: perPage,
            position: 'top',
            perPageDropdown: perPageOptions,
            dropdownAllowAll: false,
            setCurrentPage: currentPage,
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
            <div v-if="props.column.field == 'eg'">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                width="24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"
                />
              </svg>
            </div>
            <div v-else-if="props.column.field == 'bill'">
              <feather-icon
                icon="FolderPlusIcon"
                size="18"
                class="align-middle text-body"
                @click="accountFile({id:props.row.id, name:'Bill', type:'bill'})"
              />
            </div>
            <div v-else-if="props.column.field == 'loa'">
              <feather-icon
                icon="FolderPlusIcon"
                size="18"
                class="align-middle text-body"
                @click="accountFile({id:props.row.id, name:'Loa', type:'loa'})"
              />
            </div>
            <div v-else-if="props.column.field == 'lor'">
              <feather-icon
                icon="FolderPlusIcon"
                size="18"
                class="align-middle text-body"
                @click="accountFile({id:props.row.id, name:'Lor', type:'lor'})"
              />
            </div>
            <div v-else-if="props.column.field == 'misc'">
              <feather-icon
                icon="FolderPlusIcon"
                size="18"
                class="align-middle text-body"
                @click="accountFile({id:props.row.id,name:'Misc', type:'misc'})"
              />
            </div>
            <div v-else-if="props.column.field == 'tax_exempt'">
              <feather-icon
                icon="FolderPlusIcon"
                size="18"
                class="align-middle text-body"
                @click="accountFile({id:props.row.id,name:'Tax Exempt', type:'tax_exempt'})"
              />
            </div>
            <div v-else-if="props.column.field == 'notes'">
              <feather-icon
                icon="FolderIcon"
                size="18"
                class="align-middle text-body"
              />
            </div>
            <div v-else-if="props.column.field === 'actions'">
              <b-dropdown
                toggle-class="p-0"
                variant="link"
                no-caret
                right
              >
                <template #button-content>
                  <feather-icon
                    icon="MoreVerticalIcon"
                    size="16"
                    class="align-middle text-body"
                  />
                </template>
                <b-dropdown-item>
                  <feather-icon
                    icon="RotateCcwIcon"
                  />
                  <span
                    class="align-middle ml-50"
                  >History</span>
                </b-dropdown-item>
                <b-dropdown-item
                  @click="editAccountRow(props.row)"
                >
                  <feather-icon icon="EditIcon" />
                  <span
                    class="align-middle ml-50"
                  >Edit</span>
                </b-dropdown-item>
                <b-dropdown-item
                  @click="confirmDelete(props.row.id)"
                >
                  <feather-icon icon="TrashIcon" />
                  <span
                    class="align-middle ml-50"
                  >Delete</span>
                </b-dropdown-item>
              </b-dropdown>
            </div>
            <span v-else>
              {{ props.formattedRow[props.column.field] }}
            </span>
          </template>
        </vue-good-table>
        
        <b-row class="mt-4">
          <b-col
            md="6"
            lg="4"
          >
            <b-form-group label="Document">
              <b-form-file
                type="file"
                v-model="file.document"
              />
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Zip">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Zip"
              >
                <b-form-input
                  v-model="formData.zip"
                  :state="errors.length > 0 ? false : null"
                  placeholder="Zip"
                />
                <small class="text-danger">{{
                  errors[0]
                }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Sub Type">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Sub Type"
              >
                <b-form-input
                  v-model="formData.sub_type"
                  :state="errors.length > 0 ? false : null"
                  placeholder="Sub Type"
                />
                <small class="text-danger">{{
                  errors[0]
                }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Commodity">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Commodity"
              >
                <vue-select
                  :options="[
                    {
                      value: 'electricity',
                      name: 'Electricity',
                    },
                    {
                      value: 'gas',
                      name: 'Gas',
                    },
                  ]"
                  label="name"
                  :reduce="(dropdown) => dropdown.name"
                  v-model="formData.commodity"
                  :state="errors.length > 0 ? false : null"
                />
                <small class="text-danger">{{
                  errors[0]
                }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Address 1">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Address 1"
              >
                <b-form-input
                  v-model="formData.address1"
                  :state="errors.length > 0 ? false : null"
                  placeholder="Address 1"
                />
                <small class="text-danger">{{
                  errors[0]
                }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Address 2">
              <b-form-input
                v-model="formData.address2"
                placeholder="Address 2"
              />
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Rate Class">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Rate Class"
              >
                <vue-select
                  :options="[
                    {
                      value: 'none',
                      name: 'None',
                    }
                  ]"
                  label="name"
                  :reduce="(dropdown) => dropdown.name"
                  v-model="formData.rate_class"
                  :state="errors.length > 0 ? false : null"
                />
                <small class="text-danger">{{
                  errors[0]
                }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Status">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Status"
              >
                <vue-select
                  :options="[
                    {
                      value: 'Under Contact',
                      name: 'Under Contact',
                    },
                    {
                      value: 'Not Under Contract',
                      name: 'Not Under Contract',
                    },
                  ]"
                  label="name"
                  :reduce="(dropdown) => dropdown.name"
                  v-model="formData.account_status"
                  :state="errors.length > 0 ? false : null"
                />
                <small class="text-danger">{{
                  errors[0]
                }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Contract End Date">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Contract End Date"
              >
                <b-form-input
                  type="date"
                  v-model="formData.contract_end_date"
                  :state="errors.length > 0 ? false : null"
                  placeholder="Contract End Date"
                />
                <small class="text-danger">{{
                  errors[0]
                }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="State">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="State"
              >
                <vue-select
                  v-model="formData.state"
                  :options="statesOptions"
                  :reduce="(state) => state.name"
                  label="name"
                  @input="filterCities"
                  :state="errors.length > 0 ? false : null"
                />
                <small class="text-danger">{{
                  errors[0]
                }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="City">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="City"
              >
                <vue-select
                  :options="citiesFilteredObjects"
                  :reduce="(city) => city.name"
                  v-model="formData.city"
                  label="name"
                  :state="errors.length > 0 ? false : null"
                />
                <small class="text-danger">{{
                  errors[0]
                }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Zone">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Zone"
              >
                <vue-select
                  :options="[
                    {
                      value: 'none',
                      name: 'None',
                    }
                  ]"
                  label="name"
                  :reduce="(dropdown) => dropdown.name"
                  v-model="formData.zone"
                  :state="errors.length > 0 ? false : null"
                />
                <small class="text-danger">{{
                  errors[0]
                }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Utility">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Utility"
              >
                <vue-select
                  :options="utility"
                  label="name"
                  :reduce="(dropdown) => dropdown.name"
                  v-model="formData.utility"
                  :state="errors.length > 0 ? false : null"
                />
                <small class="text-danger">{{
                  errors[0]
                }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Current Rate">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Current Rate"
              >
                <b-form-input
                  v-model="formData.current_rate"
                  :state="errors.length > 0 ? false : null"
                  placeholder="Current Rate"
                />
                <small class="text-danger">{{
                  errors[0]
                }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Notes">
              <b-form-input
                v-model="formData.notes"
                placeholder="Notes"
              />
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Account Number">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Account Number"
              >
                <b-form-input
                  v-model="formData.account_number"
                  :state="errors.length > 0 ? false : null"
                  placeholder="Account Number"
                />
                <small class="text-danger">{{
                  errors[0]
                }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>

          <b-col
            cols="12"
            md="6"
            lg="4"
          >
            <b-form-group label="Annual Volume">
              <validation-provider
                #default="{ errors }"
                rules="required"
                name="Annual Volume"
              >
                <b-form-input
                  v-model="formData.annual_volume"
                  :state="errors.length > 0 ? false : null"
                  placeholder="Annual Volume"
                />
                <small class="text-danger">{{
                  errors[0]
                }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>
        </b-row>
      </tab-content>

      <!-- address -->
      <tab-content
        title="Generate Contract"
      >
        <b-row>
          <b-col
            cols="12"
            class="mb-2"
          >
            <h5 class="mb-0">
              Generate Contract
            </h5>
            <small class="text-muted">Enter Contract Details.</small>
          </b-col>
          <b-col md="6">
            <b-form-group
              label="Address"
              label-for="i-address"
            >
              <b-form-input
                id="i-address"
                placeholder="98 Borough bridge Road, Birmingham"
              />
            </b-form-group>
          </b-col>
          <b-col md="6">
            <b-form-group
              label="Landmark"
              label-for="i-landmark"
            >
              <b-form-input
                id="i-landmark"
                placeholder="Borough bridge"
              />
            </b-form-group>
          </b-col>
          <b-col md="6">
            <b-form-group
              label="Pincode"
              label-for="i-pincode"
            >
              <b-form-input
                id="i-pincode"
                placeholder="658921"
              />
            </b-form-group>
          </b-col>
          <b-col md="6">
            <b-form-group
              label-for="i-city"
              label="City"
            >
              <b-form-input
                id="i-city"
                placeholder="Birmingham"
              />
            </b-form-group>
          </b-col>
        </b-row>
      </tab-content>
    </form-wizard>
  </b-card>
</template>

<script>
import { ref } from '@vue/composition-api'
import { FormWizard, TabContent } from 'vue-form-wizard'
import vSelect from 'vue-select'
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import { VueSelect } from 'vue-select'
import 'vue-select/dist/vue-select.css'

import {
  BRow,
  BCol,
  BCard,
  BForm,
  BModal,
  BButton,
  BFormFile,
  BFormGroup,
  BFormInput,
  BFormSelect,
  BInputGroup,
  BFormCheckbox,

  BInputGroupPrepend,
} from 'bootstrap-vue'
import useCustomers from '@/composables/customers'
import statesOptions from '@core/data/states.json'
import citiesOptions from '@core/data/cities.json'
import {
  required, email, integer, min,
} from '@validations'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import useAccounts from '@/composables/customersAccount'
import { VueGoodTable } from 'vue-good-table'
import 'vue-good-table/dist/vue-good-table.css'
import utility from '@core/data/utility.json'

export default {
  components: {
    FormWizard,
    TabContent,
    BRow,
    BCol,
    BCard,
    vSelect,
    BForm,
    BModal,
    BButton,
    VueSelect,
    BFormFile,
    BFormGroup,
    BFormInput,
    BFormSelect,
    BInputGroup,
    BFormCheckbox,
    VueGoodTable,
    ValidationProvider,
    ValidationObserver,
    BInputGroupPrepend,
  },
  methods: {
    formSubmitted() {},
  },

  setup() {
    const titles = ref([
      'Owner',
      'Principal',
      'Partner',
      'Vice President',
      'CEO',
      'COO',
      'CFO',
      'Controller',
      'Treasurer',
      'Director of Operations',
      'Director of Finance',
      'Business Manager',
      'Finance Manager',
      'Property Manager',
      'Trustee',
      'Board Member',
      'Power of Attorney',
      'Business Administrator',
      'Pastor',
      'Reverend',
      'Rabbi',
      'Accounts Payable Manager',
    ])
    const businessTypes = ref([
      'Corporation',
      'Limited Liability Company',
      'Partnership',
      'Individual',
    ])
    const industries = ([
      'Real Estate',
      'Information',
      'Arts',
      'Entertainment',
      'Construction',
      'Corporate Management',
      'Education Services',
      'Agriculture',
      'Other',
      'Government',
      'Finance',
      'Energy',
      'Healthcare',
      'Hospitality',
      'Manufacturing',
      'Retail Trade',
      'Wholesale Trade',
    ])

    const formInitialState = {
      document: null,
      first_name: '',
      last_name: '',
      title: '',
      email: '',
      business_name: '',
      doing_business_as: '',
      business_type: '',
      ein: '',
      industry: '',
      tax_exempt: '',
      address1: '',
      address2: '',
      state: '',
      city: '',
      zip: '',
      billing_address_option: '',
      billing_address: '',
      billing_state: '',
      billing_city: '',
      billing_zip: '',
    }

    const fileInitialState = {
      document: [],
    }

    const file = ref({ ...fileInitialState })

    const {
      perPage,
      respResult,
      currentPage,
      tableColumns2,
      totalRecords,
      fetchAccounts,
      deleteAccount,
      perPageOptions,
      customersAccounts,
    } = useAccounts()

    const formPhoneInitialState = {
      phone_number: [
        {
          id: 1,
          type: 'Mobile',
          value: '',
        },
      ],
    }


    const serverParams = ref({
      columnFilters: {},
      page: currentPage,
      perPage,
    })

    const fetchAccountRefresh = () => {
      fetchAccounts(serverParams.value)
    }

    const updateParams = newProps => {
      serverParams.value = { ...serverParams.value, ...newProps }
    }

    const onPageChange = params => {
      updateParams({ page: params.currentPage })
      fetchAccounts(serverParams.value)
    }

    const onPerPageChange = params => {
      updateParams({ perPage: params.currentPerPage })
      fetchAccounts(serverParams.value)
    }

    const onColumnFilter = params => {
      updateParams(params)
      fetchAccounts(serverParams.value)
    }

    const { busy, storeCustomer } = useCustomers()

    const isBillingActive = ref(false)
    const citiesFilteredObjects = ref([])
    const billingCitiesFilteredObjects = ref([])
    const formData = ref({ ...formInitialState })
    const phone = ref({ ...formPhoneInitialState })

    const showBilling = item => {
      isBillingActive.value = item
    }

    const addPhoneNumber = id => {
      phone.value.phone_number.push({ id, type: 'Mobile', value: '' })
    }
    const removePhoneNumber = id => {
      phone.value.phone_number = phone.value.phone_number.filter(
        obj => obj.id !== id,
      )
    }

    const filterCities = state => {
      citiesFilteredObjects.value = citiesOptions.filter(
        obj => obj.state_name === state,
      )
    }

    const filterBillingCities = state => {
      billingCitiesFilteredObjects.value = citiesOptions.filter(
        obj => obj.state_name === state,
      )
    }

    return {
      required,
      email,
      integer,
      min,
      busy,
      phone,
      formData,
      utility,
      file,
      titles,
      industries,
      businessTypes,
      showBilling,
      filterCities,
      onColumnFilter,
      citiesOptions,
      perPage,
      onPageChange,
      onPerPageChange,
      respResult,
      currentPage,
      tableColumns2,
      totalRecords,
      fetchAccounts,
      deleteAccount,
      fetchAccountRefresh,
      perPageOptions,
      customersAccounts,
      statesOptions,
      addPhoneNumber,
      isBillingActive,
      removePhoneNumber,
      filterBillingCities,
      citiesFilteredObjects,
      billingCitiesFilteredObjects,
    }
  },
}
</script>
<style lang="scss">
@import '@core/scss/vue/libs/vue-wizard.scss';
.vgt-table th{
  font-size: 11px !important;
}
</style>

<style lang="scss" scoped>
.checkout-form-wizard ::v-deep {
  .wizard-tab-content {
    box-shadow: none !important;
    background: transparent !important;
    padding: 0;
  }
}

</style>
