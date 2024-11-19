/**
 * Get the local system timezone
 */
export function getTimeZone() {
    return Intl.DateTimeFormat().resolvedOptions().timeZone;
}

/**
 * Converts the given utc time to the local system time
 * 
 * @param {string} time 
 */
export function UTCtoLocal(time) {
    const date = new Date(time + 'UTC');
    return date.toLocaleString("fr", { timeZone: getTimeZone() });
}

/**
 * Converts a given UTC time to the local system time and returns it in the required format
 * for an HTML <input type="datetime-local">
 * 
 * @param {string} utcTime - The UTC time string (e.g., "2024-11-18T14:00:00Z")
 * @returns {string} - The local time formatted as 'YYYY-MM-DDTHH:mm'
 */
export function UTCtoLocalForInput(utcTime) {
    const date = new Date(utcTime); 

    const timezoneOffset = date.getTimezoneOffset();
    date.setMinutes(date.getMinutes() - timezoneOffset)

    const localDate = new Date(date.toLocaleString("en-US", { timeZone: getTimeZone() }));

    const year = localDate.getFullYear();
    const month = String(localDate.getMonth() + 1).padStart(2, '0');  
    const day = String(localDate.getDate()).padStart(2, '0'); 
    const hours = String(localDate.getHours()).padStart(2, '0');
    const minutes = String(localDate.getMinutes()).padStart(2, '0');

    return `${year}-${month}-${day}T${hours}:${minutes}`;
}

/**
 * Convienient setup wrapper for automatic timezone changes 
 * from UTC to other timezones and vice-versa
 */
export function setupAutoTimezone() {
    document.querySelectorAll('input[name="timezone"]').forEach((e) => {
        if (e instanceof HTMLInputElement) {
            e.value = getTimeZone();
        }
    });

    document.querySelectorAll('[timezone-change]').forEach((e) => {
        if (e instanceof HTMLInputElement && e.type == "datetime-local") {
            console.log(e.value, UTCtoLocalForInput(e.value))
            e.value = UTCtoLocalForInput(e.value);
            return;
        }

        if (e.textContent != null) {
            e.textContent = UTCtoLocal(e.textContent);
        }
    });
}