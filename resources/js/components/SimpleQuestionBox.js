import axios from "axios";

import Icon from "./Icon.js";
import Swal from "sweetalert2";
import { Button } from "./ui/index.js";

import { questionAPIRoute } from "../variables.js";
import notify from "../utils/toast.js";

/**
 * A simple question box with only one action
 * 
 * @param {Element} parent 
 * @param {number} id 
 * @param {string} title 
 */
export default function SimpleQuestionBox(parent, id, title) {
    const root = document.createElement("div");
    root.classList.add("flex", "justify-between", "items-center", "border-2", "rounded-md", "shadow-sm", "px-4", "py-2");

    const boxTitle = document.createElement("h6");
    boxTitle.classList.add("text-lg", "font-semibold");
    boxTitle.textContent = title;

    const btn = Button({ className: "text-danger" });
    btn.appendChild(Icon("delete"));

    btn.addEventListener("click", () => {
        Swal.fire({
            title: "Konfirmasi",
            text: `Apakah anda yakin untuk menghapus pertanyaan ini?`,
            icon: "question",
            showCancelButton: true,
            showConfirmButton: true,
            timer: 5000,
            timerProgressBar: true,
            backdrop: true,
            allowOutsideClick: false,
        }).then(response => {
            if (response.isConfirmed) {
                axios.delete(questionAPIRoute, {data: {'id': id}})
                    .then(() => {
                        notify("success", "Berhasil menghapus pertanyaan!", 3000);
                        parent.removeChild(root);
                    })
                    .catch(error => {
                        console.error(error);
                        notify("error", "Gagal menghapus pertanyaan!", 3000)
                    });
            }
        })
    });

    root.appendChild(boxTitle);
    root.appendChild(btn);

    return root;
}