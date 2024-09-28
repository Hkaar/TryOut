import { clearNodeTree, uuid } from "../utils.js";

import Icon from "./Icon.js";
import PhotoSVG from "./ImageAsset.js";

/**
 * A choice box element for the question create & edit page
 * 
 * @param {Element} parent 
 */
export default function ChoiceBox(parent) {
    const root = document.createElement("div");
    root.classList.add("answerBox", "flex", "flex-col", "py-2", "px-4", "rounded-md", "border-2", "shadow-sm", "gap-2");

    const answerContainer = document.createElement("div");
    answerContainer.classList.add("flex", "flex-col", "gap-2", "answerContainer");

    answerContainer.appendChild(AnswerTextBox());

    root.appendChild(TopBar(root));
    root.appendChild(answerContainer);

    return root;
}

/**
 * Top bar element of the choice box
 * 
 * @param {Element} parent 
 */
function TopBar(parent) {
    const topBar = document.createElement("div");
    topBar.classList.add("flex", "justify-between", "items-center");

    const radioContainer = document.createElement("div");
    radioContainer.classList.add("flex", "items-center");

    const radio = document.createElement("input");
    radio.classList.add("shrink-0", "mt-0.5", "border-gray-200", "rounded-full", "text-blue-600", "focus:ring-blue-500", "disabled:opacity-50", "disabled:pointer-events-none", "dark:bg-neutral-800", "dark:border-neutral-700", "dark:checked:bg-blue-500", "dark:checked:border-blue-500", "dark:focus:ring-offset-gray-800");
    radio.id = `status ${uuid()}`;
    radio.type = "radio";
    radio.name = "status";

    const radioLabel = document.createElement("label");
    radioLabel.classList.add("text-sm", "text-gray-500", "ms-2", "dark:text-neutral-400");
    radioLabel.setAttribute("for", radio.id);
    radioLabel.textContent = "Pilihan";
    
    radioContainer.appendChild(radio);
    radioContainer.appendChild(radioLabel);

    const actionContainer = document.createElement("div");
    actionContainer.classList.add("flex", "items-center", "gap-1");

    const changeToTextBtn = document.createElement("button");
    changeToTextBtn.type = "button";
    changeToTextBtn.classList.add("textChange", "bg-gray-100", "btn", "text-info", "ease-in-out", "duration-100", "hover:opacity-95", "active:opacity-50");
    changeToTextBtn.appendChild(Icon("message"));

    const changeToImageBtn = document.createElement("button");
    changeToImageBtn.type = "button";
    changeToImageBtn.classList.add("imageChange", "btn", "text-info", "ease-in-out", "duration-100", "hover:opacity-95", "active:opacity-50");
    changeToImageBtn.appendChild(Icon("image"));

    const deleteBtn = document.createElement("button");
    deleteBtn.type = "button";
    deleteBtn.classList.add("btn", "text-danger", "ease-in-out", "duration-100", "hover:opacity-95", "active:opacity-50");
    deleteBtn.appendChild(Icon("delete"));

    changeToTextBtn.addEventListener("click", () => {switchContent(parent, "text")});
    changeToImageBtn.addEventListener("click", () => {switchContent(parent, "image")});
    deleteBtn.addEventListener("click", () => {parent.parentElement?.removeChild(parent)});

    actionContainer.appendChild(changeToTextBtn);
    actionContainer.appendChild(changeToImageBtn);
    actionContainer.appendChild(deleteBtn);

    topBar.appendChild(radioContainer);
    topBar.appendChild(actionContainer);

    return topBar;
}

/**
 * Answer text box mode for the choice box
 */
function AnswerTextBox() {
    const root = document.createElement("div");
    root.classList.add("w-full", "space-y-3");

    const answerTextArea = document.createElement("textarea");
    answerTextArea.classList.add("py-3", "px-4", "block", "w-full", "border-gray-200", "rounded-lg", "text-sm", "focus:border-blue-500", "focus:ring-blue-500", "disabled:opacity-50", "disabled:pointer-events-none", "dark:bg-neutral-900", "dark:border-neutral-700", "dark:text-neutral-400", "dark:placeholder-neutral-500", "dark:focus:ring-neutral-600");
    answerTextArea.rows = 3;
    answerTextArea.placeholder = "Masukkan jawaban ...";

    root.appendChild(answerTextArea);

    return root;
}

/**
 * Answer text box mode for the choice box
 */
function AnswerImageBox() {
    const root = document.createElement("div");
    root.classList.add("flex", "flex-col", "gap-2");

    const previewContainer = document.createElement("div");
    previewContainer.classList.add("flex", "w-full", "flex-col", "gap-1", "items-center", "h-52");
    previewContainer.id = `preview-${uuid()}`;

    const subtitle = document.createElement("span");
    subtitle.classList.add("text-gray-400");
    subtitle.textContent = "Foto jawaban akan muncul disini!";

    previewContainer.appendChild(PhotoSVG());
    previewContainer.appendChild(subtitle);

    const imageInput = document.createElement("input");
    imageInput.classList.add("block", "w-full", "border", "border-gray-200", "shadow-sm", "rounded-lg", "text-sm", "focus:z-10", "focus:border-blue-500", "focus:ring-blue-500", "disabled:opacity-50", "disabled:pointer-events-none", "dark:bg-neutral-900", "dark:border-neutral-700", "dark:text-neutral-400", "file:bg-gray-50", "file:border-0", "file:me-4", "file:py-3", "file:px-4", "dark:file:bg-neutral-700", "dark:file:text-neutral-400");
    imageInput.type = "file";
    imageInput.name = `img-${uuid()}`;
    imageInput.id = imageInput.name;
    imageInput.setAttribute("preview-target", `#${previewContainer.id}`);
    imageInput.setAttribute("preview-classes", "max-w-48 object-cover");

    root.appendChild(previewContainer);
    root.appendChild(imageInput);

    return root;
}

/**
 * Switches the content mode of the choice box
 * 
 * @param {Element} element 
 * @param {string} mode 
 */
function switchContent(element, mode) {
    const container = element.querySelector(".answerContainer");

    const textChangeBtn = element.querySelector(".textChange");
    const imageChangeBtn = element.querySelector(".imageChange");

    if (container === null) {
        console.error("Anser container doesnt exist!");
        return;
    }

    switch (mode) {
        case "text":
            clearNodeTree(container);
            textChangeBtn?.classList.add("bg-gray-100");
            imageChangeBtn?.classList.remove("bg-gray-100");
            container.appendChild(AnswerTextBox());
            break;

        case "image":
            clearNodeTree(container);
            textChangeBtn?.classList.remove("bg-gray-100");
            imageChangeBtn?.classList.add("bg-gray-100");
            container.appendChild(AnswerImageBox());
            break;
    
        default:
            console.error(`Invalid mode for choice box ${mode}!`);
            break;
    }
}