import { uuid } from "../../utils/common.js";

/**
 * The question part of the exam ui
 * 
 * @param {Questions.questionData} questionData  
 */
export default function Question(questionData) {
    const root = document.createElement("div");
    root.classList.add("flex", "flex-col", "gap-6");

    const questionContent = document.createElement("p");
    questionContent.className = "text-xl font-medium";
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

    root.appendChild(questionContent);
    root.appendChild(choices);

    return root;
}