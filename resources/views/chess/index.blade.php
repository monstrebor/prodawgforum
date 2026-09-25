<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Chess Lobby</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background:
                radial-gradient(circle at 15% 20%, rgba(99, 102, 241, .12), transparent 30%),
                radial-gradient(circle at 85% 80%, rgba(139, 92, 246, .10), transparent 30%),
                #09090f;
            color: #f8fafc;
            min-height: 100vh;
        }

        button,
        input {
            font-family: inherit;
        }

        .chess-page {
            width: 100%;
            min-height: 100vh;
        }

        /* Header */

        .chess-header {
            height: 72px;
            padding: 0 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
            background: rgba(9, 9, 15, .88);
            backdrop-filter: blur(16px);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 21px;
            font-weight: 800;
            letter-spacing: .3px;
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            color: #111827;
            font-size: 23px;
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 28px;
        }

        .nav a {
            color: #94a3b8;
            text-decoration: none;
            font-size: 14px;
            transition: .2s ease;
        }

        .nav a:hover,
        .nav a.active {
            color: #ffffff;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 7px 11px;
            border: 1px solid rgba(255, 255, 255, .08);
            border-radius: 12px;
            background: rgba(255, 255, 255, .04);
            font-size: 14px;
        }

        .avatar {
            width: 32px;
            height: 32px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            font-size: 13px;
            font-weight: 700;
        }

        /* Main */

        .container {
            width: min(1180px, calc(100% - 40px));
            margin: 0 auto;
        }

        .hero {
            text-align: center;
            padding: 72px 20px 50px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 13px;
            border-radius: 999px;
            background: rgba(255, 255, 255, .05);
            border: 1px solid rgba(255, 255, 255, .08);
            color: #a5b4fc;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .7px;
            text-transform: uppercase;
            margin-bottom: 18px;
        }

        .hero h1 {
            font-size: clamp(38px, 6vw, 64px);
            line-height: 1;
            font-weight: 900;
            letter-spacing: -2px;
            margin-bottom: 18px;
        }

        .hero p {
            max-width: 570px;
            margin: 0 auto;
            color: #94a3b8;
            font-size: 16px;
            line-height: 1.7;
        }

        /* Game Cards */

        .game-options {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 45px;
        }

        .game-card {
            position: relative;
            overflow: hidden;
            padding: 30px;
            border-radius: 22px;
            border: 1px solid rgba(255, 255, 255, .08);
            background: rgba(255, 255, 255, .035);
            transition: transform .25s ease, border-color .25s ease;
        }

        .game-card:hover {
            transform: translateY(-4px);
            border-color: rgba(165, 180, 252, .3);
        }

        .game-card::after {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            right: -80px;
            top: -80px;
            background: rgba(99, 102, 241, .12);
            filter: blur(5px);
            pointer-events: none;
        }

        .game-icon {
            width: 58px;
            height: 58px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 27px;
            margin-bottom: 24px;
        }

        .ai-icon {
            background: rgba(99, 102, 241, .13);
            color: #a5b4fc;
        }

        .multi-icon {
            background: rgba(139, 92, 246, .13);
            color: #c4b5fd;
        }

        .game-card h2 {
            font-size: 23px;
            margin-bottom: 9px;
        }

        .game-card p {
            color: #94a3b8;
            line-height: 1.6;
            font-size: 14px;
            min-height: 46px;
        }

        .game-card-footer {
            margin-top: 28px;
        }

        .primary-btn,
        .secondary-btn {
            border: none;
            cursor: pointer;
            border-radius: 11px;
            padding: 12px 18px;
            font-size: 14px;
            font-weight: 700;
            transition: .2s ease;
        }

        .primary-btn {
            background: #ffffff;
            color: #111827;
        }

        .primary-btn:hover {
            background: #e5e7eb;
            transform: translateY(-1px);
        }

        .secondary-btn {
            background: rgba(255, 255, 255, .07);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, .08);
        }

        .secondary-btn:hover {
            background: rgba(255, 255, 255, .11);
        }

        .full-btn {
            width: 100%;
        }

        /* Sections */

        .section {
            margin-bottom: 35px;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 800;
        }

        .section-subtitle {
            color: #64748b;
            font-size: 13px;
            margin-top: 4px;
        }

        /* Stats */

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }

        .stat {
            padding: 20px;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, .07);
            background: rgba(255, 255, 255, .035);
        }

        .stat-label {
            color: #64748b;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .6px;
            margin-bottom: 9px;
        }

        .stat-value {
            font-size: 25px;
            font-weight: 800;
        }

        /* Waiting Games */

        .games-container {
            overflow-x: auto;
            border: 1px solid rgba(255, 255, 255, .07);
            border-radius: 16px;
            background: rgba(255, 255, 255, .025);
        }

        .games-table {
            width: 100%;
            min-width: 650px;
            border-collapse: collapse;
        }

        .games-table th,
        .games-table td {
            padding: 16px 18px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, .06);
        }

        .games-table th {
            color: #64748b;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .7px;
        }

        .games-table td {
            color: #cbd5e1;
            font-size: 14px;
        }

        .games-table tr:last-child td {
            border-bottom: none;
        }

        .player {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            color: #f8fafc;
        }

        .mini-avatar {
            width: 32px;
            height: 32px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, .08);
            font-size: 12px;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 6px 9px;
            border-radius: 999px;
            background: rgba(34, 197, 94, .08);
            color: #86efac;
            font-size: 12px;
            font-weight: 700;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #4ade80;
        }

        .empty-games {
            padding: 45px 20px;
            text-align: center;
            color: #64748b;
        }

        .empty-games i {
            display: block;
            font-size: 30px;
            margin-bottom: 12px;
            color: #475569;
        }

        /* Modal */

        .modal-overlay {
            position: fixed;
            inset: 0;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(0, 0, 0, .72);
            backdrop-filter: blur(8px);
            z-index: 100;
        }

        .modal-overlay.show {
            display: flex;
        }

        .modal {
            width: min(480px, 100%);
            padding: 28px;
            border-radius: 22px;
            background: #11111a;
            border: 1px solid rgba(255, 255, 255, .09);
            box-shadow: 0 25px 80px rgba(0, 0, 0, .45);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 24px;
        }

        .modal-header h2 {
            font-size: 22px;
        }

        .modal-header p {
            color: #64748b;
            font-size: 13px;
            margin-top: 5px;
        }

        .close-btn {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            border: 1px solid rgba(255, 255, 255, .07);
            background: rgba(255, 255, 255, .04);
            color: #94a3b8;
            cursor: pointer;
        }

        .difficulty-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin-bottom: 20px;
        }

        .difficulty {
            padding: 17px;
            text-align: left;
            border-radius: 13px;
            border: 1px solid rgba(255, 255, 255, .08);
            background: rgba(255, 255, 255, .035);
            color: #ffffff;
            cursor: pointer;
            transition: .2s ease;
        }

        .difficulty:hover {
            border-color: rgba(165, 180, 252, .35);
        }

        .difficulty.selected {
            border-color: #818cf8;
            background: rgba(99, 102, 241, .13);
        }

        .difficulty strong {
            display: block;
            margin-bottom: 4px;
        }

        .difficulty span {
            color: #64748b;
            font-size: 12px;
        }

        /* Footer */

        .footer {
            padding: 35px 0 45px;
            color: #475569;
            font-size: 12px;
            text-align: center;
        }

        /* Responsive */

        @media (max-width: 800px) {
            .chess-header {
                padding: 0 20px;
            }

            .nav {
                display: none;
            }

            .game-options {
                grid-template-columns: 1fr;
            }

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero {
                padding-top: 50px;
            }
        }

        @media (max-width: 500px) {
            .container {
                width: min(100% - 24px, 1180px);
            }

            .hero h1 {
                letter-spacing: -1px;
            }

            .game-card {
                padding: 23px;
            }

            .stats {
                gap: 8px;
            }

            .stat {
                padding: 16px;
            }

            .user-menu span {
                display: none;
            }

            .chess-header {
                height: 64px;
            }
        }
    </style>
</head>

<body>

    <div class="chess-page">

        <!-- HEADER -->
        <header class="chess-header">

            <div class="brand">
                <div class="brand-icon">
                    ♞
                </div>

                <span>Chess</span>
            </div>

            <nav class="nav">
                <a href="{{ route('user.chess.index') }}" class="active">
                    Play
                </a>

                <a href="#">
                    Games
                </a>

                <a href="#">
                    Leaderboard
                </a>
            </nav>

            <div class="user-menu">
                <div class="avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <span>
                    {{ Auth::user()->name }}
                </span>

                <i class="fa-solid fa-chevron-down" style="font-size: 10px; color: #64748b;"></i>
            </div>

        </header>


        <main class="container">

            <!-- HERO -->
            <section class="hero">

                <div class="hero-badge">
                    <i class="fa-solid fa-chess-knight"></i>
                    Chess Arena
                </div>

                <h1>Play Chess</h1>

                <p>
                    Challenge an AI opponent or create a multiplayer game
                    and test your strategy against another player.
                </p>

            </section>


            <!-- GAME OPTIONS -->
            <section class="game-options">

                <!-- SINGLE PLAYER -->
                <div class="game-card">

                    <div class="game-icon ai-icon">
                        <i class="fa-solid fa-robot"></i>
                    </div>

                    <h2>Single Player</h2>

                    <p>
                        Play against an AI opponent and choose the
                        difficulty that matches your skill level.
                    </p>

                    <div class="game-card-footer">

                        <button type="button" class="primary-btn" onclick="openDifficultyModal()">
                            <i class="fa-solid fa-play"></i>
                            &nbsp; Play Against AI
                        </button>

                    </div>

                </div>


                <!-- MULTIPLAYER -->
                <div class="game-card">

                    <div class="game-icon multi-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>

                    <h2>Multiplayer</h2>

                    <p>
                        Create a chess game and invite another player
                        to compete against you.
                    </p>

                    <div class="game-card-footer">

                        <form method="POST" action="{{ route('user.chess.multiplayer.create') }}">

                            @csrf

                            <button type="submit" class="primary-btn">
                                <i class="fa-solid fa-plus"></i>
                                &nbsp; Create Game
                            </button>

                        </form>

                    </div>

                </div>

            </section>


            <!-- PLAYER STATS -->
            <section class="section">

                <div class="section-header">

                    <div>
                        <div class="section-title">
                            Your Chess Stats
                        </div>

                        <div class="section-subtitle">
                            Track your progress and game results.
                        </div>
                    </div>

                </div>

                <div class="stats">

                    <div class="stat">
                        <div class="stat-label">
                            Rating
                        </div>

                        <div class="stat-value">
                            {{ $stats->rating ?? 1200 }}
                        </div>
                    </div>

                    <div class="stat">
                        <div class="stat-label">
                            Games
                        </div>

                        <div class="stat-value">
                            {{ $stats->games_played ?? 0 }}
                        </div>
                    </div>

                    <div class="stat">
                        <div class="stat-label">
                            Wins
                        </div>

                        <div class="stat-value">
                            {{ $stats->wins ?? 0 }}
                        </div>
                    </div>

                    <div class="stat">
                        <div class="stat-label">
                            Draws
                        </div>

                        <div class="stat-value">
                            {{ $stats->draws ?? 0 }}
                        </div>
                    </div>

                </div>

            </section>


            <!-- AVAILABLE GAMES -->
            <section class="section">

                <div class="section-header">

                    <div>
                        <div class="section-title">
                            Available Games
                        </div>

                        <div class="section-subtitle">
                            Join a player who is currently waiting for an opponent.
                        </div>
                    </div>

                </div>

                <div class="games-container">

                    @if($waitingGames->count())

                    <table class="games-table">

                        <thead>
                            <tr>
                                <th>Player</th>
                                <th>Mode</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($waitingGames as $waitingGame)

                            <tr>

                                <td>
                                    <div class="player">

                                        <div class="mini-avatar">
                                            {{ strtoupper(substr($waitingGame->whitePlayer->name, 0, 1)) }}
                                        </div>

                                        {{ $waitingGame->whitePlayer->name }}

                                    </div>
                                </td>

                                <td>
                                    Multiplayer
                                </td>

                                <td>
                                    <span class="status">
                                        <span class="status-dot"></span>
                                        Waiting
                                    </span>
                                </td>

                                <td>

                                    <form method="POST" action="{{ route('user.chess.join', $waitingGame) }}">

                                        @csrf

                                        <button type="submit" class="secondary-btn">
                                            Join Game
                                        </button>

                                    </form>

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                    @else

                    <div class="empty-games">

                        <i class="fa-regular fa-chess-knight"></i>

                        <div>
                            No multiplayer games are currently waiting.
                        </div>

                    </div>

                    @endif

                </div>

            </section>


            <div class="footer">
                Chess Arena &copy; {{ date('Y') }}
            </div>

        </main>

    </div>


    <!-- DIFFICULTY MODAL -->

    <div class="modal-overlay" id="difficultyModal">

        <div class="modal">

            <div class="modal-header">

                <div>
                    <h2>Select Difficulty</h2>

                    <p>
                        Choose your AI opponent.
                    </p>
                </div>

                <button type="button" class="close-btn" onclick="closeDifficultyModal()">

                    <i class="fa-solid fa-xmark"></i>

                </button>

            </div>


            <form method="POST" action="{{ route('user.chess.single.create') }}">

                @csrf

                <input type="hidden" name="ai_difficulty" id="aiDifficulty" value="easy">


                <div class="difficulty-grid">

                    <button type="button" class="difficulty selected" data-difficulty="easy"
                        onclick="selectDifficulty(this)">

                        <strong>Easy</strong>
                        <span>Relaxed opponent</span>

                    </button>


                    <button type="button" class="difficulty" data-difficulty="medium" onclick="selectDifficulty(this)">

                        <strong>Medium</strong>
                        <span>Balanced challenge</span>

                    </button>


                    <button type="button" class="difficulty" data-difficulty="hard" onclick="selectDifficulty(this)">

                        <strong>Hard</strong>
                        <span>Strong opponent</span>

                    </button>


                    <button type="button" class="difficulty" data-difficulty="expert" onclick="selectDifficulty(this)">

                        <strong>Expert</strong>
                        <span>Maximum challenge</span>

                    </button>

                </div>


                <button type="submit" class="primary-btn full-btn">

                    <i class="fa-solid fa-chess"></i>
                    &nbsp; Start Game

                </button>

            </form>

        </div>

    </div>


    <script>
        const difficultyModal =
        document.getElementById('difficultyModal');

    const difficultyInput =
        document.getElementById('aiDifficulty');


    function openDifficultyModal() {

        difficultyModal.classList.add('show');

    }


    function closeDifficultyModal() {

        difficultyModal.classList.remove('show');

    }


    function selectDifficulty(button) {

        document
            .querySelectorAll('.difficulty')
            .forEach(item => {
                item.classList.remove('selected');
            });

        button.classList.add('selected');

        difficultyInput.value =
            button.dataset.difficulty;

    }


    difficultyModal.addEventListener('click', function (event) {

        if (event.target === difficultyModal) {
            closeDifficultyModal();
        }

    });


    document.addEventListener('keydown', function (event) {

        if (event.key === 'Escape') {
            closeDifficultyModal();
        }

    });

    </script>

</body>

</html>
