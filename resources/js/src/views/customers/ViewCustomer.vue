<template>
    <div class="row customer-data-row">
        <div class="col-md-4 col-lg-3 col-xl-2 d-flex flex-column">
            <p class="text-center">
                <strong>Customer Info #</strong>
                5455646
            </p>
            <p class="text-center">
                <strong>Agency</strong><br />
                Utility Choice Program
            </p>
            <p class="text-center">
                <strong>Agent</strong><br />
                Corey Harbin
            </p>
            <vue-perfect-scrollbar
                :settings="perfectScrollbarSettings"
                class="bg-white customer-data-scroll col p-2"
            >
                <validation-observer
                    #default="{ handleSubmit }"
                    ref="refFormObserver"
                >
                    <b-form ref="form" @submit.prevent="handleSubmit(onSubmit)">
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
                                <small class="text-danger">{{
                                    errors[0]
                                }}</small>
                            </validation-provider>
                        </b-form-group>
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
                                <small class="text-danger">{{
                                    errors[0]
                                }}</small>
                            </validation-provider>
                        </b-form-group>
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
                                <small class="text-danger">{{
                                    errors[0]
                                }}</small>
                            </validation-provider>
                        </b-form-group>
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
                                <small class="text-danger">{{
                                    errors[0]
                                }}</small>
                            </validation-provider>
                        </b-form-group>
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
                                <small class="text-danger">{{
                                    errors[0]
                                }}</small>
                            </validation-provider>
                        </b-form-group>
                        <b-form-group
                            v-for="(phoneNum, index) in phone.phone_number"
                            :key="index"
                            label="Phone Number"
                        >
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
                                            :state="
                                                errors.length > 0 ? false : null
                                            "
                                            placeholder="Phone Number"
                                        />
                                        <button
                                            v-if="index == 0"
                                            type="button"
                                            class="btn btn-sm btn-form-action btn-primary"
                                            @click.prevent="
                                                addPhoneNumber(
                                                    phone.phone_number[
                                                        phone.phone_number
                                                            .length - 1
                                                    ].id + 1
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
                                            @click.prevent="
                                                removePhoneNumber(phoneNum.id)
                                            "
                                        >
                                            <feather-icon
                                                icon="XIcon"
                                                size="16"
                                            />
                                        </button>
                                    </div>
                                    <small class="text-danger">{{
                                        errors[0]
                                    }}</small>
                                </validation-provider>
                            </b-input-group>
                            <!-- </validation-provider> -->
                        </b-form-group>
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
                                <small class="text-danger">{{
                                    errors[0]
                                }}</small>
                            </validation-provider>
                        </b-form-group>
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
                                <small class="text-danger">{{
                                    errors[0]
                                }}</small>
                            </validation-provider>
                        </b-form-group>
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
                                <small class="text-danger">{{
                                    errors[0]
                                }}</small>
                            </validation-provider>
                        </b-form-group>
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
                                <small class="text-danger">{{
                                    errors[0]
                                }}</small>
                            </validation-provider>
                        </b-form-group>
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
                                <small class="text-danger">{{
                                    errors[0]
                                }}</small>
                            </validation-provider>
                        </b-form-group>
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
                                        You will be required to upload a state
                                        Tax Exemption document
                                    </p></b-form-checkbox
                                >
                                <small class="text-danger">{{
                                    errors[0]
                                }}</small>
                            </validation-provider>
                        </b-form-group>
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
                        <b-form-group label="Address 2">
                            <validation-provider
                                #default="{ errors }"
                                rules="required"
                                name="Address 2"
                            >
                                <b-form-input
                                    v-model="formData.address2"
                                    :state="errors.length > 0 ? false : null"
                                    placeholder="Address 2"
                                />
                                <small class="text-danger">{{
                                    errors[0]
                                }}</small>
                            </validation-provider>
                        </b-form-group>
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
                                <small class="text-danger">{{
                                    errors[0]
                                }}</small>
                            </validation-provider>
                        </b-form-group>
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
                                <small class="text-danger">{{
                                    errors[0]
                                }}</small>
                            </validation-provider>
                        </b-form-group>
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
                                <small class="text-danger">{{
                                    errors[0]
                                }}</small>
                            </validation-provider>
                        </b-form-group>
                        <b-form-group label="Billing Address">
                            <b-form-checkbox
                                @input="showBilling"
                                v-model="formData.billing_address_option"
                                placeholder="Billing Address"
                                value="1"
                                ><p>
                                    Check if billing address different than
                                    business address
                                </p></b-form-checkbox
                            >
                        </b-form-group>
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
                                <small class="text-danger">{{
                                    errors[0]
                                }}</small>
                            </validation-provider>
                        </b-form-group>
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
                                <small class="text-danger">{{
                                    errors[0]
                                }}</small>
                            </validation-provider>
                        </b-form-group>
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
                                <small class="text-danger">{{
                                    errors[0]
                                }}</small>
                            </validation-provider>
                        </b-form-group>
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
                                <small class="text-danger">{{
                                    errors[0]
                                }}</small>
                            </validation-provider>
                        </b-form-group>

                        <!-- Form Actions -->
                        <div class="d-flex mt-2 m-2 justify-content-end">
                            <b-button
                                type="button"
                                size="sm"
                                class="mr-2"
                                variant="outline-secondary"
                                @click="
                                    $emit(
                                        'update:is-add-customer-active',
                                        false
                                    )
                                "
                            >
                                Cancel
                            </b-button>
                            <b-button variant="primary" type="submit">
                                Save
                            </b-button>
                        </div>
                    </b-form>
                </validation-observer>
            </vue-perfect-scrollbar>
        </div>
        <div class="col-md-8 col-lg-9 col-xl-10">
            <b-tabs pills>
                <template #tabs-end>
                    <b-button
                        variant="primary"
                        @click="isAddAccountActive = !isAddAccountActive"
                    >
                        <feather-icon icon="PlusIcon"></feather-icon>
                        Add New Account
                    </b-button>
                </template>
                <b-tab title="Accounts">
                    <vue-good-table
                        mode="remote"
                        max-height="80vh"
                        :columns="tableColumns"
                        :rows="customerDummy"
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
                            perPage: 20,
                            position: 'top',
                            perPageDropdown: [10, 20, 30],
                            dropdownAllowAll: false,
                            setCurrentPage: 1,
                            nextLabel: 'Next',
                            prevLabel: 'Prev',
                            rowsPerPageLabel: 'Rows per page',
                            ofLabel: 'of',
                            pageLabel: 'page', // for 'pages' mode
                            allLabel: 'All',
                        }"
                    >
                        <template slot="table-row" slot-scope="props">
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
                                ></feather-icon>
                            </div>
                            <div v-else-if="props.column.field == 'loa'">
                                <feather-icon
                                    icon="FolderPlusIcon"
                                    size="18"
                                    class="align-middle text-body"
                                ></feather-icon>
                            </div>
                            <div v-else-if="props.column.field == 'lor'">
                                <feather-icon
                                    icon="FolderPlusIcon"
                                    size="18"
                                    class="align-middle text-body"
                                ></feather-icon>
                            </div>
                            <div v-else-if="props.column.field == 'tax_exempt'">
                                <feather-icon
                                    icon="FolderPlusIcon"
                                    size="18"
                                    class="align-middle text-body"
                                ></feather-icon>
                            </div>
                            <div v-else-if="props.column.field == 'misc'">
                                <feather-icon
                                    icon="FolderPlusIcon"
                                    size="18"
                                    class="align-middle text-body"
                                ></feather-icon>
                            </div>
                            <div v-else-if="props.column.field == 'notes'">
                                <feather-icon
                                    icon="FolderIcon"
                                    size="18"
                                    class="align-middle text-body"
                                ></feather-icon>
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
                                        ></feather-icon>
                                        <span class="align-middle ml-50"
                                            >History</span
                                        >
                                    </b-dropdown-item>
                                    <b-dropdown-item
                                        @click="editCustomerRow(props.row)"
                                    >
                                        <feather-icon icon="EditIcon" />
                                        <span class="align-middle ml-50"
                                            >Edit</span
                                        >
                                    </b-dropdown-item>
                                    <b-dropdown-item
                                        @click="confirmDelete(props.row.id)"
                                    >
                                        <feather-icon icon="TrashIcon" />
                                        <span class="align-middle ml-50"
                                            >Delete</span
                                        >
                                    </b-dropdown-item>
                                </b-dropdown>
                            </div>
                            <span v-else>
                                {{ props.formattedRow[props.column.field] }}
                            </span>
                        </template>
                    </vue-good-table>
                </b-tab>
                <b-tab title="Quotes"></b-tab>
                <b-tab title="Proposals"></b-tab>
            </b-tabs>
        </div>
        <AddAccount :isAddAccountActive.sync="isAddAccountActive"></AddAccount>
    </div>
</template>

<script>
import { ref } from "@vue/composition-api";
import { ValidationProvider, ValidationObserver } from "vee-validate";
import { VueGoodTable } from "vue-good-table";
import "vue-good-table/dist/vue-good-table.css";
import "vue-select/dist/vue-select.css";
import { VueSelect } from "vue-select";
import "vue-good-table/dist/vue-good-table.css";
import useCustomers from "@/composables/customers";
import statesOptions from "@core/data/states.json";
import citiesOptions from "@core/data/cities.json";
import { required, email, integer, min } from "@validations";
import VuePerfectScrollbar from "vue-perfect-scrollbar";
import AddAccount from "./AddAccount.vue";
import {
    BRow,
    BCol,
    BForm,
    BModal,
    VBModal,
    BButton,
    BTabs,
    BTab,
    BFormFile,
    BFormGroup,
    BFormInput,
    BDropdown,
    BDropdownItem,
    BFormSelect,
    BInputGroup,
    BFormCheckbox,
    BInputGroupPrepend,
} from "bootstrap-vue";

export default {
    data() {
        return {
            required,
            email,
            integer,
            min,
            titles: ["Owner", "Principal", "Partner", "Vice President", "CEO"],
            businessTypes: [
                "Corporation",
                "Limited Liability Company",
                "Partnership",
                "Individual",
            ],
            industries: [
                "Real Estate",
                "Information",
                "Arts",
                "Entertainment",
                "Construction",
                "Corporate Management",
                "Education Services",
                "Agriculture",
                "Other",
                "Government",
                "Finance",
                "Energy",
                "Healthcare",
                "Hospitality",
                "Manufacturing",
                "Retail Trade",
                "Wholesale Trade",
            ],
            perfectScrollbarSettings: {
                maxScrollbarLength: 60,
                wheelPropagation: false,
            },
            isAddAccountActive: false,
        };
    },
    setup(props, { emit }) {
        const formInitialState = {
            document: null,
            first_name: "",
            last_name: "",
            title: "",
            email: "",
            business_name: "",
            doing_business_as: "",
            business_type: "",
            ein: "",
            industry: "",
            tax_exempt: "",
            address1: "",
            address2: "",
            state: "",
            city: "",
            zip: "",
            billing_address_option: "",
            billing_address: "",
            billing_state: "",
            billing_city: "",
            billing_zip: "",
        };

        const formPhoneInitialState = {
            phone_number: [
                {
                    id: 1,
                    type: "Mobile",
                    value: "",
                },
            ],
        };

        const { busy, respResult, storeCustomer } = useCustomers();

        const isBillingActive = ref(false);
        const citiesFilteredObjects = ref([]);
        const billingCitiesFilteredObjects = ref([]);
        const formData = ref({ ...formInitialState });
        const phone = ref({ ...formPhoneInitialState });

        const showBilling = (item) => {
            isBillingActive.value = item;
        };

        const addPhoneNumber = (id) => {
            phone.value.phone_number.push({ id, type: "Mobile", value: "" });
        };
        const removePhoneNumber = (id) => {
            phone.value.phone_number = phone.value.phone_number.filter(
                (obj) => obj.id !== id
            );
        };

        const filterCities = (state) => {
            citiesFilteredObjects.value = citiesOptions.filter(
                (obj) => obj.state_name === state
            );
        };

        const filterBillingCities = (state) => {
            billingCitiesFilteredObjects.value = citiesOptions.filter(
                (obj) => obj.state_name === state
            );
        };

        const resetform = () => {
            formData.value = JSON.parse(JSON.stringify(formInitialState));
            phone.value.phone_number = JSON.parse(
                JSON.stringify(formPhoneInitialState)
            );
        };

        const updateParams = (newProps) => {
            serverParams.value = { ...serverParams.value, ...newProps };
        };

        const onPageChange = (params) => {
            updateParams({ page: params.currentPage });
            fetchCustomers(serverParams.value);
        };

        const onPerPageChange = (params) => {
            updateParams({ perPage: params.currentPerPage });
            fetchCustomers(serverParams.value);
        };

        const onColumnFilter = (params) => {
            updateParams(params);
            fetchCustomers(serverParams.value);
        };

        const onSubmit = async () => {
            const data = new FormData();
            data.append("document", formData.value.document);
            data.append("first_name", formData.value.first_name);
            data.append("last_name", formData.value.last_name);
            data.append("title", formData.value.title);
            data.append("email", formData.value.email);
            data.append("business_name", formData.value.business_name);
            data.append("doing_business_as", formData.value.doing_business_as);
            data.append("business_type", formData.value.business_type);
            data.append("ein", formData.value.ein);
            data.append("industry", formData.value.industry);
            data.append("tax_exempt", formData.value.tax_exempt);
            data.append("address1", formData.value.address1);
            data.append("address2", formData.value.address2);
            data.append("state", formData.value.state);
            data.append("city", formData.value.city);
            data.append("zip", formData.value.zip);
            data.append(
                "billing_address_option",
                formData.value.billing_address_option
            );
            data.append("billing_address", formData.value.billing_address);
            data.append("billing_state", formData.value.billing_state);
            data.append("billing_city", formData.value.billing_city);
            data.append("billing_zip", formData.value.billing_zip);

            for (
                let index = 0;
                index < phone.value.phone_number.length;
                index++
            ) {
                data.append(
                    `phone[${index}][id]`,
                    phone.value.phone_number[index].id
                );
                data.append(
                    `phone[${index}][type]`,
                    phone.value.phone_number[index].type
                );
                data.append(
                    `phone[${index}][value]`,
                    phone.value.phone_number[index].value
                );
            }

            await storeCustomer(data);
            if (respResult.value.status === 200) {
                emit("update:is-add-customer-active", false);
                emit("refetch-data");
                resetform();
            }
        };

        const tableColumns = [
            {
                label: "ID",
                field: "id",
                width: "50px",
                filterOptions: {
                    enabled: true,
                    filterValue: "",
                },
                tdClass: "align-middle",
            },
            {
                label: "E/G",
                field: "eg",
                width: "50px",
                filterOptions: {
                    enabled: true,
                    filterValue: "",
                },
                tdClass: "align-middle",
            },
            {
                label: "State",
                field: "state",
                width: "120px",
                filterOptions: {
                    enabled: true,
                    filterValue: "",
                },
                tdClass: "align-middle",
            },
            {
                label: "Utility",
                field: "utility",
                width: "120px",
                filterOptions: {
                    enabled: true,
                    filterValue: "",
                },
                tdClass: "align-middle",
            },
            {
                label: "Account Number",
                field: "account_number",
                width: "160px",
                filterOptions: {
                    enabled: true,
                    filterValue: "",
                },
                tdClass: "align-middle",
            },
            {
                label: "Service Agreement",
                field: "service_agreement",
                width: "150px",
                tdClass: "align-middle",
            },
            {
                label: "Zone",
                field: "zone",
                width: "70px",
                filterOptions: {
                    enabled: true,
                    filterValue: "",
                },
                tdClass: "align-middle",
            },
            {
                label: "Rate Class",
                field: "rate_class",
                width: "120px",
                filterOptions: {
                    enabled: true,
                    filterValue: "",
                    filterDropdownItems: [
                        "Corporation",
                        "Limited Liability Company",
                        "Partnership",
                        "Individual",
                    ],
                },
                tdClass: "align-middle",
            },
            {
                label: "Sub Type",
                field: "sub_type",
                width: "100px",
                filterOptions: {
                    enabled: true,
                    filterValue: "",
                },
                tdClass: "align-middle",
            },
            {
                label: "Annual Vol.",
                field: "annual_vol",
                width: "120px",
                filterOptions: {
                    enabled: true,
                    filterValue: "",
                    filterDropdownItems: [
                        "Real Estate",
                        "Information",
                        "Arts",
                        "Entertainment",
                        "Construction",
                        "Corporate Management",
                        "Education Services",
                        "Agriculture",
                        "Other",
                        "Government",
                        "Finance",
                        "Energy",
                        "Healthcare",
                        "Hospitality",
                        "Manufacturing",
                        "Retail Trade",
                        "Wholesale Trade",
                    ],
                },
                tdClass: "align-middle",
            },
            {
                label: "Current Rate",
                field: "current_rate",
                width: "150px",
                filterOptions: {
                    enabled: true,
                    filterValue: "",
                    filterDropdownItems: ["Yes", "No"],
                },
                tdClass: "align-middle",
            },
            {
                label: "End Rate",
                field: "end_rate",
                width: "100px",
                filterOptions: {
                    enabled: true,
                    filterValue: "",
                },
                tdClass: "align-middle",
            },
            {
                label: "Status",
                field: "status",
                width: "100px",
                filterOptions: {
                    enabled: true,
                    filterValue: "",
                },
                tdClass: "align-middle",
            },
            {
                label: "Address 1",
                field: "address1",
                width: "150px",
                filterOptions: {
                    enabled: true,
                    filterValue: "",
                },
                tdClass: "align-middle",
            },
            {
                label: "Address 2",
                field: "address2",
                width: "150px",
                filterOptions: {
                    enabled: true,
                    filterValue: "",
                },
                tdClass: "align-middle",
            },
            {
                label: "City",
                field: "city",
                width: "100px",
                filterOptions: {
                    enabled: true,
                    filterValue: "",
                },
                tdClass: "align-middle",
            },
            {
                label: "Zip",
                field: "zip",
                width: "60px",
                filterOptions: {
                    enabled: true,
                    filterValue: "",
                },
                tdClass: "align-middle",
            },
            {
                label: "Bill",
                field: "bill",
                width: "80px",
                tdClass: "align-middle",
            },
            {
                label: "LOR",
                field: "lor",
                width: "80px",
                tdClass: "align-middle",
            },
            {
                label: "LOA",
                field: "loa",
                width: "80px",
                tdClass: "align-middle",
            },
            {
                label: "Misc",
                field: "misc",
                width: "80px",
                tdClass: "align-middle",
            },
            {
                label: "Tax Exempt",
                field: "tax_exempt",
                width: "100px",
            },
            {
                label: "Notes",
                field: "notes",
                width: "80px",
                filterOptions: {
                    enabled: true,
                    filterValue: "",
                },
            },
            {
                label: "Actions",
                field: "actions",
                width: "150px",
                tdClass: "align-middle",
            },
        ];

        const customerDummy = [
            {
                id: 1,
                first_name: "John",
                last_name: "Doe",
                email: "johndoe@example.com",
                phone: "+1 555-555-5555",
                business_name: "ABC Company",
                doing_business_as: "ABC Co.",
                business_type: "Corporation",
                ein: "12-3456789",
                industry: "Technology",
                tax_exempt: false,
                address1: "123 Main St",
                address2: "Suite 100",
                state: "CA",
                city: "San Francisco",
                billing_address: "123 Billing St",
                billing_state: "CA",
                billing_city: "San Francisco",
                billing_zip: "94111",
                agency: "XYZ Agency",
                agent: "Jane Smith",
            },
        ];

        return {
            busy,
            phone,
            formData,
            tableColumns,
            customerDummy,
            onSubmit,
            showBilling,
            filterCities,
            citiesOptions,
            statesOptions,
            addPhoneNumber,
            isBillingActive,
            removePhoneNumber,
            filterBillingCities,
            citiesFilteredObjects,
            billingCitiesFilteredObjects,
        };
    },
    directives: {
        "b-modal": VBModal,
    },
    components: {
        ValidationProvider,
        ValidationObserver,
        BInputGroupPrepend,
        AddAccount,
        BFormCheckbox,
        BInputGroup,
        BFormSelect,
        BDropdown,
        BFormInput,
        BFormGroup,
        VueSelect,
        BFormFile,
        BDropdownItem,
        VueGoodTable,
        BButton,
        BModal,
        BForm,
        BCol,
        BRow,
        BTabs,
        BTab,
        VuePerfectScrollbar,
    },
};
</script>
<style lang="scss">
.customer-data-row {
    height: calc(100vh - 120px);
}
.customer-data-scroll {
}

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
