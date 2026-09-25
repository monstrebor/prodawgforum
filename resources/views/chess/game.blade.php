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

    let selectedSquare = null;
    let currentTurn = 'white';
    let moveHistory = [];

    let isSubmittingMove = false;

    const boardElement = document.getElementById('chessBoard');
    const turnElement = document.getElementById('turnIndicator');
    const historyElement = document.getElementById('moveHistory');
    const statusElement = document.getElementById('statusMessage');

    const stateUrl = @json(route('user.chess.state', $game));
    const moveUrl = @json(route('user.chess.move', $game));

    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute('content');


    /*
     * GET SQUARE NAME
     */

    function getSquareName(row, col) {

        const files = 'abcdefgh';

        return files[col] + (8 - row);
    }


    /*
     * GET PIECE COLOR
     */

    function getPieceColor(piece) {

        if (!piece) {
            return null;
        }

        return piece.startsWith('white_')
            ? 'white'
            : 'black';
    }


    /*
     * GET PIECE TYPE
     */

    function getPieceType(piece) {

        if (!piece) {
            return null;
        }

        return piece.split('_')[1];
    }


    /*
     * RENDER BOARD
     */

    function renderBoard() {

        if (!boardElement) {
            return;
        }

        boardElement.innerHTML = '';

        for (let row = 0; row < 8; row++) {

            for (let col = 0; col < 8; col++) {

                const square = getSquareName(row, col);

                const squareElement =
                    document.createElement('div');

                squareElement.classList.add('square');

                if ((row + col) % 2 === 0) {
                    squareElement.classList.add('light');
                } else {
                    squareElement.classList.add('dark');
                }

                squareElement.dataset.square = square;

                const piece = board[square];

                if (piece) {

                    const pieceElement =
                        document.createElement('span');

                    pieceElement.classList.add(
                        'piece',
                        getPieceColor(piece) === 'white'
                            ? 'white-piece'
                            : 'black-piece'
                    );

                    pieceElement.textContent = pieces[piece];

                    pieceElement.dataset.piece = piece;

                    squareElement.appendChild(pieceElement);
                }

                squareElement.addEventListener(
                    'click',
                    () => handleSquareClick(square)
                );

                boardElement.appendChild(squareElement);
            }
        }

        highlightSelectedSquare();
    }


    /*
     * HANDLE SQUARE CLICK
     */

    function handleSquareClick(square) {

        if (isSubmittingMove) {
            return;
        }

        const piece = board[square];


        /*
         * NOTHING SELECTED
         */

        if (!selectedSquare) {

            if (!piece) {
                return;
            }

            /*
             * Player can only select their own pieces.
             */

            if (getPieceColor(piece) !== playerColor) {

                setStatus(
                    `You are playing as ${capitalize(playerColor)}.`
                );

                return;
            }

            /*
             * Player cannot move when it is
             * the opponent's turn.
             */

            if (currentTurn !== playerColor) {

                setStatus(
                    `${capitalize(currentTurn)}'s turn. Please wait.`
                );

                return;
            }

            selectedSquare = square;

            setStatus(
                `Selected ${square}. Choose a highlighted square.`
            );

            renderBoard();

            return;
        }


        /*
         * CLICK SAME SQUARE
         * CANCEL SELECTION
         */

        if (square === selectedSquare) {

            selectedSquare = null;

            setStatus('Select a piece to begin.');

            renderBoard();

            return;
        }


        /*
         * CLICK ANOTHER OWN PIECE
         * CHANGE SELECTION
         */

        if (
            piece &&
            getPieceColor(piece) === playerColor
        ) {

            if (currentTurn !== playerColor) {
                return;
            }

            selectedSquare = square;

            setStatus(
                `Selected ${square}. Choose a highlighted square.`
            );

            renderBoard();

            return;
        }


        /*
         * CHECK VALID MOVES
         */

        const validMoves =
            getValidMoves(selectedSquare);

        if (!validMoves.includes(square)) {

            setStatus('That is not a valid move.');

            return;
        }


        /*
         * SEND MOVE TO SERVER
         */

        movePiece(
            selectedSquare,
            square
        );
    }


    /*
     * HIGHLIGHT SELECTED SQUARE
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
            selectedElement.classList.add('selected');
        }


        const validMoves =
            getValidMoves(selectedSquare);


        validMoves.forEach(square => {

            const element =
                document.querySelector(
                    `[data-square="${square}"]`
                );

            if (!element) {
                return;
            }

            element.classList.add('valid-move');

            if (board[square]) {

                element.classList.remove('valid-move');

                element.classList.add(
                    'capture-move'
                );
            }
        });
    }


    /*
     * SEND MOVE TO LARAVEL
     */

    async function movePiece(from, to) {

        if (isSubmittingMove) {
            return;
        }

        const piece = board[from];

        if (!piece) {
            return;
        }

        /*
         * Extra client-side protection.
         */

        if (getPieceColor(piece) !== playerColor) {

            setStatus(
                'You cannot move that piece.'
            );

            selectedSquare = null;

            renderBoard();

            return;
        }


        if (currentTurn !== playerColor) {

            setStatus(
                `${capitalize(currentTurn)}'s turn.`
            );

            selectedSquare = null;

            renderBoard();

            return;
        }


        isSubmittingMove = true;

        setStatus('Sending move...');


        try {

            const response = await fetch(
                moveUrl,
                {
                    method: 'POST',

                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },

                    body: JSON.stringify({
                        from: from,
                        to: to
                    })
                }
            );


            const data = await response.json();


            if (!response.ok) {

                throw new Error(
                    data.message ||
                    'The move could not be completed.'
                );
            }


            /*
             * Laravel is authoritative.
             *
             * Do NOT manually move the piece here.
             * Refresh the board from the server.
             */

            selectedSquare = null;

            await refreshGameState();


            setStatus(
                data.message ||
                'Move completed.'
            );

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
     * GET VALID MOVES
     */

    function getValidMoves(square) {

        const piece = board[square];

        if (!piece) {
            return [];
        }

        const color =
            getPieceColor(piece);

        const type =
            getPieceType(piece);


        switch (type) {

            case 'pawn':

                return getPawnMoves(
                    square,
                    color
                );


            case 'knight':

                return getKnightMoves(
                    square,
                    color
                );


            case 'bishop':

                return getSlidingMoves(
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

                return getSlidingMoves(
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

                return getSlidingMoves(
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

                return getKingMoves(
                    square,
                    color
                );


            default:

                return [];
        }
    }


    /*
     * GET COORDINATES
     */

    function getCoordinates(square) {

        const files = 'abcdefgh';

        return {
            col: files.indexOf(square[0]),
            row: 8 - parseInt(square[1])
        };
    }


    /*
     * COORDINATES TO SQUARE
     */

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


    /*
     * PAWN MOVES
     */

    function getPawnMoves(square, color) {

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
         * ONE SQUARE FORWARD
         */

        const oneRow =
            row + direction;

        const oneSquare =
            coordinatesToSquare(
                oneRow,
                col
            );


        if (
            oneSquare &&
            !board[oneSquare]
        ) {

            moves.push(oneSquare);


            /*
             * TWO SQUARES FROM START
             */

            const twoRow =
                row + direction * 2;

            const twoSquare =
                coordinatesToSquare(
                    twoRow,
                    col
                );


            if (
                row === startRow &&
                twoSquare &&
                !board[twoSquare]
            ) {

                moves.push(twoSquare);
            }
        }


        /*
         * PAWN CAPTURES
         */

        for (const offset of [-1, 1]) {

            const captureSquare =
                coordinatesToSquare(
                    row + direction,
                    col + offset
                );


            if (!captureSquare) {
                continue;
            }


            const target =
                board[captureSquare];


            if (
                target &&
                getPieceColor(target) !== color
            ) {

                moves.push(captureSquare);
            }
        }


        return moves;
    }


    /*
     * KNIGHT MOVES
     */

    function getKnightMoves(square, color) {

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


        offsets.forEach(
            ([rowOffset, colOffset]) => {

                const target =
                    coordinatesToSquare(
                        row + rowOffset,
                        col + colOffset
                    );


                if (!target) {
                    return;
                }


                if (
                    !board[target] ||
                    getPieceColor(board[target]) !== color
                ) {

                    moves.push(target);
                }
            }
        );


        return moves;
    }


    /*
     * KING MOVES
     */

    function getKingMoves(square, color) {

        const moves = [];

        const {
            row,
            col
        } = getCoordinates(square);


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
                    !board[target] ||
                    getPieceColor(board[target]) !== color
                ) {

                    moves.push(target);
                }
            }
        }


        return moves;
    }


    /*
     * SLIDING PIECES
     *
     * Bishop
     * Rook
     * Queen
     */

    function getSlidingMoves(
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


                if (!board[target]) {

                    moves.push(target);

                } else {

                    if (
                        getPieceColor(board[target]) !== color
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
     * REFRESH GAME STATE
     */

    async function refreshGameState() {

        try {

            const response =
                await fetch(
                    stateUrl + '?_=' + Date.now(),
                    {
                        method: 'GET',

                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
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


            /*
             * Update board from Laravel.
             */

            if (data.board_state) {

                try {

                    board =
                        JSON.parse(
                            data.board_state
                        );

                } catch (error) {

                    console.error(
                        'Invalid board state:',
                        error
                    );

                    return;
                }
            }


            /*
             * Update turn from Laravel.
             */

            if (data.current_turn) {

                currentTurn =
                    data.current_turn;
            }


            /*
             * Update move history.
             */

            if (Array.isArray(data.moves)) {

                moveHistory =
                    data.moves;
            }


            /*
             * Clear selection if it is no
             * longer valid.
             */

            if (selectedSquare) {

                const selectedPiece =
                    board[selectedSquare];

                if (
                    !selectedPiece ||
                    getPieceColor(selectedPiece) !== playerColor ||
                    currentTurn !== playerColor
                ) {

                    selectedSquare = null;
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
        }
    }


    /*
     * UPDATE TURN DISPLAY
     */

    function updateTurnDisplay() {

        if (!turnElement) {
            return;
        }


        if (currentTurn === playerColor) {

            turnElement.textContent =
                `${capitalize(playerColor)}'s Turn`;

        } else {

            turnElement.textContent =
                `${capitalize(currentTurn)}'s Turn`;
        }
    }


    /*
     * UPDATE MOVE HISTORY
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


        /*
         * Group moves by move number.
         */

        const groupedMoves = {};


        moveHistory.forEach(move => {

            const number =
                move.move_number ?? 1;


            if (!groupedMoves[number]) {
                groupedMoves[number] = [];
            }


            groupedMoves[number].push(move);
        });


        Object.keys(groupedMoves)
            .sort(
                (a, b) => Number(a) - Number(b)
            )
            .forEach(number => {

                const moves =
                    groupedMoves[number];


                const row =
                    document.createElement('div');

                row.className =
                    'move-row';


                const numberElement =
                    document.createElement('div');

                numberElement.textContent =
                    number + '.';


                const whiteElement =
                    document.createElement('div');


                const blackElement =
                    document.createElement('div');


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
                        String(@json($game->white_player_id))
                    ) {

                        whiteElement.textContent =
                            notation;

                    } else {

                        blackElement.textContent =
                            notation;
                    }
                });


                row.appendChild(numberElement);
                row.appendChild(whiteElement);
                row.appendChild(blackElement);

                historyElement.appendChild(row);
            });
    }


    /*
     * UPDATE GAME STATUS
     */

    function updateGameStatus(data) {

        if (!statusElement) {
            return;
        }


        if (data.status === 'waiting') {

            statusElement.textContent =
                playerColor === 'white'
                    ? 'Waiting for an opponent...'
                    : 'Waiting for the game to start.';

            return;
        }


        if (data.status === 'active') {

            if (currentTurn === playerColor) {

                statusElement.textContent =
                    'Your turn. Select a piece to move.';

            } else {

                statusElement.textContent =
                    `Waiting for ${currentTurn} to move.`;
            }

            return;
        }


        if (data.status === 'completed') {

            statusElement.textContent =
                'Game completed.';

            return;
        }


        if (data.status === 'abandoned') {

            statusElement.textContent =
                'Game abandoned.';

            return;
        }
    }


    /*
     * STATUS MESSAGE
     */

    function setStatus(message) {

        if (!statusElement) {
            return;
        }

        statusElement.textContent = message;
    }


    /*
     * CAPITALIZE
     */

    function capitalize(value) {

        if (!value) {
            return '';
        }

        return value.charAt(0).toUpperCase()
            + value.slice(1);
    }


    /*
     * INITIAL LOAD
     */

    renderBoard();

    updateTurnDisplay();

    updateMoveHistory();


    /*
     * GET CURRENT SERVER STATE IMMEDIATELY
     */

    refreshGameState();


    /*
     * REFRESH EVERY SECOND
     */

    setInterval(
        refreshGameState,
        1000
    );
</script>


</body>

</html>
