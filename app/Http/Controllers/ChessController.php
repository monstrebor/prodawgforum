<?php

namespace App\Http\Controllers;

use App\Models\ChessGame;
use App\Models\ChessGamePlayer;
use App\Models\ChessPlayerStats;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ChessController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Chess Lobby
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $waitingGames = ChessGame::with('whitePlayer')
            ->where('mode', 'multiplayer')
            ->where('status', 'waiting')
            ->whereNull('black_player_id')
            ->latest()
            ->get();

        $stats = ChessPlayerStats::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'rating' => 1200,
                'games_played' => 0,
                'wins' => 0,
                'losses' => 0,
                'draws' => 0,
            ]
        );

        return view('chess.index', compact(
            'waitingGames',
            'stats'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Create Single Player Game
    |--------------------------------------------------------------------------
    */

    public function createSingle(Request $request)
    {
        $request->validate([
            'ai_difficulty' => [
                'required',
                'in:easy,medium,hard,expert',
            ],
        ]);

        $user = Auth::user();

        $game = DB::transaction(function () use ($user, $request) {

            $game = ChessGame::create([
                'mode' => 'single',
                'white_player_id' => $user->id,
                'black_player_id' => null,
                'ai_difficulty' => $request->ai_difficulty,
                'status' => 'active',
                'current_turn' => 'white',
                'board_state' => null,
                'winner_id' => null,
                'result' => null,
                'started_at' => now(),
            ]);

            ChessGamePlayer::create([
                'game_id' => $game->id,
                'user_id' => $user->id,
                'color' => 'white',
                'joined_at' => now(),
            ]);

            $this->createPlayerStats($user->id);

            return $game;
        });

        return redirect()->route('user.chess.game', $game->id);
    }

    /*
    |--------------------------------------------------------------------------
    | Create Multiplayer Game
    |--------------------------------------------------------------------------
    */

    public function createMultiplayer()
    {
        $user = Auth::user();

        $game = ChessGame::create([
            'mode' => 'multiplayer',
            'white_player_id' => $user->id,
            'black_player_id' => null,
            'status' => 'waiting',
            'current_turn' => 'white',
            'board_state' => json_encode([
                'a8' => 'black_rook',
                'b8' => 'black_knight',
                'c8' => 'black_bishop',
                'd8' => 'black_queen',
                'e8' => 'black_king',
                'f8' => 'black_bishop',
                'g8' => 'black_knight',
                'h8' => 'black_rook',

                'a7' => 'black_pawn',
                'b7' => 'black_pawn',
                'c7' => 'black_pawn',
                'd7' => 'black_pawn',
                'e7' => 'black_pawn',
                'f7' => 'black_pawn',
                'g7' => 'black_pawn',
                'h7' => 'black_pawn',

                'a2' => 'white_pawn',
                'b2' => 'white_pawn',
                'c2' => 'white_pawn',
                'd2' => 'white_pawn',
                'e2' => 'white_pawn',
                'f2' => 'white_pawn',
                'g2' => 'white_pawn',
                'h2' => 'white_pawn',

                'a1' => 'white_rook',
                'b1' => 'white_knight',
                'c1' => 'white_bishop',
                'd1' => 'white_queen',
                'e1' => 'white_king',
                'f1' => 'white_bishop',
                'g1' => 'white_knight',
                'h1' => 'white_rook',
            ]),
        ]);

        ChessGamePlayer::create([
            'game_id' => $game->id,
            'user_id' => $user->id,
            'color' => 'white',
            'joined_at' => now(),
        ]);

        return redirect()->route('user.chess.game', $game);
    }

    /*
    |--------------------------------------------------------------------------
    | Join Multiplayer Game
    |--------------------------------------------------------------------------
    */

    public function joinGame(ChessGame $game)
    {
        $user = Auth::user();

        if ($game->mode !== 'multiplayer') {
            abort(404);
        }

        if ($game->status !== 'waiting') {
            return back()->with('error', 'This game is no longer available.');
        }

        if ($game->white_player_id === $user->id) {
            return back()->with('error', 'You cannot join your own game.');
        }

        if ($game->black_player_id !== null) {
            return back()->with('error', 'This game already has an opponent.');
        }

        $game->update([
            'black_player_id' => $user->id,
            'status' => 'active',
            'started_at' => now(),
        ]);

        ChessGamePlayer::create([
            'game_id' => $game->id,
            'user_id' => $user->id,
            'color' => 'black',
            'joined_at' => now(),
        ]);

        return redirect()->route('user.chess.game', $game);
    }

    /*
    |--------------------------------------------------------------------------
    | Show Game
    |--------------------------------------------------------------------------
    */

    public function game(ChessGame $game)
    {
        $user = Auth::user();

        $player = $game->gamePlayers()
            ->where('user_id', $user->id)
            ->first();

        if (!$player) {
            abort(403, 'You are not a player in this game.');
        }

        $game->load([
            'whitePlayer',
            'blackPlayer',
            'moves.player',
            'players',
        ]);

        return view('chess.game', [
            'game' => $game,
            'playerColor' => $player->color,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Get Current Game State
    |--------------------------------------------------------------------------
    */

    public function state(ChessGame $game)
    {
        $user = Auth::user();

        $player = $game->gamePlayers()
            ->where('user_id', $user->id)
            ->first();

        if (!$player) {
            abort(403);
        }

        return response()->json([
            'id' => $game->id,
            'status' => $game->status,
            'current_turn' => $game->current_turn,
            'board_state' => $game->board_state,
            'white_player_id' => $game->white_player_id,
            'black_player_id' => $game->black_player_id,
            'player_color' => $player->color,
            'moves' => $game->moves()
                ->orderBy('move_number')
                ->get([
                    'move_number',
                    'from_square',
                    'to_square',
                    'piece',
                    'captured_piece',
                    'promotion_piece',
                    'notation',
                ]),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Make Move
    |--------------------------------------------------------------------------
    */

    public function move(Request $request, ChessGame $game)
    {
        $user = Auth::user();

        $request->validate([
            'from' => ['required', 'string', 'size:2'],
            'to' => ['required', 'string', 'size:2'],
        ]);

        if ($game->mode !== 'multiplayer') {
            return response()->json([
                'message' => 'This move endpoint is for multiplayer games.'
            ], 422);
        }

        if ($game->status !== 'active') {
            return response()->json([
                'message' => 'This game is not active.'
            ], 422);
        }

        $player = $game->gamePlayers()
            ->where('user_id', $user->id)
            ->first();

        if (!$player) {
            return response()->json([
                'message' => 'You are not a player in this game.'
            ], 403);
        }

        if ($game->current_turn !== $player->color) {
            return response()->json([
                'message' => "It is {$game->current_turn}'s turn."
            ], 422);
        }

        $from = $request->input('from');
        $to = $request->input('to');

        /*
        |--------------------------------------------------------------------------
        | Load board
        |--------------------------------------------------------------------------
        */

        if ($game->board_state) {
            $board = json_decode($game->board_state, true);

            if (!is_array($board)) {
                return response()->json([
                    'message' => 'Invalid board state.'
                ], 500);
            }
        } else {
            $board = [
                'a8' => 'black_rook',
                'b8' => 'black_knight',
                'c8' => 'black_bishop',
                'd8' => 'black_queen',
                'e8' => 'black_king',
                'f8' => 'black_bishop',
                'g8' => 'black_knight',
                'h8' => 'black_rook',

                'a7' => 'black_pawn',
                'b7' => 'black_pawn',
                'c7' => 'black_pawn',
                'd7' => 'black_pawn',
                'e7' => 'black_pawn',
                'f7' => 'black_pawn',
                'g7' => 'black_pawn',
                'h7' => 'black_pawn',

                'a2' => 'white_pawn',
                'b2' => 'white_pawn',
                'c2' => 'white_pawn',
                'd2' => 'white_pawn',
                'e2' => 'white_pawn',
                'f2' => 'white_pawn',
                'g2' => 'white_pawn',
                'h2' => 'white_pawn',

                'a1' => 'white_rook',
                'b1' => 'white_knight',
                'c1' => 'white_bishop',
                'd1' => 'white_queen',
                'e1' => 'white_king',
                'f1' => 'white_bishop',
                'g1' => 'white_knight',
                'h1' => 'white_rook',
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Validate source piece
        |--------------------------------------------------------------------------
        */

        $piece = $board[$from] ?? null;

        if (!$piece) {
            return response()->json([
                'message' => 'There is no piece on that square.'
            ], 422);
        }

        $pieceColor = str_starts_with($piece, 'white_')
            ? 'white'
            : 'black';

        if ($pieceColor !== $player->color) {
            return response()->json([
                'message' => 'You cannot move your opponent\'s piece.'
            ], 403);
        }

        /*
        |--------------------------------------------------------------------------
        | Basic destination validation
        |--------------------------------------------------------------------------
        */

        $validMoves = $this->getBasicValidMoves(
            $board,
            $from
        );

        if (!in_array($to, $validMoves, true)) {
            return response()->json([
                'message' => 'That is not a valid move.'
            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Prevent capturing your own piece
        |--------------------------------------------------------------------------
        */

        if (
            isset($board[$to]) &&
            (
                str_starts_with($board[$to], 'white_') &&
                $pieceColor === 'white'
            ) ||
            (
                isset($board[$to]) &&
                str_starts_with($board[$to], 'black_') &&
                $pieceColor === 'black'
            )
        ) {
            return response()->json([
                'message' => 'You cannot capture your own piece.'
            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Capture
        |--------------------------------------------------------------------------
        */

        $capturedPiece = $board[$to] ?? null;

        /*
        |--------------------------------------------------------------------------
        | Move piece
        |--------------------------------------------------------------------------
        */

        $board[$to] = $piece;

        unset($board[$from]);

        /*
        |--------------------------------------------------------------------------
        | Move number
        |--------------------------------------------------------------------------
        */

        $moveNumber = $game->moves()->count() + 1;

        /*
        |--------------------------------------------------------------------------
        | Switch turn
        |--------------------------------------------------------------------------
        */

        $nextTurn = $player->color === 'white'
            ? 'black'
            : 'white';

        /*
        |--------------------------------------------------------------------------
        | Save everything
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use ($game, $user, $board, $nextTurn, $moveNumber, $from, $to, $piece, $capturedPiece) {

            $game->update([
                'board_state' => json_encode($board),
                'current_turn' => $nextTurn,
            ]);

            $game->moves()->create([
                'player_id' => $user->id,
                'move_number' => $moveNumber,
                'from_square' => $from,
                'to_square' => $to,
                'piece' => $piece,
                'captured_piece' => $capturedPiece,
                'notation' => strtoupper($from . '-' . $to),
                'board_state' => json_encode($board),
            ]);
        });

        return response()->json([
            'success' => true,
            'message' => 'Move completed.',
            'board_state' => json_encode($board),
            'current_turn' => $nextTurn,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper: Check Player
    |--------------------------------------------------------------------------
    */

    private function authorizePlayer(
        ChessGame $game,
        int $userId
    ): void {
        $isPlayer = $game->players()
            ->where('users.id', $userId)
            ->exists();

        if (!$isPlayer) {
            abort(403, 'You are not a player in this game.');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Helper: Get Player Color
    |--------------------------------------------------------------------------
    */

    private function getPlayerColor(
        ChessGame $game,
        int $userId
    ): ?string {
        $player = $game->gamePlayers()
            ->where('user_id', $userId)
            ->first();

        return $player?->color;
    }

    /*
    |--------------------------------------------------------------------------
    | Helper: Create Player Stats
    |--------------------------------------------------------------------------
    */

    private function createPlayerStats(int $userId): void
    {
        ChessPlayerStats::firstOrCreate(
            [
                'user_id' => $userId,
            ],
            [
                'rating' => 1200,
                'games_played' => 0,
                'wins' => 0,
                'losses' => 0,
                'draws' => 0,
            ]
        );
    }

    private function getBasicValidMoves(array $board, string $square): array
    {
        $piece = $board[$square] ?? null;

        if (!$piece) {
            return [];
        }

        $color = str_starts_with($piece, 'white_')
            ? 'white'
            : 'black';

        $type = explode('_', $piece)[1];

        $file = ord($square[0]) - ord('a');
        $rank = (int) $square[1];

        $moves = [];

        $addSquare = function (int $file, int $rank) use (&$moves, $board, $color) {

            if (
                $file < 0 ||
                $file > 7 ||
                $rank < 1 ||
                $rank > 8
            ) {
                return false;
            }

            $square =
                chr(ord('a') + $file) . $rank;

            if (!isset($board[$square])) {
                $moves[] = $square;
                return true;
            }

            $targetColor =
                str_starts_with(
                    $board[$square],
                    'white_'
                )
                ? 'white'
                : 'black';

            if ($targetColor !== $color) {
                $moves[] = $square;
            }

            return false;
        };


        /*
        |--------------------------------------------------------------------------
        | Pawn
        |--------------------------------------------------------------------------
        */

        if ($type === 'pawn') {

            $direction =
                $color === 'white'
                ? 1
                : -1;

            $startRank =
                $color === 'white'
                ? 2
                : 7;

            $oneRank =
                $rank + $direction;

            if (
                $oneRank >= 1 &&
                $oneRank <= 8
            ) {

                $oneSquare =
                    chr(ord('a') + $file) . $oneRank;

                if (!isset($board[$oneSquare])) {

                    $moves[] = $oneSquare;

                    $twoRank =
                        $rank + ($direction * 2);

                    $twoSquare =
                        chr(ord('a') + $file) . $twoRank;

                    if (
                        $rank === $startRank &&
                        !isset($board[$twoSquare])
                    ) {
                        $moves[] = $twoSquare;
                    }
                }
            }


            foreach ([-1, 1] as $fileOffset) {

                $captureFile =
                    $file + $fileOffset;

                $captureRank =
                    $rank + $direction;

                if (
                    $captureFile < 0 ||
                    $captureFile > 7 ||
                    $captureRank < 1 ||
                    $captureRank > 8
                ) {
                    continue;
                }

                $captureSquare =
                    chr(ord('a') + $captureFile) .
                    $captureRank;

                if (!isset($board[$captureSquare])) {
                    continue;
                }

                $targetColor =
                    str_starts_with(
                        $board[$captureSquare],
                        'white_'
                    )
                    ? 'white'
                    : 'black';

                if ($targetColor !== $color) {
                    $moves[] = $captureSquare;
                }
            }

            return $moves;
        }


        /*
        |--------------------------------------------------------------------------
        | Knight
        |--------------------------------------------------------------------------
        */

        if ($type === 'knight') {

            $offsets = [
                [-2, -1],
                [-2, 1],
                [-1, -2],
                [-1, 2],
                [1, -2],
                [1, 2],
                [2, -1],
                [2, 1],
            ];

            foreach ($offsets as [$rankOffset, $fileOffset]) {

                $addSquare(
                    $file + $fileOffset,
                    $rank + $rankOffset
                );
            }

            return $moves;
        }


        /*
        |--------------------------------------------------------------------------
        | King
        |--------------------------------------------------------------------------
        */

        if ($type === 'king') {

            for ($rankOffset = -1; $rankOffset <= 1; $rankOffset++) {

                for ($fileOffset = -1; $fileOffset <= 1; $fileOffset++) {

                    if (
                        $rankOffset === 0 &&
                        $fileOffset === 0
                    ) {
                        continue;
                    }

                    $addSquare(
                        $file + $fileOffset,
                        $rank + $rankOffset
                    );
                }
            }

            return $moves;
        }


        /*
        |--------------------------------------------------------------------------
        | Bishop / Rook / Queen
        |--------------------------------------------------------------------------
        */

        $directions = [];

        if ($type === 'bishop' || $type === 'queen') {

            $directions = array_merge(
                $directions,
                [
                    [1, 1],
                    [1, -1],
                    [-1, 1],
                    [-1, -1],
                ]
            );
        }

        if ($type === 'rook' || $type === 'queen') {

            $directions = array_merge(
                $directions,
                [
                    [1, 0],
                    [-1, 0],
                    [0, 1],
                    [0, -1],
                ]
            );
        }

        foreach ($directions as [$rankDirection, $fileDirection]) {

            $currentRank =
                $rank + $rankDirection;

            $currentFile =
                $file + $fileDirection;

            while (
                $currentRank >= 1 &&
                $currentRank <= 8 &&
                $currentFile >= 0 &&
                $currentFile <= 7
            ) {

                $continue =
                    $addSquare(
                        $currentFile,
                        $currentRank
                    );

                if (!$continue) {
                    break;
                }

                $currentRank += $rankDirection;
                $currentFile += $fileDirection;
            }
        }

        return $moves;
    }
}
