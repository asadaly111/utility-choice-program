
const routes = [

  {
    path: 'commercial',
    name: 'commercial',
    component: () => import('@/views/commercial/Index.vue'),
    meta: {
      pageTitle: 'Commercial Rates',
      resource: 'all',
      action: 'commercial-view',
      auth: true,
      breadcrumb: [
        {
          text: 'Commercial Rates',
          active: true,
        },
      ],
    },
  },
]

export default routes
