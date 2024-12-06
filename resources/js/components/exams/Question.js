import { uuid } from "../../utils/common.js";
import {
    getQuestionBoxState,
    saveQuestion,
    updateQuestionBox,
} from "../../utils/exam.js";

import { Label, RadioInput, TextArea } from "../ui/form.js";
import { Image } from "../ui/content.js";

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

    questionData.img
        ? topContent.appendChild(Image({
            src: questionData.img,
            alt: "Gambar tidak dapat dimuatkan",
            className: "h-48 object-cover rounded-md border-gray-200 border",
        })) : null;

    const questionContent = document.createElement("p");
    questionContent.className = "text-xl font-medium";
    questionContent.textContent = questionData.content
        ? questionData.content
        : "NULL";

    const choices = document.createElement("div");
    choices.classList.add("space-y-3");

    if (questionData.type === "multiple_choice") {
        createMultipleChoiceOptions(choices, questionData);
    } else {
        createEssay(choices, questionData);
    }

    topContent.appendChild(questionContent);

    root.appendChild(topContent);
    root.appendChild(choices);

    return root;
}

/**
 * Create the multiple choice options and append them to the given container
 * 
 * @param {Element} container - The container element to contain the options
 * @param {Questions.questionData} questionData - The data of the question that is going to be used
 */
function createMultipleChoiceOptions(container, questionData) {
    questionData.choices.forEach(data => {
        const choice = document.createElement("div");
        choice.className = "flex items-center gap-2";

        const radio = RadioInput({
            name: "answer",
            id: `choice-${uuid()}`,
            value: data.content,
            checked: questionData.answer === data.content,
        })

        const label = data.is_image
            ? Image({
                src: data.content,
                alt: "Gambar tidak dapat dimuatkan",
                className: "h-20 rounded-md border-gray-200 border"
            })
            : Label({ htmlFor: radio.id });

        if (!data.is_image) {
            label.textContent = data.content;
        }

        radio.addEventListener("change", () => {
            saveQuestion();

            const isIndertiminate = getQuestionBoxState(questionData.id, "current") === "indertiminate";

            if (radio.checked && !isIndertiminate) {
                updateQuestionBox(questionData.id, "active");
                return;
            }
        });

        choice.appendChild(radio);
        choice.appendChild(label);

        container.appendChild(choice);
    });
}

/**
 * Create the essay answer box and append it to the given container
 * 
 * @param {Element} container - The container element to contain the options
 * @param {Questions.questionData} questionData - The data of the question that is going to be used
 */
function createEssay(container, questionData) {
    const root = document.createElement("div");
    root.className = "w-full space-y-3";

    const answerBox = TextArea({
        name: "answer",
        className: "answerBox",
        placeholder: "Masukkan jawaban ...",
    });

    answerBox.textContent = questionData.answer
        ? questionData.answer
        : "";

    const isIndertiminate = getQuestionBoxState(questionData.id, "current") === "indertiminate";

    if (answerBox.value.length > 0 && !isIndertiminate) {
        updateQuestionBox(questionData.id, "active");
    }

    answerBox.addEventListener("change", () => {
        if (answerBox.value.length > 0) {
            updateQuestionBox(questionData.id, "active");
            return;
        }

        updateQuestionBox(questionData.id, "prev");
    });

    root.appendChild(answerBox);
    container.appendChild(root);
}