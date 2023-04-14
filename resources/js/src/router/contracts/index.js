
const routes = [

  {
    path: 'contracts',
    name: 'contracts',
    component: () => import('@/views/contracts/Index.vue'),
    meta: {
      pageTitle: 'Contracts',
      resource: 'all',
      action: 'contracts-view',
      auth: true,
      breadcrumb: [
        {
          text: 'Contracts Rates',
          active: true,
        },
      ],
    },
  },
  {
    path: 'contracts/create',
    name: 'create-contract',
    component: () => import('@/views/contracts/CreateContract.vue'),
    meta: {
      pageTitle: 'Contracts',
      resource: 'all',
      action: 'contracts-view',
      auth: true,
      breadcrumb: [
        {
          text: 'Contracts Rates',
          active: true,
        },
        {
          text: 'Create Contract',
          active: true,
        },
      ],
    },
  },
]

export default routes
