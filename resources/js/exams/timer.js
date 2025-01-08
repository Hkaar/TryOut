"use strict";

import axios from "axios";
import Swal from "sweetalert2";

import { request } from "../utils/network.js";
import { examAPIRoute } from "../variables.js";

/**
 * Bootstraps the exam timer functionality into the app
 *
 * @param {string} timer - The element where the timer will be bootstrapped into
 */
export default function setupExamTimer(timer) {
    let triggered = false;
    const randomDelay = Math.floor(Math.random() * (60 - 10 + 1)) + 5;

    fetchExamTime(timer);

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
    }, (1 * 60 + randomDelay) * 1000);
}

/**
 * Fetches the exam time from the server and displays it
 *
 * @param {string} timer - The element where the timer will be bootstrapped into
 */
function fetchExamTime(timer) {
    request(async () => {
        const response = await axios.get(
            `${examAPIRoute}/${examResult}/remaining`
        );
        /** @type {Exam.ExamTimeResponse} */
        const data = response.data;

        if (!data.valid) {
            Swal.fire({
                title: "Waktu ujian sudah habis",
                allowOutsideClick: false,
                backdrop: true,
                icon: "warning",
            }).then(() => window.location.replace("/"));
            return;
        }

        const offset = remainingTime - data.remaining;

        if (Math.abs(offset) > 50000) {
            Swal.fire({
                title: "Terdeteksi gangguan",
                text: "Terdeteksi gangguan saat mengerjakan ujian",
                allowOutsideClick: false,
                backdrop: true,
                icon: "error",
            }).then(() => logout());
            return;
        }

        remainingTime = data.remaining;
        updateTimerDisplay(timer, remainingTime);
    });
}

/**
 * Updates the displayed time on the bootstrapped exam timer
 *
 * @param {string} timer - The element where the timer will be bootstrapped into
 * @param {number} remaining - The remaining amount of time in the exam in seconds
 */
function updateTimerDisplay(timer, remaining) {
    const hours = String(Math.floor(remaining / 3600)).padStart(2, "0");
    const mins = String(Math.floor((remaining % 3600) / 60)).padStart(2, "0");
    const secs = String(remaining % 60).padStart(2, "0");

    const timerElement = document.querySelector(timer);

    if (timerElement) {
        timerElement.textContent = `${hours}:${mins}:${secs}`;
    } else {
        console.error("Timer element is undefined or null.");
    }
}

export function logout() {
    request(async () => {
        await axios.post(
            "/logout",
            {},
            {
                headers: {
                    "X-CSRF-TOKEN": csrf,
                },
            }
        );

        globalThis.window.location.reload();
    });
}
