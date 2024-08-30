<div class="dark:text-gray-200">
    <x-markdown class="waiit-theme">
        {!! $faq->answer  !!}
    </x-markdown>
</div>

<style>
    .waiit-theme p {
        line-height: 1.75rem;
    }

    /* Headings */
    .waiit-theme h1 {
        font-size: 2em;
        margin: 0.67em 0;
        font-weight: bold;
    }

    .waiit-theme h2 {
        font-size: 1.5em;
        margin: 0.75em 0;
        font-weight: bold;
    }

    /* Bold text */
    .waiit-theme strong {
        font-weight: bold;
    }

    /* Italic text */
    .waiit-theme em {
        font-style: italic;
    }

    /* Unordered list */
    .waiit-theme ul {
        list-style-type: disc;
        margin-left: 2em;
    }

    /* Ordered list */
    .waiit-theme ol {
        list-style-type: decimal;
        margin-left: 2em;
    }

    /* Blockquote */
    .waiit-theme blockquote {
        margin: 1em 2em;
        padding-left: 1em;
        border-left: 5px solid #ccc;
        color: #666;
        font-style: italic;
    }

    /* Links */

    .waiit-theme a {
        color: #2563eb; /* Blue 600 */
        text-decoration: none;
    }

    .waiit-theme a:hover {
        color: #60a5fa; /* Blue 400 */
    }

    .waiit-theme a:visited {
        color: #7c3aed; /* Purple 600 */
    }
</style>
