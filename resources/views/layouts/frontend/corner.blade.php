<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @foreach($users as $item)
    <title>{{$item->institute_name}}</title>
    @endforeach
    <link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.2/owl.carousel.css" rel="stylesheet" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ asset('css/frontend.css') }}" rel="stylesheet">
    <!-- Styles -->
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%
        }

        body {
            margin: 0
        }

        a {
            background-color: transparent
        }

        [hidden] {
            display: none
        }

        html {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5
        }

        *,
        :after,
        :before {
            box-sizing: border-box;
            border: 0 solid #e2e8f0
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        svg,
        video {
            display: block;
            vertical-align: middle
        }

        video {
            max-width: 100%;
            height: auto
        }

        .bg-white {
            --bg-opacity: 1;
            background-color: #fff;
            background-color: rgba(255, 255, 255, var(--bg-opacity))
        }

        .bg-gray-100 {
            --bg-opacity: 1;
            background-color: #f7fafc;
            background-color: rgba(247, 250, 252, var(--bg-opacity))
        }

        .border-gray-200 {
            --border-opacity: 1;
            border-color: #edf2f7;
            border-color: rgba(237, 242, 247, var(--border-opacity))
        }

        .border-t {
            border-top-width: 1px
        }

        .flex {
            display: flex
        }

        .grid {
            display: grid
        }

        .hidden {
            display: none
        }

        .items-center {
            align-items: center
        }

        .justify-center {
            justify-content: center
        }

        .font-semibold {
            font-weight: 600
        }

        .h-5 {
            height: 1.25rem
        }

        .h-8 {
            height: 2rem
        }

        .h-16 {
            height: 4rem
        }

        .text-sm {
            font-size: .875rem
        }

        .text-lg {
            font-size: 1.125rem
        }

        .leading-7 {
            line-height: 1.75rem
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .ml-1 {
            margin-left: .25rem
        }

        .mt-2 {
            margin-top: .5rem
        }

        .mr-2 {
            margin-right: .5rem
        }

        .ml-2 {
            margin-left: .5rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .ml-4 {
            margin-left: 1rem
        }

        .mt-8 {
            margin-top: 2rem
        }

        .ml-12 {
            margin-left: 3rem
        }

        .-mt-px {
            margin-top: -1px
        }

        .max-w-6xl {
            max-width: 72rem
        }

        .min-h-screen {
            min-height: 100vh
        }

        .overflow-hidden {
            overflow: hidden
        }

        .p-6 {
            padding: 1.5rem
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .pt-8 {
            padding-top: 2rem
        }

        .fixed {
            position: fixed
        }

        .relative {
            position: relative
        }

        .top-0 {
            top: 0
        }

        .right-0 {
            right: 0
        }

        .shadow {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06)
        }

        .text-center {
            text-align: center
        }

        .text-gray-200 {
            --text-opacity: 1;
            color: #edf2f7;
            color: rgba(237, 242, 247, var(--text-opacity))
        }

        .text-gray-300 {
            --text-opacity: 1;
            color: #e2e8f0;
            color: rgba(226, 232, 240, var(--text-opacity))
        }

        .text-gray-400 {
            --text-opacity: 1;
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--text-opacity))
        }

        .text-gray-500 {
            --text-opacity: 1;
            color: #a0aec0;
            color: rgba(160, 174, 192, var(--text-opacity))
        }

        .text-gray-600 {
            --text-opacity: 1;
            color: #718096;
            color: rgba(113, 128, 150, var(--text-opacity))
        }

        .text-gray-700 {
            --text-opacity: 1;
            color: #4a5568;
            color: rgba(74, 85, 104, var(--text-opacity))
        }

        .text-gray-900 {
            --text-opacity: 1;
            color: #1a202c;
            color: rgba(26, 32, 44, var(--text-opacity))
        }

        .underline {
            text-decoration: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .w-5 {
            width: 1.25rem
        }

        .w-8 {
            width: 2rem
        }

        .w-auto {
            width: auto
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr))
        }

        @media (min-width:640px) {
            .sm\:rounded-lg {
                border-radius: .5rem
            }

            .sm\:block {
                display: block
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-start {
                justify-content: flex-start
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:h-20 {
                height: 5rem
            }

            .sm\:ml-0 {
                margin-left: 0
            }

            .sm\:px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem
            }

            .sm\:pt-0 {
                padding-top: 0
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width:768px) {
            .md\:border-t-0 {
                border-top-width: 0
            }

            .md\:border-l {
                border-left-width: 1px
            }

            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }
        }

        @media (min-width:1024px) {
            .lg\:px-8 {
                padding-left: 2rem;
                padding-right: 2rem
            }
        }

        @media (prefers-color-scheme:dark) {
            .dark\:bg-gray-800 {
                --bg-opacity: 1;
                background-color: #2d3748;
                background-color: rgba(45, 55, 72, var(--bg-opacity))
            }

            .dark\:bg-gray-900 {
                --bg-opacity: 1;
                background-color: #1a202c;
                background-color: rgba(26, 32, 44, var(--bg-opacity))
            }

            .dark\:border-gray-700 {
                --border-opacity: 1;
                border-color: #4a5568;
                border-color: rgba(74, 85, 104, var(--border-opacity))
            }

            .dark\:text-white {
                --text-opacity: 1;
                color: #fff;
                color: rgba(255, 255, 255, var(--text-opacity))
            }

            .dark\:text-gray-400 {
                --text-opacity: 1;
                color: #cbd5e0;
                color: rgba(203, 213, 224, var(--text-opacity))
            }

            .dark\:text-gray-500 {
                --tw-text-opacity: 1;
                color: #6b7280;
                color: rgba(107, 114, 128, var(--tw-text-opacity))
            }
        }
    </style>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="antialiased">
    @include('layouts.frontend.header')
    <section id="corner">
        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-md-10 offset-md-1 wow sobornojointy " style="background:#fff">
                    <div id="leftcolumn" style="text-align:justify; font-size:15px; color:#000; padding:10px; background:#F1F8E9;border-radius:3px">
                        <table class="table table-bordered sjointy sj">
                            <tbody>
                                <tr>
                                    <td><img src="{{asset('images/shuborno/sobornojointy.png')}}" alt="About College" class="lightborder image-left" width="50%"></td>
                                    <td>
                                        <h3> স্বাধীনতার সুবর্ণজয়ন্তী কর্নার</h3>
                                        বাংলাদেশের স্বাধীনতা ও বিজয় অর্জনের ৫০ বছর পূর্তি
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered sjointy">

                            <tbody>
                                <tr>
                                    <td>
                                        <h3>জাতির জনক বঙ্গবন্ধু শেখ মুজিবুর রহমান</h3>
                                        <img src="{{asset('images/shuborno/1.jpg')}}" alt="sobornojointy" class="lightborder image-left" width="100%">
                                    </td>
                                    <td style="">
                                        <h3>বঙ্গবন্ধু শেখ মুজিবুর রহমানের সংক্ষিপ্ত জীবনী</h3>
                                        জাতির জনক বঙ্গবন্ধু শেখ মুজিবুর রহমান ফরিদপুর জেলার গোপালগঞ্জ মহকুমার (বর্তমানে জেলা) টুঙ্গিপাড়া গ্রামে এক সম্ভ্রান্ত মুসলিম পরিবারে ১৯২০ সালের ১৭ মার্চ জন্মগ্রহণ করেন। শেখ লুৎফর রহমান ও মোসাম্মৎ সাহারা খাতুনের চার কন্যা ও দুই পুত্রের মধ্যে তৃতীয় সন্তান শেখ মুজিব। বাবা-মা ডাকতেন খোকা বলে। খোকার শৈশবকাল কাটে টুঙ্গি-পাড়ায়।
                                        ৭ বছর বয়সে গিমাডাঙ্গা প্রাইমারি স্কুলে পড়াশোনা শুরু করেন। নয় বছর বয়সে গোপালগঞ্জ পাবলিক স্কুলে তৃতীয় শ্রেণীতে ভর্তি হন। পরে তিনি স্থানীয় মিশনারি স্কুলে ভর্তি হন।
                                        ১৪ বছর বয়সে বেরিবেরি রোগে আক্রান্ত হলে তার একটি চোখ কলকাতায় অপারেশন করা হয় এবং চক্ষুরোগের কারণে তার লেখাপড়ার সাময়িক বিরতি ঘটে।
                                        চক্ষুরোগে চার বছর শিক্ষাজীবন ব্যাহত হওয়ার পর শেখ মুজিব পুনরায় স্কুলে ভর্তি হন।
                                        ১৮ বছর বয়সে বঙ্গবন্ধু ও বেগম ফজিলাতুন্নেছা আনুষ্ঠানিক বিয়ে সম্পন্ন হয়। তারা দুই কন্যা শেখ হাসিনা, শেখ রেহানা ও তিন পুত্র শেখ কামাল, শেখ জামাল ও শেখ রাসেল এর জনক-জননী।
                                        অবিভক্ত বাংলার মুখ্যমন্ত্রী শেরে বাংলা এ কে ফজলুল হক এবং হোসেন শহীদ সোহরাওয়ার্দী গোপালগঞ্জ মিশনারি স্কুল পরিদর্শনে এলে বঙ্গবন্ধু স্কুলের ছাদ দিয়ে পানি পড়ত তা সারাবার জন্য ও ছাত্রাবাসের দাবি স্কুল ছাত্রদের পক্ষ থেকে তুলে ধরেন।
                                        শেখ মুজিব নিখিল ভারত মুসলিম ছাত্র ফেডারেশনে যোগদান করেন এবং এক বছরের জন্য বেঙ্গল মুসলিম ছাত্র ফেডারেশনের কাউন্সিলর নির্বাচিত হন। তাকে গোপালগঞ্জ মুসলিম ডিফেন্স কমিটির সেক্রেটারি নিযুক্ত করা হয়।
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color:#004d40">
                                        <h3>ঐতিহাসিক ৭ মার্চ এর ভাষণ</h3>
                                        ৭ মার্চ রেসকোর্স ময়দানে (বর্তমানে সোহরাওয়ার্দী উদ্যান) সমবেত জনসমুদ্রে জাতির উদ্দেশে ঐতিহাসিক ভাষণ দেন বঙ্গবন্ধু। তাঁর এই ভাষণ জাতিকে অনুপ্রাণিত করে স্বাধীনতার জন্য সশস্ত্র মুক্তিযুদ্ধে ঝাঁপিয়ে পড়তে। ২০১৭ সালে ইউনেস্কো এই ঐতিহাসিক ভাষণকে বিশ্বের গুরুত্বপূর্ণ প্রামাণ্য ঐতিহ্য হিসেবে স্বীকৃতি দিয়েছে। ৭ মার্চ রেসকোর্সের জনসমুদ্র থেকে বঙ্গবন্ধু শেখ মুজিবুর রহমান ঘোষণা করেন ‘এবারের সংগ্রাম আমাদের মুক্তির সংগ্রাম, এবারের সংগ্রাম স্বাধীনতার সংগ্রাম, জয় বাংলা’। ঐতিহাসিক ভাষণে জাতির জনক বঙ্গবন্ধু বাঙালি জাতিকে শৃঙ্খল মুক্তির আহ্বান জানিয়ে ঘোষণা করেন, “রক্ত যখন দিয়েছি রক্ত আরও দেবো। এদেশের মানুষকে মুক্ত করে ছাড়বো ইনশাআল্লাহ্।”
                                    </td>
                                    <td>
                                        <img src="{{asset('images/shuborno/2.jpg')}}" alt="sobornojointy" class="lightborder image-left" width="100%">
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <img src="{{asset('images/shuborno/3.jpg')}}" alt="sobornojointy" class="lightborder image-left" width="100%">
                                    </td>
                                    <td>
                                        <h3>বাংলাদেশ উন্নয়নশীল দেশ</h3>
                                        মাননীয় প্রধানমন্ত্রী শেখ হাসিনা ২০২১ সালের মধ্যে বাংলাদেশকে একটি মধ্যম আয়ের দেশে এবং ২০৪১ সালের মধ্যে একটি উন্নত সমৃদ্ধ দেশে রূপান্তরিত করার স্বপ্ন দেখেছেন। ১৯৭৫ সাল থেকে স্বল্পোন্নত দেশের কাতারে থাকা বাংলাদেশ উন্নয়নশীল দেশে উত্তরণে সিডিপির সব শর্ত পূরণ করে ২০১৮ সালে৷ সিডিপির তিনটি সূচকেই বাংলাদেশ শর্ত পূরণ করে অনেক এগিয়ে গেছে৷ উন্নয়নশীল দেশ হতে মাথাপিছু আয় হতে হয় কমপক্ষে ১২৩০ মার্কিন ডলার, ২০২০ সালে বাংলাদেশের মাথাপিছু আয় ছিল ১৮২৭ ডলার৷ মানবসম্পদ সূচকে উন্নয়নশীল দেশ হতে ৬৬ পয়েন্টের প্রয়োজন; বাংলাদেশের পয়েন্ট ২০২০ সালে ছিল ৭৫.৩ ৷ অর্থনৈতিক ভঙ্গুরতা সূচকে কোনো দেশের পয়েন্ট ৩৬ এর বেশি হলে সেই দেশকে এলডিসিভুক্ত রাখা হয়, ৩২ এ আসার পর উন্নয়নশীল দেশের যোগ্যতা অর্জন হয় সেখানে বাংলাদেশের পয়েন্ট ২৫ দশমিক ২ ৷
                                    </td>
                                </tr>

                                <tr>
                                    <td style="color:#004d40">
                                        <h3>বঙ্গবন্ধু স্যাটেলাইট</h3>
                                        বাংলাদেশের জন্য অত্যন্ত গৌরবময় এই ঘটনার সাক্ষী দেশের মানুষদের উৎসাহের শেষ নেই।ফ্লোরিডার স্থানীয় সময় ১০ মে স্পেসএক্স এর যান্ত্রিক ত্রুটির কারণে বঙ্গবন্ধু-১ স্যাটেলাইট একদিন পিছিয়ে ১১ মে ফ্লোরিডার স্থানীয় সময় বিকেল ২টার দিকে উৎক্ষেপিত হয়। বাংলাদেশ সময় ১২মে ২০১৮ (অথবা ১১মে শুক্রবার দিবাগত) রাত ২টা ১৪ মিনিটে যুক্তরাষ্ট্রের ফ্লোরিডার কেনেডি স্পেস সেন্টার থেকে বঙ্গবন্ধু-১ স্যাটেলাইটটি সফলভাবে উৎক্ষেপণ করা হয়। উৎক্ষেপণের ৩৩ মিনিট ৪৭ সেকেন্ডে বঙ্গবন্ধু-১ স্যাটেলাইট পৌঁছে যায় জিওস্টেশনারি ট্রান্সফার অরবিটে।
                                    </td>
                                    <td>
                                        <img src="{{asset('images/shuborno/4.jpg')}}" alt="sobornojointy" class="lightborder image-left" width="100%">
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <img src="{{asset('images/shuborno/7.jpg')}}" alt="sobornojointy" class="lightborder image-left" width="100%">
                                    </td>
                                    <td>
                                        <h3>বাংলাদেশ উন্নয়নের রোল মডেল</h3>
                                        বাংলাদেশ এখন দক্ষিণ এশিয়ার উন্নয়নের রোল মডেল। অদম্য গতিতে এগিয়ে যাচ্ছে বিজয়ের সুবর্ণজয়ন্তী উদ্যাপন করা বাংলাদেশটি। অল্প সময়ের মধ্যে প্রতিবেশী ভারত ও পাকিস্তানের চেয়ে সব ধরনের সূচকে এগিয়ে রয়েছে দেশটি। স্বাধীনতার পূর্বে বাংলাদেশে কাজ করা বর্তমানে পাকিস্তানের প্রধানমন্ত্রী ইমরান খানের প্রাতিষ্ঠানিক সংস্কার ও নীতিবিষয়ক উপদেষ্টা ইশরাত হুসাইন এক নিবন্ধে এই তথ্য লিখেছেন। মুক্তিযুদ্ধের আগে বাংলাদেশের পটুয়াখালী, চট্টগ্রাম ও ঢাকায় কর্মরত ছিলেন তিনি। তার লেখা ‘বাংলাদেশের গল্প’ শিরোনামে একটি নিবন্ধ প্রকাশ করেছে পাকিস্তানী দৈনিক ডন। ডন পত্রিকার নিবন্ধে তিনি বলেছেন, বাংলাদেশের জাতীয় আয় ৫০ গুণ, মাথাপিছু আয় ২৫ গুণ (ভারত ও পাকিস্তানের চেয়ে বেশি) এবং খাদ্য উৎপাদন চার গুণ বেড়েছে। ১৯৯০ সালের তুলনায় রফতানি ১০০ গুণ বেড়েছে এবং দারিদ্র্য ৬০ থেকে নেমে ২০ শতাংশে এসেছে। প্রত্যাশিত গড় আয়ু বেড়ে ৭২ হয়েছে।
                                    </td>
                                </tr>

                                <tr>
                                    <td style="color:#004d40">
                                        <h3>স্বাধীনতার ৫০ বছরে অর্জনের বাংলাদেশ</h3>
                                        স্বাধীন বাংলাদেশের ৫০ বছরে বাঙালি বিশ্বের কাছে আত্মমর্যাদাশীল, আত্মপ্রত্যয়ী ও উন্নয়ন যাত্রাপথে সাফল্য অর্জনের কঠোর সংগ্রামে অবিচল জাতি হিসেবে নিজেদের পরিচয় প্রতিষ্ঠা করেছে। বাংলাদেশের উন্নয়নের যে ডাইমেনশনগুলো বিশ্বের প্রশংসা অর্জন করেছে সেগুলো হলো, বাংলাদেশের জিডিপির প্রবৃদ্ধির হার ২০১৮- অর্থবছরে ৮ দশমিক ১৫ শতাংশে পৌঁছে গিয়েছিল। করোনাভাইরাস মহামারীর আঘাতে ২০১৯-২০ অর্থবছরে প্রবৃদ্ধির হার ৩ দশমিক ৮ শতাংশে নেমে গেলেও বাংলাদেশের মাথাপিছু জিএনআই ২০১৯ অর্থবছরের ১ হাজার ৯০৯ ডলার থেকে বেড়ে ২০২১ সালের ৩০ জুন ২ হাজার ৫৫৪ ডলারে পৌঁছেছে বলে প্রাক্কলিত হয়েছে।
                                    </td>
                                    <td>
                                        <img src="{{asset('images/shuborno/6.jpg')}}" alt="sobornojointy" class="lightborder image-left" width="100%">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('layouts.frontend.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.2/owl.carousel.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/frontend.js') }}" defer></script>

</body>

</html>