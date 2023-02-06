
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
]

export default routes
