/**
 * An essay box element for the question create & edit page
 */
export default function EssayBox() {
    const root = document.createElement("div");
    root.classList.add("w-full", "space-y-3");

    const answerTextArea = document.createElement("textarea");
    answerTextArea.classList.add("answerBox", "py-3", "px-4", "block", "w-full", "border-gray-200", "rounded-lg", "text-sm", "focus:border-blue-500", "focus:ring-blue-500", "disabled:opacity-50", "disabled:pointer-events-none", "dark:bg-neutral-900", "dark:border-neutral-700", "dark:text-neutral-400", "dark:placeholder-neutral-500", "dark:focus:ring-neutral-600");
    answerTextArea.rows = 3;

    answerTextArea.placeholder = "Masukkan jawaban ...";

    root.appendChild(answerTextArea);

    return root;
}