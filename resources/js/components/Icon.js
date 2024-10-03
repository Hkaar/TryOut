/**
 * Create a icon element
 * 
 * @param {string} type 
 */
export default function Icon(type) {
    const root = document.createElement("i");
    root.classList.add("material-symbols-outlined", "font-var-light");
    root.textContent = type;

    return root;
}