import { cn } from "../../utils/common.js";

/**
 * The warning icon component
 * 
 * @param {Components.Icons.IconProps} props 
 */
export default function Warning({ id = "", className = "", type = "outlined" }) {
    const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    svg.setAttribute("xmlns", "http://www.w3.org/2000/svg");
    svg.setAttribute("viewBox", "0 0 24 24");
    svg.setAttribute("class", cn(
        `size-6`, className
    ));
    svg.setAttribute("id", id);

    const path = document.createElementNS("http://www.w3.org/2000/svg", "path");

    if (type === "outlined") {
        svg.setAttribute('fill', 'none');
        svg.setAttribute("stroke-width", "1.5");
        svg.setAttribute("stroke", "currentColor");

        path.setAttribute("stroke-linecap", "round");
        path.setAttribute("stroke-linejoin", "round");
        path.setAttribute(
            "d",
            `M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 
            1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z`
        );
    } else if (type === "solid") {
        svg.setAttribute("fill", "currentColor");
        svg.removeAttribute("stroke-width");
        svg.removeAttribute("stroke");

        path.setAttribute("fill-rule", "even-odd");
        path.setAttribute("clip-rule", "evenodd");
        path.setAttribute(
            "d",
            `M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 
            0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 
            0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z`
        );
    }

    svg.appendChild(path);
    return svg;
}