import { createWebHistory, createRouter } from 'vue-router'
import store from '@/store'

/* Guest Component */
const Login = () => import('@/components/Login.vue')
const Register = () => import('@/components/Register.vue')
/* Guest Component */

/* Layouts */
const DahboardLayout = () => import('@/components/layouts/Default.vue')
/* Layouts */

/* Authenticated Component */
const Dashboard = () => import('@/components/Dashboard.vue')
/* Authenticated Component */

const Ambiente = () => import('@/components/Ambiente/Ambiente.vue')
const FormAmbiente = () => import('@/components/Ambiente/Form.vue')

const FacultadOficina = () => import('@/components/FacultadOficina/FacultadOficina.vue')
const FormFacultadOficina = () => import('@/components/FacultadOficina/Form.vue')

const routes = [
    {
        name: "login",
        path: "/login",
        component: Login,
        meta: {
            middleware: "guest",
            title: `Login`
        }
    },
    {
        name: "register",
        path: "/register",
        component: Register,
        meta: {
            middleware: "guest",
            title: `Register`
        }
    },
    {
        path: "/",
        component: DahboardLayout,
        meta: {
            middleware: "auth"
        },
        children: [
            {
                name: "dashboard",
                path: '/',
                component: Dashboard,
                meta: {
                    title: `Dashboard`
                }
            },
            {
                name: "ambientes",
                path: '/ambientes',
                component: Ambiente,
                meta: {
                    title:  `Lista de Ambientes`
                }
            },
            {
                name: "ambientes/create",
                path: '/ambientes/create',
                component: FormAmbiente,
                meta: {
                    title:  `Crear Ambientes`
                }
            },
            {
                name: "editambientes",
                path: '/ambientes/:id/edit',
                component: FormAmbiente,
                meta: {
                    title: `Editar Ambientes`
                }
            },
            {
                name: "facultadOficina",
                path: '/facultadOficina',
                component: FacultadOficina,
                meta: {
                    title:  `Lista de Facultad u Oficina`
                }
            },
            {
                name: "facultadOficina/create",
                path: '/facultadOficina/create',
                component: FormFacultadOficina,
                meta: {
                    title:  `Crear Facultad u Oficina`
                }
            },
            {
                name: "editFacultadOficina",
                path: '/facultadOficina/:id/edit',
                component: FormFacultadOficina,
                meta: {
                    title: `Editar Facultad u Oficina`
                }
            }

        ]
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes, // short for `routes: routes`
})

router.beforeEach((to, from, next) => {
    document.title = to.meta.title
    if (to.meta.middleware == "guest") {
        if (store.state.auth.authenticated) {
            next({ name: "dashboard" })
        }
        next()
    } else {
        if (store.state.auth.authenticated) {
            next()
        } else {
            next({ name: "login" })
        }
    }
})

export default router
