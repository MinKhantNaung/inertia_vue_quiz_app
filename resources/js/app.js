import './bootstrap';

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { createPinia } from 'pinia';

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(createPinia())
      .mount(el)
  },
  // for show progress everytime while link
  progress: {
    delay: 250,
    color: 'pink',
    includeCSS: true,
    showSpinner: true,
  }
})

// after set up inertia
// download vue -- npm install vue@next
// install vite -- npm install @vitejs/plugin-vue
