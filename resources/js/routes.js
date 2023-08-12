import {createRouter, createWebHistory} from 'vue-router';

const routes = [
    { path: '/', name: 'home.page', component:() => import ('./components/User/HomeComponent.vue') },
    { path: '/login', name: 'login.page', component:() => import ('./components/User/LoginComponent.vue') },
    { path: '/register', name: 'register.page', component:() => import ('./components/User/SingInComponent.vue') },
    { path: '/:catchAll(.*)', name: '404.page', component:() => import ('./components/NotFound.vue') },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to, from, next) => {
    const accessToken = localStorage.getItem('access_token');

    if (to.name !== 'login.page') {
        if (!accessToken) {
            try {
                return next();
            } catch (error) {
                return next({ name: 'login.page' });
            }
        }
    }

    if ((to.name === 'login.page' || to.name === 'register.page') && accessToken) {
        return next({ name: 'home.page' });
    }

    next();
});
export default router;
