import { cn } from "../../utils/common.js";

import { Info, Bug, Error, Success, Warning } from "../icons/index.js";
import XMark from "../icons/XMark.js";
import { Button } from "./index.js";

/**
 * The standard toast component
 *
 * @param {Components.Toasts.ToastProps} props
 * @returns {HTMLElement}
 */
function Toast({ id = "", className = "", type = "default" }) {
    const root = document.createElement("div");
    root.role = "alert";
    root.id = id;
    root.tabIndex = -1;
    root.className = cn(
        `max-w-xs border border-gray-200 rounded-xl shadow-lg 
        dark:border-neutral-700`,
        toastStyles(type),
        className
    );

    root.appendChild(closeButton(root));

    return root;
}

/**
 * The close button for the toast
 *
 * @param {Element} root
 */
function closeButton(root) {
    const closeButton = Button({
        className: `absolute top-2.5 right-3`,
    });
    closeButton.appendChild(XMark({
        className: "size-5"
    }));
    closeButton.addEventListener("click", () => {
        const parent = root.closest(".toastify");

        if (!parent) {
            console.warn("No nearest toast parent!");
            return;
        }

        const close = parent.querySelector(".toast-close");

        if (!(close instanceof HTMLButtonElement)) {
            console.warn("No nearest toast close button on parent!");
            return;
        }

        close.click();
    });

    return closeButton;
}

/**
 * Generate the default contents of the toast
 *
 * @param {"default" | "success" | "debug" | "info" | "warning" | "error"} type
 * @param {string?} text
 */
function toastContent(type = "default", text = null) {
    const container = document.createElement("div");
    container.className = "flex items-center gap-3 p-4";

    switch (type) {
        case "info":
            container.appendChild(Info({}));
            break;

        case "debug":
            container.appendChild(Bug({}));
            break;

        case "success":
            container.appendChild(Success({}));
            break;

        case "warning":
            container.appendChild(Warning({}));
            break;

        case "error":
            container.appendChild(Error({}));
            break;

        default:
            break;
    }

    if (text) {
        const content = document.createElement("span");
        content.className = "text-sm";
        content.textContent = text;

        container.appendChild(content);
    }

    return container;
}

/**
 * Get the preconfigured toast styles
 *
 * @param {"default" | "success" | "debug" | "info" | "warning" | "error"} type
 */
function toastStyles(type) {
    switch (type) {
        case "debug":
            return "bg-info text-white";

        case "info":
            return "bg-info text-white";

        case "success":
            return "bg-success text-white";

        case "warning":
            return "bg-caution";

        case "error":
            return "bg-danger text-white";

        default:
            return `text-gray-500 hover:text-gray-800 dark:text-neutral-400 
            dark:hover:text-neutral-100 bg-white dark:bg-neutral-800`;
    }
}

export { Toast, toastContent, toastStyles };
