import Toastify from 'toastify-js';

import { Toast, toastContent, toastStyles } from "../components/ui/toast.js";
import { cn } from './common.js';

/**
 * Show a toast notification
 * 
 * @param {"default" | "success" | "debug" | "info" | "warning" | "error"} type 
 * @param {string} text 
 * @param {number} [duration=5000] 
 */
export default function notify(type = "default", text, duration = 5000) {
    const toast = Toast({
        type: type,
    });

    toast.appendChild(toastContent(type, text));

    Toastify({
        node: toast,
        duration: duration,
        className: cn(
            `fixed -top-[150px] right-[4px] md:right-[10px] lg:right-[20px] z-[90] opacity-[87%] transition-all duration-300 w-[320px] text-sm rounded-xl shadow-lg [&>.toast-close]:hidden`,
            toastStyles(type),
        ),
        close: true,
    }).showToast();
}