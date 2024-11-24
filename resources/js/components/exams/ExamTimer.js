/**
 * The component responsible for displaying the current exam time
 * 
 * @returns HTMLSpanElement
 */
export default function ExamTimer() {
    const root = document.createElement("span");
    root.className = "font-semibold px-2 py-1 rounded-lg bg-gray-100 text-black w-20 text-center";
    root.id = "examTimer";
    root.textContent = "00:00:00";

    return root
}