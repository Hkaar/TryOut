"use strict";

import Swal from "sweetalert2";

import { getQuestionBoxState, updateQuestionBox } from "../utils/exam.js";
import {
    endExam,
    gotoQuestion,
    nextQuestion,
    previousQuestion,
    saveAsIndertiminate,
} from "./question.js";
import setupExamTimer, { logout } from "./timer.js";

/**
 * The setup function for the exam module
 */
export default function setupExam() {
    const nextBtn = document.getElementById("nextQuestion");
    const prevBtn = document.getElementById("previousQuestion");
    const indertiminateBtn = document.getElementById("ragu");

    const finishBtn = document.getElementById("finishExam");
    const questionBoxes = document.querySelectorAll("[question-id]");

    if (!nextBtn || !prevBtn || !indertiminateBtn || !finishBtn) {
        console.error(
            "Exam module required next, previous, indertiminate and finish exam buttons to work!"
        );
        return;
    }

    questionBoxes.forEach((element) => {
        element.addEventListener("click", () =>
            gotoQuestion({ element: element })
        );
    });

    nextBtn.addEventListener("click", nextQuestion);
    prevBtn.addEventListener("click", previousQuestion);

    indertiminateBtn.addEventListener("click", () => {
        saveAsIndertiminate();

        const currentState = getQuestionBoxState(currentQuestionId, "current");

        if (currentState === "indertiminate") {
            updateQuestionBox(currentQuestionId, "prev");
        } else {
            updateQuestionBox(currentQuestionId, "indertiminate");
        }
    });

    finishBtn.addEventListener("click", endExam);

    setupExamTimer("#examTimer");

    globalThis.window.addEventListener("blur", () => {
        detectedSwitched = true;

        if (detectedSwitched) {
            Swal.fire({
                title: "Terdeteksi Gangguan",
                text: "Tidak diperbolehkan keluar dari aplikasi sesaat mengerjakan ujian!",
                timer: 5000,
                timerProgressBar: true,
                allowOutsideClick: false,
                icon: "warning",
            }).then(() => {
                detectedSwitched = false;
                logout();
            });
        }
    });

    gotoQuestion({
        questionId: currentQuestionId,
        questionNumber: currentQuestionNumber,
    });
}
