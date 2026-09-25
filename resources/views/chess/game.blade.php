<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Chess Game</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background: #111827;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .chess-container {
            width: 100%;
            max-width: 1100px;
        }

        .chess-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            gap: 20px;
        }

        .chess-title h1 {
            margin: 0;
            font-size: 30px;
        }

        .chess-title p {
            margin: 5px 0 0;
            color: #9ca3af;
        }

        .game-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .turn-indicator {
            padding: 10px 16px;
            border-radius: 8px;
            background: #1f2937;
            border: 1px solid #374151;
            font-weight: bold;
        }

        .reset-button {
            border: none;
            padding: 10px 16px;
            border-radius: 8px;
            background: #2563eb;
            color: white;
            cursor: pointer;
            font-weight: bold;
        }

        .reset-button:hover {
            background: #1d4ed8;
        }

        .chess-layout {
            display: grid;
            grid-template-columns: minmax(300px, 760px) 260px;
            gap: 25px;
            align-items: start;
        }

        .board-wrapper {
            width: 100%;
            max-width: 760px;
            aspect-ratio: 1 / 1;
        }

        #chessBoard {
            width: 100%;
            height: 100%;
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            grid-template-rows: repeat(8, 1fr);
            border: 5px solid #374151;
            border-radius: 6px;
            overflow: hidden;
        }

        .square {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            user-select: none;
        }

        .square.light {
            background: #f3e5c8;
        }

        .square.dark {
            background: #8b5e3c;
        }

        .square.selected {
            box-shadow: inset 0 0 0 5px rgba(250, 204, 21, 0.9);
        }

        .square.valid-move::after {
            content: "";
            position: absolute;
            width: 22%;
            height: 22%;
            border-radius: 50%;
            background: rgba(17, 24, 39, 0.35);
        }

        .square.capture-move::after {
            content: "";
            position: absolute;
            width: 72%;
            height: 72%;
            border-radius: 50%;
            border: 5px solid rgba(220, 38, 38, 0.7);
        }

        .piece {
            position: relative;
            z-index: 2;
            font-size: clamp(30px, 7vw, 72px);
            line-height: 1;
            cursor: pointer;
            transition: transform 0.1s ease;
            font-family: "Times New Roman", serif;
        }

        /* WHITE PIECES */

        .white-piece {
            color: #ffffff;
            text-shadow:
                -1px -1px 0 #1f2937,
                1px -1px 0 #1f2937,
                -1px 1px 0 #1f2937,
                1px 1px 0 #1f2937,
                0 3px 4px rgba(0, 0, 0, 0.45);
        }


        /* BLACK PIECES */

        .black-piece {
            color: #111111;
            text-shadow:
                -1px -1px 0 #f3f4f6,
                1px -1px 0 #f3f4f6,
                -1px 1px 0 #f3f4f6,
                1px 1px 0 #f3f4f6,
                0 3px 4px rgba(0, 0, 0, 0.55);
        }


        .piece:hover {
            transform: scale(1.08);
        }

        .coordinate {
            position: absolute;
            font-size: 11px;
            font-weight: bold;
            pointer-events: none;
        }

        .rank {
            top: 4px;
            left: 5px;
        }

        .file {
            bottom: 4px;
            right: 5px;
        }

        .light .coordinate {
            color: #b58863;
        }

        .dark .coordinate {
            color: #f0d9b5;
        }

        .game-panel {
            background: #1f2937;
            border: 1px solid #374151;
            border-radius: 12px;
            padding: 20px;
        }

        .player {
            padding: 15px;
            background: #111827;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .player-label {
            font-size: 12px;
            color: #9ca3af;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .player-name {
            font-size: 18px;
            font-weight: bold;
        }

        .move-history {
            margin-top: 20px;
        }

        .move-history h3 {
            margin: 0 0 12px;
            font-size: 16px;
        }

        #moveHistory {
            max-height: 300px;
            overflow-y: auto;
            background: #111827;
            border-radius: 8px;
            padding: 10px;
        }

        .move-row {
            display: grid;
            grid-template-columns: 35px 1fr 1fr;
            padding: 6px;
            border-bottom: 1px solid #374151;
            font-size: 14px;
        }

        .move-row:last-child {
            border-bottom: none;
        }

        .status-message {
            margin-top: 15px;
            padding: 12px;
            border-radius: 8px;
            background: #111827;
            color: #d1d5db;
            font-size: 14px;
        }

        @media (max-width: 900px) {
            .chess-layout {
                grid-template-columns: 1fr;
            }

            .board-wrapper {
                margin: auto;
            }

            .game-panel {
                width: 100%;
            }
        }

        @media (max-width: 500px) {
            body {
                padding: 10px;
            }

            .chess-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .game-info {
                width: 100%;
                justify-content: space-between;
            }

            #chessBoard {
                border-width: 3px;
            }

            .coordinate {
                font-size: 8px;
            }
        }

        .promotion-modal {
            position: fixed;
            inset: 0;
            display: none;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.7);
            z-index: 9999;
        }

        .promotion-modal.show {
            display: flex;
        }

        .promotion-box {
            width: min(420px, calc(100vw - 30px));
            padding: 25px;
            border-radius: 16px;
            background: #1f2937;
            color: white;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
        }

        .promotion-box h3 {
            margin: 0 0 20px;
            font-size: 20px;
        }

        .promotion-options {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .promotion-options button {
            border: 1px solid #374151;
            border-radius: 12px;
            background: #111827;
            color: white;
            padding: 15px 8px;
            cursor: pointer;
            transition: 0.2s;
        }

        .promotion-options button:hover {
            background: #374151;
        }

        .promotion-options button {
            font-size: 36px;
        }

        .promotion-options span {
            display: block;
            margin-top: 5px;
            font-size: 12px;
        }

        .king-in-check {
            box-shadow:
                inset 0 0 0 4px rgba(239, 68, 68, 0.9),
                inset 0 0 25px rgba(239, 68, 68, 0.5);
            animation: kingCheckPulse 0.8s infinite alternate;
        }

        @keyframes kingCheckPulse {
            from {
                box-shadow:
                    inset 0 0 0 3px rgba(239, 68, 68, 0.7),
                    inset 0 0 15px rgba(239, 68, 68, 0.35);
            }

            to {
                box-shadow:
                    inset 0 0 0 5px rgba(239, 68, 68, 1),
                    inset 0 0 30px rgba(239, 68, 68, 0.7);
            }
        }
    </style>
</head>

<body>

    <div class="chess-container">

        <div class="chess-header">

            <div class="chess-title">
                <h1>♟ Chess</h1>
                <p>
                    {{ $game->mode === 'single' ? 'Single Player' : 'Multiplayer' }}
                </p>
            </div>

            <div class="game-info">

                <div class="turn-indicator" id="turnIndicator">
                    White's Turn
                </div>

                <button type="button" class="reset-button" id="resetBoard">
                    Reset
                </button>

            </div>

        </div>


        <div class="chess-layout">

            <div class="board-wrapper">
                <div id="chessBoard"></div>
            </div>


            <div class="game-panel">

                <div class="player">

                    <div class="player-label">
                        White
                    </div>

                    <div class="player-name">
                        {{ $game->whitePlayer?->name ?? 'White Player' }}
                    </div>

                </div>


                <div class="player">

                    <div class="player-label">
                        Black
                    </div>

                    <div class="player-name">
                        {{ $game->blackPlayer?->name ?? ($game->mode === 'single' ? 'Computer' : 'Waiting...') }}
                    </div>

                </div>


                <div class="move-history">

                    <h3>
                        Move History
                    </h3>

                    <div id="moveHistory">
                        <div style="color:#9ca3af;">
                            No moves yet.
                        </div>
                    </div>

                </div>


                <div class="status-message" id="statusMessage">
                    Select a piece to begin.
                </div>

            </div>

        </div>

    </div>
    <div id="promotionModal" class="promotion-modal">
        <div class="promotion-box">
            <h3>Choose Promotion</h3>

            <div class="promotion-options">
                <button type="button" data-piece="queen">
                    ♛
                    <span>Queen</span>
                </button>

                <button type="button" data-piece="rook">
                    ♜
                    <span>Rook</span>
                </button>

                <button type="button" data-piece="bishop">
                    ♝
                    <span>Bishop</span>
                </button>

                <button type="button" data-piece="knight">
                    ♞
                    <span>Knight</span>
                </button>
            </div>
        </div>
    </div>

    <script>
        const gameId = @json($game->id);
    const playerColor = @json($playerColor);

    const pieces = {
        white_king: '♔',
        white_queen: '♕',
        white_rook: '♖',
        white_bishop: '♗',
        white_knight: '♘',
        white_pawn: '♙',

        black_king: '♚',
        black_queen: '♛',
        black_rook: '♜',
        black_bishop: '♝',
        black_knight: '♞',
        black_pawn: '♟'
    };

    const startingBoard = {
        a8: 'black_rook',
        b8: 'black_knight',
        c8: 'black_bishop',
        d8: 'black_queen',
        e8: 'black_king',
        f8: 'black_bishop',
        g8: 'black_knight',
        h8: 'black_rook',

        a7: 'black_pawn',
        b7: 'black_pawn',
        c7: 'black_pawn',
        d7: 'black_pawn',
        e7: 'black_pawn',
        f7: 'black_pawn',
        g7: 'black_pawn',
        h7: 'black_pawn',

        a2: 'white_pawn',
        b2: 'white_pawn',
        c2: 'white_pawn',
        d2: 'white_pawn',
        e2: 'white_pawn',
        f2: 'white_pawn',
        g2: 'white_pawn',
        h2: 'white_pawn',

        a1: 'white_rook',
        b1: 'white_knight',
        c1: 'white_bishop',
        d1: 'white_queen',
        e1: 'white_king',
        f1: 'white_bishop',
        g1: 'white_knight',
        h1: 'white_rook'
    };

    let board = { ...startingBoard };

    let chessState = {
        board: { ...startingBoard },

        castling: {
            white_kingside: true,
            white_queenside: true,
            black_kingside: true,
            black_queenside: true
        },

        en_passant: null,
        halfmove: 0,
        fullmove: 1
    };

    let selectedSquare = null;
    let currentTurn = 'white';
    let moveHistory = [];

    let isSubmittingMove = false;
    let isRefreshing = false;

    let lastServerData = null;

    const boardElement =
        document.getElementById('chessBoard');

    const turnElement =
        document.getElementById('turnIndicator');

    const historyElement =
        document.getElementById('moveHistory');

    const statusElement =
        document.getElementById('statusMessage');

    const stateUrl =
        @json(route('user.chess.state', $game));

    const moveUrl =
        @json(route('user.chess.move', $game));

    const csrfToken =
        document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute('content');


    /*
     * ============================================================
     * BASIC HELPERS
     * ============================================================
     */

    function getSquareName(row, col) {
        const files = 'abcdefgh';

        return files[col] + (8 - row);
    }


    function getPieceColor(piece) {
        if (!piece) {
            return null;
        }

        return piece.startsWith('white_')
            ? 'white'
            : 'black';
    }


    function getPieceType(piece) {
        if (!piece) {
            return null;
        }

        return piece.split('_')[1];
    }


    function oppositeColor(color) {
        return color === 'white'
            ? 'black'
            : 'white';
    }


    function getCoordinates(square) {
        const files = 'abcdefgh';

        return {
            col: files.indexOf(square[0]),
            row: 8 - parseInt(square[1], 10)
        };
    }


    function coordinatesToSquare(row, col) {
        if (
            row < 0 ||
            row > 7 ||
            col < 0 ||
            col > 7
        ) {
            return null;
        }

        const files = 'abcdefgh';

        return files[col] + (8 - row);
    }


    function isValidSquare(square) {
        return /^[a-h][1-8]$/.test(square);
    }


    /*
     * ============================================================
     * STATE NORMALIZATION
     * ============================================================
     */

    function normalizeChessState(rawState) {
        if (!rawState || typeof rawState !== 'object') {
            return {
                board: { ...startingBoard },

                castling: {
                    white_kingside: true,
                    white_queenside: true,
                    black_kingside: true,
                    black_queenside: true
                },

                en_passant: null,
                halfmove: 0,
                fullmove: 1
            };
        }


        /*
         * New server format:
         *
         * {
         *     board: {...},
         *     castling: {...},
         *     en_passant: null,
         *     halfmove: 0,
         *     fullmove: 1
         * }
         */

        if (
            rawState.board &&
            typeof rawState.board === 'object'
        ) {
            return {
                board: {
                    ...rawState.board
                },

                castling: {
                    white_kingside:
                        rawState.castling?.white_kingside ?? true,

                    white_queenside:
                        rawState.castling?.white_queenside ?? true,

                    black_kingside:
                        rawState.castling?.black_kingside ?? true,

                    black_queenside:
                        rawState.castling?.black_queenside ?? true
                },

                en_passant:
                    rawState.en_passant ?? null,

                halfmove:
                    Number(rawState.halfmove ?? 0),

                fullmove:
                    Number(rawState.fullmove ?? 1)
            };
        }


        /*
         * Backward compatibility with the old format:
         *
         * {
         *     "a1": "white_rook",
         *     "e1": "white_king"
         * }
         */

        return {
            board: {
                ...rawState
            },

            castling: {
                white_kingside: true,
                white_queenside: true,
                black_kingside: true,
                black_queenside: true
            },

            en_passant: null,
            halfmove: 0,
            fullmove: 1
        };
    }


    /*
     * ============================================================
     * CLONE CHESS STATE
     * ============================================================
     */

    function cloneChessState(state) {
        return {
            board: {
                ...state.board
            },

            castling: {
                ...state.castling
            },

            en_passant:
                state.en_passant,

            halfmove:
                state.halfmove,

            fullmove:
                state.fullmove
        };
    }


    /*
     * ============================================================
     * FIND KING
     * ============================================================
     */

    function findKing(state, color) {
        const target = `${color}_king`;

        for (const square in state.board) {
            if (state.board[square] === target) {
                return square;
            }
        }

        return null;
    }


    /*
     * ============================================================
     * PATH CHECK
     * ============================================================
     */

    function isPathClear(state, from, to) {
        const fromCoords =
            getCoordinates(from);

        const toCoords =
            getCoordinates(to);

        const dx =
            Math.sign(
                toCoords.col - fromCoords.col
            );

        const dy =
            Math.sign(
                toCoords.row - fromCoords.row
            );

        let row =
            fromCoords.row + dy;

        let col =
            fromCoords.col + dx;


        while (
            row !== toCoords.row ||
            col !== toCoords.col
        ) {
            const square =
                coordinatesToSquare(
                    row,
                    col
                );

            if (square && state.board[square]) {
                return false;
            }

            row += dy;
            col += dx;
        }

        return true;
    }


    /*
     * ============================================================
     * ATTACK DETECTION
     *
     * IMPORTANT:
     * This intentionally does NOT use legalMoves().
     *
     * A square can be attacked even if the attacking piece
     * itself is pinned.
     * ============================================================
     */

    function pieceAttacksSquare(
        state,
        from,
        target
    ) {
        const piece =
            state.board[from];

        if (!piece) {
            return false;
        }

        const color =
            getPieceColor(piece);

        const type =
            getPieceType(piece);

        const fromCoords =
            getCoordinates(from);

        const targetCoords =
            getCoordinates(target);

        const dx =
            targetCoords.col -
            fromCoords.col;

        const dy =
            targetCoords.row -
            fromCoords.row;


        /*
         * PAWN
         */

        if (type === 'pawn') {
            const direction =
                color === 'white'
                    ? -1
                    : 1;

            return (
                dy === direction &&
                Math.abs(dx) === 1
            );
        }


        /*
         * KNIGHT
         */

        if (type === 'knight') {
            return (
                Math.abs(dx) === 1 &&
                Math.abs(dy) === 2
            ) || (
                Math.abs(dx) === 2 &&
                Math.abs(dy) === 1
            );
        }


        /*
         * KING
         */

        if (type === 'king') {
            return (
                Math.max(
                    Math.abs(dx),
                    Math.abs(dy)
                ) === 1
            );
        }


        /*
         * BISHOP
         */

        if (type === 'bishop') {
            if (
                Math.abs(dx) !==
                Math.abs(dy)
            ) {
                return false;
            }

            return isPathClear(
                state,
                from,
                target
            );
        }


        /*
         * ROOK
         */

        if (type === 'rook') {
            if (
                dx !== 0 &&
                dy !== 0
            ) {
                return false;
            }

            return isPathClear(
                state,
                from,
                target
            );
        }


        /*
         * QUEEN
         */

        if (type === 'queen') {
            if (
                dx !== 0 &&
                dy !== 0 &&
                Math.abs(dx) !==
                Math.abs(dy)
            ) {
                return false;
            }

            return isPathClear(
                state,
                from,
                target
            );
        }

        return false;
    }


    function isSquareAttacked(
        state,
        square,
        byColor
    ) {
        for (const from in state.board) {
            const piece =
                state.board[from];

            if (
                getPieceColor(piece) !==
                byColor
            ) {
                continue;
            }

            if (
                pieceAttacksSquare(
                    state,
                    from,
                    square
                )
            ) {
                return true;
            }
        }

        return false;
    }


    /*
     * ============================================================
     * CHECK DETECTION
     * ============================================================
     */

    function isInCheck(state, color) {
        const kingSquare =
            findKing(
                state,
                color
            );

        if (!kingSquare) {
            return true;
        }

        return isSquareAttacked(
            state,
            kingSquare,
            oppositeColor(color)
        );
    }


    /*
     * ============================================================
     * PAWN PSEUDO MOVES
     * ============================================================
     */

    function getPawnPseudoMoves(
        state,
        square,
        color
    ) {
        const moves = [];

        const {
            row,
            col
        } = getCoordinates(square);

        const direction =
            color === 'white'
                ? -1
                : 1;

        const startRow =
            color === 'white'
                ? 6
                : 1;


        /*
         * ONE SQUARE
         */

        const oneSquare =
            coordinatesToSquare(
                row + direction,
                col
            );

        if (
            oneSquare &&
            !state.board[oneSquare]
        ) {
            moves.push(oneSquare);


            /*
             * TWO SQUARES
             */

            if (row === startRow) {
                const twoSquare =
                    coordinatesToSquare(
                        row + direction * 2,
                        col
                    );

                if (
                    twoSquare &&
                    !state.board[twoSquare]
                ) {
                    moves.push(twoSquare);
                }
            }
        }


        /*
         * NORMAL CAPTURES
         */

        for (const offset of [-1, 1]) {
            const target =
                coordinatesToSquare(
                    row + direction,
                    col + offset
                );

            if (!target) {
                continue;
            }

            const targetPiece =
                state.board[target];

            if (
                targetPiece &&
                getPieceColor(targetPiece) !==
                    color
            ) {
                moves.push(target);
            }


            /*
             * EN PASSANT
             */

            if (
                state.en_passant === target &&
                !targetPiece
            ) {
                moves.push(target);
            }
        }

        return moves;
    }


    /*
     * ============================================================
     * KNIGHT PSEUDO MOVES
     * ============================================================
     */

    function getKnightPseudoMoves(
        state,
        square,
        color
    ) {
        const moves = [];

        const {
            row,
            col
        } = getCoordinates(square);

        const offsets = [
            [-2, -1],
            [-2, 1],
            [-1, -2],
            [-1, 2],
            [1, -2],
            [1, 2],
            [2, -1],
            [2, 1]
        ];

        for (
            const [
                rowOffset,
                colOffset
            ] of offsets
        ) {
            const target =
                coordinatesToSquare(
                    row + rowOffset,
                    col + colOffset
                );

            if (!target) {
                continue;
            }

            if (
                !state.board[target] ||
                getPieceColor(
                    state.board[target]
                ) !== color
            ) {
                moves.push(target);
            }
        }

        return moves;
    }


    /*
     * ============================================================
     * SLIDING MOVES
     * ============================================================
     */

    function getSlidingPseudoMoves(
        state,
        square,
        color,
        directions
    ) {
        const moves = [];

        const {
            row,
            col
        } = getCoordinates(square);

        for (
            const [
                rowDirection,
                colDirection
            ] of directions
        ) {
            let nextRow =
                row + rowDirection;

            let nextCol =
                col + colDirection;


            while (true) {
                const target =
                    coordinatesToSquare(
                        nextRow,
                        nextCol
                    );

                if (!target) {
                    break;
                }


                if (!state.board[target]) {
                    moves.push(target);
                } else {

                    if (
                        getPieceColor(
                            state.board[target]
                        ) !== color
                    ) {
                        moves.push(target);
                    }

                    break;
                }


                nextRow += rowDirection;
                nextCol += colDirection;
            }
        }

        return moves;
    }


    /*
     * ============================================================
     * KING PSEUDO MOVES
     * ============================================================
     */

    function getKingPseudoMoves(
        state,
        square,
        color
    ) {
        const moves = [];

        const {
            row,
            col
        } = getCoordinates(square);


        /*
         * NORMAL KING MOVEMENT
         */

        for (
            let rowOffset = -1;
            rowOffset <= 1;
            rowOffset++
        ) {
            for (
                let colOffset = -1;
                colOffset <= 1;
                colOffset++
            ) {
                if (
                    rowOffset === 0 &&
                    colOffset === 0
                ) {
                    continue;
                }

                const target =
                    coordinatesToSquare(
                        row + rowOffset,
                        col + colOffset
                    );

                if (!target) {
                    continue;
                }

                if (
                    !state.board[target] ||
                    getPieceColor(
                        state.board[target]
                    ) !== color
                ) {
                    moves.push(target);
                }
            }
        }


        /*
         * CASTLING
         */

        const enemy =
            oppositeColor(color);

        const rank =
            color === 'white'
                ? '1'
                : '8';

        const kingSquare =
            `e${rank}`;


        if (square !== kingSquare) {
            return moves;
        }


        /*
         * KING MUST NOT ALREADY BE IN CHECK
         */

        if (isInCheck(state, color)) {
            return moves;
        }


        /*
         * KING SIDE CASTLING
         */

        if (
            state.castling[
                `${color}_kingside`
            ]
        ) {
            const rookSquare =
                `h${rank}`;

            const fSquare =
                `f${rank}`;

            const gSquare =
                `g${rank}`;


            if (
                state.board[rookSquare] ===
                    `${color}_rook` &&

                !state.board[fSquare] &&
                !state.board[gSquare] &&

                !isSquareAttacked(
                    state,
                    fSquare,
                    enemy
                ) &&

                !isSquareAttacked(
                    state,
                    gSquare,
                    enemy
                )
            ) {
                moves.push(gSquare);
            }
        }


        /*
         * QUEEN SIDE CASTLING
         */

        if (
            state.castling[
                `${color}_queenside`
            ]
        ) {
            const rookSquare =
                `a${rank}`;

            const bSquare =
                `b${rank}`;

            const cSquare =
                `c${rank}`;

            const dSquare =
                `d${rank}`;


            if (
                state.board[rookSquare] ===
                    `${color}_rook` &&

                !state.board[bSquare] &&
                !state.board[cSquare] &&
                !state.board[dSquare] &&

                !isSquareAttacked(
                    state,
                    cSquare,
                    enemy
                ) &&

                !isSquareAttacked(
                    state,
                    dSquare,
                    enemy
                )
            ) {
                moves.push(cSquare);
            }
        }

        return moves;
    }


    /*
     * ============================================================
     * PSEUDO MOVES
     * ============================================================
     */

    function getPseudoMoves(
        state,
        square
    ) {
        const piece =
            state.board[square];

        if (!piece) {
            return [];
        }

        const color =
            getPieceColor(piece);

        const type =
            getPieceType(piece);


        switch (type) {
            case 'pawn':
                return getPawnPseudoMoves(
                    state,
                    square,
                    color
                );

            case 'knight':
                return getKnightPseudoMoves(
                    state,
                    square,
                    color
                );

            case 'bishop':
                return getSlidingPseudoMoves(
                    state,
                    square,
                    color,
                    [
                        [1, 1],
                        [1, -1],
                        [-1, 1],
                        [-1, -1]
                    ]
                );

            case 'rook':
                return getSlidingPseudoMoves(
                    state,
                    square,
                    color,
                    [
                        [1, 0],
                        [-1, 0],
                        [0, 1],
                        [0, -1]
                    ]
                );

            case 'queen':
                return getSlidingPseudoMoves(
                    state,
                    square,
                    color,
                    [
                        [1, 1],
                        [1, -1],
                        [-1, 1],
                        [-1, -1],
                        [1, 0],
                        [-1, 0],
                        [0, 1],
                        [0, -1]
                    ]
                );

            case 'king':
                return getKingPseudoMoves(
                    state,
                    square,
                    color
                );

            default:
                return [];
        }
    }


    /*
     * ============================================================
     * APPLY MOVE LOCALLY
     *
     * Used only for determining legal moves.
     * Laravel remains authoritative.
     * ============================================================
     */

    function applyMove(
        originalState,
        from,
        to,
        promotion = 'queen'
    ) {
        const state =
            cloneChessState(
                originalState
            );

        const board =
            state.board;

        const piece =
            board[from];

        if (!piece) {
            return state;
        }

        const color =
            getPieceColor(piece);

        const type =
            getPieceType(piece);

        const capturedPiece =
            board[to] || null;


        /*
         * EN PASSANT CAPTURE
         */

        if (
            type === 'pawn' &&
            to === state.en_passant &&
            !board[to]
        ) {
            const {
                col,
                row
            } = getCoordinates(to);

            const capturedRow =
                color === 'white'
                    ? row + 1
                    : row - 1;

            const capturedSquare =
                coordinatesToSquare(
                    capturedRow,
                    col
                );

            if (capturedSquare) {
                delete board[capturedSquare];
            }
        }


        delete board[from];


        /*
         * CASTLING
         */

        if (type === 'king') {
            const fromCoords =
                getCoordinates(from);

            const toCoords =
                getCoordinates(to);

            if (
                Math.abs(
                    toCoords.col -
                    fromCoords.col
                ) === 2
            ) {
                const rank =
                    color === 'white'
                        ? '1'
                        : '8';

                let rookFrom;
                let rookTo;

                if (
                    toCoords.col >
                    fromCoords.col
                ) {
                    rookFrom = `h${rank}`;
                    rookTo = `f${rank}`;
                } else {
                    rookFrom = `a${rank}`;
                    rookTo = `d${rank}`;
                }

                if (board[rookFrom]) {
                    board[rookTo] =
                        board[rookFrom];

                    delete board[rookFrom];
                }
            }
        }


        /*
         * PROMOTION
         */

        if (type === 'pawn') {
            const rank =
                parseInt(to[1], 10);

            if (
                (
                    color === 'white' &&
                    rank === 8
                ) ||
                (
                    color === 'black' &&
                    rank === 1
                )
            ) {
                const validPromotions = [
                    'queen',
                    'rook',
                    'bishop',
                    'knight'
                ];

                if (
                    !validPromotions.includes(
                        promotion
                    )
                ) {
                    promotion = 'queen';
                }

                board[to] =
                    `${color}_${promotion}`;
            } else {
                board[to] = piece;
            }
        } else {
            board[to] = piece;
        }


        /*
         * UPDATE CASTLING RIGHTS
         */

        if (
            type === 'king' &&
            color === 'white'
        ) {
            state.castling.white_kingside =
                false;

            state.castling.white_queenside =
                false;
        }

        if (
            type === 'king' &&
            color === 'black'
        ) {
            state.castling.black_kingside =
                false;

            state.castling.black_queenside =
                false;
        }


        /*
         * ROOK MOVED OR ROOK WAS CAPTURED
         */

        if (
            from === 'a1' ||
            to === 'a1'
        ) {
            state.castling.white_queenside =
                false;
        }

        if (
            from === 'h1' ||
            to === 'h1'
        ) {
            state.castling.white_kingside =
                false;
        }

        if (
            from === 'a8' ||
            to === 'a8'
        ) {
            state.castling.black_queenside =
                false;
        }

        if (
            from === 'h8' ||
            to === 'h8'
        ) {
            state.castling.black_kingside =
                false;
        }


        /*
         * EN PASSANT TARGET
         */

        state.en_passant = null;

        if (type === 'pawn') {
            const fromCoords =
                getCoordinates(from);

            const toCoords =
                getCoordinates(to);

            if (
                Math.abs(
                    toCoords.row -
                    fromCoords.row
                ) === 2
            ) {
                const middleRow =
                    (
                        fromCoords.row +
                        toCoords.row
                    ) / 2;

                state.en_passant =
                    coordinatesToSquare(
                        middleRow,
                        fromCoords.col
                    );
            }
        }


        /*
         * HALF MOVE CLOCK
         */

        if (
            type === 'pawn' ||
            capturedPiece
        ) {
            state.halfmove = 0;
        } else {
            state.halfmove++;
        }


        /*
         * FULL MOVE NUMBER
         */

        if (color === 'black') {
            state.fullmove++;
        }


        return state;
    }


    /*
     * ============================================================
     * LEGAL MOVES
     *
     * This is where pins and check are enforced.
     * ============================================================
     */

    function getLegalMoves(
        state,
        square
    ) {
        const piece =
            state.board[square];

        if (!piece) {
            return [];
        }

        const color =
            getPieceColor(piece);

        const pseudoMoves =
            getPseudoMoves(
                state,
                square
            );

        const legalMoves = [];

        for (
            const target of pseudoMoves
        ) {
            const nextState =
                applyMove(
                    state,
                    square,
                    target,
                    'queen'
                );

            if (
                !isInCheck(
                    nextState,
                    color
                )
            ) {
                legalMoves.push(target);
            }
        }

        return legalMoves;
    }


    /*
     * ============================================================
     * ALL LEGAL MOVES
     * ============================================================
     */

    function getAllLegalMoves(
        state,
        color
    ) {
        const allMoves = [];

        for (const square in state.board) {
            const piece =
                state.board[square];

            if (
                getPieceColor(piece) !==
                color
            ) {
                continue;
            }

            const moves =
                getLegalMoves(
                    state,
                    square
                );

            for (const target of moves) {
                allMoves.push({
                    from: square,
                    to: target
                });
            }
        }

        return allMoves;
    }


    /*
     * ============================================================
     * CURRENT PLAYER LEGAL MOVES
     * ============================================================
     */

    function getValidMoves(square) {
        const piece =
            board[square];

        if (!piece) {
            return [];
        }

        if (
            getPieceColor(piece) !==
            playerColor
        ) {
            return [];
        }

        if (
            currentTurn !==
            playerColor
        ) {
            return [];
        }

        return getLegalMoves(
            chessState,
            square
        );
    }


    /*
     * ============================================================
     * PROMOTION DETECTION
     * ============================================================
     */

    function isPromotionMove(
        from,
        to
    ) {
        const piece =
            board[from];

        if (
            !piece ||
            getPieceType(piece) !== 'pawn'
        ) {
            return false;
        }

        const rank =
            parseInt(
                to[1],
                10
            );

        return (
            (
                getPieceColor(piece) === 'white' &&
                rank === 8
            ) ||
            (
                getPieceColor(piece) === 'black' &&
                rank === 1
            )
        );
    }


    /*
     * ============================================================
     * PROMOTION MODAL
     * ============================================================
     */

    function createPromotionModal() {
        if (
            document.getElementById(
                'promotionModal'
            )
        ) {
            return;
        }

        const modal =
            document.createElement('div');

        modal.id =
            'promotionModal';

        modal.innerHTML = `
            <div class="promotion-box">
                <h3>Choose Promotion</h3>

                <div class="promotion-options">

                    <button
                        type="button"
                        data-promotion="queen"
                    >
                        <span class="promotion-piece">
                            ♛
                        </span>

                        <span>
                            Queen
                        </span>
                    </button>

                    <button
                        type="button"
                        data-promotion="rook"
                    >
                        <span class="promotion-piece">
                            ♜
                        </span>

                        <span>
                            Rook
                        </span>
                    </button>

                    <button
                        type="button"
                        data-promotion="bishop"
                    >
                        <span class="promotion-piece">
                            ♝
                        </span>

                        <span>
                            Bishop
                        </span>
                    </button>

                    <button
                        type="button"
                        data-promotion="knight"
                    >
                        <span class="promotion-piece">
                            ♞
                        </span>

                        <span>
                            Knight
                        </span>
                    </button>

                </div>
            </div>
        `;

        Object.assign(
            modal.style,
            {
                position: 'fixed',
                inset: '0',
                display: 'none',
                alignItems: 'center',
                justifyContent: 'center',
                background: 'rgba(0,0,0,.75)',
                zIndex: '99999'
            }
        );


        const box =
            modal.querySelector(
                '.promotion-box'
            );

        Object.assign(
            box.style,
            {
                width: 'min(420px, calc(100vw - 30px))',
                padding: '25px',
                borderRadius: '16px',
                background: '#1f2937',
                color: '#fff',
                textAlign: 'center',
                boxShadow:
                    '0 20px 60px rgba(0,0,0,.5)'
            }
        );


        const options =
            modal.querySelector(
                '.promotion-options'
            );

        Object.assign(
            options.style,
            {
                display: 'grid',
                gridTemplateColumns:
                    'repeat(4, 1fr)',
                gap: '10px',
                marginTop: '20px'
            }
        );


        modal
            .querySelectorAll(
                '[data-promotion]'
            )
            .forEach(button => {

                Object.assign(
                    button.style,
                    {
                        border:
                            '1px solid #374151',
                        borderRadius: '12px',
                        background: '#111827',
                        color: '#fff',
                        padding: '12px 6px',
                        cursor: 'pointer',
                        display: 'flex',
                        flexDirection: 'column',
                        alignItems: 'center',
                        gap: '5px'
                    }
                );

                const pieceElement =
                    button.querySelector(
                        '.promotion-piece'
                    );

                Object.assign(
                    pieceElement.style,
                    {
                        fontSize: '36px',
                        lineHeight: '1'
                    }
                );
            });


        document.body.appendChild(modal);
    }


    function choosePromotion() {
        createPromotionModal();

        return new Promise(resolve => {
            const modal =
                document.getElementById(
                    'promotionModal'
                );

            const buttons =
                modal.querySelectorAll(
                    '[data-promotion]'
                );

            modal.style.display =
                'flex';


            const handlers = [];


            buttons.forEach(button => {

                const handler = () => {

                    const promotion =
                        button.dataset
                            .promotion;

                    modal.style.display =
                        'none';

                    buttons.forEach(
                        (
                            btn,
                            index
                        ) => {
                            btn.removeEventListener(
                                'click',
                                handlers[index]
                            );
                        }
                    );

                    resolve(
                        promotion
                    );
                };


                handlers.push(handler);

                button.addEventListener(
                    'click',
                    handler
                );
            });
        });
    }


    /*
     * ============================================================
     * HANDLE SQUARE CLICK
     * ============================================================
     */

    async function handleSquareClick(square) {
        if (isSubmittingMove) {
            return;
        }


        if (
            lastServerData?.status ===
            'completed'
        ) {
            return;
        }


        const piece =
            board[square];


        /*
         * NOTHING SELECTED
         */

        if (!selectedSquare) {

            if (!piece) {
                return;
            }


            if (
                getPieceColor(piece) !==
                playerColor
            ) {
                setStatus(
                    `You are playing as ${capitalize(playerColor)}.`
                );

                return;
            }


            if (
                currentTurn !==
                playerColor
            ) {
                setStatus(
                    `${capitalize(currentTurn)}'s turn. Please wait.`
                );

                return;
            }


            const availableMoves =
                getValidMoves(square);


            if (!availableMoves.length) {

                if (
                    isInCheck(
                        chessState,
                        playerColor
                    )
                ) {
                    setStatus(
                        'Your king is in check and this piece has no legal move.'
                    );
                } else {
                    setStatus(
                        'This piece has no legal moves.'
                    );
                }

                return;
            }


            selectedSquare =
                square;

            setStatus(
                `Selected ${square}. Choose a highlighted square.`
            );

            renderBoard();

            return;
        }


        /*
         * CLICK SAME SQUARE
         */

        if (
            square ===
            selectedSquare
        ) {
            selectedSquare = null;

            setStatus(
                'Select a piece to begin.'
            );

            renderBoard();

            return;
        }


        /*
         * SELECT ANOTHER OWN PIECE
         */

        if (
            piece &&
            getPieceColor(piece) ===
                playerColor
        ) {

            if (
                currentTurn !==
                playerColor
            ) {
                return;
            }


            const availableMoves =
                getValidMoves(square);


            if (!availableMoves.length) {

                setStatus(
                    'That piece has no legal moves.'
                );

                return;
            }


            selectedSquare =
                square;

            setStatus(
                `Selected ${square}. Choose a highlighted square.`
            );

            renderBoard();

            return;
        }


        /*
         * DESTINATION
         */

        const validMoves =
            getValidMoves(
                selectedSquare
            );


        if (
            !validMoves.includes(square)
        ) {
            setStatus(
                'That is not a legal chess move.'
            );

            return;
        }


        const from =
            selectedSquare;

        const to =
            square;


        selectedSquare = null;

        renderBoard();


        /*
         * PROMOTION
         */

        let promotion = null;

        if (
            isPromotionMove(
                from,
                to
            )
        ) {
            promotion =
                await choosePromotion();
        }


        await movePiece(
            from,
            to,
            promotion
        );
    }


    /*
     * ============================================================
     * RENDER BOARD
     * ============================================================
     */

    function renderBoard() {
        if (!boardElement) {
            return;
        }

        boardElement.innerHTML = '';


        for (
            let row = 0;
            row < 8;
            row++
        ) {

            for (
                let col = 0;
                col < 8;
                col++
            ) {

                const square =
                    getSquareName(
                        row,
                        col
                    );


                const squareElement =
                    document.createElement(
                        'div'
                    );


                squareElement.classList.add(
                    'square'
                );


                if (
                    (row + col) % 2 === 0
                ) {
                    squareElement.classList.add(
                        'light'
                    );
                } else {
                    squareElement.classList.add(
                        'dark'
                    );
                }


                squareElement.dataset.square =
                    square;


                const piece =
                    board[square];


                if (piece) {

                    const pieceElement =
                        document.createElement(
                            'span'
                        );


                    pieceElement.classList.add(
                        'piece',

                        getPieceColor(piece) ===
                            'white'
                            ? 'white-piece'
                            : 'black-piece'
                    );


                    pieceElement.textContent =
                        pieces[piece] ||
                        '';


                    pieceElement.dataset.piece =
                        piece;


                    squareElement.appendChild(
                        pieceElement
                    );
                }


                squareElement.addEventListener(
                    'click',
                    () =>
                        handleSquareClick(
                            square
                        )
                );


                boardElement.appendChild(
                    squareElement
                );
            }
        }


        highlightSelectedSquare();

        highlightKingInCheck();
    }


    /*
     * ============================================================
     * HIGHLIGHT SELECTED SQUARE
     * ============================================================
     */

    function highlightSelectedSquare() {
        if (!selectedSquare) {
            return;
        }


        const selectedElement =
            document.querySelector(
                `[data-square="${selectedSquare}"]`
            );


        if (selectedElement) {
            selectedElement.classList.add(
                'selected'
            );
        }


        const validMoves =
            getValidMoves(
                selectedSquare
            );


        validMoves.forEach(square => {

            const element =
                document.querySelector(
                    `[data-square="${square}"]`
                );


            if (!element) {
                return;
            }


            if (board[square]) {

                element.classList.add(
                    'capture-move'
                );

            } else {

                element.classList.add(
                    'valid-move'
                );
            }
        });
    }


    /*
     * ============================================================
     * HIGHLIGHT KING IN CHECK
     * ============================================================
     */

    function highlightKingInCheck() {
        for (
            const color of [
                'white',
                'black'
            ]
        ) {

            if (
                !isInCheck(
                    chessState,
                    color
                )
            ) {
                continue;
            }


            const kingSquare =
                findKing(
                    chessState,
                    color
                );


            if (!kingSquare) {
                continue;
            }


            const kingElement =
                document.querySelector(
                    `[data-square="${kingSquare}"]`
                );


            if (kingElement) {
                kingElement.classList.add(
                    'king-in-check'
                );
            }
        }
    }


    /*
     * ============================================================
     * SEND MOVE TO SERVER
     * ============================================================
     */

    async function movePiece(
        from,
        to,
        promotion = null
    ) {

        if (isSubmittingMove) {
            return;
        }


        const piece =
            board[from];


        if (!piece) {
            return;
        }


        if (
            getPieceColor(piece) !==
            playerColor
        ) {

            setStatus(
                'You cannot move that piece.'
            );

            selectedSquare = null;

            renderBoard();

            return;
        }


        if (
            currentTurn !==
            playerColor
        ) {

            setStatus(
                `${capitalize(currentTurn)}'s turn.`
            );

            selectedSquare = null;

            renderBoard();

            return;
        }


        /*
         * Final client-side legality check.
         */

        const validMoves =
            getValidMoves(from);


        if (
            !validMoves.includes(to)
        ) {

            setStatus(
                'That is not a legal chess move.'
            );

            selectedSquare = null;

            renderBoard();

            return;
        }


        isSubmittingMove = true;

        setStatus(
            'Sending move...'
        );


        try {

            const response =
                await fetch(
                    moveUrl,
                    {
                        method: 'POST',

                        headers: {
                            'Content-Type':
                                'application/json',

                            'Accept':
                                'application/json',

                            'X-CSRF-TOKEN':
                                csrfToken,

                            'X-Requested-With':
                                'XMLHttpRequest'
                        },

                        body: JSON.stringify({
                            from: from,
                            to: to,
                            promotion:
                                promotion
                        })
                    }
                );


            const data =
                await response.json();


            if (!response.ok) {

                throw new Error(
                    data.message ||
                    'The move could not be completed.'
                );
            }


            selectedSquare = null;


            /*
             * Laravel is authoritative.
             */

            await refreshGameState();


            if (data.checkmate) {

                setStatus(
                    'Checkmate!'
                );

            } else if (data.stalemate) {

                setStatus(
                    'Stalemate — Draw.'
                );

            } else if (data.check) {

                setStatus(
                    `${capitalize(
                        data.current_turn
                    )} is in check.`
                );

            } else {

                setStatus(
                    data.message ||
                    'Move completed.'
                );
            }


        } catch (error) {

            console.error(
                'Move error:',
                error
            );


            selectedSquare = null;

            renderBoard();


            setStatus(
                error.message ||
                'Unable to make the move.'
            );

        } finally {

            isSubmittingMove = false;
        }
    }


    /*
     * ============================================================
     * REFRESH GAME STATE
     * ============================================================
     */

    async function refreshGameState() {

        if (isRefreshing) {
            return;
        }

        isRefreshing = true;


        try {

            const response =
                await fetch(
                    stateUrl +
                    '?_=' +
                    Date.now(),
                    {
                        method: 'GET',

                        headers: {
                            'Accept':
                                'application/json',

                            'X-Requested-With':
                                'XMLHttpRequest'
                        },

                        cache: 'no-store'
                    }
                );


            if (!response.ok) {

                console.error(
                    'State request failed:',
                    response.status
                );

                return;
            }


            const data =
                await response.json();


            lastServerData =
                data;


            /*
             * BOARD STATE
             */

            if (data.board_state) {

                try {

                    const parsedState =
                        JSON.parse(
                            data.board_state
                        );


                    chessState =
                        normalizeChessState(
                            parsedState
                        );


                    board =
                        chessState.board;

                } catch (error) {

                    console.error(
                        'Invalid board state:',
                        error
                    );

                    return;
                }
            }


            /*
             * CURRENT TURN
             */

            if (data.current_turn) {
                currentTurn =
                    data.current_turn;
            }


            /*
             * MOVE HISTORY
             */

            if (
                Array.isArray(
                    data.moves
                )
            ) {
                moveHistory =
                    data.moves;
            }


            /*
             * CLEAR INVALID SELECTION
             */

            if (selectedSquare) {

                const selectedPiece =
                    board[
                        selectedSquare
                    ];


                if (
                    !selectedPiece ||
                    getPieceColor(
                        selectedPiece
                    ) !== playerColor ||
                    currentTurn !== playerColor
                ) {

                    selectedSquare =
                        null;
                }
            }


            renderBoard();

            updateTurnDisplay();

            updateMoveHistory();

            updateGameStatus(data);


        } catch (error) {

            console.error(
                'Failed to refresh game:',
                error
            );

        } finally {

            isRefreshing = false;
        }
    }


    /*
     * ============================================================
     * TURN DISPLAY
     * ============================================================
     */

    function updateTurnDisplay() {

        if (!turnElement) {
            return;
        }


        if (
            lastServerData?.status ===
            'completed'
        ) {

            turnElement.textContent =
                'Game Over';

            return;
        }


        if (
            currentTurn ===
            playerColor
        ) {

            turnElement.textContent =
                `${capitalize(playerColor)}'s Turn`;

        } else {

            turnElement.textContent =
                `${capitalize(currentTurn)}'s Turn`;
        }
    }


    /*
     * ============================================================
     * MOVE HISTORY
     * ============================================================
     */

    function updateMoveHistory() {

        if (!historyElement) {
            return;
        }


        if (!moveHistory.length) {

            historyElement.innerHTML = `
                <div style="color:#9ca3af;">
                    No moves yet.
                </div>
            `;

            return;
        }


        historyElement.innerHTML = '';


        const groupedMoves = {};


        moveHistory.forEach(move => {

            const number =
                move.move_number ?? 1;


            if (
                !groupedMoves[number]
            ) {
                groupedMoves[number] = [];
            }


            groupedMoves[number].push(
                move
            );
        });


        Object.keys(groupedMoves)
            .sort(
                (a, b) =>
                    Number(a) -
                    Number(b)
            )
            .forEach(number => {

                const moves =
                    groupedMoves[number];


                const row =
                    document.createElement(
                        'div'
                    );


                row.className =
                    'move-row';


                const numberElement =
                    document.createElement(
                        'div'
                    );


                numberElement.textContent =
                    number + '.';


                const whiteElement =
                    document.createElement(
                        'div'
                    );


                const blackElement =
                    document.createElement(
                        'div'
                    );


                moves.forEach(move => {

                    const notation =
                        move.notation ||
                        `${move.from_square} → ${move.to_square}`;


                    const movePlayer =
                        move.player?.id ??
                        move.player_id;


                    if (
                        movePlayer &&
                        String(movePlayer) ===
                        String(
                            @json($game->white_player_id)
                        )
                    ) {

                        whiteElement.textContent =
                            notation;

                    } else {

                        blackElement.textContent =
                            notation;
                    }
                });


                row.appendChild(
                    numberElement
                );

                row.appendChild(
                    whiteElement
                );

                row.appendChild(
                    blackElement
                );


                historyElement.appendChild(
                    row
                );
            });
    }


    /*
     * ============================================================
     * GAME STATUS
     * ============================================================
     */

    function updateGameStatus(data) {

        if (!statusElement) {
            return;
        }


        /*
         * WAITING
         */

        if (
            data.status ===
            'waiting'
        ) {

            statusElement.textContent =
                playerColor === 'white'
                    ? 'Waiting for an opponent...'
                    : 'Waiting for the game to start.';

            return;
        }


        /*
         * COMPLETED
         */

        if (
            data.status ===
            'completed'
        ) {

            if (
                data.result ===
                'checkmate'
            ) {

                if (
                    data.winner_id &&
                    String(data.winner_id) ===
                    String(
                        @json($game->white_player_id)
                    )
                ) {

                    statusElement.textContent =
                        'Checkmate — White wins.';

                } else {

                    statusElement.textContent =
                        'Checkmate — Black wins.';
                }

                return;
            }


            if (
                data.result ===
                'stalemate'
            ) {

                statusElement.textContent =
                    'Stalemate — Draw.';

                return;
            }


            if (
                data.result ===
                'draw'
            ) {

                statusElement.textContent =
                    'Draw.';

                return;
            }


            statusElement.textContent =
                'Game completed.';

            return;
        }


        /*
         * ABANDONED
         */

        if (
            data.status ===
            'abandoned'
        ) {

            statusElement.textContent =
                'Game abandoned.';

            return;
        }


        /*
         * ACTIVE
         */

        if (
            data.status ===
            'active'
        ) {

            const currentColor =
                data.current_turn ||
                currentTurn;


            if (
                data.check &&
                currentColor ===
                    playerColor
            ) {

                statusElement.textContent =
                    'Check! Your king is under attack.';

                return;
            }


            if (
                isInCheck(
                    chessState,
                    currentColor
                )
            ) {

                if (
                    currentColor ===
                    playerColor
                ) {

                    statusElement.textContent =
                        'Check! Your king is under attack.';

                } else {

                    statusElement.textContent =
                        `Check — ${capitalize(currentColor)} must respond.`;
                }

                return;
            }


            if (
                currentColor ===
                playerColor
            ) {

                statusElement.textContent =
                    'Your turn. Select a piece to move.';

            } else {

                statusElement.textContent =
                    `Waiting for ${currentColor} to move.`;
            }

            return;
        }
    }


    /*
     * ============================================================
     * STATUS MESSAGE
     * ============================================================
     */

    function setStatus(message) {

        if (!statusElement) {
            return;
        }

        statusElement.textContent =
            message;
    }


    /*
     * ============================================================
     * CAPITALIZE
     * ============================================================
     */

    function capitalize(value) {

        if (!value) {
            return '';
        }

        return (
            value.charAt(0).toUpperCase() +
            value.slice(1)
        );
    }


    /*
     * ============================================================
     * INITIALIZATION
     * ============================================================
     */

    createPromotionModal();

    renderBoard();

    updateTurnDisplay();

    updateMoveHistory();

    refreshGameState();


    /*
     * ============================================================
     * LIVE MULTIPLAYER POLLING
     * ============================================================
     */

    setInterval(
        refreshGameState,
        1000
    );
    </script>


</body>

</html>
