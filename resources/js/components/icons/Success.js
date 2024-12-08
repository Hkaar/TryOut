import { cn } from "../../utils/common.js";

/**
 * The success icon component
 * 
 * @param {Components.Icons.IconProps} props
 */
export default function Success({ id = "", className = "", type = "outlined" }) {
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
            "M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
        );
    } else if (type === "solid") {
        svg.setAttribute("fill", "currentColor");
        svg.removeAttribute("stroke-width");
        svg.removeAttribute("stroke");

        path.setAttribute("fill-rule", "even-odd");
        path.setAttribute("clip-rule", "evenodd");
        path.setAttribute(
            "d",
            "M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
        );
    }

    svg.appendChild(path);
    return svg;
}