import "preline/dist/toggle-password.mjs";
import "preline/dist/input-number.mjs";
import "preline/dist/collapse.mjs";
import "preline/dist/dropdown.mjs";
import "preline/dist/accordion.mjs";
import "preline/dist/overlay.mjs";

import "htmx.org";

import.meta.glob(["../images/**/*"]);

import {
    createIcons,
    Trash2,
    Edit,
    Plus,
    Info,
    CircleCheck,
    CircleX,
    CircleAlert,
    Circle,
    CalendarRange,
    Save,
    LayoutGrid,
    LayoutList,
    User,
    Users,
    ChartNoAxesCombined,
    Package,
    Text,
    List,
    ArrowRight,
    ArrowLeft,
    Settings,
    LibraryBig,
    PanelLeftClose,
    PanelLeftOpen,
    EllipsisVertical,
    House,
    LayoutPanelLeft,
    LogOut,
    History,
    CircleChevronLeft,
    CircleChevronRight,
    CircleHelp,
    Send,
    ChevronLeft,
    ChevronRight,
} from "lucide";

createIcons({
    icons: {
        Trash2,
        Edit,
        Plus,
        Info,
        CircleCheck,
        CircleX,
        CircleAlert,
        Circle,
        CalendarRange,
        Save,
        LayoutGrid,
        LayoutList,
        User,
        Users,
        ChartNoAxesCombined,
        Package,
        Text,
        List,
        ArrowRight,
        ArrowLeft,
        Settings,
        LibraryBig,
        PanelLeftClose,
        PanelLeftOpen,
        EllipsisVertical,
        House,
        LayoutPanelLeft,
        LogOut,
        History,
        CircleChevronLeft,
        CircleChevronRight,
        CircleHelp,
        Send,
        ChevronLeft,
        ChevronRight,
    },
});

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from "axios";
// @ts-ignore
window.axios = axios;

// @ts-ignore
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });
