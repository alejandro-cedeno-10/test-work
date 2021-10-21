import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from './pages/Home'
import Test1Resultados from './pages/Test1Resultados'
import Test1 from './pages/Test1'
import Test2 from "./pages/Test2";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/test1',
            name: 'test1',
            component: Test1
        },
        {
            path: '/test2',
            name: 'test2',
            component: Test2
        },
        {
            path: '/test1-resultados',
            name: 'test1-resultados',
            component: Test1Resultados
        },
        {
            path: '*',
            name: '',
            component: Home
        }
    ]
});

export default router;
