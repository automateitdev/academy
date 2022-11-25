<style>
    HTML CSS Result Skip Results Iframe * {
        border: 0;
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .mainloader{
        position: absolute;
        width: 100vw;
        height: 100vh;
        text-align: center;
        margin: 0 auto;
        left: 0;
        top: 0;
        z-index: 3000;
        background-color: rgba(0,0,0,0.8);
        overflow: hidden;
    }

    main {
        padding: 1.5em 0;
        position: absolute;
margin: 0 auto;
width: 100%;
height: 100%;
top: 40vh;
    }

    .lp {
        width: 8em;
        height: 8em;
    }

    .lp__drops,
    .lp__fall-line,
    .lp__worm {
        animation-duration: 4s;
        animation-iteration-count: infinite;
        transform-origin: 64px 64px;
    }

    .lp__drops {
        animation-name: drops;
        animation-timing-function: ease-in-out;
        stroke-dasharray: 22 307.85 22;
        visibility: hidden;
        transform: rotate(90deg);
    }

    .lp__fall-line {
        animation-name: fallLine1;
        animation-timing-function: ease-in;
        stroke-dasharray: 1 112;
        stroke-dashoffset: 114;
    }

    .lp__fall-line--delay1 {
        animation-name: fallLine2;
    }

    .lp__fall-line--delay2 {
        animation-name: fallLine3;
    }

    .lp__fall-line--delay3 {
        animation-name: fallLine4;
    }

    .lp__fall-line--delay4 {
        animation-name: fallLine5;
    }

    .lp__ring {
        stroke: hsla(var(--hue), 90%, 5%, 0.1);
        transition: stroke 0.3s;
    }

    .lp__worm {
        animation-name: worm;
        stroke-dasharray: 43.98 307.87;
        stroke-dashoffset: -131.94;
        transform: rotate(-90deg);
    }

    /* Dark theme */
    @media (prefers-color-scheme: dark) {
        :root {
            --bg: hsl(var(--hue), 90%, 5%);
            --fg: hsl(var(--hue), 90%, 95%);
        }

        .lp__ring {
            stroke: hsla(var(--hue), 90%, 95%, 0.1);
        }
    }

    /* Animtions */
    @keyframes drops {
        from {
            animation-timing-function: steps(1, end);
            stroke-dasharray: 0 351.85 0;
            visibility: hidden;
        }

        25% {
            animation-timing-function: ease-in-out;
            stroke-dasharray: 0 351.85 0;
            visibility: visible;
        }

        26% {
            stroke-dasharray: 4 343.85 4;
        }

        27% {
            stroke-dasharray: 8 335.85 8
        }

        28% {
            stroke-dasharray: 12 327.85 12;
        }

        29% {
            animation-timing-function: ease-in;
            stroke-dasharray: 17 317.85 17;
        }

        32% {
            animation-timing-function: ease-out;
            stroke-dasharray: 25 301.85 25;
        }

        35%,
        47.5% {
            animation-timing-function: linear;
            stroke-dasharray: 22 307.85 22;
            visibility: visible;
        }

        50% {
            animation-timing-function: steps(1, end);
            stroke-dasharray: 0 307.85 43.98;
            visibility: hidden;
        }

        75% {
            animation-timing-function: ease-in-out;
            stroke-dasharray: 0 351.85 0;
            visibility: visible;
        }

        76% {
            stroke-dasharray: 4 343.85 4;
        }

        77% {
            stroke-dasharray: 8 335.85 8
        }

        78% {
            stroke-dasharray: 12 327.85 12;
        }

        79% {
            animation-timing-function: ease-in;
            stroke-dasharray: 17 317.85 17;
        }

        82% {
            animation-timing-function: ease-out;
            stroke-dasharray: 25 301.85 25;
        }

        85%,
        97.5% {
            animation-timing-function: linear;
            stroke-dasharray: 22 307.85 22;
            visibility: visible;
        }

        to {
            stroke-dasharray: 43.98 307.85 0;
            visibility: hidden;
        }
    }

    @keyframes fallLine1 {

        from,
        15% {
            stroke-dashoffset: 114;
        }

        25%,
        65% {
            stroke-dashoffset: 1;
        }

        75%,
        to {
            stroke-dashoffset: -112;
        }
    }

    @keyframes fallLine2 {

        from,
        16% {
            stroke-dashoffset: 114;
        }

        26%,
        66% {
            stroke-dashoffset: 1;
        }

        76%,
        to {
            stroke-dashoffset: -112;
        }
    }

    @keyframes fallLine3 {

        from,
        17% {
            stroke-dashoffset: 114;
        }

        27%,
        67% {
            stroke-dashoffset: 1;
        }

        77%,
        to {
            stroke-dashoffset: -112;
        }
    }

    @keyframes fallLine4 {

        from,
        18% {
            stroke-dashoffset: 114;
        }

        28%,
        68% {
            stroke-dashoffset: 1;
        }

        78%,
        to {
            stroke-dashoffset: -112;
        }
    }

    @keyframes fallLine5 {

        from,
        19% {
            stroke-dashoffset: 114;
        }

        29%,
        69% {
            stroke-dashoffset: 1;
        }

        79%,
        to {
            stroke-dashoffset: -112;
        }
    }

    @keyframes worm {
        from {
            animation-timing-function: ease-out;
            stroke-dasharray: 87.96 307.87;
            stroke-dashoffset: -131.94;
        }

        25% {
            animation-timing-function: steps(1);
            stroke-dasharray: 87.96 307.87;
            stroke-dashoffset: -307.86;
        }

        25.01% {
            animation-timing-function: ease-in;
            stroke-dasharray: 43.98 307.87;
            stroke-dashoffset: -307.86;
        }

        50% {
            animation-timing-function: steps(1);
            stroke-dasharray: 43.98 307.87;
            stroke-dashoffset: -175.92;
        }

        50.01% {
            animation-timing-function: ease-out;
            stroke-dasharray: 87.96 307.87;
            stroke-dashoffset: -131.94;
        }

        75% {
            animation-timing-function: steps(1);
            stroke-dasharray: 87.96 307.87;
            stroke-dashoffset: 43.98;
        }

        75.01% {
            animation-timing-function: ease-in;
            stroke-dasharray: 43.98 307.87;
            stroke-dashoffset: 0;
        }

        to {
            stroke-dasharray: 43.98 307.87;
            stroke-dashoffset: -131.94;
        }
    }
</style>
<main style="position: absolute;">
    <svg class="lp" viewBox="0 0 128 128" width="128px" height="128px" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <linearGradient id="grad1" x1="0" y1="0" x2="0" y2="1">
                <stop offset="0%" stop-color="#000" />
                <stop offset="100%" stop-color="#fff" />
            </linearGradient>
            <mask id="mask1">
                <rect x="0" y="0" width="128" height="128" fill="url(#grad1)" />
            </mask>
        </defs>
        <g fill="none" stroke-linecap="round" stroke-width="16">
            <circle class="lp__ring" r="56" cx="64" cy="64" stroke="#ddd" />
            <g stroke="hsl(183,90%,40%)">
                <polyline class="lp__fall-line" points="64,8 64,120" />
                <polyline class="lp__fall-line lp__fall-line--delay1" points="64,8 64,120" />
                <polyline class="lp__fall-line lp__fall-line--delay2" points="64,8 64,120" />
                <polyline class="lp__fall-line lp__fall-line--delay3" points="64,8 64,120" />
                <polyline class="lp__fall-line lp__fall-line--delay4" points="64,8 64,120" />
                <circle class="lp__drops" r="56" cx="64" cy="64" transform="rotate(90,64,64)" />
                <circle class="lp__worm" r="56" cx="64" cy="64" transform="rotate(-90,64,64)" />
            </g>
            <g stroke="hsl(93,90%,40%)" mask="url(#mask1)">
                <polyline class="lp__fall-line" points="64,8 64,120" />
                <polyline class="lp__fall-line lp__fall-line--delay1" points="64,8 64,120" />
                <polyline class="lp__fall-line lp__fall-line--delay2" points="64,8 64,120" />
                <polyline class="lp__fall-line lp__fall-line--delay3" points="64,8 64,120" />
                <polyline class="lp__fall-line lp__fall-line--delay4" points="64,8 64,120" />
                <circle class="lp__drops" r="56" cx="64" cy="64" transform="rotate(90,64,64)" />
                <circle class="lp__worm" r="56" cx="64" cy="64" transform="rotate(-90,64,64)" />
            </g>
        </g>
    </svg>
</main>