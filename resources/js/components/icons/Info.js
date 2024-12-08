import { cn } from "../../utils/common.js";

/**
 * The info icon component
 * 
 * @param {Components.Icons.IconProps} props
 */
export default function Info({ id = "", className = "", type = "outlined" }) {
    const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    svg.setAttribute("xmlns", "http://www.w3.org/2000/svg");
    svg.setAttribute("viewBox", "0 0 24 24");
    svg.setAttribute("class", cn(
        `size-6`, className
    ));
    svg.setAttribute("id", id);

    const path = document.createElementNS("http://www.w3.org/2000/svg", "path");

    if (type === "outlined") {
        svg.setAttribute("fill", "none");
        svg.setAttribute("stroke-width", "1.5");
        svg.setAttribute("stroke", "currentColor");
        
        path.setAttribute("stroke-linecap", "round");
        path.setAttribute("stroke-linejoin", "round");
        path.setAttribute(
            "d",
            "m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"
        );
    } else if (type === "solid") {
        svg.setAttribute("fill", "currentColor");
        svg.removeAttribute("stroke-width");
        svg.removeAttribute("stroke");

        path.setAttribute(
            "d",
            "M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
        );
    }

    svg.appendChild(path);
    return svg;
}