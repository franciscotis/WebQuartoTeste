import Vue from 'vue'
import Router from 'vue-router'

import index from '../vue/pages/index';
import newProperty from '../vue/pages/newProperty';
import show from "../vue/pages/show";
import admin from "../vue/pages/admin";
import edit from "../vue/pages/edit";
Vue.use(Router)

const routes = [
    {
        name: 'home',
        path:'/',
        component: index
    },
    {
        name: 'create',
        path:'/create',
        component: newProperty
    },
    {
        name: 'show',
        path:'/show/:id',
        component: show,
    },
    {
        name: 'admin',
        path:'/admin',
        component: admin,
    },
    {
        name: 'edit',
        path:'/edit/:id',
        component: edit,
    },
]

const router = new Router({routes})

export default router
