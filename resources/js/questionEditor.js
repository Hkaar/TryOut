'use strict';

import axios from "axios";
import toastr, { error } from 'toastr';

import { questionSaveRoute, questionAPIRoute } from "./variables.js";
import { clearNodeTree } from "./utils.js";

import ChoiceBox from "./components/ChoiceBox.js";
import EssayBox from "./components/EssayBox.js";
import SimpleQuestionBox from "./components/SimpleQuestionBox.js";

/**
 * Add a option to the container
 */
function addOption() {
    const parent = document.getElementById("choices");

    if (parent === null) {
        console.error("Parent element of choice box doesnt exist!");
        return;
    }

    parent.appendChild(ChoiceBox(parent));
}

/**
 * Toggles the question box
 * 
 * @param {boolean} multipleChoice 
 */
export function toggleChoiceBox(multipleChoice) {
    const choiceBtn = document.getElementById("addChoice");
    const container = document.getElementById("choices");

    if (!(choiceBtn instanceof HTMLButtonElement) || container === null) {
        console.error("choiceButton and answer container doesnt exist!");
        return;
    }

    clearNodeTree(container);

    if (multipleChoice) {
        choiceBtn.disabled = false;

        container.appendChild(ChoiceBox(container));
        choiceBtn.addEventListener("click", addOption)
    } else {
        choiceBtn.disabled = true;
        choiceBtn.removeEventListener("click", addOption, true);

        container.appendChild(EssayBox(container));
    }
}

/**
 * Extract the essay answer from the page
 * 
 * @param {Element} container 
 * @returns {Questions.answerBoxData|null}
 */
export function extractEssay(container) {
    const answer = container.querySelector(".answerBox");

    if (!(answer instanceof HTMLTextAreaElement)) {
        console.error("Text area was not registered!");
        return null;
    }

    if (answer.value === '') {
        return null;
    }

    return {
        status: true,
        answer: answer.value
    };
}

/**
 * Extract the multiple choice elements in a page
 * 
 * @param {Element} container 
 * @returns {Questions.choicesBoxData|null}
 */
export function extractChoices(container) {
    const answers = container.querySelectorAll(".answerBox");

    /** @type {Questions.choicesBoxData} */
    const data = {};

    let existsAnswer = false;

    answers.forEach((element, i) => {
        const radio = element.querySelector('input[type="radio"]');
        const textarea = element.querySelector('textarea');
        const imageInput = element.querySelector('input[type="file"]');

        if (!(radio instanceof HTMLInputElement)) {
            console.error("Invalid input radio instance for question saving!");
            return;
        }

        if (!existsAnswer && radio.checked) {
            existsAnswer = true;
        }

        const checked = radio.checked;
        const answer = textarea instanceof HTMLTextAreaElement ? textarea.value : null;

        const file = imageInput instanceof HTMLInputElement ? imageInput.files 
            ? imageInput?.files.length > 0 
                ? imageInput.files[0] 
                : null 
            : null : null;

        data[i] = {
            status: checked,
            answer: answer,
            imageFile: file,
        };
    });

    if (!existsAnswer) {
        return null;
    }

    return data;
}

/**
 * Submits both forms to save a qustion and it's answers
 * 
 * @param {SubmitEvent} event 
 * @param {HTMLFormElement} questionForm 
 */
export function saveQuestion(event, questionForm) {
    event.preventDefault();

    const choiceBtn = document.getElementById("addChoice");
    const container = document.getElementById("choices");

    if (!(container instanceof HTMLElement)) {
        console.error("Container element not found for question form!");
        return;
    }

    if (!(choiceBtn instanceof HTMLButtonElement)) {
        console.error("Add choice button was not registered!");
        return;
    }

    const formData = new FormData(questionForm);
    const essai = choiceBtn.disabled;

    if (!essai) {
        const data = extractChoices(container);

        if (data === null) {
            toastr.error("Tolong siapkan minimal 1 jawaban", "Status", {
                timeOut: 3000,
                closeButton: true
            })
            
            return;
        }

        Object.keys(data).forEach((key, i) => {
            const { status, answer, imageFile } = data[i];

            formData.append(`choices[${key}][status]`, status ? 'true' : 'false');
            formData.append(`choices[${key}][answer]`, answer ? answer : '');

            if (imageFile) {
                formData.append(`choices[${key}][image]`, imageFile);
            }
        });
    } else {
        const data = extractEssay(container);

        if (data === null) {
            toastr.error("Tolong siapkan minimal 1 jawaban", "Status", {
                timeOut: 3000,
                closeButton: true
            })
            
            return;
        }

        formData.append("choices[status]", data.status ? 'true' : 'false');
        formData.append("choices[answer]", data.answer ? data.answer : '');
    }

    axios.post(questionSaveRoute, formData)
        .then((message) => {
            console.info(message);

            toastr.success("Berhasil menyimpan soal!", "Status", {
                timeOut: 3000,
                closeButton: true
            });

            clearNodeTree(container);
        })
        .catch((message) => {
            console.error(message);

            toastr.error("Gagal menyimpan soal", "Status", {
                timeOut: 3000,
                closeButton: true
            });
        });
}

/**
 * Updates the question list with a set of questions
 * 
 * @param {Element} container 
 */
export async function updateQuestionList(container)
{
    const questions = await axios.get(questionAPIRoute);

    if (questions === null) {
        console.error("No data was available to update questions!");
        return;
    }

    clearNodeTree(container);

    questions.data.forEach((/** @type {Questions.Question} */ val) => {
        container.appendChild(SimpleQuestionBox(container, val.id, val.content));
    });
} 

/**
 * Convinient setup function for the question editor
 */
export default function setupQEditor()
{
    const typeSelect = document.querySelector('select[name="question_type_id"]');
    const questionForm = document.getElementById('questionForm');
    const questionList = document.getElementById('questionList');

    if (!(typeSelect instanceof HTMLSelectElement)) {
        console.error("Select element with the name question_type_id doesn't exist!");
        return;
    }

    if (!(questionForm instanceof HTMLFormElement)) {
        console.error("question form must be a form element!");
        return;
    }

    if (questionList === null) {
        console.error("question list does not exist!");
        return;
    }

    typeSelect.addEventListener("change", () => {
        const selected = typeSelect.options[typeSelect.selectedIndex];

        if (selected.text.toLowerCase() === 'multiple_choice' ) {
            toggleChoiceBox(true);
        } else {
            toggleChoiceBox(false);
        }
    });

    questionForm.addEventListener("submit", function (e) {
        saveQuestion(e, this);
        updateQuestionList(questionList);
    });

    updateQuestionList(questionList);
}