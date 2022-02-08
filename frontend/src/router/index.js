import { createRouter, createWebHistory } from "vue-router";
import { watch, ref } from "vue";
import gsap from "@/assets/js/gsap.js";
import { sDur, msDur } from "@/assets/js/animation-duration";
import store from '@/store';
import axios from 'axios';

const Main = () => import('@/views/Main');
const Portfolio = () => import('@/views/Portfolio');
const Project = () => import('@/views/Project');
const Equipment = () => import('@/views/Equipment');
const Monitoring = () => import('@/views/Monitoring');
const NotFound = () => import('@/views/NotFound');

const routes = [
  { 
    path: '/', 
    name: 'main',
    component: Main,
  }, {
    path: '/portfolio', 
    name: 'portfolio',
    component: Portfolio
  }, {
    path: '/portfolio/:id',
    name: 'project',
    component: Project
  }, {
    path: '/equipment/',
    name: 'equipment',
    component: Equipment
  }, {
    path: '/monitoring/',
    name: 'monitoring',
    component: Monitoring
  }, {
    path: '/:pathMatch(.*)*',
    name: 'noPathMatch',
    component: NotFound
  }
]

const router = createRouter({
  routes,
  history: createWebHistory(process.env.BASE_URL),
  scrollBehavior(to, from, savedPosition) {
    return new Promise((resolve, reject) => {
      const stop = watch(
        () => store.state.transition.enterStart,
        () => {
          stop();
          
          //if (!store.state.appReady) return { top: 0 };
          if (from.path === to.path && store.state.appReady) resolve(false);

          else if (to.hash) {
            const element = document.querySelector(to.hash);
            if (!element) {
              resolve({ top: top });
            } else {
              const height = element.getBoundingClientRect().height;
              if (height < window.innerHeight) {
                const top = element.getBoundingClientRect().top - window.innerHeight / 2 + height / 2 + window.pageYOffset;
                resolve({ top: top });
              } else {
                resolve({ el: to.hash });
              }
            }
          }

          else if (to.name === 'project' && from.name === 'portfolio' && store.state.transition.projectTransition) {
            resolve({ el: '#photo' });
          } 
          
          else if (savedPosition) {
            resolve({ top: savedPosition.top });
          } 

          else {
            resolve({ top: 0 });
          }
        }
      )
    })
  }
})

let route, 
    data,
    scrollToTimeout;

const loadData = async function(path) {
  let response;
  try {
    response = await axios.get(`/backend/api${path}`);
  } catch(error) {
    response = error.response;
  }
  if (response && response.status && response.data && (response.status === 200 || response.status === 404)) {
    return response;
  } else {
    return false;
  }
}

const leaveAnimation = async function() {
  if (!store.state.appReady) return;

  if (store.state.transition.leaveStart || store.state.transition.leaveFinish) {
    return new Promise((resolve) => {
      setTimeout(resolve, 1000);
    })
  } else {

    return new Promise((resolve) => {
      //запуск анимаций выхода
      store.dispatch('transition/leave');

      const stop = watch(
        () => store.state.transition.leaveFinish,
        (value) => {
          if (value) {
            stop();
            resolve();
          }
        }
      )
    })

  }
}

router.beforeEach(async (to, from) => {
  let response;
  route = to;

  //закрыть меню
  if (store.state.navigation.active) {
    store.commit('navigation/ACTIVE', false);
  }

  //перемещение по якорям
  if (from.path === to.path && from.hash !== to.hash && store.state.appReady) {
    return true;
  }

  //редирект на 404
  if (to.name === 'notFound') {
    return true;
  }

  await Promise.all([
    loadData(to.path).then((res) => {
      response = res;
    }),
    leaveAnimation().then(() => {
      //к моменту окончания фнимации данные еще не загружены
      if (response === undefined && store.state.appReady) {
        store.commit('LOADER', true);
      }
    })
  ]);

  //проверка актуальности маршрута
  return new Promise((resolve) => {
    if (route === to && response) { 
      data = response.data;
      if (response.status === 404) {
        router.addRoute({ path: to.fullPath, name: 'notFound', component: NotFound });
        resolve({ name: 'notFound', replace: true });
      } else {
        resolve(true);
      }
    }
  });
})

router.afterEach(async (to, from, failure) => {
  if (failure) return;

  //перемещение по якорям
  if (from.path === to.path && from.hash !== to.hash && store.state.appReady) {
    if (!to.hash) return;
    const element = document.querySelector(to.hash);
    if (!element) return;
    if (scrollToTimeout) clearTimeout(scrollToTimeout);

    scrollToTimeout = setTimeout(() => {
      const height = element.getBoundingClientRect().height;
      if (height < window.innerHeight) {
        const y = element.getBoundingClientRect().top - window.innerHeight / 2 + height / 2 + window.pageYOffset;
        gsap.to(window, { duration: sDur[3], scrollTo: { y: y, autoKill: true }});
      } else {
        gsap.to(window, { duration: sDur[3], scrollTo: { y: to.hash, autoKill: true }});
      }
    }, msDur[3]);

    return;
  }

  else {
    store.commit('route/KEY', store.state.route.key + 1);
    store.commit('route/FROM', from);
    store.commit('route/DATA', data);

    if (store.state.loader) {
      store.commit('LOADER', false);
    }

    if (to.name === 'notFound') {
      router.removeRoute('notFound');
    }

    //meta update
    const title = store.state.route.data.title;
    if (title) document.title = title;
  }
})


export default router;