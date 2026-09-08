<div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 py-6 sm:py-10 px-3 sm:px-6 lg:px-8">

```
<div class="max-w-7xl mx-auto space-y-6">

    {{-- ============================= --}}
    {{-- HERO / SEARCH SECTION --}}
    {{-- ============================= --}}

    <div class="relative overflow-hidden rounded-3xl border border-white/10 bg-slate-900/80 backdrop-blur-xl shadow-2xl">

        {{-- Background Decorations --}}
        <div class="absolute inset-0 overflow-hidden opacity-30 pointer-events-none">

            <div class="absolute -top-32 -right-32 w-96 h-96 bg-indigo-600 rounded-full blur-3xl"></div>

            <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-purple-600 rounded-full blur-3xl"></div>

        </div>


        <div class="relative p-6 sm:p-10">

            {{-- HERO HEADER --}}

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">

                <div>

                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-500/10 border border-indigo-400/20 text-indigo-300 text-sm font-semibold mb-4">

                        ⚔️ CLASH OF CLANS API EXPLORER

                    </div>


                    <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight">

                        Clash Intelligence

                    </h1>


                    <p class="mt-3 text-slate-400 max-w-xl">

                        Search clans and players, explore trophies, war statistics,
                        battle history, league performance, and more.

                    </p>

                </div>


                <div class="hidden lg:flex items-center justify-center w-32 h-32 rounded-3xl bg-gradient-to-br from-amber-400 to-orange-600 text-6xl shadow-xl">

                    🏰

                </div>

            </div>


            {{-- ============================= --}}
            {{-- SEARCH FORM --}}
            {{-- ============================= --}}

            <form action="{{ url()->current() }}" method="GET" class="mt-8 space-y-5">

                {{-- SEARCH TYPE --}}

                <div class="inline-flex p-1 rounded-xl bg-black/30 border border-white/10">

                    {{-- CLAN --}}

                    <label class="cursor-pointer">

                        <input
                            type="radio"
                            name="type"
                            value="clan"
                            class="hidden peer"
                            {{ ($type ?? 'clan') === 'clan' ? 'checked' : '' }}
                        >

                        <div class="px-5 py-3 rounded-lg text-sm font-bold text-slate-400 peer-checked:bg-indigo-600 peer-checked:text-white transition-all">

                            🛡️ Clan

                        </div>

                    </label>


                    {{-- PLAYER --}}

                    <label class="cursor-pointer">

                        <input
                            type="radio"
                            name="type"
                            value="player"
                            class="hidden peer"
                            {{ ($type ?? '') === 'player' ? 'checked' : '' }}
                        >

                        <div class="px-5 py-3 rounded-lg text-sm font-bold text-slate-400 peer-checked:bg-indigo-600 peer-checked:text-white transition-all">

                            👤 Player

                        </div>

                    </label>

                </div>


                {{-- TAG INPUT + SEARCH BUTTON --}}

                <div class="flex flex-col sm:flex-row gap-3">

                    <div class="relative flex-1">

                        <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-500 text-xl">

                            🔎

                        </span>


                        <input
                            type="text"
                            name="tag"
                            value="{{ $searchedTag ?? '' }}"
                            placeholder="Enter Clan or Player Tag (Example: #GP8PUQ8Y)"
                            class="w-full rounded-2xl bg-black/30 border border-white/10 pl-14 pr-5 py-4 text-white placeholder:text-slate-500 outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent uppercase"
                            required
                        >

                    </div>


                    <button
                        type="submit"
                        class="rounded-2xl bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 px-8 py-4 font-bold text-white shadow-lg shadow-indigo-900/40 transition-all hover:scale-[1.02]"
                    >

                        Search Now ⚔️

                    </button>

                </div>


                {{-- ============================= --}}
                {{-- PLAYER API TOKEN --}}
                {{-- ============================= --}}

                <div
                    id="tokenSection"
                    class="{{ ($type ?? '') === 'player' ? '' : 'hidden' }}"
                >

                    <div class="rounded-2xl bg-black/20 border border-white/10 p-5">

                        <div class="flex items-start gap-3">

                            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-indigo-500/10 text-lg">

                                🔐

                            </div>


                            <div class="flex-1">

                                <label class="block text-sm font-semibold text-slate-200 mb-2">

                                    Player API Token

                                    <span class="text-slate-500 font-normal">

                                        (Optional)

                                    </span>

                                </label>


                                <input
                                    type="text"
                                    name="api_token"
                                    value="{{ request('api_token') }}"
                                    placeholder="Enter player API token for verification"
                                    class="w-full rounded-xl bg-black/30 border border-white/10 px-5 py-3.5 text-white placeholder:text-slate-500 outline-none focus:ring-2 focus:ring-indigo-500"
                                >


                                <p class="text-xs text-slate-500 mt-3">

                                    Used only to verify the player's token through the official Clash of Clans API.

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </form>


            {{-- ERROR --}}

            @if($error)

                <div class="mt-5 rounded-xl border border-red-500/30 bg-red-500/10 p-4 text-red-300">

                    <div class="flex items-center gap-3">

                        <span class="text-xl">

                            ⚠️

                        </span>


                        <div>

                            <p class="font-bold">

                                Search Failed

                            </p>


                            <p class="text-sm text-red-300/80">

                                {{ $error }}

                            </p>

                        </div>

                    </div>

                </div>

            @endif

        </div>

    </div>


    {{-- ============================= --}}
    {{-- PLAYER RESULTS --}}
    {{-- ============================= --}}

    @if($player)

        {{-- PLAYER HERO --}}

        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-700 via-indigo-800 to-purple-900 border border-white/10 shadow-2xl">

            <div class="absolute inset-0 opacity-20 pointer-events-none">

                <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>

            </div>


            <div class="relative p-6 sm:p-8">

                <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-8">


                    {{-- PLAYER INFO --}}

                    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">

                        <div class="w-28 h-28 rounded-3xl bg-white/10 border border-white/20 flex items-center justify-center shadow-xl">

                            @if(isset($player['league']['iconUrls']['medium']))

                                <img
                                    src="{{ $player['league']['iconUrls']['medium'] }}"
                                    alt="{{ $player['league']['name'] ?? 'League' }}"
                                    class="w-24 h-24 object-contain"
                                >

                            @else

                                <span class="text-6xl">

                                    👤

                                </span>

                            @endif

                        </div>


                        <div class="text-center sm:text-left">

                            <div class="flex flex-col sm:flex-row sm:items-center gap-3">

                                <h2 class="text-3xl font-black text-white">

                                    {{ $player['name'] }}

                                </h2>


                                @if(isset($player['league']['name']))

                                    <span class="px-3 py-1 rounded-full bg-white/10 border border-white/20 text-xs font-bold text-indigo-100">

                                        {{ $player['league']['name'] }}

                                    </span>

                                @endif

                            </div>


                            <p class="mt-2 font-mono text-indigo-200">

                                {{ $player['tag'] }}

                            </p>


                            <div class="flex flex-wrap justify-center sm:justify-start gap-3 mt-4">

                                <span class="px-3 py-2 rounded-xl bg-black/20 text-sm text-white">

                                    🏠 Town Hall {{ $player['townHallLevel'] ?? 'N/A' }}

                                </span>


                                <span class="px-3 py-2 rounded-xl bg-black/20 text-sm text-white">

                                    ⚔️ XP {{ $player['expLevel'] ?? 'N/A' }}

                                </span>


                                @if(isset($player['clan']['name']))

                                    <span class="px-3 py-2 rounded-xl bg-black/20 text-sm text-white">

                                        🛡️ {{ $player['clan']['name'] }}

                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>


                    {{-- TROPHIES --}}

                    <div class="text-center">

                        <p class="text-sm uppercase tracking-widest text-indigo-200">

                            Current Trophies

                        </p>


                        <div class="text-5xl font-black text-amber-300 mt-2">

                            🏆 {{ number_format($player['trophies'] ?? 0) }}

                        </div>


                        <p class="text-sm text-indigo-200 mt-2">

                            Best: {{ number_format($player['bestTrophies'] ?? 0) }}

                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- PLAYER STATS --}}

        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-4">

            @php

                $stats = [
                    ['War Stars', '⭐', $player['warStars'] ?? 0, 'text-yellow-400'],
                    ['Donations', '▲', $player['donations'] ?? 0, 'text-emerald-400'],
                    ['Received', '▼', $player['donationsReceived'] ?? 0, 'text-cyan-400'],
                    ['Attack Wins', '⚔️', $player['attackWins'] ?? 0, 'text-red-400'],
                    ['Defense Wins', '🛡️', $player['defenseWins'] ?? 0, 'text-blue-400'],
                    ['Builder Trophies', '🏆', $player['builderBaseTrophies'] ?? 0, 'text-purple-400'],
                ];

            @endphp


            @foreach($stats as $stat)

                <div class="rounded-2xl bg-slate-900 border border-white/10 p-5 hover:-translate-y-1 hover:border-white/20 transition-all">

                    <p class="text-xs uppercase tracking-wider text-slate-500">

                        {{ $stat[0] }}

                    </p>


                    <p class="mt-2 text-2xl font-black {{ $stat[3] }}">

                        {{ $stat[1] }} {{ number_format($stat[2]) }}

                    </p>

                </div>

            @endforeach

        </div>


        {{-- PLAYER API DATA --}}

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">


            {{-- BATTLE LOG --}}

            <div class="rounded-3xl bg-slate-900 border border-white/10 overflow-hidden shadow-xl">

                <div class="flex items-center justify-between px-6 py-5 border-b border-white/10">

                    <div>

                        <p class="text-xs uppercase tracking-widest text-slate-500">

                            Player Activity

                        </p>


                        <h3 class="text-xl font-bold text-white">

                            ⚔️ Recent Battle Log

                        </h3>

                    </div>


                    <span class="px-3 py-1 rounded-full bg-indigo-500/10 text-indigo-300 text-xs">

                        {{ count($battleLog ?? []) }} Battles

                    </span>

                </div>


                <div class="p-4 space-y-3 max-h-[500px] overflow-y-auto">

                    @forelse($battleLog ?? [] as $battle)

                        <div class="rounded-2xl bg-slate-800/70 border border-white/5 p-4 hover:bg-slate-800 transition">

                            <div class="flex items-center justify-between gap-4">

                                <div>

                                    <p class="font-bold text-white capitalize">

                                        ⚔️ {{ $battle['battleType'] ?? 'Battle' }}

                                    </p>


                                    <p class="text-sm text-slate-400 mt-1">

                                        Destruction:
                                        {{ $battle['destructionPercentage'] ?? 0 }}%

                                    </p>

                                </div>


                                <div class="text-right">

                                    <div class="text-lg font-bold text-yellow-400">

                                        ⭐ {{ $battle['stars'] ?? 0 }}

                                    </div>


                                    @php

                                        $trophyChange = $battle['trophyChange'] ?? 0;

                                    @endphp


                                    <p class="text-sm font-bold {{ $trophyChange >= 0 ? 'text-emerald-400' : 'text-red-400' }}">

                                        {{ $trophyChange >= 0 ? '+' : '' }}{{ $trophyChange }}

                                    </p>

                                </div>

                            </div>

                        </div>

                    @empty

                        <div class="py-12 text-center">

                            <div class="text-5xl mb-4">

                                📜

                            </div>


                            <p class="font-semibold text-slate-300">

                                No Battle Log Available

                            </p>


                            <p class="text-sm text-slate-500 mt-2">

                                The player's battle log may be private.

                            </p>

                        </div>

                    @endforelse

                </div>

            </div>


            {{-- LEAGUE HISTORY --}}

            <div class="rounded-3xl bg-slate-900 border border-white/10 overflow-hidden shadow-xl">

                <div class="flex items-center justify-between px-6 py-5 border-b border-white/10">

                    <div>

                        <p class="text-xs uppercase tracking-widest text-slate-500">

                            Competitive Performance

                        </p>


                        <h3 class="text-xl font-bold text-white">

                            🏆 League History

                        </h3>

                    </div>


                    <span class="px-3 py-1 rounded-full bg-purple-500/10 text-purple-300 text-xs">

                        {{ count($leagueHistory ?? []) }} Seasons

                    </span>

                </div>


                <div class="p-4 space-y-3 max-h-[500px] overflow-y-auto">

                    @forelse($leagueHistory ?? [] as $history)

                        <div class="flex items-center justify-between gap-4 rounded-2xl bg-slate-800/70 border border-white/5 p-4 hover:bg-slate-800 transition">

                            <div class="flex items-center gap-4">

                                <div class="w-12 h-12 rounded-xl bg-slate-700 flex items-center justify-center">

                                    @if(isset($history['league']['iconUrls']['small']))

                                        <img
                                            src="{{ $history['league']['iconUrls']['small'] }}"
                                            class="w-10 h-10 object-contain"
                                            alt="League"
                                        >

                                    @else

                                        🏆

                                    @endif

                                </div>


                                <div>

                                    <p class="font-bold text-white">

                                        {{ $history['season'] ?? 'Season' }}

                                    </p>


                                    <p class="text-xs text-slate-500">

                                        Rank #{{ $history['rank'] ?? 'N/A' }}

                                    </p>

                                </div>

                            </div>


                            <p class="font-bold text-amber-400">

                                🏆 {{ number_format($history['trophies'] ?? 0) }}

                            </p>

                        </div>

                    @empty

                        <div class="py-12 text-center">

                            <div class="text-5xl mb-4">

                                🏆

                            </div>


                            <p class="font-semibold text-slate-300">

                                No League History

                            </p>


                            <p class="text-sm text-slate-500 mt-2">

                                No league history was returned by the API.

                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>


        {{-- TOKEN VERIFICATION RESULT --}}

        @if(request('api_token'))

            <div class="rounded-3xl bg-slate-900 border border-white/10 p-6">

                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">

                    <div>

                        <p class="text-xs uppercase tracking-widest text-slate-500">

                            Official API Feature

                        </p>


                        <h3 class="text-xl font-bold text-white mt-1">

                            🔐 Player Token Verification

                        </h3>

                    </div>


                    <div>

                        @if(($tokenVerification['status'] ?? '') === 'ok')

                            <span class="inline-flex px-5 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 font-bold">

                                ✓ Token Verified

                            </span>

                        @else

                            <span class="inline-flex px-5 py-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 font-bold">

                                ✕ Token Invalid

                            </span>

                        @endif

                    </div>

                </div>

            </div>

        @endif

    @endif


    {{-- ============================= --}}
    {{-- CLAN RESULTS --}}
    {{-- ============================= --}}

    @if($clan)

        <div class="rounded-3xl overflow-hidden bg-slate-900 border border-white/10 shadow-2xl">


            {{-- CLAN HEADER --}}

            <div class="relative overflow-hidden p-6 sm:p-8 bg-gradient-to-r from-emerald-800 via-teal-800 to-cyan-900">

                <div class="absolute inset-0 opacity-20 pointer-events-none">

                    <div class="absolute -top-32 -right-20 w-96 h-96 bg-white rounded-full blur-3xl"></div>

                </div>


                <div class="relative flex flex-col xl:flex-row xl:items-center xl:justify-between gap-8">


                    {{-- CLAN INFO --}}

                    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">

                        <div class="w-28 h-28 rounded-3xl bg-black/20 border border-white/20 flex items-center justify-center">

                            @if(isset($clan['badgeUrls']['medium']))

                                <img
                                    src="{{ $clan['badgeUrls']['medium'] }}"
                                    class="w-24 h-24 object-contain"
                                    alt="{{ $clan['name'] }}"
                                >

                            @else

                                <span class="text-6xl">

                                    🛡️

                                </span>

                            @endif

                        </div>


                        <div class="text-center sm:text-left">

                            <h2 class="text-3xl font-black text-white">

                                {{ $clan['name'] }}

                            </h2>


                            <p class="font-mono text-emerald-200 mt-1">

                                {{ $clan['tag'] }}

                            </p>


                            <div class="flex flex-wrap justify-center sm:justify-start gap-3 mt-4">

                                <span class="px-3 py-2 rounded-xl bg-black/20 text-white text-sm">

                                    ⭐ Clan Level {{ $clan['clanLevel'] ?? 'N/A' }}

                                </span>


                                <span class="px-3 py-2 rounded-xl bg-black/20 text-white text-sm">

                                    👥 {{ $clan['members'] ?? 0 }}/50 Members

                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- CLAN TROPHIES --}}

                    <div class="text-center">

                        <p class="text-sm uppercase tracking-widest text-emerald-200">

                            Clan Points

                        </p>


                        <p class="text-5xl font-black text-amber-300 mt-2">

                            🏆 {{ number_format($clan['clanPoints'] ?? 0) }}

                        </p>

                    </div>

                </div>


                @if(!empty($clan['description']))

                    <div class="relative mt-8 rounded-2xl bg-black/20 border border-white/10 p-5 text-emerald-50">

                        {{ $clan['description'] }}

                    </div>

                @endif

            </div>


            {{-- CLAN STATS --}}

            <div class="grid grid-cols-2 md:grid-cols-4 gap-px bg-white/5">

                <div class="bg-slate-900 p-6 text-center">

                    <p class="text-xs uppercase text-slate-500">

                        War Wins

                    </p>


                    <p class="text-2xl font-black text-emerald-400 mt-2">

                        ⚔️ {{ number_format($clan['warWins'] ?? 0) }}

                    </p>

                </div>


                <div class="bg-slate-900 p-6 text-center">

                    <p class="text-xs uppercase text-slate-500">

                        War Streak

                    </p>


                    <p class="text-2xl font-black text-orange-400 mt-2">

                        🔥 {{ number_format($clan['warWinStreak'] ?? 0) }}

                    </p>

                </div>


                <div class="bg-slate-900 p-6 text-center">

                    <p class="text-xs uppercase text-slate-500">

                        Capital Points

                    </p>


                    <p class="text-2xl font-black text-purple-400 mt-2">

                        🏰 {{ number_format($clan['clanCapitalPoints'] ?? 0) }}

                    </p>

                </div>


                <div class="bg-slate-900 p-6 text-center">

                    <p class="text-xs uppercase text-slate-500">

                        Required Trophies

                    </p>


                    <p class="text-2xl font-black text-amber-400 mt-2">

                        🏆 {{ number_format($clan['requiredTrophies'] ?? 0) }}

                    </p>

                </div>

            </div>


            {{-- ============================= --}}
            {{-- CLAN MEMBERS --}}
            {{-- ============================= --}}

            @if(!empty($clan['memberList']))

                <div class="p-6 border-t border-white/10">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

                        <div>

                            <p class="text-xs uppercase tracking-widest text-slate-500">

                                Clan Roster

                            </p>


                            <h3 class="text-2xl font-black text-white">

                                👥 Clan Members

                            </h3>

                        </div>


                        <span class="text-sm text-slate-400">

                            {{ count($clan['memberList']) }} Players

                        </span>

                    </div>


                    <div class="overflow-x-auto rounded-2xl border border-white/10">

                        <table class="w-full text-sm">

                            <thead class="bg-slate-800 text-slate-400">

                                <tr>

                                    <th class="text-left px-6 py-4">

                                        Player

                                    </th>


                                    <th class="text-center px-4 py-4">

                                        Role

                                    </th>


                                    <th class="text-center px-4 py-4">

                                        TH

                                    </th>


                                    <th class="text-center px-4 py-4">

                                        Trophies

                                    </th>


                                    <th class="text-center px-4 py-4">

                                        Donations

                                    </th>


                                    <th class="text-center px-4 py-4">

                                        Action

                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-white/5">

                                @foreach($clan['memberList'] as $member)

                                    <tr class="hover:bg-white/[0.04] transition group">

                                        {{-- CLICKABLE PLAYER NAME --}}

                                        <td class="px-6 py-4">

                                            <a
                                                href="{{ url()->current() }}?type=player&tag={{ urlencode($member['tag']) }}"
                                                class="inline-flex items-center gap-2 font-bold text-white hover:text-indigo-400 transition"
                                            >

                                                <span>

                                                    👤

                                                </span>

                                                <span>

                                                    {{ $member['name'] }}

                                                </span>

                                            </a>


                                            <p class="text-xs text-slate-500 font-mono mt-1">

                                                {{ $member['tag'] }}

                                            </p>

                                        </td>


                                        {{-- ROLE --}}

                                        <td class="text-center px-4 py-4">

                                            @php

                                                $role = $member['role'] ?? 'member';

                                                $roleClass = match($role) {

                                                    'leader' => 'bg-yellow-500/10 text-yellow-400 border border-yellow-500/20',

                                                    'coLeader' => 'bg-purple-500/10 text-purple-400 border border-purple-500/20',

                                                    'admin' => 'bg-blue-500/10 text-blue-400 border border-blue-500/20',

                                                    default => 'bg-slate-700 text-slate-300 border border-white/5',

                                                };

                                            @endphp


                                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold {{ $roleClass }}">

                                                {{ ucfirst(str_replace('_', ' ', $role)) }}

                                            </span>

                                        </td>


                                        {{-- TOWN HALL --}}

                                        <td class="text-center px-4 py-4 text-white">

                                            🏠 {{ $member['townHallLevel'] ?? '-' }}

                                        </td>


                                        {{-- TROPHIES --}}

                                        <td class="text-center px-4 py-4 font-bold text-amber-400">

                                            🏆 {{ number_format($member['trophies'] ?? 0) }}

                                        </td>


                                        {{-- DONATIONS --}}

                                        <td class="text-center px-4 py-4 text-emerald-400">

                                            ▲ {{ number_format($member['donations'] ?? 0) }}

                                        </td>


                                        {{-- VIEW PLAYER BUTTON --}}

                                        <td class="text-center px-4 py-4">

                                            <a
                                                href="{{ url()->current() }}?type=player&tag={{ urlencode($member['tag']) }}"
                                                class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-indigo-600/20 border border-indigo-500/20 text-indigo-300 text-xs font-bold hover:bg-indigo-600 hover:text-white transition"
                                            >

                                                View →

                                            </a>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            @endif

        </div>

    @endif

</div>
```

</div>

{{-- ============================= --}}
{{-- PLAYER TOKEN TOGGLE SCRIPT --}}
{{-- ============================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const playerRadio = document.querySelector(
        'input[name="type"][value="player"]'
    );

    const clanRadio = document.querySelector(
        'input[name="type"][value="clan"]'
    );

    const tokenSection = document.getElementById('tokenSection');


    function toggleTokenSection() {

        if (!playerRadio || !clanRadio || !tokenSection) {
            return;
        }


        if (playerRadio.checked) {

            tokenSection.classList.remove('hidden');

        } else {

            tokenSection.classList.add('hidden');

        }

    }


    playerRadio.addEventListener('change', toggleTokenSection);

    clanRadio.addEventListener('change', toggleTokenSection);


    toggleTokenSection();

});

</script>
