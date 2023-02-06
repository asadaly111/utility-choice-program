<template>
    <b-form-row
        class="commercial-rates-filters align-items-center justify-content-end"
    >
        <b-col cols="12">
            <app-breadcrumb />
        </b-col>
        <b-col cols="6" sm="4" md="3" lg="2">
            <b-form-group>
                <vue-select
                    :options="zipcodes"
                    v-model="filter.zipcode"
                    placeholder="Zip Code"
                ></vue-select>
            </b-form-group>
        </b-col>
        <b-col cols="6" sm="4" md="3" lg="2">
            <b-form-group>
                <vue-select
                    :options="commodities"
                    v-model="filter.commodities"
                    placeholder="Commodity"
                ></vue-select>
            </b-form-group>
        </b-col>
        <b-col cols="6" sm="4" md="3" lg="2">
            <b-form-group>
                <vue-select
                    :options="states"
                    v-model="filter.states"
                    placeholder="States"
                ></vue-select>
            </b-form-group>
        </b-col>
        <b-col cols="6" sm="4" md="3" lg="2">
            <b-form-group>
                <vue-select
                    :options="utilities"
                    v-model="filter.utilities"
                    placeholder="Utilities"
                ></vue-select>
            </b-form-group>
        </b-col>
        <b-col cols="6" sm="4" md="3" lg="2">
            <b-form-group>
                <vue-select
                    :options="zones"
                    v-model="filter.zones"
                    placeholder="Zones"
                ></vue-select>
            </b-form-group>
        </b-col>
        <b-col cols="6" sm="4" md="3" lg="2">
            <b-form-group>
                <vue-select
                    :options="rateClasses"
                    v-model="filter.rateClasses"
                    placeholder="Rate Classes"
                ></vue-select>
            </b-form-group>
        </b-col>
        <b-col cols="6" sm="4" md="3" lg="2">
            <b-form-group>
                <vue-select
                    :options="dSizeRCode"
                    v-model="filter.dSizeRCode"
                    placeholder="D. Size / R. Code"
                ></vue-select>
            </b-form-group>
        </b-col>
        <b-col cols="6" sm="4" md="3" lg="2">
            <b-form-group>
                <b-form-input
                    type="text"
                    v-model="filter.startMonth"
                    placeholder="Start Month"
                />
            </b-form-group>
        </b-col>
        <b-col cols="6" sm="4" md="3" lg="2">
            <b-form-group>
                <b-form-input
                    type="text"
                    v-model="filter.annualVolume"
                    placeholder="Annual Volumne"
                />
            </b-form-group>
        </b-col>
        <b-col cols="6" sm="4" md="3" lg="2">
            <b-form-group>
                <vue-select
                    :options="prices"
                    v-model="filter.fixedPrice"
                    placeholder="Fixed Price"
                ></vue-select>
            </b-form-group>
        </b-col>
        <b-col cols="6" sm="4" md="3" lg="2">
            <b-form-group>
                <b-form-input
                    type="text"
                    v-model="filter.brokerFee"
                    placeholder="Broker Fee"
                />
            </b-form-group>
        </b-col>
        <b-col cols="6" sm="4" md="3" lg="2">
            <b-form-group>
                <b-form-input
                    type="text"
                    v-model="filter.currentRate"
                    placeholder="Current Rate"
                />
            </b-form-group>
        </b-col>
        <b-col cols="6" sm="4" md="3" lg="2">
            <button type="submit" class="btn btn-primary w-100">
                <feather-icon icon="SearchIcon" />
                <span class="ml-1">Start Search</span>
            </button>
        </b-col>
    </b-form-row>
</template>

<script>
import AppBreadcrumb from "@core/layouts/components/AppBreadcrumb.vue";
import { VueSelect } from "vue-select";
import "vue-select/dist/vue-select.css";
import {
    BRow,
    BCol,
    BForm,
    BFormRow,
    BFormGroup,
    BFormInput,
} from "bootstrap-vue";
import { ref } from "@vue/composition-api";
export default {
    data() {
        return {};
    },
    components: {
        BRow,
        BCol,
        BForm,
        BFormRow,
        BFormGroup,
        BFormInput,
        VueSelect,
        AppBreadcrumb,
    },
    setup() {
        const filter = ref({
            zipcode: "",
            commodities: "",
            states: "",
            utilities: "",
            zones: "",
            rateClasses: "",
            dSizeRCode: "",
            startMonth: "",
            annualVolume: "",
            fixedPrice: "",
            brokerFee: "",
            currentRate: "",
        });
        const zipcodes = ["834798", "645331", "567323", "478563"];
        const commodities = ["Option A", "Option B", "Option C", "Option D"];
        const states = ["Option A", "Option B", "Option C", "Option D"];
        const utilities = ["Option A", "Option B", "Option C", "Option D"];
        const zones = ["Option A", "Option B", "Option C", "Option D"];
        const rateClasses = ["Option A", "Option B", "Option C", "Option D"];
        const dSizeRCode = ["Option A", "Option B", "Option C", "Option D"];
        const prices = ["Option A", "Option B", "Option C", "Option D"];

        return {
            filter,
            zipcodes,
            commodities,
            states,
            utilities,
            zones,
            rateClasses,
            dSizeRCode,
            prices,
        };
    },
};
</script>
<style lang="scss">
.commercial-rates-filters {
    .form-group {
        .vs__dropdown-toggle {
            padding: 3px 0 7px;
            border: 1px solid #d8d6de;
        }
    }
}
</style>
