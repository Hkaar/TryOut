import axios from "axios";
import Swal from "sweetalert2";
import toastr from "toastr";

import Question from "../components/exams/Question.js";
import QuestionTopBar from "../components/exams/QuestionTopBar.js";

import { request } from "../utils/network.js";
import { clearNodeTree } from "../utils/common.js";
import { examAPIRoute } from "../variables.js";

/**
 * Goes to the given question by the id or question box
 *
 * @param {Exam.QuestionGotoConfig} config
 */
export function gotoQuestion(config) {
    const questionContainer = document.getElementById("questionContainer");
    const questionHeader = document.getElementById("questionHeader");

    if (!questionContainer || !questionHeader) {
        console.error(`Error: 'questionContainer' or 'questionHeader' DOM elements are missing. Ensure that 
            these elements exist in the document.`);
        return;
    }

    let questionId = currentQuestionId;
    let questionNumber = currentQuestionNumber;

    if (config.element) {
        const tempId = config.element.getAttribute("question-id");
        const tempNumber = config.element.getAttribute("question-number");

        if (!tempId || !tempNumber) {
            console.error(`Error: Missing question id and/or question number in the element attributes. 
                Ensure the element has 'question-id' and 'question-number' attributes.`);
            return;
        }

        questionId = Number(tempId);
        questionNumber = Number(tempNumber);
    } else if (config.questionId && config.questionNumber) {
        questionId = config.questionId;
        questionNumber = config.questionNumber;
    } else {
        console.error(`Error: Config object is incorrectly defined. It must either contain 'element' with 
            'question-id' and 'question-number', or directly contain 'questionId' and 'questionNumber'.`);
        return;
    }

    console.debug(
        `Navigating to Question ID: ${questionId}, Question Number: ${questionNumber}`
    );

    request(async () => {
        const url = `${examAPIRoute}/${examResult}/pertanyaan/${questionId}`;

        const response = await axios.get(url);
        saveQuestion();

        const display = Question(response.data);
        const header = QuestionTopBar(
            questionNumber,
        );

        switch (response.status) {
            case 200:
                clearNodeTree(questionContainer, questionHeader);

                questionContainer.appendChild(display);
                questionHeader.appendChild(header);

                toastr.success("Berhasil memperbarui soal!", "Status", {
                    timeOut: 3000,
                    progressBar: true,
                });

                currentQuestionId = Number(questionId);
                currentQuestionNumber = Number(questionNumber);
                break;

            case 204:
                handleStatusResponse(response.status);
                break;

            default:
                console.warn(
                    `Encountered unexpected status code from response ${response.status}\nData : ${response.data}`
                );
                break;
        }
    });
}

/**
 * Goes the the next question in the exam
 */
export function nextQuestion() {
    const questionContainer = document.getElementById("questionContainer");
    const questionHeader = document.getElementById("questionHeader");

    if (!questionContainer || !questionHeader) {
        console.error(`Error: 'questionContainer' or 'questionHeader' DOM elements are missing. Ensure that 
            these elements exist in the document.`);
        return;
    }

    console.debug("Navigating to the next question!");

    request(async () => {
        const url = `${examAPIRoute}/${examResult}/pertanyaan/${currentQuestionId}/next`;

        const response = await axios.get(url);
        /** @type {Questions.questionData} */
        const data = response.data;

        saveQuestion();

        const newQuestionId = data.id;
        const newQuestionNumber = currentQuestionNumber + 1;

        const display = Question(data);
        const header = QuestionTopBar(newQuestionNumber);

        switch (response.status) {
            case 200:
                clearNodeTree(questionContainer, questionHeader);

                questionContainer.appendChild(display);
                questionHeader.appendChild(header);

                toastr.success("Berhasil memperbarui soal!", "Status", {
                    timeOut: 3000,
                    progressBar: true,
                });

                currentQuestionId = Number(newQuestionId);
                currentQuestionNumber = newQuestionNumber;
                break;

            case 204:
                handleStatusResponse(response.status);
                break;

            default:
                console.warn(
                    `Encountered unexpected status code from response ${response.status}\nData : ${response.data}`
                );
                break;
        }
    });
}

/**
 * Goes to the previous question in the exam
 */
export function previousQuestion() {
    const questionContainer = document.getElementById("questionContainer");
    const questionHeader = document.getElementById("questionHeader");

    if (!questionContainer || !questionHeader) {
        console.error(`Error: 'questionContainer' or 'questionHeader' DOM elements are missing. Ensure that 
            these elements exist in the document.`);
        return;
    }

    request(async () => {
        const url = `${examAPIRoute}/${examResult}/pertanyaan/${currentQuestionId}/previous`;

        const response = await axios.get(url);
        /** @type {Questions.questionData} */
        const data = response.data;

        saveQuestion();

        const newQuestionId = data.id;
        const newQuestionNumber = currentQuestionNumber - 1;

        const display = Question(data);
        const header = QuestionTopBar(newQuestionNumber);

        switch (response.status) {
            case 200:
                clearNodeTree(questionContainer, questionHeader);

                questionContainer.appendChild(display);
                questionHeader.appendChild(header);

                toastr.success("Berhasil memperbarui soal!", "Status", {
                    timeOut: 3000,
                    progressBar: true,
                });

                currentQuestionId = Number(newQuestionId);
                currentQuestionNumber = newQuestionNumber;
                break;

            case 204:
                handleStatusResponse(response.status);
                break;

            default:
                console.warn(
                    `Encountered unexpected status code from response ${response.status}\nData : ${response.data}`
                );
                break;
        }
    });
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
                toastr.success("Berhasil menyimpan jawaban!", "Status", {
                    timeOut: 3000,
                    progressBar: true,
                });
                break;
        
            default:
                console.warn(
                    `Encountered unexpected status code from response ${response.status}\nData : ${response.data}`
                );
                break;
        }
    });
}

/**
 * Saves a question as being in the indertiminate state
 */
export function saveAsIndertiminate() {
    request(async () => {
        const response = await axios.put(
            `${examAPIRoute}/${examResult}/pertanyaan/${currentQuestionId}/not-sure`,
            {},
            {
                headers: {
                    "X-CSRF-TOKEN": csrf,
                },
            }
        );

        switch (response.status) {
            case 200:
                toastr.success("Berhasil merubah status ragu soal", "Status", {
                    timeOut: 3000,
                    progressBar: true,
                });
                break;

            default:
                console.warn(
                    `Encountered unexpected status code from response ${response.status}\nData : ${response.data}`
                );
                break;
        }
    });
}

/**
 * Ends the current exam
 */
export function endExam() {
    const handleRequest = () => request(async () => {
        const url = `${examAPIRoute}/${examResult}/finish`;

        const response = await axios.put(url);
        /** @type {Exam.ExamEndResponse} */
        const data = response.data;

        switch (response.status) {
            case 200:
                window.location.assign(data.redirect);

                Swal.fire({
                    title: "Status",
                    text: "Berhasil mengakhiri ujian!",
                    icon: "success",
                    timer: 5000,
                    timerProgressBar: true,
                });
                break;
        
            default:
                console.warn(
                    `Encountered unexpected status code from response ${response.status}\nData : ${response.data}`
                );
                break;
        }
    });

    Swal.fire({
        title: "Konfirmasi",
        text: "Apakah anda yakin untuk mengakhiri ujian ini?",
        icon: "question",
        timer: 10000,
        timerProgressBar: true,
        showConfirmButton: true,
        showCancelButton: true,
        cancelButtonText: "Batalkan",
        cancelButtonColor: "#ef4444",
        confirmButtonText: "Selesaikan",
        backdrop: true,
        allowOutsideClick: false,
    }).then(response => {
        if (response.isConfirmed) {handleRequest()}
    })
}   

/**
 * Helper function for handling default status responses from the server
 *
 * @param {number} statusCode
 */
export function handleStatusResponse(statusCode) {
    switch (statusCode) {
        case 204:
            if (currentQuestionNumber > 1) {
                endExam();
                return;
            }

            toastr.error("Maaf tidak ada soal lagi :(", "Status", {
                timeOut: 3000,
                progressBar: true,
            });
            break;
    
        default:
            break;
    }
}
