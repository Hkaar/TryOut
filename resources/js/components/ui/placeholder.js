import { cn } from "../../utils/common.js";

/**
 * The placeholder component for indicating a resource is not ready
 *
 * @param {{className: string}} props
 */
const Placeholder = ({ className = "" }) => {
    const root = document.createElement("div");
    root.className = cn(
        "bg-gray-400 animate-pulse h-64 w-64 rounded-xl",
        className
    );

    return root;
};

export default Placeholder;
