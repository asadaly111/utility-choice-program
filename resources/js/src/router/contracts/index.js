
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
    path: 'contracts/customer/:id?',
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
    path: 'contracts/customer-accounts/:id',
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
    path: 'contracts/generate/:id',
    name: 'contract-generate',
    component: () => import('@/views/contracts/GenerateContract.vue'),
    meta: {
      pageTitle: 'Contracts',
      resource: 'all',
      action: 'contracts-view',
      auth: true,
      breadcrumb: [
        {
          text: 'Customer Details',
          active: true,
        },
      ],
    },
  },
]

export default routes
