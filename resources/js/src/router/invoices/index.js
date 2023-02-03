
const routes = [
  {
    path: 'invoices',
    name: 'invoices',
    component: () => import('@/views/invoices/Index.vue'),
    meta: {
      pageTitle: 'Invoices',
      layout: 'vertical',
      auth: true,
      resource: 'all',
      action: 'invoices-view',
      breadcrumb: [
        {
          text: 'Invoices',
          active: true,
        },
      ],
    },
  },
]

export default routes

