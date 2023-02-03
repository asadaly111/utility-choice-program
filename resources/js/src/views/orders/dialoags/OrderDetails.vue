<template>
  <b-modal
    cancel-variant="outline-secondary"
    centered
    :hide-footer="true"
    title="Order Details"
    size="lg"
    @close="$emit('update:is-order-details-active', false)"
    :visible="isOrderDetailsActive"
    @hide="$emit('update:is-order-details-active', false)"
  >

    <b-row>
      <b-col
        sm="12"
        v-if="orderDetailsData"
      >
        <b-card-text class="m-0">
          <span class="font-weight-bolder">Created At: </span> {{ orderDetailsData.created_at }}
        </b-card-text>
        <b-card-text class="m-0">
          <span class="font-weight-bolder">Order: </span> {{ orderDetailsData.order_id }}
        </b-card-text>
        <b-card-text class="m-0">
          <span class="font-weight-bolder">By: </span> {{ orderDetailsData.user.name }}
        </b-card-text>
        <hr>
      </b-col>
      <b-col
        cols="4"
        md="4"
      >
        <p>BO File</p>
        <b-link
          :to="orderDetailsData.dstFile"
          class="font-weight-bold"
          target="_blank"
          download
        >
          <feather-icon
            icon="DownloadIcon"
            size="22"
          />
        </b-link>
      </b-col>
      <b-col
        cols="4"
        md="4"
      >
        <p>Run Sheet File</p>
        <b-link
          :to="orderDetailsData.runSheetFile"
          class="font-weight-bold"
          target="_blank"
          download
        >
          <feather-icon
            icon="DownloadIcon"
            size="22"
          />
        </b-link>
      </b-col>
      <b-col
        cols="4"
        md="4"
      >
        <p>DST File</p>
        <b-link
          :to="orderDetailsData.dstFile"
          class="font-weight-bold"
          target="_blank"
          download
        >
          <feather-icon
            icon="DownloadIcon"
            size="22"
          />
        </b-link>
      </b-col>
      <b-col
        cols="12"
        md="12"
      >
        <b-card-text class="mt-3">
          <span class="font-weight-bolder">Comments:</span>
          <p>{{ orderDetailsData.comments }}</p>
        </b-card-text>
      </b-col>
    </b-row>
  </b-modal>
</template>

<script>
import {
  BModal, BRow, BCol, BLink, BCardText,
} from 'bootstrap-vue'
import { ref, onMounted } from '@vue/composition-api'

export default {
  components: {
    BRow,
    BCol,
    BLink,
    BModal,
    BCardText,
  },
  model: {
    prop: 'isOrderDetailsActive',
    event: 'update:is-order-details-active',
  },
  props: {
    isOrderDetailsActive: {
      type: Boolean,
      required: true,
    },
    orderData: {
      type: Object,
      required: false,
      default: () => { },
    },
  },


  setup(props) {
    const orderDetailsData = ref({})
    onMounted(() => {
      if (props.isOrderDetailsActive) {
        orderDetailsData.value = props.orderData
        console.log(props.orderData)
      }
    })
    return {
      orderDetailsData,
    }
  },
}
</script>

