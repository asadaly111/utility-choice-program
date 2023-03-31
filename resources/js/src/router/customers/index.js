
const routes = [

  {
    path: 'customers',
    name: 'customers',
    component: () => import('@/views/customers/Index.vue'),
    meta: {
      pageTitle: 'Customers',
      resource: 'all',
      action: 'customers-view',
      auth: true,
      breadcrumb: [
        {
          text: 'Customers Rates',
          active: true,
        },
      ],
    },
  },
  {
    path: 'customer/:id',
    name: 'customer',
    component: () => import('@/views/customers/ViewCustomer.vue'),
    props: route => ({ id: Number(route.params.id) }),
    meta: {
      pageTitle: 'Customers',
      resource: 'all',
      action: 'customers-view',
      auth: true,
      breadcrumb: [
        {
          text: 'Customers Rates',
          active: true,
        },
      ],
    },
  },
]

export default routes
