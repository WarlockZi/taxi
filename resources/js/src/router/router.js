import {createRouter, createWebHashHistory} from 'vue-router'
import routes from './routes'
const router = createRouter({
  history:createWebHashHistory(),
  routes,
})

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth) ) {
    const token = localStorage.getItem('token');
    if (token) {
      next();
      return;
    } else {
      router.push('/');
    }
  } else {
    next();
  }
});

export default router;