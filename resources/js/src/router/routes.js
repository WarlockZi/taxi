import Login from '../pages/Login.vue'
import Users from '../pages/Users.vue'

const routes = [
  {
    component: Login,
    path: '/',
    name:'login'
  },
  {
    component: Users,
    path: '/users',
    name:'users',
    meta: {
      requiresAuth: true
    }
  },

]

export default routes;