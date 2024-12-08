import { cn } from "../../utils/common.js";

/**
 * The x mark icon
 * 
 * @param {Components.HTMLElementProps} props
 */
export default function XMark({ id = "", className = "" }) {
    const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    svg.setAttribute("xmlns", "http://www.w3.org/2000/svg");
    svg.setAttribute("viewBox", "0 0 24 24");
    svg.setAttribute("class", cn(
        `size-6`, className
    ));
    svg.setAttribute("id", id);

    const path = document.createElementNS("http://www.w3.org/2000/svg", "path");
    svg.setAttribute("fill", "none");
    svg.setAttribute("stroke-width", "1.5");
    svg.setAttribute("stroke", "currentColor");
    
    path.setAttribute("stroke-linecap", "round");
    path.setAttribute("stroke-linejoin", "round");
    path.setAttribute(
        "d",
        `M6 18 18 6M6 6l12 12`
    );

    svg.appendChild(path);
    return svg;
}