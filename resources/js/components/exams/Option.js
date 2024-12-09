import { cn } from "../../utils/common.js";

/**
 * The option radio for multiple choice questions
 * 
 * @param {Components.Exam.OptionProps} props 
 */
export default function Option({ letter = "A", name = "", value = "", checked = false, id = "", className = "" }) {
    const root = document.createElement("label");
    root.className = cn(
        `relative block cursor-pointer p-2 pl-5`,
        className,
    );

    const radio = document.createElement("input");
    radio.type = "radio";
    radio.id = id;
    radio.name = name;
    radio.value = value;
    radio.checked = checked;
    radio.className = "peer hidden";

    const radioLetter = document.createElement("span");
    radioLetter.textContent = letter;
    radioLetter.className = `absolute left-1 top-1/2 flex size-4 -translate-y-1/2 
    items-center justify-center rounded-full border border-gray-300 text-xs 
    transition-all duration-200 peer-checked:border-accent peer-checked:bg-accent
    peer-checked:text-white p-3 shadow-md shadow-gray-200`;

    root.appendChild(radio);
    root.appendChild(radioLetter);

    return {root, radio};
}