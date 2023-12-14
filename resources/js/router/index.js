import { createRouter, createWebHistory } from 'vue-router'
//page
import Home from '../components/pages/Home.vue'
//login
import Login from '../components/pages/Auth/Login.vue'
//forgot
import Forgot from '../components/pages/Auth/Forgot.vue'
//Reset password
import ResetPassword from '../components/pages/Auth/ResetPassword.vue'
//Reset password success
import ResetPasswordSuccess from '../components/pages/Auth/ResetPasswordSuccess.vue'

import AdminList from '../components/pages/AdminList/AdminList.vue'
import SupportCountry from '../components/pages/AdminList/SupportCountry/Index.vue'
import ProductComponent from '../components/pages/AdminList/Product/Index.vue'
import SupportCountryList from '../components/pages/AdminList/SupportCountry/List.vue'
import ProductList from '../components/pages/AdminList/Product/ProductList.vue'
import ProductDetail from '../components/pages/AdminList/Product/ProductDetail.vue'
import SupportCountryDetail from '../components/pages/AdminList/SupportCountry/Detail.vue'

//SupportCountryGroup
import SupportCountryGroup from '../components/pages/AdminList/SupportCountryGroup/Index.vue'
import SupportCountryGroupList from '../components/pages/AdminList/SupportCountryGroup/List.vue'
import SupportCountryGroupDetail from '../components/pages/AdminList/SupportCountryGroup/Detail.vue'

//Terminal
import Terminal from '../components/pages/AdminList/Terminal/Index.vue'
import TerminalList from '../components/pages/AdminList/Terminal/List.vue'
import TerminalDetail from '../components/pages/AdminList/Terminal/Detail.vue'

//Place
import Place from '../components/pages/AdminList/Place/Index.vue'
import PlaceList from '../components/pages/AdminList/Place/List.vue'
import PlaceDetail from '../components/pages/AdminList/Place/Detail.vue'

//Option Plan
import OptionPlan from '../components/pages/AdminList/OptionPlan/Index.vue'
import OptionPlanList from '../components/pages/AdminList/OptionPlan/List.vue'
import OptionPlanDetail from '../components/pages/AdminList/OptionPlan/Detail.vue'

// Option
import OptionComponent from '../components/pages/AdminList/Option/Index.vue'
import OptionList from '../components/pages/AdminList/Option/OptionList.vue'
import OptionDetail from '../components/pages/AdminList/Option/OptionDetail.vue'
import OptionFrominList from '../components/pages/AdminList/OptionFromin/OptionFrominList.vue'
import OptionFrominDetail from '../components/pages/AdminList/OptionFromin/OptionFrominDetail.vue'

//notfound
import notFound from '../components/notfound.vue'
import store from '../store'

let initAuthStore = false;

const routes = [
    {
        path: '/',
        component: Home,
        name: "home",
        meta: { layout: 'default' }
    },
    {
        path: '/login',
        component: Login,
        name: "login",
        meta: {
            layout: 'login',
            middleware: "guest",
            title: "VMDB日本"
        }
    },
    {
        path: '/forgot',
        component: Forgot,
        name: "forgot",
        meta: {
            layout: 'login',
            middleware: "guest",
            title: "パスワード再設定 | VMDB日本"
        }
    },
    {
        path: '/reset_password',
        component: ResetPassword,
        name: "reset_password",
        meta: {
            layout: 'login',
            middleware: "guest",
            title: "VMDB日本"
        }
    },
    {
        path: '/reset_password_success',
        component: ResetPasswordSuccess,
        name: "reset_password_success",
        meta: {
            layout: 'login',
            middleware: "guest",
            title: "VMDB日本"
        }
    },  
    {
        path: '/page_404',
        component: notFound,
        name: "page_404",
        meta: {
            title: "404"
        }
    },  
    {
        path: '/admin_list',
        component: AdminList,
        name: "admin_list",
        meta: {
            title: "担当者一覧 | VMDB日本"
        },
        children: [
            {
                path: '/',
                name: "admin_list",
                component: AdminList,
                title: "担当者一覧 | VMDB日本"
            },
            {
                path: "/support_country_list",
                name: "support_country",
                component: SupportCountry,
                title: "対応国一覧 | VMDB日本",
                children:[
                    {
                        path: "",
                        name: "support_country_list",
                        component: SupportCountryList,
                        meta: {
                            title: "対応国一覧 | VMDB日本",
                        }
                    },
                    {
                        path:"/support_country_detail/:id",
                        name:"support_country_detail",
                        component: SupportCountryDetail,
                        meta : {
                            title: "対応国詳細 | VMDB日本",
                        }
                    }
                ]
            },
            {
                path: "/support_country_group_list",
                name: "support_country_group",
                component: SupportCountryGroup,
                title: "周遊国一覧 | VMDB日本",
                children:[
                    {
                        path: "",
                        name: "support_country_group_list",
                        component: SupportCountryGroupList,
                        meta: {
                            title: "周遊国一覧 | VMDB日本",
                        }
                    },
                    {
                        path:"/support_country_group_detail/:id",
                        name:"support_country_group_detail",
                        component: SupportCountryGroupDetail,
                        meta : {
                            title: "周遊国詳細 | VMDB日本",
                        }
                    }
                ]
            },
            {
                path: "/product_list",
                name: "product",
                component: ProductComponent,
                title: "対応国一覧 | VMDB日本",
                children:[
                    {
                        path: "",
                        name: "product_list",
                        component: ProductList,
                        meta: {
                            title: "商材管理 | VMDB日本",
                        }
                    },
                    {
                        path:"/product_detail/:id",
                        name:"product_detail",
                        component: ProductDetail,
                        meta : {
                            title: "対応国詳細 | VMDB日本",
                        }
                    }
                ]
            },
            {
                path: "/terminal_list",
                name: "terminal",
                component: Terminal,
                title: "端末管理 | VMDB日本",
                children:[
                    {
                        path: "",
                        name: "terminal_list",
                        component: TerminalList,
                        meta: {
                            title: "端末基本情報一覧 | VMDB日本",
                        }
                    },
                    {
                        path: "/terminal_detail/:id",
                        name: "terminal_detail",
                        component: TerminalDetail,
                        meta: {
                            title: "端末基本情報詳細 | VMDB日本",
                        }
                    }
                ]
            },
            {
                path: "/place_list",
                name: "place",
                component: Place,
                title: "場所一覧 | VMDB日本",
                children:[
                    {
                        path: "",
                        name: "place_list",
                        component: PlaceList,
                        meta: {
                            title: "場所一覧 | VMDB日本",
                        }
                    },
                    {
                        path: "/place_detail/:id",
                        name: "place_detail",
                        component: PlaceDetail,
                        meta: {
                            title: "場所詳細 | VMDB日本",
                        }
                    }
                ]
            },
            {
                path: "/option_plan_list",
                name: "option_plan",
                component: OptionPlan,
                title: "オプションプラン一覧 | VMDB日本",
                children:[
                    {
                        path: "",
                        name: "option_plan_list",
                        component: OptionPlanList,
                        meta: {
                            title: "オプションプラン一覧 | VMDB日本",
                        }
                    },
                    {
                        path: "/option_plan_detail/:id",
                        name: "option_plan_detail",
                        component: OptionPlanDetail,
                        meta: {
                            title: "オプションプラン詳細 | VMDB日本",
                        }
                    }
                ]
            },
            {
                path: "/option_list",
                name: "option",
                component: OptionComponent,
                title: "オプション管理 | VMDB日本",
                children: [
                    {
                        path: "",
                        name: "option_list",
                        component: OptionList,
                        meta: {
                            title: "オプション一覧 | VMDB日本",
                        }
                    },
                    {
                        path: "/option_detail/:id",
                        name: "option_detail",
                        component: OptionDetail,
                        meta: {
                            title: "オプションプラン詳細 | VMDB日本",
                        }
                    }
                ]
            },
            {
                path: "/option_from_list",
                name: "option_from",
                component: OptionComponent,
                title: "オプション管理 | VMDB日本",
                children: [
                    {
                        path: "",
                        name: "option_from_list",
                        component: OptionFrominList,
                        meta: {
                            title: "オプション一覧 | VMDB日本",
                        }
                    },
                    {
                        path: "/option_from_detail/:id",
                        name: "option_from_detail",
                        component: OptionFrominDetail,
                        meta: {
                            title: "オプション長期詳細 | VMDB日本",
                        }
                    }
                ]
            },
            
        ],
    }, 

    {
        path: '/:pathMatch(.*)*',
        name: "not-found",
        component: notFound
    }

]

const router = createRouter({
    history: createWebHistory(import.meta.env.VITE_BASE_PATH),
    routes
})



router.beforeEach((to, from, next) => {
    document.title = to.meta.title || "VMDB日本"
    const handleRoute = (to) => {
        if (to.meta.middleware == "guest") {
            if (store.state.auth.authenticated) {
                next({ name: "home" })
            }
            next()
        } else {
            
            if (store.state.auth.authenticated) {
                if(store.state.auth.user.menu.indexOf(to.name) == -1){
                    next({ name: "home" })
                    return
                }
                next()
            } else {
                next({ name: "login" })
            }
        }
    }
    if (!initAuthStore) {
        store.dispatch('auth/login').then((res) => {
            handleRoute(to);
        });
        initAuthStore = true;
    } else {
        handleRoute(to);
    }

})



export default router