<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function getCategoriesAndNews(Request $request)
    {
        try {
            $categories = Category::where('status', true)
                ->orderBy('orderby', 'asc')
                ->get();

            $categoryData = [];
            $categoryData[0] = [
                'id' => 0,
                'title' => 'ទាំងអស់',
            ];

            foreach ($categories as $row) {
                $categoryData[$row->id] = [
                    'id' => $row->id,
                    'title' => $row->name,
                ];
            }

            $newsQuery = News::join('categories', 'news.categories_id', '=', 'categories.id')
                ->join('users', 'news.user_id', '=', 'users.id')
                ->select(
                    'news.id',
                    'news.title as news_title',
                    'news.created_at as created_at',
                    'news.short_description as short_description',
                    'news.thumbnail',
                    'news.pin',
                    'users.name as user',
                    'users.image as user_profile',
                    'categories.name as category',
                    'categories.id as categories_id',
                )
                ->where('news.status', true);

            if ($request->has('categories_id')) {
                if ($request->categories_id != 0) {
                    $newsQuery->where('news.categories_id', $request->categories_id);
                }
                $newsQuery->orderByDesc('news.orderby')
                    ->orderByDesc('news.pinned_at');
            } else {
                $newsQuery->orderByDesc('news.pin')
                    ->orderByDesc('news.pinned_at')
                    ->orderByDesc('news.orderby');
            }

            $newsResponses = $newsQuery->paginate($request->pagination ?? 5);

            $newsData = [];
            foreach ($newsResponses as $row) {
                $newsData[] = [
                    'id' => $row->id,
                    'categories_id' => $row->categories_id,
                    'category' => $row->category,
                    'title' => $row->news_title,
                    'created_at' => release_date($row->created_at),
                    'short_description' => $row->short_description,
                    'thumbnail' => $row->thumbnail != null
                    ? asset("/storage/news/thumbnail/$row->thumbnail")
                    : asset("/assets/images/others/placeholder.jpg"),
                    'user' => $row->user,
                    'user_profile' => $row->user_profile != null
                    ? asset("/storage/news/user/$row->user_profile")
                    : asset("/assets/images/others/placeholder.jpg"),
                ];
            }

            return $this->normalResponse([
                'categories' => array_values($categoryData),
                'news' => $newsData,
            ]);

        } catch (\Throwable $throwable) {
            return $this->errorsResponse($throwable);
        }
    }

    public function getSingleNews(Request $request)
    {
        try {
            $responses = News::join('users', 'news.user_id', '=', 'users.id')
                ->join('news_albums', 'news.id', '=', 'news_albums.news_id')
                ->select(
                    'news.id',
                    'news.title as news_title',
                    'news.created_at as created_at',
                    'news.content',
                    'news.count_album',
                    'news.orderby',
                    'news_albums.id as albums_id',
                    'news_albums.name as name',
                    'news_albums.primary',
                    'news.thumbnail',
                    'users.name as user',
                    'users.image as user_profile',
                    'users.id as user_id',
                )
                ->where('news.id', '=', $request->id)
                ->get();
            if ($responses->count()) {
                foreach ($responses as $row) {
                    $data[$row->id]['id'] = $row->id;
                    $data[$row->id]['user_id'] = $row->user_id;
                    $data[$row->id]['username'] = $row->user;
                    $data[$row->id]['title'] = $row->news_title;
                    $data[$row->id]['share'] = url("/get-news/{$row->id}");
                    $data[$row->id]['created_at'] = release_date($row->created_at);
                    $data[$row->id]['orderby'] = $row->orderby;
                    if ($row->thumbnail != '404') {
                        $data[$row->id]['thumbnail'] = asset("/storage/image/news/thumbnail/$row->thumbnail");
                    } else {
                        $data[$row->id]['thumbnail'] = asset("/assets/images/others/placeholder.jpg");
                    }
                    if ($row->user_profile != null) {
                        $data[$row->id]['user_profile'] = asset("/storage/image/news/user_profile/$row->user_profile");
                    } else {
                        $data[$row->id]['user_profile'] = asset("/assets/images/others/placeholder.jpg");
                    }
                    if ($row->count_album) {
                        $albums[$row->id][$row->albums_id]['albums_id'] = $row->albums_id;
                        $albums[$row->id][$row->albums_id]['name'] = asset("/storage/image/news/albums/$row->name");
                        $albums[$row->id][$row->albums_id]['primary'] = $row->primary;
                        $data[$row->id]['albums'] = array_values($albums[$row->id]);
                    }
                    $data[$row->id]['content'] = $row->content;
                }
                return $this->normalResponse(array_values($data));
            }
            return $this->noDataAvailable();
        } catch (\Throwable $throwable) {
            return $this->errorsResponse($throwable);
        }
    }

    public function getUserNews(Request $request)
    {
        try {
            $categories = Category::where('status', true)
                ->orderBy('orderby', 'asc')
                ->get();

            $categoryData = [];
            $categoryData[0] = [
                'id' => 0,
                'title' => 'ទាំងអស់',
            ];

            foreach ($categories as $row) {
                $categoryData[$row->id] = [
                    'id' => $row->id,
                    'title' => $row->name,
                ];
            }

            $newsQuery = News::join('categories', 'news.user_id', '=', 'categories.id')
                ->join('users', 'news.user_id', '=', 'users.id')
                ->select(
                    'news.id',
                    'news.title as news_title',
                    'news.created_at as created_at',
                    'news.short_description as short_description',
                    'news.thumbnail',
                    'news.pin',
                    'users.name as user',
                    'users.image as user_profile',
                    'categories.name as category',
                )
                ->where('news.status', true)
                ->where('news.user_id', $request->user_id);

            if ($request->has('categories_id')) {
                if ($request->categories_id != 0) {
                    $newsQuery->where('news.categories_id', $request->categories_id);
                }
                $newsQuery->orderByDesc('news.orderby')
                    ->orderByDesc('news.pinned_at');
            } else {
                $newsQuery->orderByDesc('news.pin')
                    ->orderByDesc('news.pinned_at')
                    ->orderByDesc('news.orderby');
            }

            $newsResponses = $newsQuery->paginate($request->pagination ?? 5);

            $newsData = [];
            foreach ($newsResponses as $row) {
                $newsData[] = [
                    'id' => $row->id,
                    'category' => $row->category,
                    'title' => $row->news_title,
                    'created_at' => release_date($row->created_at),
                    'short_description' => $row->short_description,
                    'thumbnail' => $row->thumbnail != null
                    ? asset("/storage/news/thumbnail/$row->thumbnail")
                    : asset("/assets/images/others/placeholder.jpg"),
                    'user' => $row->user,
                    'user_profile' => $row->user_profile != null
                    ? asset("/storage/news/user/$row->user_profile")
                    : asset("/assets/images/others/placeholder.jpg"),
                ];
            }

            return $this->normalResponse([
                'categories' => array_values($categoryData),
                'news' => $newsData,
            ]);

        } catch (\Throwable $throwable) {
            return $this->errorsResponse($throwable);
        }
    }

    public function getBreakingNews(Request $request)
    {
        try {

            $newsResponses = News::select(
                'news.id',
                'news.thumbnail',
            )
                ->where('news.status', true)
                ->latest()
                ->take(5)
                ->get();

            if ($newsResponses->count()) {
                foreach ($newsResponses as $row) {
                    $newsData[] = [
                        'id' => $row->id,
                        'thumbnail' => $row->thumbnail != null
                        ? asset("/storage/news/thumbnail/$row->thumbnail")
                        : asset("/assets/images/others/placeholder.jpg"),
                    ];
                }
                return $this->normalResponse(array_values($newsData));
            }
            return $this->noDataAvailable();
        } catch (\Throwable $throwable) {
            return $this->errorsResponse($throwable);
        }
    }

    public function searchNews(Request $request)
    {
        try {
            // Retrieve and sanitize input parameters
            $query = trim($request->input('query', ''));
            $start_date = $request->start ? date('Y-m-d', strtotime($request->start)) : null;
            $end_date = $request->end ? date('Y-m-d', strtotime($request->end)) : null;

            // Fetch users with optional search query
            $users = User::select('id', 'name', 'image as user_profile')
                ->when($query !== '', function ($queryBuilder) use ($query) {
                    return $queryBuilder->where('users.name', 'like', "%$query%");
                })
                ->get()
                ->map(function ($row) {
                    return [
                        'id' => $row->id,
                        'name' => $row->name,
                        'user_profile' => $row->user_profile
                        ? asset("/storage/news/user/{$row->user_profile}")
                        : asset("/assets/images/others/placeholder.jpg"),
                    ];
                });

            // Fetch news with optional search query and pagination
            $news = News::select(
                'news.id',
                'news.title as news_title',
                'news.created_at as created_at',
                'news.short_description as short_description',
                'news.thumbnail',
                'users.name as user',
                'users.image as user_profile',
                'categories.name as category'
            )
                ->join('users', 'news.user_id', '=', 'users.id')
                ->join('categories', 'news.categories_id', '=', 'categories.id')
                ->where('news.status', true)
                ->when($query !== '', function ($queryBuilder) use ($query) {
                    return $queryBuilder->where('news.title', 'like', "%$query%");
                })
            // Apply pagination based on request parameter (default 5)
                ->paginate($request->pagination ?? 5)
                ->map(function ($row) {
                    return [
                        'id' => $row->id,
                        'news_title' => $row->news_title,
                        'created_at' => release_date($row->created_at),
                        'short_description' => $row->short_description,
                        'thumbnail' => $row->thumbnail
                        ? asset("/storage/news/thumbnail/{$row->thumbnail}")
                        : asset("/assets/images/others/placeholder.jpg"),
                        'user' => $row->user,
                        'user_profile' => $row->user_profile
                        ? asset("/storage/news/user/{$row->user_profile}")
                        : asset("/assets/images/others/placeholder.jpg"),
                        'category' => $row->category,
                    ];
                });

            // Return the response with users and paginated news data
            $data = [
                'users' => $users,
                'news' => $news,
            ];

            return $this->normalResponse($data);

        } catch (\Throwable $throwable) {
            return $this->errorsResponse($throwable);
        }
    }

    public function SaveNews(Request $request)
    {
        try {
            // Find the news item by ID
            $news = News::find($request->id);

            if (!$news) {
                return $this->noDataAvailable('News item not found');
            }

            // Toggle the 'save' status
            $news->save = !$news->save;
            $news->save();

            $message = $news->save
            ? "News saved successfully"
            : "News unsaved successfully";

            return $this->normalResponse($message);
        } catch (\Throwable $throwable) {
            return $this->errorsResponse($throwable);
        }
    }

    public function fetchSavedNews()
    {
        try {
            // Fetch news data with joins and filters
            $newsQuery = News::join('categories', 'news.categories_id', '=', 'categories.id') // Fixed join key to use 'category_id'
                ->join('users', 'news.user_id', '=', 'users.id')
                ->select(
                    'news.id',
                    'news.title as news_title',
                    'news.created_at',
                    'news.short_description',
                    'news.thumbnail',
                    'news.pin',
                    'users.name as user',
                    'users.image as user_profile',
                    'categories.name as category'
                )
                ->where('news.status', true)
                ->where('news.save', true) // Ensure 'news.save' column exists
                ->get();

            // Check if data exists
            if ($newsQuery->isNotEmpty()) {
                $newsData = $newsQuery->map(function ($row) {
                    return [
                        'id' => $row->id,
                        'category' => $row->category,
                        'title' => $row->news_title,
                        'created_at' => release_date($row->created_at),
                        'short_description' => $row->short_description,
                        'thumbnail' => $row->thumbnail
                        ? asset("/storage/news/thumbnail/$row->thumbnail")
                        : asset("/assets/images/others/placeholder.jpg"),
                        'user' => $row->user,
                        'user_profile' => $row->user_profile
                        ? asset("/storage/news/user/$row->user_profile")
                        : asset("/assets/images/others/placeholder.jpg"),
                    ];
                });

                // Return formatted response
                return $this->normalResponse($newsData->toArray());
            }

            return $this->noDataAvailable('No saved news found');
        } catch (\Throwable $throwable) {
            return $this->errorsResponse($throwable);
        }
    }

}
