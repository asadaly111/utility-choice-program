
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
]

export default routes
