export default [

  {
    title: 'Dashboard',
    route: 'dashboard',
    icon: 'HomeIcon',
    action: 'dashboard-view',
    resource: 'all',
  },
  {
    title: 'Customers',
    route: 'orders',
    icon: 'TrelloIcon',
    action: 'orders-view',
    resource: 'all',
  },
  {
    title: 'Invoices',
    route: 'invoices',
    icon: 'TrelloIcon',
    action: 'invoices-view',
    resource: 'all',
  },
  {
    title: 'Clients',
    icon: 'UsersIcon',
    action: 'reports-view',
    resource: 'all',
    children: [
      {
        title: 'Clients',
        route: 'clients',
        action: 'clients-view',
        resource: 'all',
      },
      {
        title: 'Active',
        route: 'clients-active',
        action: 'clients-active-view',
        resource: 'all',
      },
      {
        title: 'Deactive',
        route: 'clients-archive',
        action: 'clients-archive-view',
        resource: 'all',
      },
    ],
  },

  {
    title: 'Users',
    icon: 'UsersIcon',
    action: 'users-view',
    resource: 'all',
    children: [
      {
        title: 'Users',
        route: 'users',
        action: 'users-view',
        resource: 'all',
      },
      {
        title: 'Active',
        route: 'users-active',
        action: 'users-active-view',
        resource: 'all',
      },
      {
        title: 'Deactive',
        route: 'users-deactive',
        action: 'users-deactive-view',
        resource: 'all',
      },
    ],
  },
  {
    title: 'My Profile',
    route: 'account',
    icon: 'UserIcon',
    action: 'my-profile-view',
    resource: 'all',
  },
]
