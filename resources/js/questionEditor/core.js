'use strict';

import axios from "axios";

import { clearNodeTree } from "../utils/common.js";
import { request } from "../utils/network.js";
import { questionAPIRoute, questionSaveRoute } from "../variables.js";

import ChoiceBox from "../components/ChoiceBox.js";
import EssayBox from "../components/EssayBox.js";
import SimpleQuestionBox from "../components/SimpleQuestionBox.js";
import notify from "../utils/toast.js";

/**
 * Add an option choice box to the choices container
 * 
 * @returns void
 */
function addOption() {
    const parent = document.getElementById("choices");

    if (parent === null) {
        console.error("Parent element of choice box doesnt exist!");
        return;
    }

    parent.appendChild(ChoiceBox());
}

/**
 * Toggles the choices box to essay mode or multiple choice mode
 * 
 * @param {boolean} isMultipleChoice 
 * @returns void
 */
export function toggleChoiceBox(isMultipleChoice) {
    const choiceBtn = document.getElementById("addChoice");
    const container = document.getElementById("choices");

    if (!(choiceBtn instanceof HTMLButtonElement) || container === null) {
        console.error("add choice button and/or choices container doesnt exist!");
        return;
    }

    clearNodeTree(container);

    if (isMultipleChoice) {
        choiceBtn.disabled = false;

        container.appendChild(ChoiceBox());
        choiceBtn.addEventListener("click", addOption)
    } else {
        choiceBtn.disabled = true;
        choiceBtn.removeEventListener("click", addOption, true);

        container.appendChild(EssayBox());
    }
}

/**
 * Extract the answer for the essay question
 * 
 * @param {Element} container 
 * @returns {Questions.answerBoxData|null}
 */
function extractEssay(container) {
    const answer = container.querySelector(".answerBox");

    if (!(answer instanceof HTMLTextAreaElement)) {
        console.error("Answer box element does not exist!");
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
 * Extract the choices for the multiple choice question
 * 
 * @param {Element} container 
 * @returns {Questions.choicesBoxData|null}
 */
function extractChoices(container) {
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
 * Saves the question to the server
 * 
 * @param {SubmitEvent} event 
 * @param {HTMLFormElement} questionForm 
 */
export function save(event, questionForm) {
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
            notify("error", "Tolong siapkan minimal 1 jawaban", 3000);
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
            notify("error", "Tolong siapkan minimal 1 jawaban", 3000);
            return;
        }

        formData.append("choices[status]", data.status ? 'true' : 'false');
        formData.append("choices[answer]", data.answer ? data.answer : '');
    }

    axios.post(questionSaveRoute, formData)
        .then((message) => {
            console.info(message);

            notify("success", "Berhasil menyimpan soal!", 3000);
            clearNodeTree(container);
        })
        .catch((message) => {
            console.error(message);
            notify("error", "Gagal menyimpan soal", 3000);
        });
}

/**
 * Updates the question list with a set of questions fetched from the server
 * 
 * @param {Element} container 
 */
export function updateQuestionList(container) {
    request(async () => {
        const response = await axios.get(questionAPIRoute);
        /** @type {Questions.Question[]} */
        const questions = response.data;

        if (!questions) {
            console.error("No data was available to update questions!");
            return;
        }

        clearNodeTree(container);

        questions.forEach(question => container.appendChild(
            SimpleQuestionBox(container, question.id, question.content)
        ));
    })
}