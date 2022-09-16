import { createApp, h } from "vue";
import { createInertiaApp, Link, Head } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";

InertiaProgress.init({
    delay: 0,
    color: "#fbbf24",
    showSpinner: true,
})

createInertiaApp({
    resolve: name => require(`./Pages/${name}`),
    title: title => title ? `${title} - Unsplaravel` : 'Unsplaravel',
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el)
    },
})