import { createRouter, createWebHistory } from "vue-router";
import store from '@/store';

import Main from '@/views/Main';
import Typography from '@/views/Typography';
import Project from '@/views/Project';
import Projects from '@/views/Projects';
import NotFound from '@/views/NotFound';

const routes = [
  { 
    path: '/', 
    name: 'main',
    component: Main 
  }, {
    path: '/typography', 
    name: 'typography',
    component: Typography 
  }, {
    path: '/projects', 
    name: 'projects',
    component: Projects,
    children: [
      {
        path: ':id', 
        name: 'project',
        component: Project 
      },
    ]
  }, {
    path: '/:pathMatch(.*)*',
    name: 'notFound',
    component: NotFound
  }
]

const router = createRouter({
  routes,
  history: createWebHistory(process.env.BASE_URL)
})

router.beforeEach(async (to, from) => {
  const response = await store.dispatch('loadRouteData', to.path);
  if (response) {
    return true;
  } else {
    return {name: 'notFound'};
  }
})

export default router;