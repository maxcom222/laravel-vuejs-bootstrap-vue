function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  { path: '/', name: 'posts', component: page('posts.vue') },

  { path: '/users', name: 'users', component: page('users/users.vue') },
  { path: '/users/create', name: 'create_user', component: page('users/create.vue') },
  { path: '/users/edit', name: 'edit_user', component: page('users/edit.vue') },

  { path: '/login', name: 'login', component: page('auth/login.vue') },

  { path: '*', component: page('errors/404.vue') }
]
