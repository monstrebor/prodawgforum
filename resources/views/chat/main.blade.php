<div
    class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 py-4 sm:py-6 px-2 sm:px-6 lg:px-8">


    <div class="max-w-7xl mx-auto">

        <!-- =========================================
         CHAT CONTAINER
    ========================================== -->

        <div
            class="h-[calc(100vh-2rem)] sm:h-[calc(100vh-3rem)] overflow-hidden rounded-3xl border border-white/10 bg-slate-950/70 backdrop-blur-xl shadow-2xl">

            <div class="grid h-full grid-cols-1 md:grid-cols-[320px_1fr]">


                <!-- =========================================
                 LEFT SIDE - CHAT LIST
            ========================================== -->

                <aside class="hidden md:flex flex-col border-r border-white/10 bg-slate-900/70">

                    <!-- HEADER -->

                    <div class="flex items-center justify-between px-5 py-5 border-b border-white/10">

                        <div>

                            <h1 class="text-xl font-black text-white">
                                Messages
                            </h1>

                            <p class="text-xs text-slate-500 mt-1">
                                Your conversations
                            </p>

                        </div>


                        <button type="button"
                            class="w-10 h-10 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white flex items-center justify-center transition shadow-lg shadow-indigo-900/40">
                            ✏️
                        </button>

                    </div>


                    <!-- SEARCH -->

                    <div class="p-4 border-b border-white/10">

                        <div class="relative">

                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500">
                                🔎
                            </span>

                            <input type="text" placeholder="Search conversations..."
                                class="w-full rounded-xl bg-black/30 border border-white/10 pl-11 pr-4 py-3 text-sm text-white placeholder:text-slate-500 outline-none focus:ring-2 focus:ring-indigo-500">

                        </div>

                    </div>


                    <!-- CHAT LIST -->

                    <div class="flex-1 overflow-y-auto">

                        @forelse($users as $user)

                        <button type="button"
                            class="chat-user w-full flex items-center gap-3 px-4 py-4 text-left hover:bg-white/[0.04] transition border-l-4 border-transparent"
                            data-user-id="{{ $user->id }}" data-username="{{ $user->username }}">

                            {{-- USER AVATAR --}}
                            <div class="relative flex-shrink-0">

                                <div class="w-12 h-12 rounded-full
                           bg-gradient-to-br
                           from-indigo-500
                           via-purple-500
                           to-pink-600
                           flex items-center justify-center
                           text-lg font-black text-white">

                                    {{ strtoupper(substr($user->username, 0, 1)) }}

                                </div>


                                {{-- ONLINE INDICATOR --}}
                                <span class="absolute bottom-0 right-0
                           w-3.5 h-3.5
                           rounded-full
                           bg-slate-500
                           border-2 border-slate-900"></span>

                            </div>


                            {{-- USER INFORMATION --}}
                            <div class="flex-1 min-w-0">

                                <div class="flex items-center justify-between gap-2">

                                    <p class="font-bold text-white truncate">

                                        {{ $user->username }}

                                    </p>

                                </div>


                                <div class="flex items-center justify-between gap-2 mt-1">

                                    <p class="text-sm text-slate-500 truncate">

                                        Click to start a conversation

                                    </p>

                                </div>

                            </div>

                        </button>

                        @empty

                        <div class="py-12 px-6 text-center">

                            <div class="text-5xl mb-4">
                                👥
                            </div>

                            <p class="font-bold text-white">
                                No users found
                            </p>

                            <p class="text-sm text-slate-500 mt-2">
                                There are currently no other users available to chat with.
                            </p>

                        </div>

                        @endforelse

                    </div>

                </aside>


                <!-- =========================================
                 RIGHT SIDE - CONVERSATION
            ========================================== -->

                <section class="flex flex-col h-full bg-slate-950/40">


                    <!-- =========================================
                     CHAT HEADER
                ========================================== -->

                    <header
                        class="flex items-center justify-between gap-4 px-4 sm:px-6 py-4 border-b border-white/10 bg-slate-900/60 backdrop-blur-xl">


                        <div class="flex items-center gap-3">

                            <!-- MOBILE BACK -->

                            <button type="button"
                                class="md:hidden w-10 h-10 rounded-xl bg-white/5 hover:bg-white/10 text-white transition">
                                ←
                            </button>


                            <!-- AVATAR -->

                            <div class="relative">

                                <div
                                    class="w-11 h-11 rounded-full bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center font-black text-white">
                                    J
                                </div>

                                <span
                                    class="absolute bottom-0 right-0 w-3.5 h-3.5 rounded-full bg-emerald-400 border-2 border-slate-900"></span>

                            </div>


                            <!-- USER -->

                            <div>

                                <h2 class="font-bold text-white">
                                    John Carter
                                </h2>

                                <p class="text-xs text-emerald-400">
                                    ● Online
                                </p>

                            </div>

                        </div>


                        <!-- ACTIONS -->

                        <div class="flex items-center gap-2">

                            <button type="button"
                                class="w-10 h-10 rounded-xl hover:bg-white/10 text-slate-400 hover:text-white transition">
                                📞
                            </button>


                            <button type="button"
                                class="w-10 h-10 rounded-xl hover:bg-white/10 text-slate-400 hover:text-white transition">
                                ⋮
                            </button>

                        </div>

                    </header>



                    <!-- =========================================
                     MESSAGES
                ========================================== -->

                    <div class="flex-1 overflow-y-auto px-4 sm:px-8 py-6 space-y-4">


                        <!-- DATE -->

                        <div class="flex justify-center">

                            <span
                                class="px-4 py-1.5 rounded-full bg-white/5 border border-white/10 text-xs text-slate-400">
                                Today
                            </span>

                        </div>


                        <!-- INCOMING MESSAGE -->

                        <div class="flex items-end gap-2 max-w-[85%] sm:max-w-[70%]">

                            <div
                                class="w-8 h-8 rounded-full bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center text-xs font-bold text-white flex-shrink-0">
                                J
                            </div>


                            <div
                                class="rounded-2xl rounded-bl-md bg-slate-800 border border-white/5 px-4 py-3 shadow-lg">

                                <p class="text-sm sm:text-base text-slate-100">
                                    Hey! How are you doing today?
                                </p>

                                <p class="text-[10px] text-slate-500 text-right mt-1">
                                    10:32 AM
                                </p>

                            </div>

                        </div>


                        <!-- OUTGOING MESSAGE -->

                        <div class="flex justify-end">

                            <div
                                class="max-w-[85%] sm:max-w-[70%] rounded-2xl rounded-br-md bg-gradient-to-br from-indigo-600 to-purple-600 px-4 py-3 shadow-lg shadow-indigo-900/30">

                                <p class="text-sm sm:text-base text-white">
                                    I'm doing great! Working on the new chat system right now. 🚀
                                </p>

                                <div class="flex justify-end items-center gap-1 mt-1">

                                    <span class="text-[10px] text-indigo-200">
                                        10:35 AM
                                    </span>

                                    <span class="text-[10px] text-cyan-300">
                                        ✓✓
                                    </span>

                                </div>

                            </div>

                        </div>


                        <!-- INCOMING MESSAGE -->

                        <div class="flex items-end gap-2 max-w-[85%] sm:max-w-[70%]">

                            <div
                                class="w-8 h-8 rounded-full bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center text-xs font-bold text-white flex-shrink-0">
                                J
                            </div>


                            <div
                                class="rounded-2xl rounded-bl-md bg-slate-800 border border-white/5 px-4 py-3 shadow-lg">

                                <p class="text-sm sm:text-base text-slate-100">
                                    Nice! Is it going to look like Telegram?
                                </p>

                                <p class="text-[10px] text-slate-500 text-right mt-1">
                                    10:38 AM
                                </p>

                            </div>

                        </div>


                        <!-- OUTGOING MESSAGE -->

                        <div class="flex justify-end">

                            <div
                                class="max-w-[85%] sm:max-w-[70%] rounded-2xl rounded-br-md bg-gradient-to-br from-indigo-600 to-purple-600 px-4 py-3 shadow-lg shadow-indigo-900/30">

                                <p class="text-sm sm:text-base text-white">
                                    Yes! Modern, responsive, clean, and optimized for mobile. 🔥
                                </p>

                                <div class="flex justify-end items-center gap-1 mt-1">

                                    <span class="text-[10px] text-indigo-200">
                                        10:40 AM
                                    </span>

                                    <span class="text-[10px] text-cyan-300">
                                        ✓✓
                                    </span>

                                </div>

                            </div>

                        </div>


                        <!-- INCOMING MESSAGE -->

                        <div class="flex items-end gap-2 max-w-[85%] sm:max-w-[70%]">

                            <div
                                class="w-8 h-8 rounded-full bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center text-xs font-bold text-white flex-shrink-0">
                                J
                            </div>


                            <div
                                class="rounded-2xl rounded-bl-md bg-slate-800 border border-white/5 px-4 py-3 shadow-lg">

                                <p class="text-sm sm:text-base text-slate-100">
                                    That sounds awesome. Can't wait to see it! 😎
                                </p>

                                <p class="text-[10px] text-slate-500 text-right mt-1">
                                    10:42 AM
                                </p>

                            </div>

                        </div>


                        <!-- TYPING -->

                        <div class="flex items-center gap-2 text-xs text-slate-500">

                            <div
                                class="w-8 h-8 rounded-full bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center text-xs font-bold text-white">
                                J
                            </div>

                            <div class="px-4 py-3 rounded-2xl bg-slate-800">

                                <div class="flex gap-1">

                                    <span class="w-1.5 h-1.5 bg-slate-400 rounded-full animate-bounce"></span>

                                    <span
                                        class="w-1.5 h-1.5 bg-slate-400 rounded-full animate-bounce [animation-delay:150ms]"></span>

                                    <span
                                        class="w-1.5 h-1.5 bg-slate-400 rounded-full animate-bounce [animation-delay:300ms]"></span>

                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- =========================================
                     MESSAGE INPUT
                ========================================== -->

                    <div class="border-t border-white/10 bg-slate-900/80 backdrop-blur-xl p-3 sm:p-4">

                        <form class="flex items-end gap-2">


                            <!-- ATTACH -->

                            <button type="button"
                                class="w-11 h-11 flex-shrink-0 rounded-xl hover:bg-white/10 text-slate-400 hover:text-white transition"
                                title="Attach file">
                                📎
                            </button>


                            <!-- MESSAGE INPUT -->

                            <div class="flex-1">

                                <textarea rows="1" placeholder="Write a message..."
                                    class="w-full resize-none rounded-2xl bg-black/30 border border-white/10 px-4 py-3 text-sm sm:text-base text-white placeholder:text-slate-500 outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"></textarea>

                            </div>


                            <!-- EMOJI -->

                            <button type="button"
                                class="hidden sm:flex w-11 h-11 flex-shrink-0 rounded-xl hover:bg-white/10 text-slate-400 hover:text-white items-center justify-center transition">
                                😊
                            </button>


                            <!-- SEND -->

                            <button type="submit"
                                class="w-11 h-11 flex-shrink-0 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-400 hover:to-purple-500 text-white flex items-center justify-center shadow-lg shadow-indigo-900/40 transition hover:scale-105">
                                ➤
                            </button>


                        </form>

                    </div>

                </section>

            </div>

        </div>

    </div>


</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const chatUsers = document.querySelectorAll('.chat-user');

    chatUsers.forEach(function (user) {

        user.addEventListener('click', function () {

            // Remove active state from everyone
            chatUsers.forEach(function (item) {

                item.classList.remove(
                    'bg-indigo-500/10',
                    'border-indigo-500'
                );

                item.classList.add(
                    'border-transparent'
                );

            });


            // Add active state
            this.classList.remove('border-transparent');

            this.classList.add(
                'bg-indigo-500/10',
                'border-indigo-500'
            );


            const userId = this.dataset.userId;
            const username = this.dataset.username;

            console.log(
                'Opening chat with:',
                username,
                userId
            );

        });

    });

});
</script>
