import { AxiosError } from "axios";

/**
 * A function to make requests using axios with error handling
 * 
 * @param {CallableFunction} reqMethod - Axios method for requesting to a server
 */
export function request(reqMethod) {
    try {
        reqMethod();
    } catch (error) {
        /** @type {AxiosError} */
        // @ts-ignore
        const axiosError = error;

        if (axiosError.response) {
            console.error(
                `Server Error: ${axiosError.response.status}`,
                axiosError.response.data
            );
            toastr.error("Terjadi kesalahan pada server!", "Status", {
                timeOut: 3000,
                progressBar: true,
            });
        } else if (axiosError.request) {
            console.error(
                "Network Error: No response received",
                axiosError.request
            );
            toastr.error(
                "Tidak ada respons dari server, coba lagi!",
                "Status",
                {
                    timeOut: 3000,
                    progressBar: true,
                }
            );
        } else {
            console.error("Request Error:", axiosError.message);
            toastr.error(
                "Terjadi kesalahan saat mengirim permintaan!",
                "Status",
                {
                    timeOut: 3000,
                    progressBar: true,
                }
            );
        }
    }
}