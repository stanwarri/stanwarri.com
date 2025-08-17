@extends('layouts.app')

@section('content')
<!-- Main Content Grid -->
<div class="mx-auto max-w-7xl lg:px-8">
    <div class="relative px-4 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-2xl lg:max-w-5xl">
            <div class="mt-16 sm:mt-20 grid grid-cols-1 gap-y-16 lg:grid-cols-2 lg:grid-rows-[auto_1fr] lg:gap-y-12">
                <!-- Portrait -->
                <div class="lg:pl-20">
                    <div class="max-w-xs px-2.5 lg:max-w-none">
                        <img src="{{ asset('image/profile.png') }}" alt="Stanley Ojadovwa" sizes="(min-width: 1024px) 32rem, 20rem" class="aspect-square rotate-3 rounded-2xl bg-zinc-100 object-cover dark:bg-zinc-800">
                    </div>

                    <!-- Social Links -->
                    <div class="mt-6 flex flex-col gap-y-4 lg:mt-8">
                        <a class="group flex text-sm font-medium text-zinc-800 transition hover:text-teal-500 dark:text-zinc-200 dark:hover:text-teal-400" href="https://x.com/stanwarri">
                            <svg viewBox="0 0 24 24" aria-hidden="true" class="h-6 w-6 flex-none fill-zinc-500 transition group-hover:fill-teal-500">
                                <path d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                            <span class="ml-4">Follow on X</span>
                        </a>

                        <a class="group flex text-sm font-medium text-zinc-800 transition hover:text-teal-500 dark:text-zinc-200 dark:hover:text-teal-400" href="https://www.instagram.com/stanwarri">
                            <svg viewBox="0 0 24 24" aria-hidden="true" class="h-6 w-6 flex-none fill-zinc-500 transition group-hover:fill-teal-500">
                                <path d="M12 3c-2.444 0-2.75.01-3.71.054-.959.044-1.613.196-2.185.418A4.412 4.412 0 0 0 4.51 4.511c-.5.5-.809 1.002-1.039 1.594-.222.572-.374 1.226-.418 2.184C3.01 9.25 3 9.556 3 12s.01 2.75.054 3.71c.044.959.196 1.613.418 2.185.23.592.538 1.094 1.039 1.595.5.5 1.002.808 1.594 1.038.572.222 1.226.374 2.184.418C9.25 20.99 9.556 21 12 21s2.75-.01 3.71-.054c.959-.044 1.613-.196 2.185-.419a4.412 4.412 0 0 0 1.595-1.038c.5-.5.808-1.002 1.038-1.594.222-.572.374-1.226.418-2.184.044-.96.054-1.267.054-3.711s-.01-2.75-.054-3.71c-.044-.959-.196-1.613-.419-2.185A4.412 4.412 0 0 0 19.49 4.51c-.5-.5-1.002-.809-1.594-1.039-.572-.222-1.226-.374-2.184-.418C14.75 3.01 14.444 3 12 3Zm0 1.622c2.403 0 2.688.009 3.637.052.877.04 1.354.187 1.671.31.421.163.72.358 1.036.673.315.315.51.615.673 1.035.123.317.27.794.31 1.671.043.95.052 1.234.052 3.637s-.009 2.688-.052 3.637c-.04.877-.187 1.354-.31 1.671-.163.421-.358.72-.673 1.036a2.79 2.79 0 0 1-1.035.673c-.317.123-.794.27-1.671.31-.95.043-1.234.052-3.637.052s-2.688-.009-3.637-.052c-.877-.04-1.354-.187-1.671-.31a2.79 2.79 0 0 1-1.035-.673 2.79 2.79 0 0 1-.673-1.036c-.123-.317-.27-.794-.31-1.671C4.631 14.688 4.622 14.403 4.622 12s.009-2.688.052-3.637c.04-.877.187-1.354.31-1.671.163-.421.358-.72.673-1.035.315-.315.615-.51 1.035-.673.317-.123.794-.27 1.671-.31.95-.043 1.234-.052 3.637-.052Z"/>
                                <path d="M12 15a3 3 0 1 1 0-6 3 3 0 0 1 0 6Zm0-7.622a4.622 4.622 0 1 0 0 9.244 4.622 4.622 0 0 0 0-9.244Zm5.884-.182a1.08 1.08 0 1 1-2.16 0 1.08 1.08 0 0 1 2.16 0Z"/>
                            </svg>
                            <span class="ml-4">Follow on Instagram</span>
                        </a>

                        <a class="group flex text-sm font-medium text-zinc-800 transition hover:text-teal-500 dark:text-zinc-200 dark:hover:text-teal-400" href="https://stanwarri.substack.com">
                            <svg viewBox="0 0 24 24" aria-hidden="true" class="h-6 w-6 flex-none fill-zinc-500 transition group-hover:fill-teal-500">
                                <path d="M22.539 8.242H1.46V5.406h21.08v2.836zM1.46 10.812V24L12 18.11 22.539 24V10.812H1.46zM22.539 0H1.46v2.836h21.08V0z"/>
                            </svg>
                            <span class="ml-4">Follow on Substack</span>
                        </a>

                        <a class="group flex text-sm font-medium text-zinc-800 transition hover:text-teal-500 dark:text-zinc-200 dark:hover:text-teal-400" href="https://www.linkedin.com/in/stanwarri/">
                            <svg viewBox="0 0 24 24" aria-hidden="true" class="h-6 w-6 flex-none fill-zinc-500 transition group-hover:fill-teal-500">
                                <path fill-rule="evenodd" d="M16.338 16.338H13.67V12.16c0-.995-.017-2.277-1.387-2.277-1.39 0-1.601 1.086-1.601 2.207v4.248H8.014v-8.59h2.559v1.174h.037c.356-.675 1.227-1.387 2.526-1.387 2.703 0 3.203 1.778 3.203 4.092v4.711zM5.005 6.575a1.548 1.548 0 11-.003-3.096 1.548 1.548 0 01.003 3.096zm-1.337 9.763H6.34v-8.59H3.667v8.59zM17.668 1H2.328C1.595 1 1 1.581 1 2.298v15.403C1 18.418 1.595 19 2.328 19h15.34c.734 0 1.332-.582 1.332-1.299V2.298C19 1.581 18.402 1 17.668 1z" clip-rule="evenodd" />
                            </svg>
                            <span class="ml-4">Follow on LinkedIn</span>
                        </a>

                        <a class="group flex text-sm font-medium text-zinc-800 transition hover:text-teal-500 dark:text-zinc-200 dark:hover:text-teal-400" href="mailto:stanley.warri@gmail.com">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="h-6 w-6 flex-none fill-zinc-500 transition group-hover:fill-teal-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.32 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            <span class="ml-4">stanley.warri@gmail.com</span>
                        </a>
                    </div>
                </div>

                <!-- Content -->
                <div class="lg:order-first lg:row-span-2">
                    <h1 class="text-4xl font-bold tracking-tight text-zinc-800 dark:text-zinc-100 sm:text-5xl">
                        Stanley Ojadovwa
                    </h1>
                    <div class="mt-12 space-y-7 text-base text-zinc-600 dark:text-zinc-400">
                        <p>
                            I’m a product leader with over a decade of experience building and scaling
                            technology products across fintech, e-commerce, education and infrastructure. Over the years I’ve
                            co-founded products like PayFlexi (flexible payments for merchants) and Codulab, and I currently work
                            with teams as Fractional CPO/CTO — helping them shape product strategy, build high-performing teams
                            and bring meaningful products to market.
                        </p>
                        <p>
                            I didn’t set out to become a “product person”. I simply enjoyed solving problems — especially the kind
                            that required both a technical understanding and a deep empathy for people. Over the years that
                            curiosity has taken me from engineering school to building, leading and scaling products for
                            early-stage startups and fast-growing teams.
                        </p>
                        <p>
                            When I’m not doing client work, I’m usually tinkering with SaaS tools like <strong>FilamentApps</strong>
                            and <strong>Prodstarter</strong>, exploring ways to make life easier for other builders in the Laravel
                            and FilamentPHP ecosystem.
                        </p>
                        <p>
                            Outside of work, you’ll probably find me somewhere between a good board game session (Monopoly is
                            still undefeated), watching my favourite football team — Barca — play, a book in one hand and great conversations about my christian faith. I strongly
                            believe that life — and great products — are built one thoughtful decision at a time.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Newsletter Section -->
<div class="mt-24 py-16 bg-zinc-50 dark:bg-zinc-900">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <div class="flex justify-center">
                <iframe src="https://stanwarri.substack.com/embed" width="100%" height="320" style="border:1px solid #EEE; background:white;" frameborder="0" scrolling="no"></iframe>
            </div>
        </div>
    </div>
</div>

@endsection
