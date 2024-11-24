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
 * Clears the node tree of an element
 * 
 * @param {...Element} elements 
 */
export function clearNodeTree(...elements) {
    const clearElement = (/** @type {Element} */ el) => {
        while (el.firstChild) {
            el.removeChild(el.firstChild);
        }
    };

    if (!elements) {
        console.error("clearNodeTree call param elements was not defined!");
        return;
    }

    elements.forEach(element => {
        if (element instanceof Element) {
            clearElement(element);
        } else {
            console.error('Invalid input: Expected a DOM element');
        }
    });

    return true;
}