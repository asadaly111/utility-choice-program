
const routes = [
  {
    path: 'orders',
    name: 'orders',
    component: () => import('@/views/orders/Index.vue'),
    meta: {
      pageTitle: 'Orders',
      layout: 'vertical',
      auth: true,
      resource: 'all',
      action: 'orders-view',
      breadcrumb: [
        {
          text: 'Orders',
          active: true,
        },
      ],
    },
  },

]

export default routes

