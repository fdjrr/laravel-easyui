<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function tree(Request $request): JsonResponse
    {
        $id = $request->id;

        if ($id) {
            $menu = Menu::find($id);
            if ($menu) {
                $results = collect($menu->childrens)->map(function ($child) {
                    $link = $child->name;

                    $is_children = $child->childrens()->count() > 0 ? true : false;

                    if (! $is_children) {
                        $href = route($child->route);

                        $link = "<a href='#' onClick=\"loadContent('{$child->name}','{$href}')\">{$child->name}</a>";
                    }

                    return [
                        'id'    => $child->id,
                        'text'  => $link,
                        'state' => $is_children ? 'closed' : 'open',
                    ];
                })->toArray();
            }
        } else {
            $menus = Menu::query()->whereNull('parent_id')->get();

            $results = collect($menus)->map(function ($menu) {
                $link = $menu->name;

                $is_children = $menu->childrens()->count() > 0 ? true : false;

                if (! $is_children) {
                    $href = route($menu->route);

                    $link = "<a href='#' onClick='loadContent('{$menu->name}','{$href}')'>{$menu->name}</a>";
                }

                return [
                    'id'    => $menu->id,
                    'text'  => $link,
                    'state' => $is_children ? 'closed' : 'open',
                ];
            })->toArray();
        }

        return response()->json($results);
    }
}
