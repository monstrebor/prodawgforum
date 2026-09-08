<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\ClashOfClansService;

class ClashOfClanController extends Controller
{
    protected ClashOfClansService $coc;

    public function __construct(ClashOfClansService $coc)
    {
        $this->coc = $coc;
    }

    public function index(Request $request)
    {
        $clanData = null;
        $playerData = null;
        $error = null;

        $type = $request->input('type', 'clan');
        $tag = $request->input('tag');

        if ($tag) {

            $formattedTag = '#' . ltrim($tag, '#');

            if ($type === 'player') {

                $playerData = $this->coc->getPlayer($formattedTag);

                if (!$playerData) {
                    $error = 'Player not found or API request failed.';
                }

            } else {

                $clanData = $this->coc->getClan($formattedTag);

                if (!$clanData) {
                    $error = 'Clan not found or API request failed.';
                }

            }
        }

        return view('clash-of-clan.index', [
            'type' => $type,
            'searchedTag' => $tag,
            'clan' => $clanData,
            'player' => $playerData,
            'error' => $error,
        ]);
    }
}
