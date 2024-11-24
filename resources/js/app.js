import './bootstrap';

import Swal from 'sweetalert2';

import { setupAutoTimezone } from "./utils/time.js";

import setupQEditor from "./questionEditor.js";
import setupExam from './exams/index.js';
import { runPlugin } from './utils/plugin.js';
import { setupHomeCharts } from './admin.js';

/**
 * A function to toggle the side bar
 */
function toggleSideBar() {
    const sideBar = document.getElementById("sideBar");

    const sideNavItems = sideBar?.querySelectorAll(".side-nav-item");
    const sideBarMenus = document.querySelectorAll(".menu-text");

    if (sideBar?.classList.contains("-translate-x-full") || sideBar?.classList.contains("min-w-24")) {
        sideBar.classList.replace("-translate-x-full", "translate-x-0");
        sideBar.classList.replace("min-w-24", "w-full");
        sideBar.classList.add("lg:min-w-72");

        sideBarMenus.forEach((e) => {
            e.classList.remove("hidden");
        });
        
        sideNavItems?.forEach((e) => {
            e.classList.add("ps-3");
        });

        document.body.classList.add("overflow-y-hidden", "md:overflow-y-auto");
    } else {
        sideBar?.classList.replace("translate-x-0", "-translate-x-full");
        sideBar?.classList.replace("w-full", "min-w-24");
        sideBar?.classList.remove("lg:min-w-72");

        sideBarMenus.forEach((e) => {
            e.classList.add("hidden");
        });

        sideNavItems?.forEach((e) => {
            e.classList.remove("ps-3");
        });

        document.body.classList.remove("overflow-y-hidden", "md:overflow-y-auto");
    }
}

/**
 * Updates the preview image based on the image input
 * 
 * @param {HTMLInputElement} element - The form input for images
 */
function updatePreviewImage(element) {
    let file = element.files ? element.files[0] : null;
    const previewTarget = element.getAttribute('preview-target');
    const previewClasses = element.getAttribute('preview-classes');

    if (previewTarget === null) {
        console.error(`Input element doesn't have a valid preview target!`);
        return;
    }

    let preview = document.querySelector(previewTarget);

    if (preview === null) {
        console.error(`Preview element ${previewTarget} doesn't exist!`);
        return;
    }

    if (file && preview) {
        let reader = new FileReader();
        
        reader.onload = (e) => {
            let result = e.target?.result;

            if (result && file.type.startsWith("image") && typeof result === "string") {
                let img = document.createElement("img");
                img.setAttribute("src", result);
                img.classList.add("block", "w-2/3", "aspect-square");

                if (previewClasses !== null) {
                    previewClasses.split(' ').forEach(styleClass => {
                        img.classList.add(styleClass);
                    });
                }
            
                while (preview.firstChild) {
                    preview.removeChild(preview.firstChild);
                }
            
                preview.appendChild(img);
            } else {
                preview.textContent = "Gambar tidak tersedia";
            }
        }

        reader.readAsDataURL(file);
    }
}

/**
 * Shows a modal upon an event being triggered
 * 
 * @param {CustomEvent<any>} event 
 */
function triggerModal(event) {
    if (!(event.target instanceof Element)) {
        console.error(`Issued event target ${event} was not an element!`);
        return;
    }

    if (event.target.matches('[delete-confirmation]')) {
        event.preventDefault();

        Swal.fire({
            title: "Konfirmasi",
            text: `Apakah anda yakin untuk menghapus ${event.detail.question} ini?`,
            icon: "question",
            showCancelButton: true,
            showConfirmButton: true,
            timer: 5000,
            timerProgressBar: true,
            backdrop: true,
            allowOutsideClick: false,
        }).then(response => {
            if (response.isConfirmed) {
                event.detail.issueRequest(true);

                Swal.fire({
                    title: "Berhasil!",
                    text: `Berhasil menghapus sebuah ${event.detail.question}!`,
                    icon: "success",
                    timer: 5000,
                    timerProgressBar: true,
                });
            }
        })

        return;
    }
}

document.addEventListener("DOMContentLoaded", () => {
    'use strict';

    const sideBarToggles = document.querySelectorAll(".side-bar-toggle");
    sideBarToggles.forEach((e) => {
        e.addEventListener("click", toggleSideBar);
    });

    document.addEventListener("change", (event) => {
        if (!(event.target instanceof Element)) {
            console.error(`Element target of event change ${event} doesnt exist!`);
            return;
        }

        if (event.target.matches("[preview-target]")) {
            if (!(event.target instanceof HTMLInputElement)) {
                console.error("Element forpreview input must be a input element!");
                return;
            }
            
            updatePreviewImage(event.target);
        }
    });

    document.addEventListener("htmx:confirm", function(e) {
        const event = /** @type {CustomEvent<any>} */ (e);

        triggerModal(event);
    });

    runPlugin('exam', setupExam);
    runPlugin('question-editor', setupQEditor);
    runPlugin('admin-charts-home', setupHomeCharts);

    setupAutoTimezone();
});