'use strict';

import axios from "axios";

import { examAPIRoute } from "../variables.js";
import { request } from "./network.js";
import notify from "./toast.js";

/**
 * Updates the corresponding question box to the given state
 * 
 * @param {number} questionId - The id of the question
 * @param {"idle"|"active"|"indertiminate"|"prev"} state - The state to toggle the box into
 */
export function updateQuestionBox(questionId, state) {
    const box = document.querySelector(`[question-id="${questionId}"]`);

    if (!box) {
        console.error(`Question box with the id of ${questionId} does not exist!`);
        return;
    }

    const activeStyles = ["bg-primary", "text-white"];
    const idleStyles = ["bg-gray-100"];
    const indertiminateStyles = ["bg-caution"];

    if (state === "prev") {
        const prevState = box.getAttribute("data-prev-state");

        if (!prevState) {
            console.warn(`Box doesn't have a previous state to return to [id: ${questionId}]!`)
            updateQuestionBoxState(box, "idle");
            state = "idle";
        } else {
            const prev = /** @type {"idle"|"active"|"indertiminate"} */ (prevState)
            state = prev;
        }
    }

    switch (state) {
        case "active":
            box.classList.remove(...indertiminateStyles, ...idleStyles);
            box.classList.add(...activeStyles);

            updateQuestionBoxState(box, state);
            break;

        case "idle":
            box.classList.remove(...activeStyles, ...indertiminateStyles);
            box.classList.add(...idleStyles);

            updateQuestionBoxState(box, state);
            break;

        case "indertiminate":
            box.classList.remove(...activeStyles, ...idleStyles);
            box.classList.add(...indertiminateStyles);

            updateQuestionBoxState(box, state);
            break;
    
        default:
            console.error(`Invalid state for question box: ${state}!`);
            break;
    }
}

/**
 * Update the state of a question box
 * 
 * @param {Element} questionBox 
 * @param {"idle"|"active"|"indertiminate"} state 
 */
export function updateQuestionBoxState(questionBox, state) {
    const prev = questionBox.getAttribute("data-prev-state");
    const current = questionBox.getAttribute("data-state");

    if (!prev || !current) {
        console.error("Question box doesn't have the required prev-state & state attributes!");
        return;
    }

    questionBox.setAttribute("data-prev-state", current);
    questionBox.setAttribute("data-state", state);
}

/**
 * Gets the selected question box's state
 * 
 * @param {number} questionId 
 * @param {"current"|"prev"} type 
 */
export function getQuestionBoxState(questionId, type) {
    const box = document.querySelector(`[question-id="${questionId}"]`);

    if (!box) {
        console.error(`Question box with the id of ${questionId} does not exist!`);
        return;
    }

    let state;

    if (type === "current") {
        state = box.getAttribute("data-state");
    } else {
        state =  box.getAttribute("data-prev-state");
    }

    if (!state || !["active", "indertiminate", "idle"].includes(state)) {
        console.error(`Invalid state: ${state} was fetched from the question box of id: ${questionId}!`);
        return;
    }

    return state;
}

/**
 * Saves the current question to the server
 */
export function saveQuestion() {
    const questionContainer = document.getElementById("questionContainer");

    if (!(questionContainer instanceof HTMLFormElement)) {
        console.error("Question container does not exist!");
        return;
    }

    const formData = new FormData(questionContainer);

    /** @type {Object<string|File, string>} */
    const data = {};

    for (const [key, value] of formData.entries()) {
        data[key] = value;
    }

    request(async () => {
        const url = `${examAPIRoute}/${examResult}/pertanyaan/${currentQuestionId}/save`;

        const response = await axios.put(url, data, {
            headers: {
                "X-CSRF-TOKEN": csrf,
            },
        });

        switch (response.status) {
            case 200:
                notify("success", "Berhasil menyimpan jawaban!", 3000)
                break;
        
            default:
                console.warn(
                    `Encountered unexpected status code from response ${response.status}\nData : ${response.data}`
                );
                break;
        }
    });
}