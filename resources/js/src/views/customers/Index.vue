<template>
    <div>
        <vue-good-table
            :columns="columns"
            :select-options="{ enabled: true, selectOnCheckboxOnly: true }"
            :rows="rows"
            max-height="80vh"
        >
            <!-- <template slot="table-header-row" slot-scope="props">
                <span v-if="props.column.field == 'actions'">
                    <button class="fancy-btn">Action</button>
                </span>
                <span v-else>
                    {{ props.formattedRow[props.column.field] }}
                </span>
            </template> -->
            <template slot="table-row" slot-scope="props">
                <!-- Column: Name -->

                <!-- Column: Action -->
                <div v-if="props.column.field === 'actions'"></div>
            </template>
        </vue-good-table>
    </div>
</template>

<script>
import "vue-good-table/dist/vue-good-table.css";
import { VueGoodTable } from "vue-good-table";
export default {
    data() {
        return {
            columns: [
                {
                    label: "ID",
                    field: "id",
                    width: "100px",
                    filterOptions: {
                        enabled: true,
                        placeholder: "ID",
                    },
                },
                {
                    label: "Name",
                    field: "name",
                    width: "200px",
                    filterOptions: {
                        enabled: true,
                        placeholder: "Name",
                    },
                },
                {
                    label: "Email",
                    field: "email",
                    width: "180px",
                    filterOptions: {
                        enabled: true,
                        placeholder: "Email",
                    },
                },
                {
                    label: "Phone",
                    field: "phone",
                    width: "180px",
                    filterOptions: {
                        enabled: true,
                        placeholder: "Phone",
                    },
                },
                {
                    label: "Business Name",
                    field: "businessname",
                    width: "200px",
                    filterOptions: {
                        enabled: true,
                        placeholder: "Select",
                        filterDropdownItems: ["Business 1", "Business 2"],
                    },
                },
                {
                    label: "Doing Business As",
                    field: "doingbusinessas",
                    width: "220px",
                    filterOptions: {
                        enabled: true,
                        placeholder: "Select",
                        filterDropdownItems: ["Seller", "Distributor"],
                    },
                },
                {
                    label: "Business Type",
                    field: "businesstype",
                    width: "200px",
                    filterOptions: {
                        enabled: true,
                        placeholder: "Business Type",
                        filterDropdownItems: [
                            "Corporation",
                            "Limited Liability Company",
                            "Partnership",
                            "Individual",
                        ],
                    },
                },
                {
                    label: "EIN",
                    field: "ein",
                    width: "150px",
                    filterOptions: {
                        enabled: true,
                        placeholder: "EIN",
                    },
                },
                {
                    label: "Industry",
                    field: "industry",
                    width: "200px",
                    filterOptions: {
                        enabled: true,
                        placeholder: "Industry",
                        filterDropdownItems: [
                            "Corporation",
                            "Limited Liability Company",
                            "Partnership",
                            "Individual",
                        ],
                    },
                },
                {
                    label: "Tax Excempt",
                    field: "taxexempt",
                    width: "200px",
                    filterOptions: {
                        enabled: true,
                        placeholder: "Tax Excempt",
                        filterDropdownItems: ["Yes", "No"],
                    },
                },
                {
                    label: "Address",
                    field: "address",
                    width: "200px",
                    filterOptions: {
                        enabled: true,
                        placeholder: "Address",
                    },
                },
                {
                    label: "City",
                    field: "city",
                    width: "150px",
                    filterOptions: {
                        enabled: true,
                        placeholder: "City",
                    },
                },
                {
                    label: "State",
                    field: "state",
                    width: "200px",
                    filterOptions: {
                        enabled: true,
                        placeholder: "State",
                        filterDropdownItems: [
                            "Ohio",
                            "Missouri",
                            "Pennsylvania",
                        ],
                    },
                },
                {
                    label: "Billing Address",
                    field: "billingaddress",
                    width: "200px",
                    filterOptions: {
                        enabled: true,
                        placeholder: "Billing Address",
                    },
                },
                {
                    label: "Billing City",
                    field: "billingcity",
                    width: "200px",
                    filterOptions: {
                        enabled: true,
                        placeholder: "Billing City",
                    },
                },
                {
                    label: "Billing State",
                    field: "billingstate",
                    width: "200px",
                    filterOptions: {
                        enabled: true,
                        placeholder: "Billing State",
                        filterDropdownItems: [
                            "South Carolina",
                            "Texas",
                            "New York",
                        ],
                    },
                },
                {
                    label: "B.Zip",
                    field: "bzip",
                    width: "200px",
                    filterOptions: {
                        enabled: true,
                        placeholder: "B.Zip",
                    },
                },
                {
                    label: "Agency",
                    field: "agency",
                    width: "200px",
                    filterOptions: {
                        enabled: true,
                        placeholder: "Agency",
                        filterDropdownItems: [
                            "Corporation",
                            "Limited Liability Company",
                            "Partnership",
                            "Individual",
                        ],
                    },
                },
                {
                    label: "Agent",
                    field: "agent",
                    width: "200px",
                    filterOptions: {
                        enabled: true,
                        placeholder: "Agent",
                        filterDropdownItems: [
                            "Robert Zane",
                            "Harvey Dentt",
                            "Sean Azfarani",
                        ],
                    },
                },
                {
                    label: "Flags",
                    field: "flags",
                    width: "100px",
                },
                {
                    label: "E/G/Q/C",
                    field: "egqc",
                    type: "date",
                    dateInputFormat: "yyyy-MM-dd",
                    dateOutputFormat: "MMM do yy",
                    width: "150px",
                },
                {
                    label: "Actions",
                    field: "actions",
                    width: "250px",
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
        };
    },
    components: {
        VueGoodTable,
    },
};
</script>
<style lang="scss">
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
    }
}
</style>
