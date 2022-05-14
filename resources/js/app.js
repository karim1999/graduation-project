import React from 'react'
import { createRoot } from 'react-dom/client';
import { InertiaProgress } from '@inertiajs/progress'
import { createInertiaApp } from '@inertiajs/inertia-react'

InertiaProgress.init()
createInertiaApp({
    resolve: name => import(`./Pages/${name}`),
    setup({ el, App, props }) {
        const root = createRoot(el);
        root.render(<App {...props} />);
    },
})
