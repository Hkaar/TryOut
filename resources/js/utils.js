/**
 * Clears the node tree of an element
 * 
 * @param {Element} element 
 */
export function clearNodeTree(element) {
    while (element.firstChild) {
        element.removeChild(element.firstChild);
    }

    return true;
}

/**
 * Generates a random hexadecimal uuid using the crypto api
 */
export function uuid() {
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, (c) => {
        const r = crypto.getRandomValues(new Uint8Array(1))[0] % 16 | 0; 
        const v = c === 'x' ? r : (r & 0x3 | 0x8); 
        
        return v.toString(16);
    });
}

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
        if (e instanceof HTMLInputElement) {
            e.value = UTCtoLocal(e.value);
            return;
        }

        if (e.textContent != null) {
            e.textContent = UTCtoLocal(e.textContent);
        }
    });
}
