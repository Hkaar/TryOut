import axios from "axios";
import toastr from "toastr";

import { toNumber } from "lodash";

import { clearNodeTree } from "./utils/common.js";
import { request } from "./utils/network.js";

import { examAPIRoute } from "./variables.js";

import Question from "./components/exams/Question.js";
import Swal from "sweetalert2";
import QuestionTopBar from "./components/exams/QuestionTopBar.js";

/**
 * Setup function for exams
 */
export default function setupExam() {
    const nextBtn = document.getElementById("nextQuestion");
    const prevBtn = document.getElementById("previousQuestion");

    const finishBtn = document.getElementById("finishExam");

    const questionBoxes = document.querySelectorAll("[question-id]");

    questionBoxes.forEach((element) => {
        element.addEventListener("click", () => {
            gotoQuestion(element);
        });
    });

    if (nextBtn === null || prevBtn === null) {
        console.error("Next and/or previous button for exams does not exist!");
        return;
    }

    nextBtn.addEventListener("click", () => {
        nextQuestion();
    });

    prevBtn.addEventListener("click", () => {
        prevQuestion();
    });

    if (finishBtn === null) {
        console.error("Finish exam button doesn't exist!");
        return;
    }

    finishBtn.addEventListener("click", () => {
        endExam();
    });

    updateExamTime("#examTimer");
}

/**
 * Fetches the specified question
 *
 * @param {Element} element
 */
function gotoQuestion(element) {
    const questionContainer = document.getElementById("questionContainer");
    const questionHeader = document.getElementById("questionHeader");

    const questionId = element.getAttribute("question-id");
    const questionNumber = element.getAttribute("question-number");

    if (questionId === null || questionNumber === null) {
        console.error(
            `Question id and/or number is not defined in ${element}!`
        );
        return;
    }

    if (questionContainer === null || questionHeader === null) {
        console.error("Question container does not exist!");
        return;
    }

    request(async () => {
        const response = await axios.get(
            `${examAPIRoute}/${examResult}/pertanyaan/${questionId}`
        );
        saveQuestion();

        const questionBox = Question(response.data);
        const header = QuestionTopBar(
            toNumber(questionNumber),
            toNumber(questionId),
            response.data
        );

        switch (response.status) {
            case 200:
                clearNodeTree(questionContainer);
                clearNodeTree(questionHeader);

                questionContainer.appendChild(questionBox);
                questionHeader.appendChild(header);

                toastr.success("Berhasil memperbarui soal!", "Status", {
                    timeOut: 3000,
                    progressBar: true,
                });

                currentQuestionId = toNumber(questionId);
                currentQuestionNumber = toNumber(questionNumber);

                break;

            case 404:
                toastr.error("Maaf tidak ada soal lagi :(", "Status", {
                    timeOut: 3000,
                    progressBar: true,
                });

                break;

            case 400 | 500:
                toastr.error("Owh.. ternyatanya ada kesalahan!", "Status", {
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
 * Go to the next question
 */
function nextQuestion() {
    const questionContainer = document.getElementById("questionContainer");
    const questionHeader = document.getElementById("questionHeader");

    if (questionContainer === null || questionHeader === null) {
        console.error("Question container does not exist!");
        return;
    }

    request(async () => {
        const response = await axios.get(
            `${examAPIRoute}/${examResult}/pertanyaan/${currentQuestionId}/next`
        );
        /** @type {Questions.questionData} */
        const data = response.data;

        saveQuestion();

        const newQuestionId = data.id;
        const newQuestionNumber = currentQuestionNumber + 1;

        const questionBox = Question(response.data);
        const header = QuestionTopBar(
            toNumber(newQuestionNumber),
            toNumber(newQuestionId),
            response.data
        );

        switch (response.status) {
            case 200:
                clearNodeTree(questionContainer);
                clearNodeTree(questionHeader);

                questionContainer.appendChild(questionBox);
                questionHeader.appendChild(header);

                toastr.success("Berhasil memperbarui soal!", "Status", {
                    timeOut: 3000,
                    progressBar: true,
                });

                currentQuestionId = toNumber(newQuestionId);
                currentQuestionNumber = newQuestionNumber;

                break;

            case 404:
                toastr.error("Maaf tidak ada soal lagi :(", "Status", {
                    timeOut: 3000,
                    progressBar: true,
                });

                break;

            case 400 | 500:
                toastr.error("Owh.. ternyatanya ada kesalahan!", "Status", {
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
 * Go to the previous question
 */
function prevQuestion() {
    const questionContainer = document.getElementById("questionContainer");
    const questionHeader = document.getElementById("questionHeader");

    if (questionContainer === null || questionHeader === null) {
        console.error("Question container does not exist!");
        return;
    }

    request(async () => {
        const response = await axios.get(
            `${examAPIRoute}/${examResult}/pertanyaan/${currentQuestionId}/previous`
        );
        /** @type {Questions.questionData} */
        const data = response.data;

        saveQuestion();

        const newQuestionId = data.id;
        const newQuestionNumber = currentQuestionNumber - 1;

        const questionBox = Question(response.data);
        const header = QuestionTopBar(
            toNumber(newQuestionNumber),
            toNumber(newQuestionId),
            response.data
        );

        switch (response.status) {
            case 200:
                clearNodeTree(questionContainer);
                clearNodeTree(questionHeader);

                questionContainer.appendChild(questionBox);
                questionHeader.appendChild(header);

                toastr.success("Berhasil memperbarui soal!", "Status", {
                    timeOut: 3000,
                    progressBar: true,
                });

                currentQuestionId = toNumber(newQuestionId);
                currentQuestionNumber = newQuestionNumber;

                break;

            case 404:
                toastr.error("Maaf tidak ada soal lagi :(", "Status", {
                    timeOut: 3000,
                    progressBar: true,
                });

                break;

            case 400 | 500:
                toastr.error("Owh.. ternyatanya ada kesalahan!", "Status", {
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
 * Save the current question
 */
function saveQuestion() {
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
        const response = await axios.put(
            `${examAPIRoute}/${examResult}/pertanyaan/${currentQuestionId}/save`,
            data,
            {
                headers: {
                    "X-CSRF-TOKEN": csrf,
                },
            }
        );

        switch (response.status) {
            case 200:
                toastr.success("Berhasil menyimpan jawaban!", "Status", {
                    timeOut: 3000,
                    progressBar: true,
                });
                break;

            case 400:
            case 404:
            case 500:
                toastr.error("Owh.. ternyatanya ada kesalahan!", "Status", {
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
 * End the exam
 */
function endExam() {
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
        backdrop: true,
        allowOutsideClick: false,
    }).then((modalResponse) => {
        if (modalResponse.isConfirmed) {
            request(async () => {
                const response = await axios.put(
                    `${examAPIRoute}/${examResult}/finish`
                );

                switch (response.status) {
                    case 200:
                        window.location.assign(response.data.redirect);

                        Swal.fire({
                            title: "Status",
                            text: "Berhasil mengakhiri ujian!",
                            icon: "success",
                            timer: 5000,
                            timerProgressBar: true,
                        });
                        break;

                    case 400 | 404 | 500:
                        Swal.fire({
                            title: "Status",
                            text: "Gagal mengakhiri ujian!",
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
        }
    });
}

/**
 * Updates the exam timer and checks accuracy every minute
 *
 * @param {string} timer - The element where the timer will be displayed
 */
function updateExamTime(timer) {
    fetchExamTime(timer);

    let triggered = false;

    setInterval(() => {
        if (remainingTime > 0) {
            remainingTime--;
            updateTimerDisplay(timer, remainingTime);
        } else if (!triggered) {
            fetchExamTime(timer);
            triggered = true;
        }
    }, 1000);

    setInterval(() => {
        fetchExamTime(timer);
    }, 1 * 60 * 1000);
}

/**
 * Fetches the remaining exam time from the server
 *
 * @param {string} timer
 */
function fetchExamTime(timer) {
    axios
        .get(`${examAPIRoute}/${examResult}/remaining`)
        .then((response) => {
            if (!response.data.valid) {
                Swal.fire({
                    title: "Waktu ujian sudah habis",
                    allowOutsideClick: false,
                    backdrop: true,
                    icon: "warning",
                }).then(() => {
                    window.location.replace("/");
                });
                return;
            }

            let offset = remainingTime - response.data.remaining;

            if (Math.abs(offset) > 10000) {
                Swal.fire({
                    title: "Terdeteksi gangguan",
                    text: "Terdeteksi gangguan saat mengerjakan ujian",
                    allowOutsideClick: false,
                    backdrop: true,
                    icon: "error",
                }).then(() => {
                    window.location.replace("/");
                });
                return;
            }

            remainingTime = response.data.remaining;
            updateTimerDisplay(timer, remainingTime);
        })
        .catch((error) => {
            console.error("Error fetching exam time:", error);
        });
}

/**
 * Updates the timer display
 *
 * @param {string} timer - The element where the timer will be displayed
 * @param {number} remainingSeconds - Remaining time in seconds
 */
function updateTimerDisplay(timer, remainingSeconds) {
    const hours = String(Math.floor(remainingSeconds / 3600)).padStart(2, "0");
    const mins = String(Math.floor((remainingSeconds % 3600) / 60)).padStart(
        2,
        "0"
    );
    const secs = String(remainingSeconds % 60).padStart(2, "0");

    const timerElement = document.querySelector(timer);

    if (timerElement) {
        timerElement.textContent = `${hours}:${mins}:${secs}`;
    } else {
        console.error("Timer element is undefined or null.");
    }
}
