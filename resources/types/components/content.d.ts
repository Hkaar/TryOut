declare namespace Components.Content {
    interface ImageProps extends Components.HTMLElementProps {
        src: string,
        srcset?: string,
        alt: string,
        loading?: "lazy" | "eager",
    }
}