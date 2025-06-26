<?php
/**
 * Class SearchController
 *
 * @author Subin <subinrabin@gmail.com>
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\Product;
use App\Models\Page;
use App\Models\Faq;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Resources\SearchResultResource;
use App\Models\SearchLog;
use App\Jobs\LogSearchQuery;

class SearchController extends Controller
{
  public function search(Request $request)
  {
    $query = $request->input('q');
    $page = $request->input('page') ?? 1;
    $perPage = $request->input('perPage') ?? 10;
    $page = LengthAwarePaginator::resolveCurrentPage();

    if (!$query) {
      // return response()->json([
      //     'message' => 'Query parameter `q` is required.',
      // ], 400);
    }

    // Fetch from Scout-enabled models using MeiliSearch fuzzy matching
    $blogResults = BlogPost::search($query)->get();
    $productResults = Product::search($query)->get();
    $pageResults = Page::search($query)->get();
    $faqResults = Faq::search($query)->get();

    // Merge & sort
    $merged = collect()
      ->merge($blogResults)
      ->merge($productResults)
      ->merge($pageResults)
      ->merge($faqResults)
      ->sortByDesc(fn($item) => $item->updated_at ?? $item->created_at)
      ->values();

    // Paginate merged results
    $paginated = new LengthAwarePaginator(
      $merged->forPage($page, $perPage),
      $merged->count(),
      $perPage,
      $page,
      ['path' => $request->url(), 'query' => $request->query()]
    );

    SearchLog::create([
        'query' => $query??'',
        'user_id' => 1,
        // 'user_id' => auth()->id(),
    ]);

    // $user_id = auth()->id();
    $user_id = 1;
    LogSearchQuery::dispatch($query ?? '', $user_id);

    return SearchResultResource::collection($paginated);
  }
  public function suggestions(Request $request)
  {
    $query = $request->input('q');
    $page = $request->input('page') ?? 1;
    $perPage = $request->input('perPage') ?? 10;
    $page = LengthAwarePaginator::resolveCurrentPage();


    if (!$query) {
      // return response()->json([], 200);
    }

    // Search top 3 results per model
    $results = collect()
      ->merge(BlogPost::search($query)->take(3)->get())
      ->merge(Product::search($query)->take(3)->get())
      ->merge(Page::search($query)->take(3)->get())
      ->merge(Faq::search($query)->take(3)->get())
      ->sortByDesc(fn($item) => $item->updated_at ?? $item->created_at)
      ->values()
      ->map(function ($item) {
        return [
          'type' => class_basename($item),
          'title' => $item->title ?? $item->name ?? $item->question,
          'id' => $item->id
        ];
      });

    // Paginate merged results
    $paginated = new LengthAwarePaginator(
      $results->forPage($page, $perPage),
      $results->count(),
      $perPage,
      $page,
      ['path' => $request->url(), 'query' => $request->query()]
    );

    return response()->json($paginated);
  }
}
