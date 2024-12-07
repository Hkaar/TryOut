declare namespace Components {
    interface HTMLElementProps {
        id?: string;
        className?: string;
    }

    interface ButtonProps extends HTMLElementProps {
        type?: "button" | "reset" | "submit";
        disabled?: boolean;
    }

    interface LinkButtonProps extends HTMLElementProps {
        href: string;
    }
}
