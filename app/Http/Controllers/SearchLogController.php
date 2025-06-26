<?php
/**
 * Class SearchLogController
 *
 * @author Subin <subinrabin@gmail.com>
 */

namespace App\Http\Controllers;

use App\Models\SearchLog;
use Illuminate\Http\Request;

class SearchLogController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->user() || !$request->user()->is_admin) {
            return response()->json(['message' => 'Unauthenticated'], 403);
        }

        $perPage = $request->get('per_page', 10);

        $topTerms = SearchLog::select('query')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('query')
            ->orderByDesc('count')
            ->paginate($perPage); // ✅ pagination added

        return response()->json($topTerms);
    }
}
