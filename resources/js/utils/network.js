'use strict';

import notify from './toast.js';

/**
 * A function to make requests using axios with error handling
 * 
 * @param {CallableFunction} reqMethod - Axios method for requesting to a server
 */
export function request(reqMethod) {
    try {
        reqMethod();
    } catch (error) {
        /** @type {import('axios').AxiosError} */
        // @ts-ignore
        const axiosError = error;

        if (axiosError.response) {
            console.error(
                `Server Error: ${axiosError.response.status}`,
                axiosError.response.data
            );
            notify("error", "Terjadi kesalahan pada server!", 3000);
        } else if (axiosError.request) {
            console.error(
                "Network Error: No response received",
                axiosError.request
            );
            notify("error", "Tidak ada respons dari server, coba lagi!", 3000);
        } else {
            console.error("Request Error:", axiosError.message);
            notify("error", "Terjadi kesalahan saat mengirim permintaan!", 3000);
        }
    }
}