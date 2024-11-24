import { uuid } from "../../utils/common.js";
import { getQuestionBoxState, updateQuestionBox } from "../../utils/exam.js";

/**
 * The question part of the exam ui
 * 
 * @param {Questions.questionData} questionData  
 */
export default function Question(questionData) {
    const root = document.createElement("div");
    root.classList.add("flex", "flex-col", "gap-6");

    const topContent = document.createElement("div");
    topContent.className = "space-y-2 w-full";

    if (questionData.img) {
        const cover = document.createElement("img");
        cover.src = questionData.img;
        cover.alt = "Gambar tidak dapat dimuatkan";
        cover.className = "h-48 object-cover rounded-md border-gray-200 border";

        topContent.appendChild(cover);
    }

    const questionContent = document.createElement("p");
    questionContent.className = "text-xl font-medium";
    questionContent.textContent = questionData.content ? questionData.content : 'NULL';

    const choices = document.createElement("div");
    choices.classList.add("space-y-3");

    if (questionData.type === 'multiple_choice') {
        questionData.choices.forEach(choice => {
            const container = document.createElement('div');
            container.className = 'flex items-center gap-2';

            const radioInput = document.createElement('input');
            radioInput.type = 'radio';
            radioInput.name = 'answer';
            radioInput.value = choice.content;
            radioInput.className = 'shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800';
            radioInput.id = `choice-${uuid()}`;
            radioInput.checked = questionData.answer === choice.content ? true : false;

            radioInput.addEventListener("change", () => {
                if (radioInput.checked && getQuestionBoxState(questionData.question_id, "current") !== "indertiminate") {
                    updateQuestionBox(questionData.id, "active");
                    return;
                }

                updateQuestionBox(questionData.id, "prev");
            })

            let choiceLabel;

            if (choice.is_image) {
                choiceLabel = document.createElement('img');
                choiceLabel.src = choice.content;
                choiceLabel.alt = "Gambar tidak dapat dimuatkan";
                choiceLabel.className = "h-20 rounded-md border-gray-200 border";
            } else {
                choiceLabel = document.createElement('label');
                choiceLabel.htmlFor = radioInput.id;
                choiceLabel.className = 'text-sm text-gray-500 ms-2 dark:text-neutral-400';
                choiceLabel.textContent = choice.content;   
            }

            container.appendChild(radioInput);
            container.appendChild(choiceLabel);
            
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

        if (answerTextArea.value.length > 0 && getQuestionBoxState(questionData.id, "current") !== "indertiminate") {
            updateQuestionBox(questionData.id, "active");
        }

        answerTextArea.addEventListener("change", () => {
            if (answerTextArea.value.length > 0) {
                updateQuestionBox(questionData.id, "active");
                return;
            }

            updateQuestionBox(questionData.id, "prev");
        })

        container.appendChild(answerTextArea);
        choices.appendChild(container);
    }

    topContent.appendChild(questionContent);

    root.appendChild(topContent);
    root.appendChild(choices);

    return root;
}