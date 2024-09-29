import axios from "axios";
import { questionAPIRoute } from "../variables.js";
import Icon from "./Icon.js";
import Swal from "sweetalert2";
import toastr from "toastr";

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

    const btn = document.createElement("button");
    btn.type = "button";
    btn.classList.add("btn", "text-danger", "hover:opacity-95", "hover:scale-110", "active:opacity-30", "active:scale-95", "duration-150", "ease-in-out");
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
                    .then(message => {
                        toastr.success("Berhasil menghapus pertanyaan!", "Status", {
                            timeOut: 3000,
                            progressBar: true,
                        });

                        parent.removeChild(root);
                    })
                    .catch(error => {
                        console.error(error);

                        toastr.error("Gagal menghapus pertanyaan!", "Status", {
                            timeOut: 3000,
                            progressBar: true,
                        });
                    });
            }
        })
    });

    root.appendChild(boxTitle);
    root.appendChild(btn);

    return root;
}