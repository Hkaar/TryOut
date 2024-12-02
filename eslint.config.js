import globals from "globals";
import pluginJs from "@eslint/js";
import js from "@eslint/js";

/** @type {import('eslint').Linter.Config[]} */
export default [
    js.configs.recommended,
    {
        languageOptions: {
            globals: {
                ...globals.browser,
                examResult: "writable",
                csrf: "readonly",
                currentQuestionId: "writable",
                currentQuestionNumber: "writable",
                remainingTime: "writable",
                detectedSwitched: "writable",
            },
        },
    },
    pluginJs.configs.recommended,
];
