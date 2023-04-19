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
    route: 'customers',
    icon: 'TrelloIcon',
    action: 'customers-view',
    resource: 'all',
  },
  {
    title: 'Contracts',
    route: 'contracts',
    icon: 'TrelloIcon',
    action: 'contracts-view',
    resource: 'all',
  },
  {
    title: 'Commerical Rates',
    route: 'commercial',
    icon: 'TrelloIcon',
    action: 'commercial-view',
    resource: 'all',
  },
  {
    title: 'Users',
    header: 'Users',
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
    title: 'Manage Rates',
    route: 'manage-rates',
    icon: 'TrelloIcon',
    action: 'manage-rates-view',
    resource: 'all',
  },
]
