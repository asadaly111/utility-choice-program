
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
          text: 'Contracts',
          active: true,
        },
      ],
    },
  },
  {
    path: 'contracts/customer',
    name: 'contract-customer',
    component: () => import('@/views/contracts/CreateCustomer.vue'),
    meta: {
      pageTitle: 'Contracts',
      resource: 'all',
      action: 'contracts-view',
      auth: true,
      breadcrumb: [
        {
          text: 'Create Customer',
          active: true,
        },
      ],
    },
  },
  {
    path: 'contracts/customer-accounts',
    name: 'contract-customer-accounts',
    component: () => import('@/views/contracts/CustomerAccounts.vue'),
    meta: {
      pageTitle: 'Contracts',
      resource: 'all',
      action: 'contracts-view',
      auth: true,
      breadcrumb: [
        {
          text: 'Customer Accounts',
          active: true,
        },
      ],
    },
  },
  {
    path: 'contracts/generate',
    name: 'contract-generate',
    component: () => import('@/views/contracts/GenerateContract.vue'),
    meta: {
      pageTitle: 'Contracts',
      resource: 'all',
      action: 'contracts-view',
      auth: true,
      breadcrumb: [
        {
          text: 'Contract Generate',
          active: true,
        },
      ],
    },
  },
]

export default routes
