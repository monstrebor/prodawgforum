<?php

namespace App\Services\Chess;

use InvalidArgumentException;

class ChessService
{
    public static function startingState(): array
    {
        return [
            'board' => [
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
            ],

            'castling' => [
                'white_kingside' => true,
                'white_queenside' => true,
                'black_kingside' => true,
                'black_queenside' => true,
            ],

            'en_passant' => null,
            'halfmove' => 0,
            'fullmove' => 1,
        ];
    }

    public static function normalizeState(?string $state): array
    {
        if (!$state) {
            return self::startingState();
        }

        $decoded = json_decode($state, true);

        if (!is_array($decoded)) {
            return self::startingState();
        }

        /*
         * Supports both:
         *
         * {
         *   "board": {...},
         *   "castling": {...}
         * }
         *
         * and the old format:
         *
         * {
         *   "a1": "white_rook",
         *   ...
         * }
         */
        if (isset($decoded['board']) && is_array($decoded['board'])) {
            $state = $decoded;
        } else {
            $state = self::startingState();
            $state['board'] = $decoded;
        }

        $state['castling'] = array_merge(
            self::startingState()['castling'],
            $state['castling'] ?? []
        );

        $state['en_passant'] = $state['en_passant'] ?? null;
        $state['halfmove'] = (int) ($state['halfmove'] ?? 0);
        $state['fullmove'] = (int) ($state['fullmove'] ?? 1);

        return $state;
    }

    public static function colorOf(string $piece): string
    {
        return str_starts_with($piece, 'white_')
            ? 'white'
            : 'black';
    }

    public static function opposite(string $color): string
    {
        return $color === 'white' ? 'black' : 'white';
    }

    public static function pieceType(string $piece): string
    {
        return explode('_', $piece, 2)[1];
    }

    public static function isValidSquare(string $square): bool
    {
        return preg_match('/^[a-h][1-8]$/', $square) === 1;
    }

    private static function coords(string $square): array
    {
        return [
            ord($square[0]) - ord('a'),
            (int) $square[1] - 1,
        ];
    }

    private static function square(int $file, int $rank): ?string
    {
        if ($file < 0 || $file > 7 || $rank < 0 || $rank > 7) {
            return null;
        }

        return chr(ord('a') + $file) . ($rank + 1);
    }

    private static function pathClear(
        array $board,
        string $from,
        string $to
    ): bool {
        [$fx, $fy] = self::coords($from);
        [$tx, $ty] = self::coords($to);

        $dx = $tx <=> $fx;
        $dy = $ty <=> $fy;

        $x = $fx + $dx;
        $y = $fy + $dy;

        while ($x !== $tx || $y !== $ty) {
            $sq = self::square($x, $y);

            if ($sq !== null && isset($board[$sq])) {
                return false;
            }

            $x += $dx;
            $y += $dy;
        }

        return true;
    }

    private static function attacksSquare(
        array $board,
        string $from,
        string $target
    ): bool {
        if (!self::isValidSquare($from) || !self::isValidSquare($target)) {
            return false;
        }

        $piece = $board[$from] ?? null;

        if (!$piece) {
            return false;
        }

        $color = self::colorOf($piece);
        $type = self::pieceType($piece);

        [$fx, $fy] = self::coords($from);
        [$tx, $ty] = self::coords($target);

        $dx = $tx - $fx;
        $dy = $ty - $fy;

        switch ($type) {
            case 'pawn':
                $direction = $color === 'white' ? 1 : -1;

                return $dy === $direction
                    && abs($dx) === 1;

            case 'knight':
                return (
                    abs($dx) === 1 && abs($dy) === 2
                ) || (
                    abs($dx) === 2 && abs($dy) === 1
                );

            case 'king':
                return max(abs($dx), abs($dy)) === 1;

            case 'bishop':
                if (abs($dx) !== abs($dy)) {
                    return false;
                }

                return self::pathClear($board, $from, $target);

            case 'rook':
                if ($dx !== 0 && $dy !== 0) {
                    return false;
                }

                return self::pathClear($board, $from, $target);

            case 'queen':
                if (
                    $dx !== 0 &&
                    $dy !== 0 &&
                    abs($dx) !== abs($dy)
                ) {
                    return false;
                }

                return self::pathClear($board, $from, $target);
        }

        return false;
    }

    public static function isSquareAttacked(
        array $board,
        string $square,
        string $byColor
    ): bool {
        foreach ($board as $from => $piece) {
            if (!self::isValidSquare($from)) {
                continue;
            }

            if (self::colorOf($piece) !== $byColor) {
                continue;
            }

            if (self::attacksSquare($board, $from, $square)) {
                return true;
            }
        }

        return false;
    }

    public static function findKing(
        array $board,
        string $color
    ): ?string {
        foreach ($board as $square => $piece) {
            if (
                self::isValidSquare($square) &&
                $piece === "{$color}_king"
            ) {
                return $square;
            }
        }

        return null;
    }

    public static function isInCheck(
        array $board,
        string $color
    ): bool {
        $king = self::findKing($board, $color);

        if (!$king) {
            return true;
        }

        return self::isSquareAttacked(
            $board,
            $king,
            self::opposite($color)
        );
    }

    private static function pseudoMoves(
        array $state,
        string $from,
        string $color
    ): array {
        $board = $state['board'];
        $piece = $board[$from] ?? null;

        if (!$piece || self::colorOf($piece) !== $color) {
            return [];
        }

        $type = self::pieceType($piece);

        [$fx, $fy] = self::coords($from);

        $moves = [];

        $add = function (int $x, int $y) use (&$moves, $board, $color) {
            $sq = self::square($x, $y);

            if (!$sq) {
                return false;
            }

            if (
                isset($board[$sq]) &&
                self::colorOf($board[$sq]) === $color
            ) {
                return false;
            }

            $moves[] = $sq;

            return !isset($board[$sq]);
        };

        if ($type === 'pawn') {
            $direction = $color === 'white' ? 1 : -1;
            $startRank = $color === 'white' ? 1 : 6;

            $one = self::square(
                $fx,
                $fy + $direction
            );

            if ($one && !isset($board[$one])) {
                $moves[] = $one;

                if ($fy === $startRank) {
                    $two = self::square(
                        $fx,
                        $fy + ($direction * 2)
                    );

                    if ($two && !isset($board[$two])) {
                        $moves[] = $two;
                    }
                }
            }

            foreach ([-1, 1] as $dx) {
                $capture = self::square(
                    $fx + $dx,
                    $fy + $direction
                );

                if (!$capture) {
                    continue;
                }

                if (
                    isset($board[$capture]) &&
                    self::colorOf($board[$capture]) !== $color
                ) {
                    $moves[] = $capture;
                }

                if (
                    $state['en_passant'] === $capture
                ) {
                    $moves[] = $capture;
                }
            }

            return $moves;
        }

        if ($type === 'knight') {
            foreach ([
                [1, 2],
                [2, 1],
                [-1, 2],
                [-2, 1],
                [1, -2],
                [2, -1],
                [-1, -2],
                [-2, -1],
            ] as [$dx, $dy]) {
                $add($fx + $dx, $fy + $dy);
            }

            return $moves;
        }

        if ($type === 'king') {
            for ($dx = -1; $dx <= 1; $dx++) {
                for ($dy = -1; $dy <= 1; $dy++) {
                    if ($dx === 0 && $dy === 0) {
                        continue;
                    }

                    $add($fx + $dx, $fy + $dy);
                }
            }

            /*
             * Castling
             */
            $rank = $color === 'white' ? 0 : 7;

            $kingSquare = self::square(4, $rank);

            if ($from === $kingSquare) {
                $enemy = self::opposite($color);

                if (
                    $state['castling']["{$color}_kingside"] ?? false
                ) {
                    $rook = self::square(7, $rank);
                    $f = self::square(5, $rank);
                    $g = self::square(6, $rank);

                    if (
                        isset($board[$rook]) &&
                        $board[$rook] === "{$color}_rook" &&
                        !isset($board[$f]) &&
                        !isset($board[$g]) &&
                        !self::isInCheck($board, $color) &&
                        !self::isSquareAttacked($board, $f, $enemy) &&
                        !self::isSquareAttacked($board, $g, $enemy)
                    ) {
                        $moves[] = $g;
                    }
                }

                if (
                    $state['castling']["{$color}_queenside"] ?? false
                ) {
                    $rook = self::square(0, $rank);
                    $b = self::square(1, $rank);
                    $c = self::square(2, $rank);
                    $d = self::square(3, $rank);

                    if (
                        isset($board[$rook]) &&
                        $board[$rook] === "{$color}_rook" &&
                        !isset($board[$b]) &&
                        !isset($board[$c]) &&
                        !isset($board[$d]) &&
                        !self::isInCheck($board, $color) &&
                        !self::isSquareAttacked($board, $c, $enemy) &&
                        !self::isSquareAttacked($board, $d, $enemy)
                    ) {
                        $moves[] = $c;
                    }
                }
            }

            return $moves;
        }

        $directions = [];

        if ($type === 'bishop' || $type === 'queen') {
            $directions = array_merge($directions, [
                [1, 1],
                [1, -1],
                [-1, 1],
                [-1, -1],
            ]);
        }

        if ($type === 'rook' || $type === 'queen') {
            $directions = array_merge($directions, [
                [1, 0],
                [-1, 0],
                [0, 1],
                [0, -1],
            ]);
        }

        foreach ($directions as [$dx, $dy]) {
            $x = $fx + $dx;
            $y = $fy + $dy;

            while (true) {
                $sq = self::square($x, $y);

                if (!$sq) {
                    break;
                }

                if (isset($board[$sq])) {
                    if (
                        self::colorOf($board[$sq]) !== $color
                    ) {
                        $moves[] = $sq;
                    }

                    break;
                }

                $moves[] = $sq;

                $x += $dx;
                $y += $dy;
            }
        }

        return $moves;
    }

    private static function applyMove(
        array $state,
        string $from,
        string $to,
        ?string $promotion = null
    ): array {
        $board = $state['board'];

        if (!isset($board[$from])) {
            throw new InvalidArgumentException('No piece exists on the source square.');
        }

        $piece = $board[$from];

        $color = self::colorOf($piece);
        $type = self::pieceType($piece);

        $captured = $board[$to] ?? null;

        /*
         * Remove the moving piece from its original square.
         */
        unset($board[$from]);

        /*
         * En passant capture.
         *
         * The destination square is empty because the captured pawn
         * is located directly behind the destination square.
         */
        if (
            $type === 'pawn' &&
            $state['en_passant'] !== null &&
            $to === $state['en_passant'] &&
            !isset($board[$to])
        ) {
            [$tx, $ty] = self::coords($to);

            $capturedRank = $color === 'white'
                ? $ty - 1
                : $ty + 1;

            $capturedSquare = self::square(
                $tx,
                $capturedRank
            );

            if ($capturedSquare !== null) {
                $enPassantPiece = $board[$capturedSquare] ?? null;

                if (
                    $enPassantPiece !== null &&
                    self::pieceType($enPassantPiece) === 'pawn' &&
                    self::colorOf($enPassantPiece) !== $color
                ) {
                    $captured = $enPassantPiece;

                    unset($board[$capturedSquare]);
                }
            }
        }

        /*
         * Castling.
         *
         * The validator should already have confirmed that
         * the castle is legal. Here we only move the rook.
         */
        if ($type === 'king') {
            [$fx, $fy] = self::coords($from);
            [$tx, $ty] = self::coords($to);

            if (abs($tx - $fx) === 2) {
                $rank = $color === 'white' ? 0 : 7;

                /*
                 * Kingside castling:
                 *
                 * e1 -> g1
                 * h1 -> f1
                 *
                 * e8 -> g8
                 * h8 -> f8
                 */
                if ($tx > $fx) {
                    $rookFrom = self::square(7, $rank);
                    $rookTo = self::square(5, $rank);
                }

                /*
                 * Queenside castling:
                 *
                 * e1 -> c1
                 * a1 -> d1
                 *
                 * e8 -> c8
                 * a8 -> d8
                 */ else {
                    $rookFrom = self::square(0, $rank);
                    $rookTo = self::square(3, $rank);
                }

                if (
                    $rookFrom !== null &&
                    $rookTo !== null &&
                    isset($board[$rookFrom])
                ) {
                    $rook = $board[$rookFrom];

                    /*
                     * Only move the rook if it is actually
                     * the correct rook for this color.
                     */
                    if (
                        self::pieceType($rook) === 'rook' &&
                        self::colorOf($rook) === $color
                    ) {
                        $board[$rookTo] = $rook;

                        unset($board[$rookFrom]);
                    }
                }
            }
        }

        /*
         * Promotion.
         *
         * A pawn reaching rank 8 for white or rank 1 for black
         * must become a queen, rook, bishop, or knight.
         */
        if ($type === 'pawn') {
            $rank = (int) $to[1];

            $isPromotionRank =
                ($color === 'white' && $rank === 8) ||
                ($color === 'black' && $rank === 1);

            if ($isPromotionRank) {
                $promotion = strtolower($promotion ?? 'queen');

                if (
                    !in_array(
                        $promotion,
                        [
                            'queen',
                            'rook',
                            'bishop',
                            'knight',
                        ],
                        true
                    )
                ) {
                    throw new InvalidArgumentException(
                        'Invalid promotion piece.'
                    );
                }

                $piece = "{$color}_{$promotion}";
            }
        }

        /*
         * Place the moving piece on the destination square.
         */
        $board[$to] = $piece;

        /*
         * Update castling rights.
         */
        $castling = $state['castling'];

        /*
         * Moving the white king permanently removes
         * both white castling rights.
         */
        if ($type === 'king' && $color === 'white') {
            $castling['white_kingside'] = false;
            $castling['white_queenside'] = false;
        }

        /*
         * Moving the black king permanently removes
         * both black castling rights.
         */
        if ($type === 'king' && $color === 'black') {
            $castling['black_kingside'] = false;
            $castling['black_queenside'] = false;
        }

        /*
         * Moving or capturing the white queenside rook.
         */
        if ($from === 'a1' || $to === 'a1') {
            $castling['white_queenside'] = false;
        }

        /*
         * Moving or capturing the white kingside rook.
         */
        if ($from === 'h1' || $to === 'h1') {
            $castling['white_kingside'] = false;
        }

        /*
         * Moving or capturing the black queenside rook.
         */
        if ($from === 'a8' || $to === 'a8') {
            $castling['black_queenside'] = false;
        }

        /*
         * Moving or capturing the black kingside rook.
         */
        if ($from === 'h8' || $to === 'h8') {
            $castling['black_kingside'] = false;
        }

        /*
         * En passant target.
         *
         * Only a pawn that moves exactly two ranks creates
         * an en passant target.
         */
        $enPassant = null;

        if ($type === 'pawn') {
            [$fx, $fy] = self::coords($from);
            [$tx, $ty] = self::coords($to);

            if (abs($ty - $fy) === 2) {
                $middleRank = ($fy + $ty) / 2;

                $enPassant = self::square(
                    $fx,
                    (int) $middleRank
                );
            }
        }

        /*
         * Halfmove clock.
         *
         * Reset after:
         * - any pawn move
         * - any capture
         *
         * Otherwise increment it.
         */
        $halfmove = $state['halfmove'];

        if (
            $type === 'pawn' ||
            $captured !== null
        ) {
            $halfmove = 0;
        } else {
            $halfmove++;
        }

        /*
         * Fullmove number increments after Black's move.
         */
        $fullmove = $state['fullmove'];

        if ($color === 'black') {
            $fullmove++;
        }

        return [
            'board' => $board,
            'castling' => $castling,
            'en_passant' => $enPassant,
            'halfmove' => $halfmove,
            'fullmove' => $fullmove,
        ];
    }

    public static function legalMoves(
        array $state,
        string $from,
        string $color
    ): array {
        $board = $state['board'];
        $piece = $board[$from] ?? null;

        if (!$piece || self::colorOf($piece) !== $color) {
            return [];
        }

        $moves = self::pseudoMoves(
            $state,
            $from,
            $color
        );

        $legal = [];

        foreach ($moves as $to) {
            try {
                $next = self::applyMove(
                    $state,
                    $from,
                    $to,
                    'queen'
                );
            } catch (\Throwable) {
                continue;
            }

            if (
                !self::isInCheck(
                    $next['board'],
                    $color
                )
            ) {
                $legal[] = $to;
            }
        }

        return $legal;
    }

    public static function allLegalMoves(
        array $state,
        string $color
    ): array {
        $moves = [];

        foreach ($state['board'] as $from => $piece) {
            if (!self::isValidSquare($from)) {
                continue;
            }

            if (self::colorOf($piece) !== $color) {
                continue;
            }

            foreach (
                self::legalMoves(
                    $state,
                    $from,
                    $color
                ) as $to
            ) {
                $moves[] = [
                    'from' => $from,
                    'to' => $to,
                ];
            }
        }

        return $moves;
    }

    public static function makeMove(
        array $state,
        string $from,
        string $to,
        string $color,
        ?string $promotion = null
    ): array {
        if (
            !self::isValidSquare($from) ||
            !self::isValidSquare($to)
        ) {
            throw new InvalidArgumentException(
                'Invalid chess square.'
            );
        }

        $board = $state['board'];

        $piece = $board[$from] ?? null;

        if (!$piece) {
            throw new InvalidArgumentException(
                'There is no piece on that square.'
            );
        }

        if (self::colorOf($piece) !== $color) {
            throw new InvalidArgumentException(
                'You cannot move the opponent\'s piece.'
            );
        }

        $legalMoves = self::legalMoves(
            $state,
            $from,
            $color
        );

        if (!in_array($to, $legalMoves, true)) {
            throw new InvalidArgumentException(
                'That is not a legal chess move.'
            );
        }

        $type = self::pieceType($piece);

        $destinationRank = (int) $to[1];

        $needsPromotion =
            $type === 'pawn' &&
            (
                ($color === 'white' && $destinationRank === 8) ||
                ($color === 'black' && $destinationRank === 1)
            );

        if ($needsPromotion) {
            $promotion = strtolower($promotion ?? 'queen');

            if (
                !in_array(
                    $promotion,
                    ['queen', 'rook', 'bishop', 'knight'],
                    true
                )
            ) {
                throw new InvalidArgumentException(
                    'Promotion must be queen, rook, bishop, or knight.'
                );
            }
        }

        $nextState = self::applyMove(
            $state,
            $from,
            $to,
            $promotion
        );

        $opponent = self::opposite($color);

        $inCheck = self::isInCheck(
            $nextState['board'],
            $opponent
        );

        $opponentMoves = self::allLegalMoves(
            $nextState,
            $opponent
        );

        $checkmate = $inCheck && count($opponentMoves) === 0;
        $stalemate = !$inCheck && count($opponentMoves) === 0;

        return [
            'state' => $nextState,
            'captured_piece' => $this->capturedPiece(
                $state,
                $from,
                $to
            ),
            'promotion_piece' => $needsPromotion
                ? $promotion
                : null,
            'check' => $inCheck,
            'checkmate' => $checkmate,
            'stalemate' => $stalemate,
        ];
    }

    private static function capturedPiece(
        array $state,
        string $from,
        string $to
    ): ?string {
        $board = $state['board'];

        if (isset($board[$to])) {
            return $board[$to];
        }

        $piece = $board[$from] ?? null;

        if (!$piece || self::pieceType($piece) !== 'pawn') {
            return null;
        }

        if ($state['en_passant'] !== $to) {
            return null;
        }

        $color = self::colorOf($piece);

        [$tx, $ty] = self::coords($to);

        $capturedRank = $color === 'white'
            ? $ty - 1
            : $ty + 1;

        $capturedSquare = self::square(
            $tx,
            $capturedRank
        );

        return $capturedSquare
            ? ($board[$capturedSquare] ?? null)
            : null;
    }
}
