declare namespace Components.Form {
    interface RadioInputProps extends Components.HTMLElementProps {
        name: string;
        value?: string;
        checked?: boolean;
    }

    interface LabelProps extends Components.HTMLElementProps {
        htmlFor?: string;
    }

    interface TextAreaProps extends Components.HTMLElementProps {
        rows?: number;
        cols?: number;
        name: string;
        placeholder?: string;
    }
}
