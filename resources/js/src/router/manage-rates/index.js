
const routes = [
  {
    path: 'manage-rates',
    name: 'manage-rates',
    component: () => import('@/views/manage-rates/Index.vue'),
    meta: {
      pageTitle: 'Manage Rates',
      layout: 'vertical',
      auth: true,
      resource: 'all',
      action: 'manage-rates-view',
      breadcrumb: [
        {
          text: 'Manage Rates',
          active: true,
        },
      ],
    },
  },

]

export default routes

