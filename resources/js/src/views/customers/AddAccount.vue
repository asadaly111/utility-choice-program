<template>
    <b-modal
        id="addNewCustomerAccount"
        cancel-variant="outline-secondary"
        size="lg"
        centered
        :hide-footer="true"
        title="Export"
        @close="$emit('update:is-add-account-active', false)"
        :visible="isAddAccountActive"
        @hide="$emit('update:is-add-account-active', false)"
    >
        <validation-observer #default="{ handleSubmit }" ref="refFormObserver">
            <b-form ref="form" @submit.prevent="handleSubmit(onSubmit)">
                <b-row>
                    <b-col md="6" lg="4">
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
                    </b-col>

                    <b-col cols="12" md="6" lg="4">
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

                    <b-col cols="12" md="6" lg="4">
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

                    <b-col cols="12" md="6" lg="4">
                        <b-form-group label="Commodity">
                            <validation-provider
                                #default="{ errors }"
                                rules="required"
                                name="Commodity"
                            >
                                <b-form-select
                                    :options="[
                                        {
                                            value: 'electricity',
                                            text: 'Electricity',
                                        },
                                        {
                                            value: 'gas',
                                            text: 'Gas',
                                        },
                                    ]"
                                    v-model="formData.commodity"
                                    :state="errors.length > 0 ? false : null"
                                >
                                </b-form-select>
                                <small class="text-danger">{{
                                    errors[0]
                                }}</small>
                            </validation-provider>
                        </b-form-group>
                    </b-col>

                    <b-col cols="12" md="6" lg="4">
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

                    <b-col cols="12" md="6" lg="4">
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
                    </b-col>

                    <b-col cols="12" md="6" lg="4">
                        <b-form-group label="Rate Class">
                            <validation-provider
                                #default="{ errors }"
                                rules="required"
                                name="Rate Class"
                            >
                                <b-form-select
                                    :options="[
                                        {
                                            value: 'DropdownItem',
                                            text: 'DropDownItem',
                                        },
                                        {
                                            value: 'DropdownItem',
                                            text: 'DropDownItem',
                                        },
                                    ]"
                                    v-model="formData.rate_class"
                                    :state="errors.length > 0 ? false : null"
                                />
                                <small class="text-danger">{{
                                    errors[0]
                                }}</small>
                            </validation-provider>
                        </b-form-group>
                    </b-col>

                    <b-col cols="12" md="6" lg="4">
                        <b-form-group label="Rate Class">
                            <validation-provider
                                #default="{ errors }"
                                rules="required"
                                name="Rate Class"
                            >
                                <b-form-select
                                    :options="[
                                        {
                                            value: 'Under Contact',
                                            text: 'Under Contact',
                                        },
                                        {
                                            value: 'Not Under Contract',
                                            text: 'Not Under Contract',
                                        },
                                    ]"
                                    v-model="formData.rate_class"
                                    :state="errors.length > 0 ? false : null"
                                />
                                <small class="text-danger">{{
                                    errors[0]
                                }}</small>
                            </validation-provider>
                        </b-form-group>
                    </b-col>

                    <b-col cols="12" md="6" lg="4">
                        <b-form-group label="Contract End Date">
                            <validation-provider
                                #default="{ errors }"
                                rules="required"
                                name="Contract End Date"
                            >
                                <b-form-input
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

                    <b-col cols="12" md="6" lg="4">
                        <b-form-group label="State">
                            <validation-provider
                                #default="{ errors }"
                                rules="required"
                                name="State"
                            >
                                <b-form-select
                                    :options="[
                                        {
                                            value: 'Ohio',
                                            text: 'Ohio',
                                        },
                                        {
                                            value: 'California',
                                            text: 'California',
                                        },
                                    ]"
                                    v-model="formData.state"
                                    :state="errors.length > 0 ? false : null"
                                />
                                <small class="text-danger">{{
                                    errors[0]
                                }}</small>
                            </validation-provider>
                        </b-form-group>
                    </b-col>

                    <b-col cols="12" md="6" lg="4">
                        <b-form-group label="City">
                            <validation-provider
                                #default="{ errors }"
                                rules="required"
                                name="City"
                            >
                                <b-form-select
                                    :options="[
                                        {
                                            value: 'Waren',
                                            text: 'Waren',
                                        },
                                        {
                                            value: 'Adamsville',
                                            text: 'Adamsville',
                                        },
                                    ]"
                                    v-model="formData.city"
                                    :state="errors.length > 0 ? false : null"
                                />
                                <small class="text-danger">{{
                                    errors[0]
                                }}</small>
                            </validation-provider>
                        </b-form-group>
                    </b-col>

                    <b-col cols="12" md="6" lg="4">
                        <b-form-group label="Zone">
                            <validation-provider
                                #default="{ errors }"
                                rules="required"
                                name="Zone"
                            >
                                <b-form-select
                                    :options="[
                                        {
                                            value: 'Lorem Ipsum',
                                            text: 'Lorem Ipsum',
                                        },
                                        {
                                            value: 'Lorem Ipsum',
                                            text: 'Lorem Ipsum',
                                        },
                                    ]"
                                    v-model="formData.zone"
                                    :state="errors.length > 0 ? false : null"
                                />
                                <small class="text-danger">{{
                                    errors[0]
                                }}</small>
                            </validation-provider>
                        </b-form-group>
                    </b-col>

                    <b-col cols="12" md="6" lg="4">
                        <b-form-group label="Utility">
                            <validation-provider
                                #default="{ errors }"
                                rules="required"
                                name="Utility"
                            >
                                <b-form-select
                                    :options="[
                                        {
                                            value: 'Lorem Ipsum',
                                            text: 'Lorem Ipsum',
                                        },
                                        {
                                            value: 'Lorem Ipsum',
                                            text: 'Lorem Ipsum',
                                        },
                                    ]"
                                    v-model="formData.utility"
                                    :state="errors.length > 0 ? false : null"
                                />
                                <small class="text-danger">{{
                                    errors[0]
                                }}</small>
                            </validation-provider>
                        </b-form-group>
                    </b-col>

                    <b-col cols="12" md="6" lg="4">
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

                    <b-col cols="12" md="6" lg="4">
                        <b-form-group label="Notes">
                            <validation-provider
                                #default="{ errors }"
                                rules="required"
                                name="Notes"
                            >
                                <b-form-input
                                    v-model="formData.notes"
                                    :state="errors.length > 0 ? false : null"
                                    placeholder="Notes"
                                />
                                <small class="text-danger">{{
                                    errors[0]
                                }}</small>
                            </validation-provider>
                        </b-form-group>
                    </b-col>

                    <b-col cols="12" md="6" lg="4">
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

                    <b-col cols="12" md="6" lg="4">
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

                <!-- Form Actions -->
                <div class="d-flex mt-2 m-2 justify-content-end">
                    <b-button
                        type="button"
                        size="sm"
                        class="mr-2"
                        variant="outline-secondary"
                        @click="$emit('update:is-add-customer-active', false)"
                    >
                        Cancel
                    </b-button>
                    <b-button variant="primary" type="submit"> Save </b-button>
                </div>
            </b-form>
        </validation-observer>
    </b-modal>
</template>

<script>
import { ValidationProvider, ValidationObserver } from "vee-validate";
import { required, email, integer, min } from "@validations";
import {
    BRow,
    BCol,
    BForm,
    VBModal,
    BButton,
    BFormFile,
    BFormGroup,
    BFormInput,
    BFormSelect,
    BInputGroup,
    BFormCheckbox,
    BInputGroupPrepend,
} from "bootstrap-vue";
export default {
    components: {
        BRow,
        BCol,
        BForm,
        VBModal,
        BButton,
        BFormFile,
        BFormGroup,
        BFormInput,
        BFormSelect,
        BInputGroup,
        BFormCheckbox,
        BInputGroupPrepend,
        ValidationProvider,
        ValidationObserver,
    },
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
            phone: "",
            formData: {},
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
        };
    },
    props: {
        isAddAccountActive: {
            type: Boolean,
            required: true,
        },
    },
    model: {
        prop: "isAddAccountActive",
        event: "update:is-add-account-active",
    },
};
</script>

<style lang="scss">
#addNewCustomerAccount .modal-dialog {
    max-width: 1000px;
}
</style>
