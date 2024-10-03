import axios from "axios";
import toastr from "toastr";

import { examAPIRoute } from "../../variables.js";
import { uuid } from "../../utils.js";

/**
 * The question part of the exam ui
 * 
 * @param {number} questionNumber 
 * @param {number} questionId
 * @param {Questions.questionData} questionData  
 */
export default function Question(questionNumber, questionId, questionData) {
    const root = document.createElement("div");
    root.classList.add("flex", "flex-col", "gap-6");

    const questionContent = document.createElement("p");
    questionContent.textContent = questionData.content ? questionData.content : 'NULL';

    const choices = document.createElement("div");
    choices.classList.add("space-y-3");

    if (questionData.type === 'multiple_choice') {
        questionData.choices.forEach(choice => {
            const container = document.createElement('div');
            container.className = 'flex';

            const radioInput = document.createElement('input');
            radioInput.type = 'radio';
            radioInput.name = 'answer';
            radioInput.value = choice.content;
            radioInput.className = 'shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800';
            radioInput.id = `choice-${uuid()}`;
            radioInput.checked = questionData.answer === choice.content ? true : false;

            const label = document.createElement('label');
            label.htmlFor = radioInput.id;
            label.className = 'text-sm text-gray-500 ms-2 dark:text-neutral-400';
            label.textContent = choice.content;

            container.appendChild(radioInput);
            container.appendChild(label);
            
            choices.appendChild(container);
        });
    } else {
        const container = document.createElement("div");
        container.classList.add("w-full", "space-y-3");

        const answerTextArea = document.createElement("textarea");
        answerTextArea.classList.add("answerBox", "py-3", "px-4", "block", "w-full", "border-gray-200", "rounded-lg", "text-sm", "focus:border-blue-500", "focus:ring-blue-500", "disabled:opacity-50", "disabled:pointer-events-none", "dark:bg-neutral-900", "dark:border-neutral-700", "dark:text-neutral-400", "dark:placeholder-neutral-500", "dark:focus:ring-neutral-600");
        answerTextArea.rows = 3;
        answerTextArea.name = "answer";
        answerTextArea.placeholder = "Masukkan jawaban ...";
        answerTextArea.textContent = questionData.answer ? questionData.answer : '';

        container.appendChild(answerTextArea);
        choices.appendChild(container);
    }

    root.appendChild(TopBar(`Soal ${questionNumber}`, questionId, questionData));
    root.appendChild(questionContent);
    root.appendChild(choices);

    return root;
}

/**
 * Top bar of the question
 * 
 * @param {string} title 
 * @param {number} questionId 
 * @param {Questions.questionData} questionData 
 */
function TopBar(title, questionId, questionData) {
    const topBar = document.createElement("div");
    topBar.classList.add("flex", "items-center", "justify-between");

    const questionTitle = document.createElement("h6");
    questionTitle.classList.add("text-xl", "font-semibold");
    questionTitle.textContent = title;

    const checkBoxContainer = document.createElement("div");
    checkBoxContainer.classList.add("flex");

    const checkbox = document.createElement('input');
    checkbox.type = 'checkbox';
    checkbox.className = 'shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800';
    checkbox.id = `status-${uuid()}`;
    checkbox.checked = questionData.not_sure === 1 ? true : false;

    const label = document.createElement('label');
    label.htmlFor = `status-${uuid()}`;
    label.className = 'text-sm text-gray-500 ms-3 dark:text-neutral-400';
    label.textContent = 'Ragu-ragu';

    checkbox.addEventListener("change", () => {
        triggerCheckBox(checkbox, questionId);

        const questionBox = document.querySelector(`[question-id="${questionId}"]`);

        if (questionBox !== null) {
            checkbox.checked 
                ? questionBox.classList.add("bg-caution") 
                : questionBox.classList.remove("bg-caution");
        }
    });

    checkBoxContainer.appendChild(checkbox);
    checkBoxContainer.appendChild(label);

    topBar.appendChild(questionTitle);
    topBar.appendChild(checkBoxContainer);

    return topBar;
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

        default:
            console.warn(`Encountered unexpected status code from response ${response.status}\nData : ${response.data}`);
            break;
    }
}