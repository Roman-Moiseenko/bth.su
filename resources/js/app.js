import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { createPinia } from 'pinia'
import { ZiggyVue } from 'ziggy-js'
import * as ElementPlusIconsVue from '@element-plus/icons-vue'
import 'dayjs/locale/ru';
import Layout from './Components/Layout.vue'
//import ElementPlus from 'element-plus'///
import 'element-plus/dist/index.css'
import '../css/app.css';

const pinia = createPinia();

createInertiaApp({
    title: title => import.meta.env.VITE_APP_NAME + ` - ${title}`,
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', {eager: true})
        let page = pages[`./Pages/${name}.vue`]
        page.default.layout = page.default.layout || Layout
//        if (name !== 'Admin/Auth/Login' && name !== 'Base/404') page.default.layout = page.default.layout || Layout
        return page
    },
    setup({el, App, props, plugin}) {
        const app = createApp({render: () => h(App, props)})
            .use(plugin)
            .use(pinia)
            .use(ZiggyVue)
//            .use(ElementPlus);
        for (const [key, component] of Object.entries(ElementPlusIconsVue)) {
            app.component(key, component)
        }
        app.mount(el)

    },
}).then()
