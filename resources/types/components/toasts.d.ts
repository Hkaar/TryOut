declare namespace Components.Toasts {
    interface ToastProps extends Components.HTMLElementProps {
        type: "default" | "success" | "debug" | "info" | "warning" | "error";
    }
}