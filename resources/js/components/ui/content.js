import { cn } from "../../utils/common.js";

/**
 * The standard image component
 * 
 * @param {Components.Content.ImageProps} props Props for configuring the image element.
 * @returns {HTMLImageElement}
 */
function Image({ src, alt, srcset = undefined, loading = "lazy", id = "", className = "" }) {
    const root = document.createElement("img");
    root.id = id;
    root.className = cn(
        `bg-cover block`,
        className,
    );

    root.src = src;
    root.loading = loading;
    root.alt = alt;

    if (!srcset) {
        const srcsetValues = [
            `${src}?w=400 1x`,  // Small image (for small devices)
            `${src}?w=800 2x`,  // Larger image (for high-density displays)
            `${src}?w=1200 3x`  // Even larger image (for very high-density displays)
        ];
        root.srcset = srcsetValues.join(", ");
    } else {
        root.srcset = srcset;
    }

    return root;
}

export { Image };