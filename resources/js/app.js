import { createApp, h } from 'vue'
import {createInertiaApp, Link} from '@inertiajs/vue3'
import Layout from "./Shared/Layout.vue";
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
        let page = pages[`./Pages/${name}.vue`];
        if (page?.default?.layout === undefined) {
            page.default.layout = Layout;
        }
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ElementPlus)
            .component('Link', Link)
            .mount(el)
    },
})
