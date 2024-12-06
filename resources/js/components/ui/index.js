import { cn } from "../../utils/common.js";

/**
 * The standard button element
 *
 * @param {Components.ButtonProps} props - The properties for the button element
 * @returns {HTMLButtonElement}
 */
function Button({
    id = "",
    className = "",
    type = "button",
    disabled = false,
}) {
    const root = document.createElement("button");
    root.type = type;
    root.disabled = disabled;
    root.id = id;

    root.className = cn(
        `btn flex justify-center duration-100 ease-in-out hover:scale-105 active:scale-95 active:opacity-75 
        disabled:pointer-events-none disabled:opacity-50`,
        className
    );

    return root;
}

/**
 * The standard link button element
 *
 * @param {Components.LinkButtonProps} props - The properties for the link button element
 * @returns {HTMLAnchorElement}
 */
function LinkButton({ href, id = "", className = "" }) {
    const root = document.createElement("a");
    root.href = href;
    root.id = id;

    root.className = cn(
        `btn flex justify-center duration-100 ease-in-out hover:scale-105 active:scale-95 active:opacity-75 
        disabled:pointer-events-none disabled:opacity-50`,
        className
    );

    return root;
}

export { Button, LinkButton };
