"use strict";

import { cn } from "../../utils/common.js";

/**
 * The standard radio input for forms
 *
 * @param {Components.Form.RadioInputProps} props - Props for configuring the radio input.
 * @returns {HTMLInputElement}
 */
function RadioInput({
    id = "",
    checked = false,
    name,
    value = "",
    className = "",
}) {
    const root = document.createElement("input");
    root.type = "radio";
    root.id = id;
    root.checked = checked;
    root.name = name;
    root.value = value;
    root.className = cn(
        `shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 
        focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none 
        dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 
        dark:checked:border-blue-500 dark:focus:ring-offset-gray-800`,
        className
    );

    return root;
}

/**
 * The standard form label
 *
 * @param {Components.Form.LabelProps} props - Props for configuring the form label.
 * @returns {HTMLLabelElement}
 */
function Label({ id = "", htmlFor = "", className = "" }) {
    const root = document.createElement("label");
    root.htmlFor = htmlFor;
    root.id = id;
    root.className = cn(
        `text-sm text-gray-500 ms-2 dark:text-neutral-400`,
        className
    );

    return root;
}

/**
 * The standard text area element
 *
 * @param {Components.Form.TextAreaProps} props - Props for configuring the text area.
 * @returns {HTMLTextAreaElement}
 */
function TextArea({
    name,
    rows = 3,
    cols = 10,
    placeholder = "",
    id = "",
    className = "",
}) {
    const root = document.createElement("textarea");
    root.cols = cols;
    root.rows = rows;
    root.name = name;
    root.id = id;
    root.placeholder = placeholder;

    root.className = cn(
        `py-3 px-4 block w-full border-gray-200 rounded-lg text-sm 
        focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 
        disabled:pointer-events-none dark:bg-neutral-900 
        dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 
        dark:focus:ring-neutral-600`,
        className
    );

    return root;
}

export { RadioInput, Label, TextArea };
