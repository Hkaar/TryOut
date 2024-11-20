import axios from "axios";
import toastr from "toastr";

import { uuid } from "../../utils/common.js";
import { examAPIRoute } from "../../variables.js";
import { updateQuestionBox } from "../../utils/exam.js";

/**
 * The question top bar of the container
 * 
 * @param {number} questionNumber 
 * @param {number} questionId
 * @param {Questions.questionData} questionData  
 */
export default function QuestionTopBar(questionNumber, questionId, questionData) {
    const root = document.createElement("div");
    root.className = "rounded-t-lg bg-tertiary px-4 py-3 text-white line-clamp-1 flex items-center justify-between gap-2";

    const titleElement = document.createElement("h3");
    titleElement.className = "text-xl font-bold line-clamp-1";

    titleElement.textContent = `Soal ${questionNumber}`;

    const checkBoxContainer = document.createElement("div");
    checkBoxContainer.classList.add("flex");

    const checkbox = document.createElement('input');
    checkbox.type = 'checkbox';
    checkbox.className = 'dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800 mt-0.5 shrink-0 rounded border-gray-200 text-blue-600 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50';
    checkbox.id = `status-${uuid()}`;
    checkbox.checked = questionData.not_sure === 1 ? true : false;

    const label = document.createElement('label');
    label.htmlFor = `status-${uuid()}`;
    label.className = 'text-sm ms-3';
    label.textContent = 'Ragu';

    checkbox.addEventListener("change", () => {
        triggerCheckBox(checkbox, questionId);
    });

    checkbox.addEventListener("click", () => {
        if (checkbox.checked) {
            updateQuestionBox(questionData.id, "indertiminate");
        } else {
            updateQuestionBox(questionData.id, "prev");
        }
    })

    checkBoxContainer.appendChild(checkbox);
    checkBoxContainer.appendChild(label);

    root.appendChild(titleElement);
    root.appendChild(checkBoxContainer);

    return root;
}

/**
 * Trigger the checkbox event
 * 
 * @param {HTMLInputElement} parent 
 * @param {number} questionId 
 */
async function triggerCheckBox(parent, questionId) {
    const response = await axios.put(`${examAPIRoute}/${examResult}/pertanyaan/${questionId}/not-sure`, {}, {
        headers: {
            'X-CSRF-TOKEN': csrf, 
        }
    });

    switch (response.status) {
        case 200:
            toastr.success("Berhasil merubah status ragu soal", "Status", {
                timeOut: 3000,
                progressBar: true,
            });
            break;

        case 400|500:
            toastr.error("Gagal merubah status ragu soal", "Status", {
                timeOut: 3000,
                progressBar: true,
            });

            parent.checked = !parent.checked;
            break;

        default:
            console.warn(`Encountered unexpected status code from response ${response.status}\nData : ${response.data}`);
            break;
    }
}