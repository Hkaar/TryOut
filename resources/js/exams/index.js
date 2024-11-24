import { getQuestionBoxState, updateQuestionBox } from "../utils/exam.js";
import { endExam, gotoQuestion, nextQuestion, previousQuestion, saveAsIndertiminate } from "./question.js";
import setupExamTimer from "./timer.js";

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
        element.addEventListener("click", () => {
            gotoQuestion({
                element: element,
            });
        });
    });

    nextBtn.addEventListener("click", () => {
        nextQuestion();
    });

    prevBtn.addEventListener("click", () => {
        previousQuestion();
    });

    indertiminateBtn.addEventListener("click", () => {
        saveAsIndertiminate();

        const currentState = getQuestionBoxState(currentQuestionId, "current");

        if (currentState === "indertiminate") {
            updateQuestionBox(currentQuestionId, "prev");
        } else {
            updateQuestionBox(currentQuestionId, "indertiminate");
        }
    });

    finishBtn.addEventListener("click", () => {
        endExam();
    });

    setupExamTimer("#examTimer");

    gotoQuestion({
        questionId: currentQuestionId,
        questionNumber: currentQuestionNumber,
    });
}