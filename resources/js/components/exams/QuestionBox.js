/**
 * A exam question box component
 * 
 * @param {number} questionNumber 
 * @param {number} questionId
 */
export default function QuestionBox(questionNumber, questionId) {
    const root = document.createElement('btn');
    root.setAttribute("question-id", `${questionId}`);
    root.classList.add("btn", "w-fit", "px-4", "py-2", "flex", "items-center", "gap-2", "duration-150", "ease-in-out", "border-primary", "hover:bg-transparent", "hover:scale-105", "active:opacity-50", "active:scale-95", "disabled:hover:scale-100", "disabled:active:scale-100", "disabled:opacity-40");
    root.textContent = questionNumber.toString();

    return root;
}