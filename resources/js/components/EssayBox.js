import { uuid } from "../utils/common.js";

import { TextArea } from "./ui/form.js";

/**
 * An essay box element for the question create & edit page
 */
export default function EssayBox() {
    const root = document.createElement("div");
    root.classList.add("w-full", "space-y-3");

    const answerTextArea = TextArea({
        name: `answerBox-${uuid()}`,
        className: "answerBox",
        placeholder: "Masukkan jawaban ...",
    });

    root.appendChild(answerTextArea);
    return root;
}