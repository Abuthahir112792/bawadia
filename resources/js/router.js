import Vue from 'vue'
import Router from 'vue-router'
import dashboard from './components/dashboard/Home.vue'
import user from './components/dashboard/user/Home.vue'
import branch from './components/dashboard/branch/Home.vue'
import setting from './components/dashboard/setting/Home.vue'
import product from './components/dashboard/product/Home.vue'
import order from './components/dashboard/order/Home.vue'
import page from './components/dashboard/page/Home.vue'
import voucher from './components/dashboard/voucher/Home.vue'
import report from './components/dashboard/report/Home.vue'
import tablebooking from './components/dashboard/tablebooking/Home.vue'
import messbooking from './components/dashboard/messbooking/Home.vue'


import userList from './components/dashboard/user/userlist.vue'
import driverMap from './components/dashboard/user/driverMap.vue'
import overview from './components/dashboard/dashboard/overview.vue'
import customerlist from './components/dashboard/user/customerlist.vue'
import branchList from './components/dashboard/branch/branchlist.vue'
import profile from './components/dashboard/setting/profile.vue'
import shopsetting from './components/dashboard/setting/shop.vue'
import contactuslist from './components/dashboard/setting/ContactUs.vue'
import categorylist from './components/dashboard/product/category.vue'
import subcategorylist from './components/dashboard/product/subcaregory.vue'
import grouplist from './components/dashboard/product/group.vue'
import productAdd from './components/dashboard/product/add.vue'
import products from './components/dashboard/product/productlist.vue'
import productEdit from './components/dashboard/product/edit.vue'
import orderlist from './components/dashboard/order/orderlist.vue'
import pendinglist from './components/dashboard/order/pendinglist.vue'
import orderadd from './components/dashboard/order/add.vue'
import orderedit from './components/dashboard/order/edit.vue'
import orderstatus from './components/dashboard/order/orderstatus.vue'
import review from './components/dashboard/order/review.vue'
import aboutus from './components/dashboard/page/about.vue'
import privacy from './components/dashboard/page/privacy.vue'
import tnc from './components/dashboard/page/tnc.vue'
import voucherlist from './components/dashboard/voucher/voucherlist.vue'
import voucheradd from './components/dashboard/voucher/voucheradd.vue'
import cuisine from './components/dashboard/product/cuisine.vue'
import tag from './components/dashboard/product/tag.vue'
import ingredient from './components/dashboard/product/ingredient.vue'
import ingredientcategory from './components/dashboard/product/ingredientcategory.vue'
import deliveryagent from './components/dashboard/user/deliveryagent.vue'
import reportorder from './components/dashboard/report/order.vue'
import reportearning from './components/dashboard/report/earning.vue'
import reportcommission from './components/dashboard/report/commission.vue'
import reportactivitylog from './components/dashboard/report/activitylog.vue'
import booktable from './components/dashboard/tablebooking/booktable.vue'
import bookmess from './components/dashboard/messbooking/bookmess.vue'
import banner from './components/dashboard/banner/bannerlist.vue'
import couponList from './components/dashboard/coupon/couponList.vue'


import i18n from './i18n';
let onlyAdmin = [1]
let onlyStaff = [1, 2]
let onlyGuest = [1, 2, 4]

Vue.use(Router)
export default new Router({
    mode: 'history',
    routes: [

        {
            path: '/',
            name: 'home',
            component: overview,
            meta: {
                title: i18n.t('message.leftbar.dashboard'),
                type: onlyStaff,
                status: false,
                icon: 'dashboard',
            },

        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: overview,
            meta: {
                title: i18n.t('message.leftbar.dashboard'),
                type: onlyStaff,
                status: true,
                icon: 'dashboard',
            },
            children: [
                {
                    path: 'overview',
                    name: 'overview',
                    component: overview,
                    meta: {
                        title: i18n.t('message.leftbar.overview'),
                        type: onlyStaff,
                        status: true,
                        icon: 'dashboard',
                    },
        
                },
            ]

        },
        {
            path: '/dashboard/product',
            component: product,
            meta: {
                title: i18n.t('message.leftbar.product'),
                type: onlyStaff,
                status: true,
                icon: 'chrome_reader_mode',
            },
            children: [
            {
                path: 'add',
                component: productAdd,
                meta: {
                    title: i18n.t('message.product.add'),
                    type: onlyAdmin,
                    status: true,
                    icon: 'dashboard',
                }
            },
            {
                path: 'edit/:id',
                component: productEdit,
                meta: {
                    title: 'Edit Product',
                    type: onlyAdmin,
                    status: false,
                    icon: 'dashboard',
                }
            },
            {
                path: 'list',
                component: products,
                meta: {
                    title: i18n.t('message.product.list'),
                    type: onlyStaff,
                    status: true,
                    icon: 'dashboard',
                }
            },
            {
                path: 'category',
                component: categorylist,
                meta: {
                    title: i18n.t('message.category.titlelist'),
                    type: onlyAdmin,
                    status: true,
                    icon: 'dashboard',
                }
            },
            {
                path: 'subcategory',
                component: subcategorylist,
                meta: {
                    title: i18n.t('message.subcategory.titlelist'),
                    type: onlyAdmin,
                    status: true,
                    icon: 'dashboard',
                }
            },
            {
                path: 'cuisine',
                component: cuisine,
                meta: {
                    title: i18n.t('message.product.cuisinelist'),
                    type: onlyAdmin,
                    status: false,
                    icon: 'dashboard',
                }
            },
            {
                path: 'tag',
                component: tag,
                meta: {
                    title: i18n.t('message.product.taglist'),
                    type: onlyAdmin,
                    status: true,
                    icon: 'dashboard',
                }
            },
            {
                path: 'ingredient',
                component: ingredient,
                meta: {
                    title: i18n.t('message.product.ingredientlist'),
                    type: onlyAdmin,
                    status: true,
                    icon: 'dashboard',
                }
            },
            {
                path: 'ingredientcategory',
                component: ingredientcategory,
                meta: {
                    title: i18n.t('message.product.ingredientcategorylist'),
                    type: onlyAdmin,
                    status: true,
                    icon: 'dashboard',
                }

                
            },
            {
                path: 'group',
                component: grouplist,
                meta: {
                    title: i18n.t('message.product.grouplist'), 
                    type: onlyAdmin,
                    status: false,
                    icon: 'dashboard',
                }

                
            },
           ]

        },
        {
            path: '/dashboard/order',
            component: order,
            meta: {
                title: i18n.t('message.leftbar.order'),
                type: onlyStaff,
                status: true,
                icon: 'all_inbox',
            },
            children: [
            {
                path: 'pendinglist',
                component: pendinglist,
                meta: {
                    title: i18n.t('message.order.pending'),
                    type: onlyStaff,
                    status: true,
                    icon: 'dashboard',
                }
            },
            {
                path: 'list',
                component: orderlist,
                meta: {
                    title: i18n.t('message.order.list'),
                    type: onlyStaff,
                    status: true,
                    icon: 'dashboard',
                }
            },

            {
                path: 'add',
                component: orderadd,
                meta: {
                    title: i18n.t('message.order.add'),
                    type: onlyStaff,
                    status: true,
                    icon: 'dashboard',
                }
            },
            {
                path: 'edit/:id',
                component: orderedit,
                meta: {
                    title: i18n.t('message.order.edit'),
                    type: onlyStaff,
                    status: false,
                    icon: 'dashboard',
                }
            },
            {
                path: 'status',
                component: orderstatus,
                meta: {
                    title: i18n.t('message.order.orderstatus'),
                    type: onlyAdmin,
                    status: true,
                    icon: 'dashboard',
                }
            },
            {
                path: 'review',
                component: review,
                meta: {
                    title: i18n.t('message.order.review'),
                    type: onlyAdmin,
                    status: false,
                    icon: 'dashboard',
                }
            }
            ]

        },
        {
            path: '/dashboard/user',
            component: user,
            meta: {
                title: i18n.t('message.leftbar.user'),
                type: onlyAdmin,
                status: true,
                icon: 'face',
            },
            children: [{
                path: 'list',
                component: userList,
                meta: {
                    title: i18n.t('message.leftbar.userlist'),
                    type: onlyAdmin,
                    status: true,
                    icon: 'dashboard',
                }
            },
            {

                path: 'customers',
                component: customerlist,
                meta: {
                    title: i18n.t('message.leftbar.customerlist'),
                    type: onlyAdmin,
                    status: true,
                    icon: 'dashboard',
                }
            },
            {

                path: 'deliveryagent',
                component: deliveryagent,
                meta: {
                    title: i18n.t('message.user.deliveryagent'),
                    type: onlyAdmin,
                    status: true,
                    icon: 'dashboard',
                }
            },
            {

                path: 'driverMap',
                component: driverMap,
                meta: {
                    title: i18n.t('message.user.driverMap'),
                    type: onlyAdmin,
                    status: true,
                    icon: 'map',
                }
            },
            ]
        },
        {
            path: '/dashboard/page',
            component: page,
            meta: {
                title: i18n.t('message.leftbar.page'),
                type: onlyAdmin,
                status: true,
                icon: 'web',
            },
            children: [
                {
                    path: 'banner',
                    component: banner,
                    meta: {
                        title: i18n.t('message.page.banner'),
                        type: onlyAdmin,
                        status: true,
                        icon: 'dashboard',
                    }
                },
                {
                    path: 'aboutus',
                    component: aboutus,
                    meta: {
                        title: i18n.t('message.page.about'),
                        type: onlyAdmin,
                        status: true,
                        icon: 'dashboard',
                    }
                },
                {
                    path: 'privacy',
                    component: privacy,
                    meta: {
                        title: i18n.t('message.page.privacy'),
                        type: onlyAdmin,
                        status: true,
                        icon: 'dashboard',
                    }
                },
                
                {
                    path: 'tnc',
                    component: tnc,
                    meta: {
                        title: i18n.t('message.page.termsandcondition'),
                        type: onlyAdmin,
                        status: true,
                        icon: 'dashboard',
                    }
                },

            ]

        },
        
        {
            path: '/dashboard/voucher',
            component: voucher,
            meta: {
                title: i18n.t('message.leftbar.voucher'),
                type: onlyAdmin,
                status: false,
                icon: 'money',
            },
            children: [{
                path: 'list',
                component: voucherlist,
                meta: {
                    title: i18n.t('message.voucher.list'),
                    type: onlyStaff,
                    status: true,
                    icon: 'dashboard',
                }
            },
            {
                path: 'add',
                component: voucheradd,
                meta: {
                    title: i18n.t('message.voucher.add'),
                    type: onlyAdmin,
                    status: true,
                    icon: 'dashboard',
                }
            },

            ]

        },
        {
            path: '/dashboard/report',
            component: report,
            meta: {
                title: i18n.t('message.leftbar.report'),
                type: onlyStaff,
                status: true,
                icon: 'featured_play_list',
            },
            children: [{
                path: 'order',
                component: reportorder,
                meta: {
                    title: i18n.t('message.report.order'),
                    type: onlyStaff,
                    status: true,
                    icon: 'dashboard',
                }
            },
            {
                path: 'earning',
                component: reportearning,
                meta: {
                    title: i18n.t('message.report.earning'),
                    type: onlyStaff,
                    status: true,
                    icon: 'dashboard',
                }
            },
            {
                path: 'commission',
                component: reportcommission,
                meta: {
                    title: i18n.t('message.report.commission'),
                    type: onlyStaff,
                    status: true,
                    icon: 'dashboard',
                }
            },
            {
                path: 'activitylog',
                component: reportactivitylog,
                meta: {
                    title: i18n.t('message.report.activitylog'),
                    type: onlyStaff,
                    status: false,
                    icon: 'dashboard',
                }
            },

            ]

        },
        {
            path: '/dashboard/tablebooking',
            component: tablebooking,
            meta: {
                title: i18n.t('message.leftbar.tablebooking'),
                type: onlyStaff,
                status: false,
                icon: 'all_inbox',
            },
            children: [{
                path: 'booktable',
                component: booktable,
                meta: {
                    title: i18n.t('message.tablebooking.booktable'),
                    type: onlyStaff,
                    status: true,
                    icon: 'dashboard',
                }
            },
            ]

        },
        {
            path: '/dashboard/messbooking',
            component: messbooking,
            meta: {
                title: i18n.t('message.leftbar.messbooking'),
                type: onlyStaff,
                status: false,
                icon: 'all_inbox',
            },
            children: [{
                path: 'bookmess',
                component: bookmess,
                meta: {
                    title: i18n.t('message.messbooking.bookmess'),
                    type: onlyStaff,
                    status: true,
                    icon: 'dashboard',
                }
            },
            ]

        },
        
        {
            path: '/dashboard/setting',
            component: setting,
            meta: {
                title: i18n.t('message.leftbar.setting'),
                type: onlyStaff,
                status: true,
                icon: 'brightness_high',
            },
            children: [{
                path: 'profile',
                component: profile,
                meta: {
                    title: i18n.t('message.leftbar.profile'),
                    type: onlyStaff,
                    status: true,
                    icon: 'dashboard',
                }
            },
            {
                path: 'shop',
                component: shopsetting,
                meta: {
                    title: i18n.t('message.leftbar.shop'),
                    type: onlyAdmin,
                    status: true,
                    icon: 'dashboard',
                }
            },
            {
                path: 'branchlist',
                component: branchList,
                meta: {
                    title: i18n.t('message.leftbar.branch'),
                    type: onlyAdmin,
                    status: true,
                    icon: 'dashboard',
                }
            },
            {
                path: 'contactus',
                component: contactuslist,
                meta: {
                    title: i18n.t('message.leftbar.conatctus'),
                    type: onlyAdmin,
                    status: true,
                    icon: 'dashboard',
                }
            },
            {
                path: 'coupon',
                component: couponList,
                meta: {
                    title: i18n.t('message.leftbar.coupon'),
                    type: onlyAdmin,
                    status: true,
                    icon: 'dashboard',
                }
            },
            ]

        },

    ]
})